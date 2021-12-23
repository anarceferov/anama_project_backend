<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class FileService
{

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

        $model = new File;

        $model->fill([
            'path' => $dbPath,
            "extension" => $ext
        ])->save();

        return $model; 
    }

    private function createNewPhotoName(string $ext): string
    {
        return strtolower(Str::random(10) . '_' . time() . '.' . $ext);
    }

}