<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $employees = Employee::query()->with('image')->orderBy('order' , 'asc')->get();
        return response($employees);
    }

    
    public function store(Request $request)
    {
        // $validated = Validator::make($request->all(), [
        //     'text' => 'required',
        //     // 'image_uuid' => 'required',
        //     'position_name' => 'required',
        //     'order' => 'required|numeric|unique:employees',
        //     'position_name_en' => 'required'
        //  ]);


        // if($validated->fails())
        // {
        //     return response(['message' => 'validate fail']);
        // }

        $employee_id = null;
        DB::transaction(function () use ($request, &$employee_id) {
            $employee = new Employee();
            $employee->fill($request->only([
                'text',
                'text_en',
                'position_name',
                'position_name_en',
                'order',
                'image_uuid'
            ]));
            $employee->save();
            $employee_id = $employee->id;
        });

        return $this->dataResponse(['employee_id' => $employee_id], 201);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'text' => 'required',
            'image_uuid' => 'required',
            'position_name' => 'required',
            'order' => 'required|numeric|unique:employees',
            'position_name_en' => 'required'
         ]);

         if($validated->fails())
         {
             return response(['message' => 'validate fail']);
         }

        try {
            DB::transaction(function () use ($request, $id) {
                Employee::findOrFail($id)->update([
                    'order'=>$request->order,
                    'text'=>$request->text,
                    'text_en'=>$request->text_en,
                    'image_uuid'=>$request->image_uuid,
                    'position_name'=>$request->position_name,
                    'position_name_en'=>$request->position_name_en
                ]);
            });
    
            return $this->dataResponse(['message' => 'success']);
        } catch (\Throwable $th) {
            return response($th);
        }
    }

    public function destroy($id)
    {
        Employee::findOrFail($id)->delete();
        return response(['message'=>'success delete']);
    }
}
