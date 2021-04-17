<?php
namespace App\Services;

use App\Jobs\ProcessCsv;
use App\Models\Csv;
use App\Models\LiveStatus;
use App\Repositories\CsvExaminerRepository;
use App\Repositories\LiveStatusRepository;

class FileService
{
    public function __construct(
        private LiveStatusRepository $liveStatusRepository
    )
    {
    }

    public function process($request): void
    {
        $status = $this->liveStatusRepository->getStatus();
        if ($status !== null && $status !== LiveStatus::$FINISHED)
        {
            return;
        }

        $request->file('csv')->storeAs('files', session()->getId().'.csv');

        LiveStatus::create([
            'status' => LiveStatus::$STARTING,
            'session_id' => session()->getId()
        ]);

        ProcessCsv::dispatch();
    }
}
