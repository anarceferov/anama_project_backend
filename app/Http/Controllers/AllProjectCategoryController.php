<?php

namespace App\Http\Controllers;

use App\Models\AllProjectCategory;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllProjectCategoryController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $categories = AllProjectCategory::with('locales', 'allProject')->get();
        return response($categories);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        $projectCategory_id = null;
        DB::transaction(function () use ($request, &$projectCategory_id) {
            $projectCategory = new AllProjectCategory;
            $projectCategory->created_at = now();
            $projectCategory->save();
            $projectCategory->setLocales($request->input("locales"));
            $projectCategory_id = $projectCategory->id;
        });

        return $this->dataResponse(['projectCategory_id' => $projectCategory_id], 201);
    }


    public function show($id)
    {
        $category = AllProjectCategory::with('locales' , 'allProject')->firstOrFail($id);
        return $this->dataResponse($category);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $category = AllProjectCategory::findOrFail($id);
            $category->updated_at = now();
            $category->save();
            $category->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $category = AllProjectCategory::findOrFail($id);

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
            'locales.*.name.required' => 'Ad mütləqdir',
            'locales.*.local.required' => 'Dil seçimi mütləqdir'
        ];
    }
}
