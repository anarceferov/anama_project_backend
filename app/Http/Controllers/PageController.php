<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $pages = page::whereIsActive(1)->get();
        return response($pages);
    }

    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'name_en' => 'required|max:100',
            'is_active' => 'numeric|min:0|max:1'
        ]);


        if($validated->fails()) 
        {
            return response(['message' => 'fail']);
        }

        DB::transaction(function () use ($request , $id) {
            page::findOrFail($id)->update([
                'name' => $request->name,
                'name_en' => $request->name_en,
                'is_active' => $request->is_active
            ]);
        });
        return response(['message' => 'success']);
    }


}
