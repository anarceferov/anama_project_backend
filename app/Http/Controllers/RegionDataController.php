<?php

namespace App\Http\Controllers;

use App\Models\RegionData;
use App\Traits\ApiResponder;
use App\Traits\Paginatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RegionDataController extends Controller
{
    use ApiResponder, Paginatable;

    private $perPage;

    public function index()
    {
        if (auth()->check()) {
            $datas = RegionData::with('locales', 'regions');
        } else {
            $datas = RegionData::with('locale', 'region');
        }
        return $this->dataResponse($datas->simplePaginate($this->getPerPage()));
    }


    public function show($id)
    {
        if (auth()->check()) {
            $data = RegionData::with('locales', 'regions')->findOrFail($id);
        } else {
            $data = RegionData::with('locale', 'region')->findOrFail($id);
        }
        return $this->dataResponse($data);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request) {
            $data = new RegionData;
            $data->year = $request->year;
            $data->month = $request->month;
            $data->week = $request->week;
            $data->tank = $request->tank;
            $data->clean_area = $request->clean_area;
            $data->unexplosive = $request->unexplosive;
            $data->pedestrian = $request->pedestrian;
            $data->region_id = $request->region_id;
            $data->created_at = now();
            $data->save();
            $data->setLocales($request->locales);
        });

        return $this->successResponse(trans('responses.ok'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules($id), $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $data = RegionData::findOrFail($id);
            $data->year = $request->year;
            $data->month = $request->month;
            $data->week = $request->week;
            $data->tank = $request->tank;
            $data->clean_area = $request->clean_area;
            $data->unexplosive = $request->unexplosive;
            $data->pedestrian = $request->pedestrian;
            $data->region_id = $request->region_id;
            $data->updated_at = now();
            $data->save();
            $data->setLocales($request->locales);
        });

        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $data = RegionData::findOrFail($id);

            $data->locales()->delete();

            $data->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }


    private function getValidationRules($id = null): array
    {
        return [
            'region_id' => [
                'required',
                'integer',
                'exists:regions,id',
                Rule::unique('region_data', 'region_id')->where(function ($query) use ($id) {
                    $query->where('id', '!=', $id);
                })
            ],
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
            'region_id.required' => 'Region id mütləqdir',
            'region_id.unique' => 'Bu şəhərə aid məlumatlar artıq var.Yenisi əlavə edilə bilməz',
            'region_id.exists' => 'Region id mövcud deyil',
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
