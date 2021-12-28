<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Models\SumRegion;
use Illuminate\Support\Facades\DB;

class SumRegionController extends Controller
{

    use ApiResponder;

    public function index()
    {
        if (auth()->check()) {
            $sumRegion = SumRegion::with('locales')->get();
        } else {
            $sumRegion = SumRegion::with('locale')->get();
        }

        return $this->dataResponse($sumRegion);
    }


    public function show($id)
    {
        if (auth()->check()) {
            $sumRegion = SumRegion::with('locales')->findOrFail($id);
        } else {
            $sumRegion = SumRegion::with('locale')->findOrFail($id);
        }
        return $this->dataResponse($sumRegion);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request) {
            $sumRegion = new SumRegion;
            $sumRegion->year = $request->year;
            $sumRegion->month = $request->month;
            $sumRegion->week = $request->week;
            $sumRegion->tank = $request->tank;
            $sumRegion->clean_area = $request->clean_area;
            $sumRegion->unexplosive = $request->unexplosive;
            $sumRegion->pedestrian = $request->pedestrian;
            $sumRegion->created_at = now();
            $sumRegion->save();
            $sumRegion->setLocales($request->locales);
        });

        return $this->successResponse(trans('responses.ok'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules($id), $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $sumRegion = SumRegion::findOrFail($id);
            $sumRegion->year = $request->year;
            $sumRegion->month = $request->month;
            $sumRegion->week = $request->week;
            $sumRegion->tank = $request->tank;
            $sumRegion->clean_area = $request->clean_area;
            $sumRegion->unexplosive = $request->unexplosive;
            $sumRegion->pedestrian = $request->pedestrian;
            $sumRegion->updated_at = now();
            $sumRegion->save();
            $sumRegion->setLocales($request->locales);
        });

        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $sumRegion = SumRegion::findOrFail($id);

            $sumRegion->locales()->delete();

            $sumRegion->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }


    private function getValidationRules($id = null): array
    {
        return [
            'year' => 'integer',
            'month' => 'integer',
            'week' => 'integer',
            'tank' => 'integer',
            'clean_area' => 'integer',
            'unexplosive' => 'integer',
            'pedestrian' => 'integer',
            'clean_area' => 'integer',
            'locales.*.local' => 'required',
            'locales.*.text' => 'required'
        ];
    }

    public function customAttributes(): array
    {
        return [
            'year.integer' => 'İl sayı rəqəm olmalıdır',
            'month.integer' => 'Ay sayı rəqəm olmalıdır',
            'week.integer' => 'Həftə sayı rəqəm olmalıdır',
            'tank.integer' => 'Tank sayı rəqəm olmalıdır',
            'clean_area.integer' => 'Təmizlənən ərazi sayı rəqəm olmalıdır',
            'unexplosive.integer' => 'Partlamayan hərbi sursat sayı rəqəm olmalıdır',
            'pedestrian.integer' => 'Piyada əleyhinə mina sayı rəqəm olmalıdır',
            'locales.*.local.required' => 'Dil seçimi mütləqdir',
            'locales.*.text.required' => 'Mətn mütləqdir'
        ];
    }
}
