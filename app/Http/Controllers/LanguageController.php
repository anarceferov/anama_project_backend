<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\SiteLocalization;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * Class LanguageController
 * @package App\Http\Controllers
 */
class LanguageController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $languages = Language::query();
        if (!auth()->check()) {
            $languages = $languages->where("is_active", true);
        }
        $languages = $languages->get(["id", 'name', 'key', 'is_active']);

        return $this->dataResponse($languages);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, $this->getValidationRules());

        $language = new Language();
        $language->fill($request->only([
            'name',
            'key',
            'is_active'
        ]));
        $language->save();
        return $this->successResponse(trans("responses.ok"), 201);
    }

    /**
     * @return string[]
     */
    private function getValidationRules()
    {
        return [
            'name' => "required|string|min:1|max:255",
            "key" => "required|string|min:2|max:4",
            "status" => "sometimes|required|boolean"
        ];
    }

    /**
     * @param  Request  $request
     * @param $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, $uid): JsonResponse
    {
        $this->validate($request, $this->getValidationRules());
        $language = Language::query()->find($uid);
        $language->fill($request->only([
            'name',
            'key',
            'is_active'
        ]));
        $language->save();
        return $this->successResponse(trans('responses.ok'));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($uid): JsonResponse
    {
        DB::transaction(function () use ($uid) {
            $language = Language::findOrFail($uid);
            SiteLocalization::query()->where("local", $language->key)->delete();
            $language->delete();
        });

        return $this->successResponse(trans('responses.ok'));
    }
}