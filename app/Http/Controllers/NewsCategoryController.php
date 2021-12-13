<?php

namespace App\Http\Controllers;

use App\Models\NewsCategory;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsCategoryController extends Controller
{

    use ApiResponder;
    
    public function index()
    {
        $categories = NewsCategory::with('news')->get();
        return response($categories);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules() , $this->customAttributes());

        $newsCategory_id = null;
        DB::transaction(function () use ($request, &$newsCategory_id) {
            $newsCategory = new NewsCategory;
            $newsCategory->created_at = now();
            // $newsCategory->image_uuid = $request->image_uuid;
            // $newsCategory->is_active = $request->is_active;
            $newsCategory->save();
            $newsCategory->setLocales($request->input("locales"));
            $newsCategory_id = $newsCategory->id;
        });

        return $this->dataResponse(['newsCategory_id' => $newsCategory_id], 201);
    }


    public function show($id)
    {
        $category = NewsCategory::with('OneNews')->where('id', $id)->first();
        return $this->dataResponse($category);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules() , $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $newsCategory = NewsCategory::findOrFail($id);
            $newsCategory->updated_at = now();
            // if(filled($request->input('image_uuid')))
            // {
            //     $newsCategory->image_uuid = $request->input('image_uuid');
            // }
            // $newsCategory->is_active = $request->is_active;
            $newsCategory->save();
            $newsCategory->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $category = NewsCategory::findOrFail($id);

            $category->locales()->delete();

            $category->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }


    private function getValidationRules(): array
    {
        return [
            'locales.*.local' => 'required',
            'locales.*.name' => 'required',
        ];
    }

    public function customAttributes(): array
    {
        return [
            'locales.*.name.required' => 'Mətn mütləqdir',
            'locales.*.local.required' => 'Dil seçimi mütləqdir'
        ];
    }
}