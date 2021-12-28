<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Traits\Paginatable;
use Illuminate\Support\Facades\DB;

class VacancyController extends Controller
{
    use ApiResponder, Paginatable;

    private $perPage;

    public function index()
    {
        if (auth()->check()) {
            $vacancies = Vacancy::with('image', 'locales')->orderBy('created_at', 'desc');
        } else {
            $vacancies = vacancy::with('image', 'locale')->orderBy('created_at', 'desc');
        }
        return $this->dataResponse($vacancies->simplePaginate($this->getPerPage()));
    }


    public function show($id)
    {
        if (auth()->check()) {
            $vacancy = vacancy::with('image', 'locales')->findOrFail($id);
        } else {
            $vacancy = vacancy::with('image', 'locale')->findOrFail($id);
        }
        return $this->dataResponse($vacancy);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request) {

            $vacancy = new vacancy;
            $vacancy->image_uuid = $request->image_uuid;
            $vacancy->created_at = now();
            $vacancy->save();
            $vacancy->setLocales($request->input("locales"));
        });
        return $this->successResponse(trans('ok'));
    }


    public function update(Request $request, $id)
    {

        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request, $id) {

            $vacancy = vacancy::findOrFail($id);
            $vacancy->image_uuid = $request->image_uuid;
            $vacancy->updated_at = now();
            $vacancy->save();
            $vacancy->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('ok'));
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $vacancy = vacancy::findOrFail($id);
            $vacancy->locales()->delete();
            $vacancy->delete();
        });
        return $this->successResponse(trans('responses.ok'));
    }

    private function getValidationRules($id = null): array
    {
        // dd($id);
        return [
            'image_uuid' => 'required|exists:files,id',
            'locales.*.local' => 'required',
            'locales.*.title' => 'required',
            'locales.*.text' => 'required',
        ];
    }

    public function customAttributes(): array
    {
        return [
            'image_uuid.required' => 'Image id mütləqdir',
            'image_uuid.exists' => 'Image id mövcud deyil',
            'locales.*.title.required' => 'Başlıq mütləqdir',
            'locales.*.text.required' => 'Mətn mütləqdir',
            'locales.*.local.required' => 'Dil seçimi mütləqdir'
        ];
    }
}
