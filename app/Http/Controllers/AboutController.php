<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponder;
use App\Models\AboutCategory;
use Illuminate\Support\Facades\Validator;
use App\Models\AboutLocale;
use App\Traits\Localizable;

class AboutController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $about = AboutCategory::with('abouts')->get();
        return response($about);
    }


    public function store(Request $request)
    {
        $about_id = null;
        DB::transaction(function () use ($request, &$about_id) {

            $about = new About();

            $about->image_uuid = $request->image_uuid;
            $about->about_category_id = $request->about_category_id;
            $about->save();
            $about->setLocales($request->locales);

            $about_id = $about->id;
        });

        return $this->dataResponse(['about_id' => $about_id], 201);
    }


    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $about = About::findOrFail($id);

            $about->fill($request->only([
                'about_category_id',
                'image_uuid'
            ]));
            $about->save();

            $about->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $about = About::findOrFail($id);

            $about->locales()->delete();

            $about->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }


    public function show($id)
    {
        $about = About::with('image', 'category', 'locale')->where('id', $id)->first();
        return $this->dataResponse($about);
    }
}
