<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Traits\ApiResponder;
use App\Traits\Paginatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{

    use ApiResponder, Paginatable;

    private $perPage;

    public function index()
    {
        if (auth()->check()) {
            $banners = Banner::with('image', 'locales')->get();
        } else {
            $banners = banner::with('image', 'locale')->get();
        }
        return $this->dataResponse($banners);
    }


    public function show($id)
    {
        if (auth()->check()) {
            $banner = banner::with('image', 'locales')->findOrFail($id);
        } else {
            $banner = banner::with('image', 'locale')->findOrFail($id);
        }
        return $this->dataResponse($banner);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        $banner_id = null;
        DB::transaction(function () use ($request, &$banner_id) {
            $banner = new banner;
            $banner->image_uuid = $request->image_uuid;
            $banner->created_at = now();
            $banner->save();

            $banner->setLocales($request->input("locales"));

            $banner_id = $banner->id;
        });

        return $this->dataResponse(['banner_id' => $banner_id], 201);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $banner = banner::findOrFail($id);
            $banner->image_uuid = $request->image_uuid;
            $banner->updated_at = now();
            $banner->save();
            $banner->setLocales($request->input("locales"));
        });
        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $banner = banner::findOrFail($id);
            $banner->locales()->delete();
            $banner->delete();
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
            'image_uuid.required' => 'Image id mütləqdir',
            'image_uuid.exists' => 'Image id mövcud deyil',
            'locales.*.text.required' => 'Mətn mütləqdir',
            'locales.*.local.required' => 'Dil seçimi mütləqdir'
        ];
    }
}
