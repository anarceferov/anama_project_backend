<?php

namespace App\Http\Controllers;

use App\Models\Quality;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QualityController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $qualities = Quality::query()->with('image')->get();
        return response($qualities);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required',
            'image_uuid' => 'required',
         ]);


        if($validated->fails())
        {
            return response(['message' => 'validate fail']);
        }

        $employee_id = null;
        DB::transaction(function () use ($request, &$employee_id) {
        $employee = new Quality();
            $employee->fill($request->only([
                'text',
                'text_en',
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
         ]);


        if($validated->fails())
        {
            return response(['message' => 'validate fail']);
        }

        try {
            DB::transaction(function () use ($request, $id) {
                Quality::findOrFail($id)->update([
                    'text'=>$request->date,
                    'text_en'=>$request->title,
                    'file_uuid'=>$request->file_uuid
                ]);
            });
    
            return $this->dataResponse(['message' => 'success']);
        } catch (\Throwable $th) {
            return response($th);
        }
    }

    public function destroy($id)
    {
        Quality::findOrFail($id)->delete();
        return response(['message'=>'success delete']);
    }
}
