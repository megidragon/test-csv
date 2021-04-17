<?php

namespace App\Http\Controllers;

use App\Http\Requests\CsvRequest;
use App\Repositories\LiveStatusRepository;
use App\Services\FileService;

class FileController extends Controller
{
    public function __construct(
        private FileService $fileService,
        private LiveStatusRepository $liveStatusRepository
    )
    {
    }

    public function uploadCsv(CsvRequest $request)
    {
        $this->fileService->process($request);

        return redirect()->route('list');
    }

    public function getProccessStatus()
    {
        return response()->json([
            'type' => 'success',
            'data' => [
                'status' => $this->liveStatusRepository->getStatus()
            ]
        ]);
    }
}
