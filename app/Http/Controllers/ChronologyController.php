<?php

namespace App\Http\Controllers;

use App\Models\Chronology;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChronologyController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $chronologies = Chronology::query()->with('image')->orderBy('date' , 'asc')->get();
        return response($chronologies);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'text' => 'required',
            'image_uuid' => 'required'
         ]);


        if($validated->fails())
        {
            return response(['message' => 'fail']);
        }

        $chronology_id = null;
        DB::transaction(function () use ($request, &$chronology_id) {
            $chronology = new Chronology();
            $chronology->fill($request->only([
                'text',
                'text_en',
                'date',
                'image_uuid'
            ]));
            $chronology->save();
            $chronology_id = $chronology->id;
        });

        return $this->dataResponse(['about_id' => $chronology_id], 201);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'text' => 'required',
            'date' => 'numeric',
            'image_uuid' => 'required'
         ]);


        if($validated->fails())
        {
            return response(['message' => 'fail']);
        }

        try {
            DB::transaction(function () use ($request, $id) {
                $about = Chronology::findOrFail($id);
    
                $about->fill($request->only([
                    'text',
                    'text_en',
                    'date',
                    'image_uuid'
                ]));
                $about->save();
            });

            return $this->successResponse(trans('responses.ok'));
        } catch (\Throwable $th) {
            return response($th);
        }
    }
    
    public function destroy($id)
    {
        Chronology::findOrFail($id)->delete();
        return response(['message'=>'success delete']);
    }
}
