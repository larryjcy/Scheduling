<?php
date_default_timezone_set('UTC');
ini_set("display_errors",true);
define("ROOT_PATH", __DIR__.DIRECTORY_SEPARATOR);
require_once __DIR__.'/App/Controller/AppointmentController.php';
require_once __DIR__.'/App/Model/Appointment.php';
require_once __DIR__.'/App/Help/Util.php';
require_once __DIR__.'/App/Service/AppointmentService.php';
$appointmentService = new APP\Controller\AppointmentController();
$_POST['datetime_start'] = "2021-11-29T11:00:00-05:00";