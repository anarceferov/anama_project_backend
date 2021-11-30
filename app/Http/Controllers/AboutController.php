<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponder;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $about = About::query()->with('image')->get();
        return response($about);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'text' => 'required',
            'date' =>'numeric|required',
            // 'image_uuid' => 'required'
        ]);


        if ($validated->fails()) {
            return response(['message' => 'validate fail']);
        }

        $about_id = null;
        DB::transaction(function () use ($request, &$about_id) {
            $about = new About();
            $about->fill($request->only([
                'text',
                'text_en',
                (int)'date',
                'image_uuid'
            ]));
            $about->save();
            $about_id = $about->id;
        });

        return $this->dataResponse(['about_id' => $about_id], 201);
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {

        $validated = Validator::make($request->all(), [
            'text' => 'required',
            'date' =>'numeric|required',
            // 'image_uuid' => 'required'
        ]);


        if ($validated->fails()) {
            return response(['message' => 'validate fail']);
        }

        try {
            DB::transaction(function () use ($request, $id) {
                $about = About::findOrFail($id);
    
                $about->fill($request->only([
                    'text',
                    'text_en',
                    (int)'date',
                    'image_uuid'
                ]));
                $about->save();
            });

            return $this->successResponse(trans('responses.ok'));
        } catch (\Throwable $th) {
            return response($th);
        }


        // $about = About::findOrFail($id)->first();

        // $about = new About;
        // $about->date = $request->date;
        // $about->text = $request->text;
        // $about->text_en = $request->text_en;
        // $about->oreder = $request->order;


        // if($request->hasFile('image'))
        // {
        //     if (File::exists($about->image)) {
        //         File::delete(storage_path('public/'.$about->image));
        //     }

        //     $file = $request->file('image')->getClientOriginalName();
        //     $request->file('image')->storeAs('public/' , 'public/'.Str::random(10) . '_' . time() . '.' .$file);
        //     $about->image = $file;
        // }

        // $about->save();

    }

    public function destroy($id)
    {
        About::findOrFail($id)->delete();
        return response(['message' => 'success delete']);
    }
}
