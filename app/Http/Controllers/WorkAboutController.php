<?php

namespace App\Http\Controllers;

use App\Models\WorkAbout;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkAboutController extends Controller
{
    use ApiResponder;
    public function index()
    {
        $workAbouts = WorkAbout::query()->with('image', 'locales')->get();
        return response($workAbouts);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        $workAbout_id = null;
        DB::transaction(function () use ($request, &$workAbout_id) {
            $workAbout = new WorkAbout;
            $workAbout->fill($request->only([
                'image_uuid'
            ]));
            $workAbout->save();

            $workAbout->setLocales($request->input("locales"));

            $workAbout_id = $workAbout->id;
        });

        return $this->dataResponse(['workAbout_id' => $workAbout_id], 201);
    }


    public function show($id)
    {
        $workAbout = WorkAbout::with('image', 'locales')->where('id', $id)->first();
        return $this->dataResponse($workAbout);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $workAbout = WorkAbout::findOrFail($id);
            $workAbout->fill($request->only([
                'image_uuid'
            ]));

            $workAbout->save();

            $workAbout->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $workAbout = WorkAbout::findOrFail($id);

            $workAbout->locales()->delete();

            $workAbout->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }


    private function getValidationRules(): array
    {
        return [
            'image_uuid' => 'required|exists:files,id',
            'locales.*.local' => 'required',
            'locales.*.text' => 'required',
        ];
    }

    public function customAttributes(): array
    {
        return [
            'image_uuid.required' => 'İmage id mütləqdir',
            'image_uuid.exists' => 'İmage id mövcud deyil',
            'locales.*.text.required' => 'Mətn mütləqdir',
            'locales.*.local.required' => 'Dil seçimi mütləqdir'
        ];
    }
}
