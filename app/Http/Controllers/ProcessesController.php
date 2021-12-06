<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ProcessLocale;

class ProcessesController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $processes = Process::query()->with('image', 'locales')->get();
        return response($processes);
    }

    public function store(Request $request)
    {
        $process_id = null;

        DB::transaction(function () use ($request, &$process_id) {
            $process = new Process();
            $process->fill($request->only([
                'image_uuid'
            ]));
            $process->save();

            $this->setLocales($request->input("locales"));

            $process_id = $process->id;
        });

        return $this->dataResponse(['process_id' => $process_id], 201);
    }


    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $process = Process::findOrFail($id);
            $process->fill($request->only([
                'image_uuid'
            ]));

            $process->save();

            $this->setLocales($request->input("locales"));
        });

        return $this->successResponse(trans('responses.ok'));
    }

    public function destroy($id)
    {

        DB::transaction(function () use ($id) {
            $process = Process::findOrFail($id);

            $process->processLocales()->delete();

            $process->delete();
        });

        return $this->successResponse(trans("responses.ok"));
    }


    public function show($id)
    {
        $process = Process::with('image', 'locales')->where('id', $id)->first();
        return $this->dataResponse($process);
    }
}
