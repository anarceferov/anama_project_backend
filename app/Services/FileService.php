<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class FileService
{
    private $model;

    public function __construct(File $file)
    {
        $this->model = $file;
    }

    public function uploadFile(UploadedFile $uploadedFile, $isPublic = true): File
    {

        $ext = $uploadedFile->getClientOriginalExtension();
        $name = $this->createNewPhotoName($ext);
        if ($isPublic) {
            $storagePath = 'public/files';
            $dbPath = 'files' . '/' . $name;
        } else {
            $storagePath = 'private/files';
            $dbPath = 'private/files' . '/' . $name;
        }
        $uploadedFile->storeAs($storagePath, $name);

        $this->model->fill([
            'path' => $dbPath,
            "extension" => $ext
        ])->save();

        return $this->model;
    }

    private function createNewPhotoName(string $ext): string
    {
        return strtolower(Str::random(10) . '_' . time() . '.' . $ext);
    }

}