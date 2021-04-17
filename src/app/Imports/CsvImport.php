<?php

namespace App\Imports;

use App\Models\Csv;
use DateTime;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class CsvImport implements ToModel, WithCustomCsvSettings, WithChunkReading, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return Csv
     */
    public function model(array $row)
    {
        // Force validation per row
        if (!$this->isValid($row))
        {
            return null;
        }

        return new Csv([
            'id' => $row[0],
            'session_id' => session()->getId(),
            'zone' => $row[1],
            'from' => $row[2],
            'to' => $row[3],
        ]);
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ";"
        ];
    }

    private function validateDateFormat($date, $format = 'Y-m-d'){
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    private function isValid($row)
    {
        return !(
            empty($row[0]) ||
            !is_numeric($row[0]) ||
            empty($row[1]) ||
            strlen($row[1]) > 1 ||
            empty($row[2]) ||
            !$this->validateDateFormat($row[2]) ||
            empty($row[3]) ||
            !$this->validateDateFormat($row[3])
        );
    }

    public function batchSize(): int
    {
        return 400;
    }

    public function chunkSize(): int
    {
        return 400;
    }
}
