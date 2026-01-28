<?php


namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CustomLogger
{

    public static function logMessage(string $message = 'This is a message')
    {
        Log::channel('customlog')->info($message);
    }

    public static function logData($message = 'Data: ', $data)
    {
        Log::channel('customlog')->debug($message, [
            'data' => $data,
        ]);
    }
}
