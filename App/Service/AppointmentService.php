<?php
namespace App\Service;

class AppointmentService
{
    const ERROR_INVALID_CODE = 'The datetime_start is not valid.';

    public static function validate($payload = [])
    {
        $response = [
            'status' => 'success',
        ];
        if (isset($payload['datetime_start']) && !empty($payload['datetime_start'])) {
            $datetimeStart = $payload['datetime_start'];
            $pattern = '/^20[\d][\d]-(?:0[1-9]|1[0-2])-(?:0[1-9]|[1-2]\d|3[0-1])T(?:[0-1]\d|2[0-3]):[0-5]\d:[0-5]\d\-[\d][\d]\:[\d][\d]$/';
            if (!preg_match($pattern, $datetimeStart)) {
                $response = [
                    'status' => 'error',
                    'message' => self::ERROR_INVALID_CODE
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => self::ERROR_INVALID_CODE
            ];
        }
        if ($response['status'] == 'error') {
            $response['available'] = 'false';
        }
        return $response;
    }

    public static function available($success)
    {
        $response = [];
        if ($success) {
            $response['status'] = 'success';
            $response['message'] = 'The datetime_start is available.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'The datetime_start is not available.';
        }
        $response['available'] = $success;
        return $response;
    }
}