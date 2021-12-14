<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Traits\ApiResponder;
use App\Traits\Paginatable;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    use ApiResponder, Paginatable;

    private $perPage;

    public function index()
    {
        if (auth()->check()) {
            $trainings = Training::orderBy('created_at', 'desc');
        } else {
            $trainings = Training::orderBy('created_at', 'desc');
        }
        return $this->dataResponse($trainings->simplePaginate($this->getPerPage()));
    }


    public function store(Request $request)
    {

        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        $training = new Training;
        $training->category_name = $request->category_name;
        $training->count = $request->count;
        $training->tel = $request->tel; 
        $training->email = $request->email;
        $training->sector = $request->sector;
        $training->created_at = now();
        $training->save();

        return $this->successResponse(trans('ok'));
    }


    public function show($id)
    {

        if (auth()->check()) {
            $training = Training::findOrFail($id);
        } else {
            $training = Training::findOrFail($id);
        }
        return $this->dataResponse($training);
    }


    public function update(Request $request, $id)
    {

        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        $training = training::findOrFail($id);
        $training->category_name = $request->category_name;
        $training->count = $request->count;
        $training->tel = $request->tel;
        $training->email = $request->email;
        $training->sector = $request->sector;
        $training->created_at = now();
        $training->save();
        return $this->successResponse(trans('ok'));
    }


    public function destroy($id)
    {
        training::findOrFail($id)->delete();
        return $this->successResponse(trans('ok'));
    }

    private function getValidationRules(): array
    {
        return [
            'category_name' => 'required',
            'count' => 'required|numeric|max:1000',
            'tel' => 'required',
            'email' => 'required|email',
            'sector' => 'required',
        ];
    }

    public function customAttributes(): array
    {
        return [
            'category_name.required' => 'Kateqoriya adı mütləqdir',
            'count.required' => 'Say mütləqdir',
            'count.numeric' => 'Say yanlız rəqəm ola bilər',
            'count.max' => 'Say 1000-dən böyük ola bilməz',
            'tel' => 'Nömrə mütləqdir',
            'email.required' => 'Email mütləqdir',
            'sector.required' => 'Sector mütləqdir'
        ];
    }
}
