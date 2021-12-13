<?php

namespace App\Http\Controllers;

use App\Models\AllProject;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllProjectController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $project = AllProject::with('image', 'locales')->get();
        return response($project);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        $project_id = null;
        DB::transaction(function () use ($request, &$project_id) {
            $project = new AllProject;
            $project->image_uuid = $request->image_uuid;
            $project->all_project_category_id = $request->all_project_category_id;
            $project->created_at = now();
            $project->save();
            $project->setLocales($request->input("locales"));
            $project_id = $project->id;
        });

        return $this->dataResponse(['project_id' => $project_id], 201);
    }


    public function show($id)
    {
        $project = AllProject::with('image', 'locales')->where('id', $id)->first();
        return $this->dataResponse($project);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules(), $this->customAttributes());

        DB::transaction(function () use ($request, $id) {
            $project = AllProject::findOrFail($id);
            $project->image_uuid = $request->image_uuid;
            $project->all_project_category_id = $request->all_project_category_id;
            $project->updated_at = now();
            $project->save();
            $project->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $project = AllProject::findOrFail($id);

            $project->locales()->delete();

            $project->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }


    private function getValidationRules(): array
    {
        return [
            'image_uuid' => 'required|exists:files,id',
            'all_project_category_id' => 'required|exists:all_project_categories,id',
            'locales.*.local' => 'required',
            'locales.*.text' => 'required',
        ];
    }

    public function customAttributes(): array
    {
        return [
            'image_uuid.required' => 'İmage id mütləqdir',
            'image_uuid.exists' => 'İmage id mövcud deyil',
            'all_project_category_id.required' => 'Kateqoriya id mütləqdir',
            'all_project_category_id.exists' => 'Kateqoriya id mövcud deyil',
            'locales.*.text.required' => 'Mətn mütləqdir',
            'locales.*.local.required' => 'Dil seçimi mütləqdir'
        ];
    }
}
