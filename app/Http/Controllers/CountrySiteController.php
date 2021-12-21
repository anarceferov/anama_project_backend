<?php

namespace App\Http\Controllers;

use App\Models\CountrySite;
use App\Traits\ApiResponder;
use App\Traits\Paginatable;
use Illuminate\Http\Request;

class CountrySiteController extends Controller
{
    use ApiResponder, Paginatable;

    private $perPage;

    public function index()
    {
        $countrySites = CountrySite::with('image')->orderBy('created_at', 'desc');

        return $this->dataResponse($countrySites->simplePaginate($this->getPerPage()));
    }


    public function show($id)
    {
        $countrySite = CountrySite::with('image')->findOrFail($id);

        return $this->dataResponse($countrySite);
    }


    public function store(Request $request)
    {

        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        $countrySite = new CountrySite;
        $countrySite->created_at = now();
        $countrySite->image_uuid = $request->image_uuid;
        $countrySite->url = $request->url;
        $countrySite->save();

        return $this->successResponse(trans('responses.ok'));
    }


    public function update(Request $request, $id)
    {

        $this->validate($request, $this->getValidationRules($id), $this->customAttributes());

        $countrySite = CountrySite::findOrFail($id);
        $countrySite->updated_at = now();
        $countrySite->image_uuid = $request->image_uuid;
        $countrySite->url = $request->url;
        $countrySite->save();
        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        CountrySite::findOrFail($id)->delete();
        return $this->successResponse(trans('responses.ok'));
    }


    private function getValidationRules($id = null): array
    {
        return [
            'image_uuid' => 'required|exists:files,id',
            'url' => 'required|url',
        ];
    }

    public function customAttributes(): array
    {
        return [
            'image_uuid.required' => 'Image id mütləqdir',
            'image_uuid.exists' => 'Image id mövcud deyil',
            'url.required' => 'Url mütləqdir',
            'url.url' => 'Url düzgün deyil',
        ];
    }
}
