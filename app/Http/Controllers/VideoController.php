<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{

    use ApiResponder;

    public function index()
    {
        $videos = Video::with('locales')->get();
        return response($videos);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules() , $this->customAttributes());

        $video_id = null;
        DB::transaction(function () use ($request, &$video_id) {
            $video = new Video;
            $video->url = $request->url;
            $video->save();

            $video->setLocales($request->input("locales"));

            $video_id = $video->id;
        });

        return $this->dataResponse(['video_id' => $video_id], 201);
    }


    public function show($id)
    {
        $video = Video::with('locales')->whereId($id)->get();
        return response($video);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules() , $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $video = Video::findOrFail($id);
            $video->url = $request->url;
            $video->save();
            $video->setLocales($request->input("locales"));
        });
        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $video = Video::findOrFail($id);
            $video->locales()->delete();
            $video->delete();
        });
        return $this->successResponse(trans("responses.ok"));
    }

    private function getValidationRules(): array
    {
        return [
            'url' => 'required',
            'locales.*.local' => 'required',
            'locales.*.title' => 'required',
        ];
    }

    public function customAttributes(): array
    {
        return [
            'url.required' => 'Url mütləqdir',
            'locales.*.title.required' => 'Başlıq mütləqdir',
            'locales.*.local.required' => 'Dil seçimi mütləqdir'
        ];
    }
}
