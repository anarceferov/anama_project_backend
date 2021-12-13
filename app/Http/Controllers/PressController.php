<?php

namespace App\Http\Controllers;

use App\Models\Press;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\PressLocale;

class PressController extends Controller
{
    use ApiResponder;
    public function index()
    {
        $presses = Press::query()->with('file' , 'locales')->get();
        return response($presses);
    }

    public function store(Request $request)
    {

        $this->validate($request, $this->getValidationRules() , $this->customAttributes());

        $press_id = null;

        DB::transaction(function () use ($request, &$press_id) {
            $press = new Press();

            $press->fill($request->only([
                'date',
                'file_uuid'
            ]));
            
            $press->save();

            $press->setLocales($request->input("locales"));

            $press_id = $press->id;
        });
        return $this->dataResponse(['press_id' => $press_id], 201);
        
    }



    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules() , $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $press = Press::findOrFail($id);

            $press->fill($request->only([
                'date',
                'file_uuid'
            ]));

            $press->save();

            $press->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }

    public function destroy($id)
    {

        DB::transaction(function () use ($id) {
            $press = Press::findOrFail($id);

            $press->locales()->delete();

            $press->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }

    public function show($id)
    {
        $press = Press::with('file', 'locales')->where('id', $id)->first();
        return $this->dataResponse($press);
    }


    private function getValidationRules(): array
    {
        return [
            'date' => 'required',
            'file_uuid' => 'required|exists:files,id',
            'locales.*.local' => 'required',
            'locales.*.title' => 'required',
        ];
    }

    public function customAttributes(): array
    {
        return [
            'date.required' => 'Tarix mütləqdir',
            'file_uuid.required' => 'File id mütləqdir',
            'file_uuid.exists' => 'File id mövcud deyil',
            'locales.*.title.required' => 'Başlıq mütləqdir',
            'locales.*.local.required' => 'Dil seçimi mütləqdir'
        ];
    }
}
