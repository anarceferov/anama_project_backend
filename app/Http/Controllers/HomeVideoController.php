<?php

namespace App\Http\Controllers;

use App\Models\HomeVideo;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeVideoController extends Controller
{

    use ApiResponder;

    public function index()
    {
        if (auth()->check()) {
            $videos = HomeVideo::with('video')->get();
        } else {
            $videos = HomeVideo::with('video')->get();
        }
        return $this->dataResponse($videos);
    }


    public function show($id)
    {
        if (auth()->check()) {
            $video = HomeVideo::with('video')->findOrFail($id);
        } else {
            $video = HomeVideo::with('video')->findOrFail($id);
        }
        return $this->dataResponse($video);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        $video_id = null;
        DB::transaction(function () use ($request, &$video_id) {
            $video = new HomeVideo;
            $video->video_uuid = $request->video_uuid;
            $video->created_at = now();
            $video->save();
            $video_id = $video->id;
        });

        return $this->dataResponse(['video_id' => $video_id], 201);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $video = HomeVideo::findOrFail($id);
            $video->video_uuid = $request->video_uuid;
            $video->updated_at = now();
            $video->save();
        });
        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        HomeVideo::findOrFail($id)->delete();
        return $this->successResponse(trans("responses.ok"));
    }

    private function getValidationRules(): array
    {
        return [
            'video_uuid' => 'required|exists:files,id'
        ];
    }

    public function customAttributes(): array
    {
        return [
            'video_uuid.required' => 'Video id mütləqdir',
            'video_uuid.exists' => 'Video id mövcud deyil',
        ];
    }
}
