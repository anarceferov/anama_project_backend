<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;

/**
 * Class FileController
 * @package App\Http\Controllers
 */
class FileController extends Controller
{
    use ApiResponder;

    private $fileService;


    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }


    public function uploadSingleImage(Request $request): JsonResponse
    {
        $this->validate($request, [
            'image_uuid' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        $image = $this->fileService->uploadFile($request->file('image_uuid'));

        return $this->dataResponse(['image__uuid' => $image->getKey()]);
    }

    // public function uploadSingleIcon(Request $request): JsonResponse
    // {
    //     $this->validate($request, [
    //         'icon_uuid' => 'required'
    //     ]);

    //     $icon = $this->fileService->uploadFile($request->file('icon_uuid'));

    //     return $this->dataResponse(['icon__uuid' => $icon->getKey()]);
    // }

    public function uploadFile(Request $request): JsonResponse
    {
        $this->validate($request, [
            'file_uuid' => 'required|file|mimes:pdf,doc,docx'
        ]);

        $image = $this->fileService->uploadFile($request->file('file_uuid'));
        return $this->dataResponse(['file_uuid' => $image->getKey()]);
    }
}
