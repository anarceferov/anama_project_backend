<?php

namespace App\Http\Controllers;

use App\Models\Chronology;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ChronologyLocale;

class ChronologyController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $chronologies = Chronology::query()->with('image', 'locales')->orderBy('date', 'asc')->get();
        return response($chronologies);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        $chronology_id = null;
        DB::transaction(function () use ($request, &$chronology_id) {
            $chronology = new Chronology();
            $chronology->fill($request->only([
                'date',
                'image_uuid'
            ]));
            $chronology->save();

            $chronology->setLocales($request->input("locales"));

            $chronology_id = $chronology->id;
        });

        return $this->dataResponse(['chronology_id' => $chronology_id], 201);
    }



    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $chronology = Chronology::findOrFail($id);

            $chronology->fill($request->only([
                'date',
                'image_uuid'
            ]));
            $chronology->save();

            $chronology->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }

    public function destroy($id)
    {

        DB::transaction(function () use ($id) {
            $chronology = Chronology::findOrFail($id);

            $chronology->locales()->delete();

            $chronology->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }


    public function show($id)
    {
        $chronology = Chronology::with('image', 'locales')->where('id', $id)->first();
        return $this->dataResponse($chronology);
    }


    private function getValidationRules(): array
    {
        return [
            'image_uuid' => 'required|exists:files,id',
            'date' => 'required',
            'locales.*.local' => 'required',
            'locales.*.text' => 'required',
        ];
    }

    public function customAttributes(): array
    {
        return [
            'image_uuid.required' => 'İmage id mütləqdir',
            'image_uuid.exists' => 'İmage id mövcud deyil',
            'date' => 'Tarix mütləqdir',
            'locales.*.text.required' => 'Mətn mütləqdir',
            'locales.*.local.required' => 'Dil seçimi mütləqdir'
        ];
    }
}
