<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponder;
use App\Traits\Paginatable;
use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{

    use ApiResponder, Paginatable;

    private $perPage;

    public function index()
    {
        if (auth()->check()) {
            $partners = Partner::with('image', 'locales');
        } else {
            $partners = Partner::with('image', 'locale');
        }
        return $this->dataResponse($partners->simplePaginate($this->getPerPage()));
    }


    public function show($id)
    {
        if (auth()->check()) {
            $partner = Partner::with('image', 'locales')->findOrFail($id);
        } else {
            $partner = Partner::with('image', 'locale')->findOrFail($id);
        }
        return $this->dataResponse($partner);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request) {
            $partner = new Partner;
            $partner->image_uuid = $request->image_uuid;
            $partner->save();
            $partner->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans("responses.ok"));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $partner = Partner::findOrFail($id);
            $partner->image_uuid = $request->image_uuid;
            $partner->save();
            $partner->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $partner = Partner::findOrFail($id);

            $partner->locales()->delete();

            $partner->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }



    private function getValidationRules(): array
    {
        return [
            'image_uuid' => 'required|exists:files,id',
            'locales.*.local' => 'required',
            'locales.*.name' => 'required',
            'locales.*.text' => 'required',
        ];
    }

    public function customAttributes(): array
    {
        return [
            'image_uuid.required' => 'İmage id mütləqdir',
            'image_uuid.exists' => 'İmage id mövcud deyil',
            'locales.*.name.required' => 'Partnyor adı mütləqdir',
            'locales.*.text.required' => 'Mətn mütləqdir',
            'locales.*.local.required' => 'Dil seçimi mütləqdir'

        ];
    }
}
