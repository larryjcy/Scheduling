<?php
namespace App\Model;
use App\Help\Util;

class Appointment
{

    public static function findAllAppoints()
    {
        $appointmentList = [];
        try {
            $appointments = file_get_contents(ROOT_PATH .'/data/blocks.json');
            $appointmentList =  json_decode($appointments);
            foreach ($appointmentList as $appointment) {
                $appointment->datetimeFrom = Util::getTimeStamp($appointment->datetime_from);
                $appointment->datetimeTo = Util::getTimeStamp($appointment->datetime_to);
            }
        } catch (Exception $e) {
            // Log error
        }
        return $appointmentList;
    }

}
