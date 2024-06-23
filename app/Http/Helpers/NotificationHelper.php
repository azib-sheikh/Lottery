<?php

namespace App\Http\Helpers;

class NotificationHelper {


    public static function successResponse($message)
    {
        return self::responseGenerator($message, 'success');
    }

    public static function errorResponse($message)
    {
        return self::responseGenerator($message, 'error');
    }
    
    private static function responseGenerator($message, $type)
    {
        flash()->options([
            'timeout' => 10000, // 10 seconds
            'position' => 'top-center',
        ])->{"add" . $type}($message);
    }


}