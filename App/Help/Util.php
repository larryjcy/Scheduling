<?php
namespace App\Help;
use \Datetime;

Class Util
{
    public static function getTimeStamp($dateStr)
    {
        $utcTime = new DateTime($dateStr);
        return $utcTime->getTimestamp();
    }

    public static function jsonOut($json_response) {
        if (ENV == 'API') {
            header('Content-Type: application/json');
            if ($json_response['status'] != 'error') {
                header('Status: 400 Bad Request');
            } else {
                header('Status: 200 OK');
            }
            print json_encode($json_response);
            exit(0);
        } else {
            return $json_response;
        }
    }
}

