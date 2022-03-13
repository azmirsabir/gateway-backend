<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Ramsey\Uuid\Uuid;

trait CSVExporter
{

    public function export_array_data_to_csv($array_data, $export_columns, $file_name, $is_save = false)
    {
        try {
            $headers = array(
                'Content-Type' => 'application/txt',
                'Cache-Control' => 'must-revalidate',
                'Content-Transfer-Encoding' => 'binary',
                'Content-Disposition' => 'attachment;',
            );

            $file_name = $file_name . '.csv';
            $handle = fopen($file_name, 'w');
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($handle, $export_columns);

            foreach ($array_data as $key => $row) {
                fputcsv($handle, (array)$row);
            }

            fclose($handle);

            return response()->download($file_name, $file_name, $headers)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ('failed_to_export');
        }
    }

}
