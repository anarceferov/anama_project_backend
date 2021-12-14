<?php

namespace App\Http\Controllers;

use App\Models\Legislation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponder;
use App\Traits\Paginatable;

class LegislationController extends Controller
{
    use ApiResponder, Paginatable;

    private $perPage;

    public function index()
    {
        if (auth()->check()) {
            $legislations = Legislation::with('locales');
        } else {
            $legislations = Legislation::with('locale');
        }
        return $this->dataResponse($legislations->simplePaginate($this->getPerPage()));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules());

        $legislation_id = null;
        DB::transaction(function () use ($request, &$legislation_id) {
            $legislation = new Legislation;
            $legislation->created_at = now();
            $legislation->save();
            $legislation->setLocales($request->input("locales"));
            $legislation_id = $legislation->id;
        });

        return $this->dataResponse(['legislation_id' => $legislation_id], 201);
    }

    public function show($id)
    {
        if (auth()->check()) {
            $legislation = Legislation::with('locales')->findOrFail($id);
        } else {
            $legislation = Legislation::with('locale')->findOrFail($id);
        }
        return $this->dataResponse($legislation);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules());

        DB::transaction(function () use ($request, $id) {
            $legislation = Legislation::findOrFail($id);
            $legislation->updated_at = now();
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


    private function getValidationRules(): array
    {
        return [
            'locales.*.local' => 'required',
            'locales.*.text' => 'required',
        ];
    }

}
