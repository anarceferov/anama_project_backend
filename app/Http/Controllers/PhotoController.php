<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\PhotoFolder;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $photos = PhotoFolder::with('locales' , 'photos')->orderBy('created_at' , 'desc')->get();
        return response($photos);
    }


    public function store(Request $request)
    {
        $photo_id = null;
        $photo = new Photo;
        $photo->image_uuid = $request->image_uuid;
        $photo->order = $request->order;
        $photo->photo_folder_id = $request->photo_folder_id;
        $photo->save();


        $photo_id = $photo->id;

        return $this->dataResponse(['photo_id' => $photo_id], 201);
    }


    public function show($id)
    {
    }


    public function update(Request $request, $id)
    {
        $photo = Photo::findOrFail($id);
        $photo->image_uuid = $request->image_uuid;
        $photo->order = $request->order;
        $photo->save();
        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        Photo::findOrFail($id)->delete();
        return $this->successResponse(trans('responses.ok'));
    }
}
