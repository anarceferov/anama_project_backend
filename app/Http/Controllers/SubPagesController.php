<?php

namespace App\Http\Controllers;

use App\Models\SubPage;
use App\Traits\ApiResponder;
use App\Traits\Paginatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubPagesController extends Controller
{
    use ApiResponder, Paginatable;

    private $perPage;

    public function index()
    {
        if (auth()->check()) {
            $subPages = SubPage::whereIsActive(1)->with('locales', 'pages');
        } else {
            $subPages = SubPage::whereIsActive(1)->with('locale', 'page');
        }
        return $this->dataResponse($subPages->simplePaginate($this->getPerPage()));
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        $subPage_id = null;
        DB::transaction(function () use ($request, &$subPage_id) {
            $subPage = new SubPage;
            $subPage->fill($request->only([
                'is_active',
                'key',
                'page_id'
            ]));

            $subPage->save();

            $subPage->setLocales($request->input("locales"));

            $subPage_id = $subPage->id;
        });

        return $this->dataResponse(['subPage_id' => $subPage_id], 201);
    }


    public function show($id)
    {
        if (auth()->check()) {
            $subPages = SubPage::where('is_active', 1)->with('locales', 'pages')->findOrFail($id);
        } else {
            $subPages = SubPage::where('is_active', 1)->with('locale', 'page')->findOrFail($id);
        }
        return $this->dataResponse($subPages);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $subPage = SubPage::findOrFail($id);

            $subPage->fill($request->only([
                'is_active',
                'key',
                'page_id'
            ]));

            $subPage->save();

            $subPage->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $subPage = SubPage::findOrFail($id);
            $subPage->locales()->delete();
            $subPage->delete();
        });

        return $this->successResponse(trans('responses.ok'));
    }

    private function getValidationRules(): array
    {
        return [
            'page_id' => 'required|numeric',
            'is_active' => 'required|boolean',
            'locales.*.local' => 'required',
            'locales.*.name' => 'required',
        ];
    }

    public function customAttributes(): array
    {
        return [
            'is_active.required' => 'Status',
            'is_active.boolean' => 'Status 1 və ya 0 ola bilər',
            'locales.*.name.required' => 'Sehifə adı mütləqdir',
            'locales.*.local.required' => 'Dil seçimi mütləqdir'
        ];
    }
}
