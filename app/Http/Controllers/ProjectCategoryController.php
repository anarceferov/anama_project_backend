<?php

namespace App\Http\Controllers;

use App\Models\ProjectCategory;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectCategoryController extends Controller
{

    use ApiResponder;

    public function index()
    {
        $categories = ProjectCategory::with('image', 'locales' , 'project')->get();
        return response($categories);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        $projectCategory_id = null;
        DB::transaction(function () use ($request, &$projectCategory_id) {
            $projectCategory = new ProjectCategory;
            $projectCategory->image_uuid = $request->image_uuid;
            $projectCategory->created_at = now();
            $projectCategory->save();
            $projectCategory->setLocales($request->input("locales"));
            $projectCategory_id = $projectCategory->id;
        });

        return $this->dataResponse(['projectCategory_id' => $projectCategory_id], 201);
    }


    public function show($id)
    {
        $category = ProjectCategory::with('image', 'locales' , 'project')->where('id', $id)->first();
        return $this->dataResponse($category);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $category = ProjectCategory::findOrFail($id);
            $category->image_uuid = $request->image_uuid;
            $category->updated_at = now();
            $category->save();
            $category->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $category = ProjectCategory::findOrFail($id);

            $category->locales()->delete();

            $category->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }


    private function getValidationRules(): array
    {
        return [
            'image_uuid' => 'required|exists:files,id',
            'locales.*.local' => 'required',
            'locales.*.title' => 'required',
            'locales.*.status' => 'required',
            'locales.*.city' => 'required',
        ];
    }

    public function customAttributes(): array
    {
        return [
            'image_uuid.required' => 'İmage id mütləqdir',
            'image_uuid.exists' => 'İmage id mövcud deyil',
            'locales.*.title.required' => 'Başlıq mütləqdir',
            'locales.*.status.required' => 'Status mütləqdir',
            'locales.*.city.required' => 'Region mütləqdir',
            'locales.*.local.required' => 'Dil seçimi mütləqdir'
        ];
    }
}
