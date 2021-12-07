<?php

namespace App\Http\Controllers;

use App\Models\Quality;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\QualityLocale;

class QualityController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $qualities = Quality::query()->with('image', 'locales')->get();
        return response($qualities);
    }


    public function store(Request $request)
    {

        $quality_id = null;
        DB::transaction(function () use ($request, &$quality_id) {
            $quality = new Quality();
            $quality->fill($request->only([
                'image_uuid'
            ]));
            $quality->save();

            $quality->setLocales($request->input("locales"));

            $quality_id = $quality->id;
        });

        return $this->dataResponse(['quality_id' => $quality_id], 201);
    }



    public function update(Request $request, $id)
    {

        DB::transaction(function () use ($request, $id) {
            $quality = Quality::findOrFail($id);
            $quality->fill($request->only([
                'image_uuid'
            ]));

            $quality->save();

            $quality->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }



    public function destroy($id)
    {

        DB::transaction(function () use ($id) {
            $quality = Quality::findOrFail($id);

            $quality->qualityLocales()->delete();

            $quality->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }


    public function show($id)
    {
        $quality = Quality::with('image' , 'locales')->where('id' , $id)->first();
        return $this->dataResponse($quality);
    }
}
