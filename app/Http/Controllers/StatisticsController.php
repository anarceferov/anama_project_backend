<?php

namespace App\Http\Controllers;

use App\Models\Statistics;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    use ApiResponder;

    public function index()
    {
        if (auth()->check()) {
            $statistics = Statistics::with('locales')->get();
        } else {
            $statistics = Statistics::with('locale')->get();
        }
        return $this->dataResponse($statistics);
    }


    public function show($id)
    {
        if (auth()->check()) {
            $statistic = Statistics::with('locales')->findOrFail($id);
        } else {
            $statistic = Statistics::with('locale')->findOrFail($id);
        }
        return $this->dataResponse($statistic);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request) {
            $statistic = new Statistics;
            $statistic->year = $request->year;
            $statistic->month = $request->month;
            $statistic->week = $request->week;
            $statistic->tank = $request->tank;
            $statistic->clean_area = $request->clean_area;
            $statistic->unexplosive = $request->unexplosive;
            $statistic->pedestrian = $request->pedestrian;
            $statistic->created_at = now();
            $statistic->save();
            $statistic->setLocales($request->locales);
        });

        return $this->successResponse(trans('responses.ok'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules($id), $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $statistic = Statistics::findOrFail($id);
            $statistic->year = $request->year;
            $statistic->month = $request->month;
            $statistic->week = $request->week;
            $statistic->tank = $request->tank;
            $statistic->clean_area = $request->clean_area;
            $statistic->unexplosive = $request->unexplosive;
            $statistic->pedestrian = $request->pedestrian;
            $statistic->updated_at = now();
            $statistic->save();
            $statistic->setLocales($request->locales);
        });

        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $statistic = Statistics::findOrFail($id);
            $statistic->locales()->delete();
            $statistic->delete();
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
            'locales.*.title' => 'required'
        ];
    }

    public function customAttributes(): array
    {
        return [
            'year.integer' => '??l say?? r??q??m olmal??d??r',
            'month.integer' => 'Ay say?? r??q??m olmal??d??r',
            'week.integer' => 'H??ft?? say?? r??q??m olmal??d??r',
            'tank.integer' => 'Tank say?? r??q??m olmal??d??r',
            'clean_area.integer' => 'T??mizl??n??n ??razi say?? r??q??m olmal??d??r',
            'unexplosive.integer' => 'Partlamayan h??rbi sursat say?? r??q??m olmal??d??r',
            'pedestrian.integer' => 'Piyada ??leyhin?? mina say?? r??q??m olmal??d??r',
            'locales.*.local.required' => 'Dil se??imi m??tl??qdir',
            'locales.*.title.required' => 'Ba??l??q m??tl??qdir'
        ];
    }
}
