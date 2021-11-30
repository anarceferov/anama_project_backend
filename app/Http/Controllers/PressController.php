<?php

namespace App\Http\Controllers;

use App\Models\Press;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Presses;

class PressController extends Controller
{
    use ApiResponder;
    public function index()
    {
        $presses = Press::query()->with('image')->get();
        return response($presses);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required',
            'date' => 'required',
            'file_uuid'=>'required'
        ]);

        if ($validated->fails()) {
            return response(['message' => 'fail']);
        }

        $press_id = null;
        DB::transaction(function () use ($request, &$press_id) {
            $press = Press::create([
                'date'=>$request->date,
                'title'=>$request->title,
                'title_en'=>$request->title_en,
                'file_uuid'=>$request->file_uuid
            ]);
            $press_id = $press->id;
        });

        return $this->dataResponse(['press_id' => $press_id], 201);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required',
            'date' => 'required',
            'file_uuid'=>'required'
        ]);

        if ($validated->fails()) {
            return response(['message' => 'fail']);
        }
        // return response(['data',$request->title]);

        try {
            DB::transaction(function () use ($request, $id) {
                Press::findOrFail($id)->update([
                    'date'=>$request->date,
                    'title'=>$request->title,
                    'title_en'=>$request->title_en,
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
        Press::findOrFail($id)->delete();
        return response(['message'=>'success delete']);
    }
}
