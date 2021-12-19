<?php

namespace App\Http\Controllers;

use App\Models\Imsma;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ImsmaLocale;
use App\Traits\Paginatable;

class ImsmaController extends Controller
{
    use ApiResponder, Paginatable;

    private $perPage;

    public function index()
    {
        if (auth()->check()) {
            $imsmas = Imsma::with('image', 'locales');
        } else {
            $imsmas = Imsma::with('image', 'locale');
        }
        return $this->dataResponse($imsmas->simplePaginate($this->getPerPage()));
    }


    public function show($id)
    {
        if (auth()->check()) {
            $imsma = Imsma::with('image', 'locales')->findOrFail($id);
        } else {
            $imsma = Imsma::with('image', 'locale')->findOrFail($id);
        }
        return $this->dataResponse($imsma);
    }

    
    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

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
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

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

            $imsma->locales()->delete();

            $imsma->delete();
        });

        return $this->successResponse(trans("responses.ok"));
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
