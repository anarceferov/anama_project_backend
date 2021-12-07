<?php

namespace App\Http\Controllers;

use App\Models\Imsma;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ImsmaLocale;

class ImsmaController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $imsmas = Imsma::query()->with('image' , 'locales')->get();
        return response($imsmas);
    }

    public function store(Request $request)
    {
        $imsma_id = null;
        DB::transaction(function () use ($request, &$imsma_id) {
            $imsma = new Imsma();
            $imsma->fill($request->only([
                'image_uuid'
            ]));
            $imsma->save();

            $imsma->setLocales($request->input("locales"));

            $imsma_id = $imsma->id;
        });

        return $this->dataResponse(['imsma_id' => $imsma_id], 201);
    }


    public function update(Request $request, $id)
    {

        DB::transaction(function () use ($request, $id) {
            $imsma = Imsma::findOrFail($id);

            $imsma->fill($request->only([
                'image_uuid'
            ]));
            $imsma->save();

            $imsma->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }

    public function destroy($id)
    {

        DB::transaction(function () use ($id) {
            $imsma = Imsma::findOrFail($id);

            $imsma->imsmaLocales()->delete();

            $imsma->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }


    public function show($id)
    {
        $imsma = Imsma::with('image' , 'locales')->where('id' , $id)->first();
        return $this->dataResponse($imsma);
    }
}
