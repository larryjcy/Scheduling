<?php
namespace App\Controller;
use App\Service\AppointmentService;
use App\Model\Appointment;
use App\Help\Util;

class AppointmentController
{
    public function check()
    {
        $response = AppointmentService::validate($_POST);
        if ($response['status'] != 'error') {
            $datetimeStart = $_POST['datetime_start'];
            $startTimeStamp = Util::getTimeStamp($datetimeStart);
            $appointments = Appointment::findAllAppoints();
            $success = true;
            foreach ($appointments as $appointment) {
                if ($startTimeStamp >= $appointment->datetimeFrom && $startTimeStamp < $appointment->datetimeTo) {
                    $success = false;
                    break;
                }
            }
            $response = AppointmentService::available($success);
        }
        return Util::jsonOut($response);
    }
}