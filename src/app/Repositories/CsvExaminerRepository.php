<?php
namespace App\Repositories;

use App\Models\Csv;
use Illuminate\Support\Facades\DB;

class CsvExaminerRepository
{
    public function getDetails()
    {
        $data = Csv::where('session_id', session()->getId())->get();
        dd($data);

        Csv::where('session_id', session()->getId())->delete();
    }

    private function getDuplicates()
    {
        return DB::table('csv')
            ->select('id','zone', 'from', 'to', DB::raw('COUNT(*) as `count`'))
            ->groupBy('id','zone', 'from', 'to')
            ->havingRaw('COUNT(*) > 1')
            ->get();
    }
}
