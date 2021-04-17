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

    /**
     * @param $request
     * @throws \Exception
     */
    public function process($request): void
    {
        session()->put('hash', md5(session()->getId().random_int(0, 9999)));

        $request->file('csv')->storeAs('files', session()->get('hash').'.csv');

        LiveStatus::create([
            'status' => LiveStatus::$STARTING,
            'session_id' => session()->get('hash')
        ]);

        ProcessCsv::dispatch();
    }
}
