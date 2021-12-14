<?php

namespace App\Http\Controllers;

use App\Models\Quality;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\QualityLocale;
use App\Traits\Paginatable;

class QualityController extends Controller
{
    use ApiResponder, Paginatable;

    private $perPage;

    public function index()
    {
        if (auth()->check()) {
            $qualities = Quality::with('image', 'locales');
        } else {
            $qualities = Quality::with('image', 'locale');
        }
        return $this->dataResponse($qualities->simplePaginate($this->getPerPage()));
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

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
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

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

            $quality->locales()->delete();

            $quality->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }


    public function show($id)
    {
        if (auth()->check()) {
            $quality = Quality::with('image', 'locales')->findOrFail($id);
        } else {
            $quality = Quality::with('image', 'locale')->findOrFail($id);
        }
        return $this->dataResponse($quality);
    }


    private function getValidationRules(): array
    {
        return [
            'image_uuid' => 'required|exists:files,id',
            'locales.*.local' => 'required',
            'locales.*.text' => 'required',
        ];
    }

    public function customAttributes(): array
    {
        return [
            'image_uuid.required' => 'İmage id mütləqdir',
            'image_uuid.exists' => 'İmage id mövcud deyil',
            'locales.*.text.required' => 'Mətn mütləqdir',
            'locales.*.local.required' => 'Dil seçimi mütləqdir'
        ];
    }
}
