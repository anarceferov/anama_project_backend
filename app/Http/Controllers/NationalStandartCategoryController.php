<?php

namespace App\Http\Controllers;

use App\Models\NationalStandartCategory;
use App\Traits\ApiResponder;
use App\Traits\Paginatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NationalStandartCategoryController extends Controller
{
    use ApiResponder, Paginatable;

    private $perPage;

    public function index()
    {
        if (auth()->check()) {
            $categories = NationalStandartCategory::with('locales', 'nationalStandarts');
        } else {
            $categories = NationalStandartCategory::with('locale', 'nationalStandart');
        }
        return $this->dataResponse($categories->simplePaginate($this->getPerPage()));
    }


    public function show($id)
    {
        if (auth()->check()) {
            $category = NationalStandartCategory::with('locales', 'nationalStandarts')->findOrFail($id);
        } else {
            $category = NationalStandartCategory::with('locale', 'nationalStandart')->findOrFail($id);
        }
        return $this->dataResponse($category);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        $NationalStandartCategory_id = null;
        DB::transaction(function () use ($request, &$NationalStandartCategory_id) {
            $NationalStandartCategory = new NationalStandartCategory;
            $NationalStandartCategory->created_at = now();
            $NationalStandartCategory->save();
            $NationalStandartCategory->setLocales($request->input("locales"));
            $NationalStandartCategory_id = $NationalStandartCategory->id;
        });

        return $this->dataResponse(['NationalStandartCategory_id' => $NationalStandartCategory_id], 201);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $category = NationalStandartCategory::findOrFail($id);
            $category->updated_at = now();
            $category->save();
            $category->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $category = NationalStandartCategory::findOrFail($id);

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
            'locales.*.name.required' => 'Kateqoriya adı mütləqdir',
            'locales.*.local.required' => 'Dil seçimi mütləqdir'
        ];
    }
}
