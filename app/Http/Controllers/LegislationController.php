<?php

namespace App\Http\Controllers;

use App\Models\Legislation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LegislationLocale;
use App\Traits\ApiResponder;

class LegislationController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $legislations = Legislation::query()->with('locales')->get();
        return response($legislations);
    }

    public function store(Request $request)
    {
        $legislation_id = null;
        DB::transaction(function () use ($request, &$legislation_id) {
            $legislation = new Legislation;
            $legislation->save();
            $legislation->setLocales($request->input("locales"));
            $legislation_id = $legislation->id;
        });

        return $this->dataResponse(['legislation_id' => $legislation_id], 201);
    }

    public function show($id)
    {
        $legislation = Legislation::with('locales')->where('id', $id)->first();
        return $this->dataResponse($legislation);
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $legislation = Legislation::findOrFail($id);
            $legislation->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $legislation = Legislation::findOrFail($id);

            $legislation->locales()->delete();

            $legislation->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }
}
