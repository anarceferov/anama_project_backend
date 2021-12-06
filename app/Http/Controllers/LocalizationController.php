<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\SiteLocalization;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class LocalizationController extends Controller
{

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
//        $this->validate($request, [
//            'local' => "required|string|exists:languages,key"
//        ]);
        $local = SiteLocalization::query()->get();
        return $this->dataResponse($local);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'local' => "required|string|min:1|max:3|exists:languages,key",
            'data' => "required|array",
            "is_active" => "sometimes|required|boolean"
        ]);

        $local = SiteLocalization::where("local", "=", $request->input("local"))->first();
        if (!$local) {
            $local = new SiteLocalization();
        }
        $local->fill($request->only([
            'local',
            'data',
            'is_active'
        ]))->save();
        return $this->successResponse(trans('responses.ok'), 201);
    }


    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $this->validate($request, [
            'local' => "required|string|min:1|max:3|exists:languages,key",
            'data' => "required|array",
            "is_active" => "sometimes|required|boolean"
        ]);

        $local = SiteLocalization::query()->findOrFail($request->input("local"));
        $local->fill($request->only([
            'data',
            'is_active'
        ]))->save();
        return $this->successResponse(trans('responses.ok'), 200);
    }


    public function destroy(Request $request)
    {
        $this->validate($request, [
            'local' => "required|string|min:1|max:3|exists:languages,key"
        ]);
        DB::transaction(function () use ($request) {
            $local = SiteLocalization::query()->findOrFail($request->input("local"));
            Language::where("key", $local->local)->delete();
            $local->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }
}