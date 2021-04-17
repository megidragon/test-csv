<?php

namespace App\Jobs;

use App\Imports\CsvImport;
use App\Models\LiveStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class ProcessCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        logger()->info('Inicia proceso de importación');
        $files = Storage::disk('local')->files('files');

        foreach ($files as $file)
        {
            $full_path = storage_path('app/'.$file);

            // Validaciones hardcore
            if (substr($file, -4) !== '.csv')
            {
                File::delete($full_path);
                continue;
            }

            $sid = substr(basename($file), 0, -4);
            $status = LiveStatus::where('session_id', $sid)->first();

            if (empty($status))
            {
                File::delete($full_path);
                continue;
            }
            // Fin validaciones

            logger()->info('Ejecutando proceso para usuario: '.$sid);

            // Guarda inicio del procesamiento del archivo
            $status->status = LiveStatus::$IN_PROCESS;
            $status->save();

            $start_time = microtime(true);

            // Ejecuta el procesamiento asincrono del archivo csv
            Excel::import(new CsvImport(), $full_path);

            $status->status = LiveStatus::$FINISHED;
            $status->save();

            $end_time = microtime(true);
            $execution_time = ($end_time - $start_time);
            logger()->info('TIEMPO DE EJCUCION DE ITERACION: '.$execution_time);
        }
    }
}
