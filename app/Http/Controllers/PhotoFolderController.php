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
        $photoFolder_id = null;
        DB::transaction(function () use ($request, &$photoFolder_id) {
            $photoFolder = new PhotoFolder;
            $photoFolder->image_uuid = $request->image_uuid;
            $photoFolder->order = $request->order;
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
        DB::transaction(function () use ($request, $id) {
            $photoFolder = PhotoFolder::findOrFail($id);
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
}
