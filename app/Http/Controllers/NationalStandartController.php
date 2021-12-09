<?php

namespace App\Http\Controllers;

use App\Models\NationalStandart;
use App\Models\NationalStandartCategory;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NationalStandartController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $nationalStandart = NationalStandartCategory::with('nationalStandarts')->get();
        return response($nationalStandart);
    }

    public function store(Request $request)
    {
        $nationalStandart_id = null;
        DB::transaction(function () use ($request, &$nationalStandart_id) {

            $nationalStandart = new NationalStandart();

            $nationalStandart->national_standart_category_id = $request->national_standart_category_id;
            $nationalStandart->save();
            $nationalStandart->setLocales($request->locales);

            $nationalStandart_id = $nationalStandart->id;
        });

        return $this->dataResponse(['nationalStandart_id' => $nationalStandart_id], 201);
    }

    public function show($id)
    {
        $nationalStandart = NationalStandart::with('locale')->where('id' , $id)->get();
        return response($nationalStandart);
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $nationalStandart = NationalStandart::findOrFail($id);
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
}
