<?php

namespace App\Http\Controllers;

use App\Models\PhotoFolder;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotoFolderController extends Controller
{
    use ApiResponder;
    public function index()
    {
        $photos = PhotoFolder::with('locales' , 'photos')->orderBy('created_at' , 'desc')->get();
        return response($photos);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules() , $this->customAttributes());

        $photoFolder_id = null;
        DB::transaction(function () use ($request, &$photoFolder_id) {
            $photoFolder = new PhotoFolder;
            $photoFolder->image_uuid = $request->image_uuid;
            $photoFolder->order = $request->order;
            $photoFolder->created_at = now();
            $photoFolder->save();

            $photoFolder->setLocales($request->input("locales"));

            $photoFolder_id = $photoFolder->id;
        });

        return $this->dataResponse(['photoFolder_id' => $photoFolder_id], 201);
    }


    public function show($id)
    {
        $photoFolder = PhotoFolder::with('locales' , 'photos')->whereId($id)->get();
        return response($photoFolder);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules() , $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $photoFolder = PhotoFolder::findOrFail($id);
            $photoFolder->updated_at = now();
            $photoFolder->image_uuid = $request->image_uuid;
            $photoFolder->order = $request->order;
            $photoFolder->save();

            $photoFolder->setLocales($request->input("locales"));
        });
        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $photoFolder = PhotoFolder::findOrFail($id);
            $photoFolder->locales()->delete();
            $photoFolder->delete();
        });
        return $this->successResponse(trans("responses.ok"));
    }


    private function getValidationRules(): array
    {
        return [
            'image_uuid' => 'required|exists:files,id',
            'locales.*.local' => 'required',
            'locales.*.name' => 'required',
            'order' => 'required|numeric|unique:photo_folders',
        ];
    }

    public function customAttributes(): array
    {
        return [
            'image_uuid.required' => 'Image id mütləqdir',
            'image_uuid.exists' => 'Image id mövcud deyil',
            'locales.*.name.required' => 'Mətn mütləqdir',
            'locales.*.local.required' => 'Dil seçimi mütləqdir'
        ];
    }
}
