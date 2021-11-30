<?php

namespace App\Http\Controllers;

use App\Models\ProcessesIcon;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProcessesIconController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $processesIcons = ProcessesIcon::query()->with('image' , 'icon')->get();
        return response($processesIcons);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'text' => 'required',
            'icon_uuid'=>'required',
            'image_uuid' =>'required',
        ]);


        if ($validated->fails()) {
            return response(['message' => 'validate fail']);
        }

        $about_id = null;
        DB::transaction(function () use ($request, &$about_id) {
            $about = new ProcessesIcon();
            $about->fill($request->only([
                'text',
                'text_en',
                'icon_uuid',
                'image_uuid'
            ]));
            $about->save();
            $about_id = $about->id;
        });

        return $this->dataResponse(['about_id' => $about_id], 201);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'text' => 'required',
            'icon_uuid'=>'required',
            'image_uuid' =>'required',
        ]);


        if ($validated->fails()) {
            return response(['message' => 'validate fail']);
        }

        try {
            DB::transaction(function () use ($request, $id) {
                ProcessesIcon::findOrFail($id)->update([
                    'text'=>$request->text,
                    'text_en'=>$request->text_en,
                    'icon_uuid'=>$request->icon_uuid,
                    'image_uuid'=>$request->image_uuid
                ]);
            });
    
            return $this->dataResponse(['message' => 'success']);
        } catch (\Throwable $th) {
            return response($th);
        }
    }

    public function destroy($id)
    {
        ProcessesIcon::findOrFail($id)->delete();
        return response(['message'=>'success delete']);
    }
}
