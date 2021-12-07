<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\EmployeeLocale;

class EmployeeController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $employees = Employee::query()->with('image', 'locales')->orderBy('order', 'asc')->get();
        return response($employees);
    }

    public function store(Request $request)
    {
        $employee_id = null;
        DB::transaction(function () use ($request, &$employee_id) {
            $employee = new Employee();
            $employee->fill($request->only([
                'order',
                'image_uuid'
            ]));
            $employee->save();

            $employee->setLocales($request->input("locales"));

            $employee_id = $employee->id;
        });

        return $this->dataResponse(['employee_id' => $employee_id], 201);
    }


    public function update(Request $request, $id)
    {

        DB::transaction(function () use ($request, $id) {
            $employee = Employee::findOrFail($id);

            $employee->fill($request->only([
                'order',
                'image_uuid'
            ]));
            $employee->save();

            $employee->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }

    public function destroy($id)
    {

        DB::transaction(function () use ($id) {
            $employee = Employee::findOrFail($id);

            $employee->employeeLocales()->delete();

            $employee->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }


    public function show($id)
    {
        $employee = Employee::with('image', 'locales')->where('id', $id)->first();
        return $this->dataResponse($employee);
    }
}
