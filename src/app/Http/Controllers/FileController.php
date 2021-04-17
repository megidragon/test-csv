<?php

namespace App\Http\Controllers;

use App\Http\Requests\CsvRequest;
use App\Imports\CsvImport;
use App\Repositories\CsvExaminerRepository;
use App\Repositories\LiveStatusRepository;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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

        return redirect()->route('details');
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
