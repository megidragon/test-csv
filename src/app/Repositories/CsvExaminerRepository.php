<?php
namespace App\Repositories;

use App\Models\Csv;
use DateTime;
use Illuminate\Support\Facades\DB;

class CsvExaminerRepository
{
    public function getDetails($sid)
    {
        $csv = new CSV;

        $ids = $csv->distinct('id')->where('session_id', $sid)->pluck('id');

        $beginning = $csv
            ->selectRaw('id, MIN(`from`) as \'beginning\'')
            ->where('session_id', $sid)
            ->groupBy('id')
            ->get()
            ->toArray();
        $beginning = array_column($beginning, 'beginning', 'id');

        $end = $csv
            ->selectRaw('id, MIN(`to`) as \'end\'')
            ->where('session_id', $sid)
            ->groupBy('id')
            ->get()
            ->toArray();
        $end = array_column($end, 'end', 'id');

        $errors = $csv
            ->where('session_id', $sid)
            ->whereRaw('`from` > `to`')
            ->get()
            ->count();

        $duplicates = $csv
            ->select('id','session_id', 'zone', 'from', 'to', DB::raw('COUNT(*) as `count`'))
            ->groupBy('id', 'session_id', 'zone', 'from', 'to')
            ->havingRaw('COUNT(*) > 1')
            ->get()
            ->count();

        $data = [
            'duplicates' => $duplicates,
            'errors' => $errors,
            'ids' => []
        ];

        foreach ($ids as $id)
        {
            $missing_dates = $this->getMissingDates($sid, $id);

            $data['ids'][$id] = [
                'beginning' => $beginning[$id],
                'end' => $end[$id],
                'missing_dates' => $missing_dates
            ];
        }

        return $data;
    }

    private function getMissingDates($sid, $id)
    {
        $missing_dates = [];
        $res = Csv::where('session_id', $sid)
            ->where('id', $id)
            ->orderBy('from', 'ASC')
            ->get();
        $current_to = $res[0]->to;

        foreach($res as $date)
        {
            if ($date->from < $current_to && $date->to <= $current_to)
            {
                continue;
            }
            elseif ($date->to > $current_to)
            {
                if ($date->from > $current_to)
                {
                    $d = new DateTime($date->from);
                    $d2 = new DateTime($current_to);
                    if ($d2->modify('+1 day') != $d)
                    {
                        $missing_dates[] = [
                            'from' => $current_to,
                            'to' => $date->from
                        ];
                    }
                }
                $current_to = $date->to;
            }
            elseif ($date->from > $current_to)
            {
                $d = new DateTime($date->from);
                $d2 = new DateTime($current_to);
                if ($d2->modify('+1 day') != $d)
                {
                    $missing_dates[] = [
                        'from' => $current_to,
                        'to' => $date->from
                    ];
                } else
                {
                    $current_to = $date->to;
                }
            }

        }

        return $missing_dates;
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
