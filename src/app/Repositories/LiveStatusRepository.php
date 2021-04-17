<?php
namespace App\Repositories;

use App\Models\Csv;
use App\Models\LiveStatus;

class LiveStatusRepository
{
    public function getStatus($sid)
    {
        $data = LiveStatus::where('session_id', $sid)->first();
        return !empty($data) ? $data->status : null;
    }

    public function getList()
    {
        $data = LiveStatus::all();
        return !empty($data) ? $data : [];
    }
}
