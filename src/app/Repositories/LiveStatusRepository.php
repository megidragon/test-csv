<?php
namespace App\Repositories;

use App\Models\Csv;
use App\Models\LiveStatus;

class LiveStatusRepository
{
    public function getStatus()
    {
        $data = LiveStatus::where('session_id', session()->getId())->first();
        return !empty($data) ? $data->status : null;
    }
}
