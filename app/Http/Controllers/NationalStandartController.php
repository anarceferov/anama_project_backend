<?php

namespace App\Http\Controllers;

use App\Models\NationalStandart;
use App\Models\NationalStandartCategory;
use App\Traits\ApiResponder;
use App\Traits\Paginatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NationalStandartController extends Controller
{
    use ApiResponder, Paginatable;

    private $perPage;

    public function index()
    {
        if (auth()->check()) {
            $nationalStandart = NationalStandartCategory::with('nationalStandarts');
        } else {
            $nationalStandart = NationalStandartCategory::with('nationalStandart');
        }
        return $this->dataResponse($nationalStandart->simplePaginate($this->getPerPage()));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        $nationalStandart_id = null;
        DB::transaction(function () use ($request, &$nationalStandart_id) {
            $nationalStandart = new NationalStandart();
            $nationalStandart->created_at = now();
            $nationalStandart->national_standart_category_id = $request->national_standart_category_id;
            $nationalStandart->save();
            $nationalStandart->setLocales($request->locales);
            $nationalStandart_id = $nationalStandart->id;
        });

        return $this->dataResponse(['nationalStandart_id' => $nationalStandart_id], 201);
    }

    public function show($id)
    {
        if (auth()->check()) {
            $nationalStandart = NationalStandart::with('locales')->findOrFail($id);
        } else {
            $nationalStandart = NationalStandart::with('locale')->findOrFail($id);
        }
        return $this->dataResponse($nationalStandart);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $nationalStandart = NationalStandart::findOrFail($id);
            $nationalStandart->updated_at = now();
            $nationalStandart->national_standart_category_id = $request->national_standart_category_id;
            $nationalStandart->save();
            $nationalStandart->setLocales($request->locales);
        });

        return $this->successResponse(trans('responses.ok'));
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $nationalStandart = NationalStandart::findOrFail($id);

            $nationalStandart->locales()->delete();

            $nationalStandart->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }


    private function getValidationRules(): array
    {
        return [
            'national_standart_category_id' => 'required|numeric|exists:national_standart_categories,id',
            'locales.*.local' => 'required',
            'locales.*.text' => 'required',
        ];
    }

    public function customAttributes(): array
    {
        return [
            'national_standart_category_id.required' => 'Kateqoriya adı mütləqdir',
            'national_standart_category_id.exists' => 'Kateqoriya id mövcud deyil',
            'locales.*.text.required' => 'Mətn mütləqdir',
            'locales.*.local.required' => 'Dil seçimi mütləqdir'
        ];
    }
}
