<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\PageLocale;

class PageController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $pages = page::whereIsActive(1)->with('locales')->get();
        return response($pages);
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $page = page::findOrFail($id);

            $page->fill($request->only([
                'is_active'
            ]));

            $page->save();

            $page->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }


    public function store(Request $request)
    {
        $page_id = null;
        DB::transaction(function () use ($request, &$page_id) {
            $page = new Page();
            $page->fill($request->only([
                'is_active'
            ]));
            
            $page->save();

            $page->setLocales($request->input("locales"));

            $page_id = $page->id;
        });

        return $this->dataResponse(['page_id' => $page_id], 201);
    }

    public function show($id)
    {
        $page = Page::with('locales')->where('id', $id)->first();
        return $this->dataResponse($page);
    }
}
