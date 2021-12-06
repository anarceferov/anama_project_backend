<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AboutCategory;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutCategoryController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $about = AboutCategory::query()->with('abouts')->get();
        return response($about);
    }

    public function store(Request $request)
    {
        AboutCategory::insert([
            'date' => $request->date
        ]);

        return $this->successResponse(trans('ok'));
    }

    public function update(Request $request, $id)
    {

        AboutCategory::findOrFail($id)->update([
            'date' => $request->date
        ]);

        return $this->successResponse(trans('ok'));
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $category = AboutCategory::findOrFail($id);
            $category->abouts()->delete();
            $category->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }


    public function show($id)
    {
        
    }
}
