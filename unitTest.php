<?php

require_once 'load.php';
define("ENV", 'TEST');
$success = true;
$availableDates = [
    '2021-11-29T11:00:00-05:00',
    '2021-11-30T16:00:00-05:00',
    '2021-11-30T14:00:00-06:00',
    '2021-11-30T13:00:00-05:00'
];

foreach ($availableDates as $datetimeStart) {
    $_POST['datetime_start'] = $datetimeStart;
    $result = $appointmentService->check();
    if (!$result['available']) {
        print "datetime_start:  {$datetimeStart} available validation failed \r\n";
        $success = false;
    }
}
// The test case for '2021-11-30T10:00:00-06:00' should be not available
$existsDates = [
    '2021-11-30T10:00:00-05:00',
    '2021-11-30T09:00:00-06:00',
    '2021-11-30T11:00:00-06:00'
];
foreach ($existsDates as $datetimeStart) {
    $_POST['datetime_start'] = $datetimeStart;
    $result = $appointmentService->check();
    if ($result['available']) {
        print "datetime_start:  {$datetimeStart} existing validation failed \r\n";
        $success = false;
    }
}

$invalidDates = [
    '2222-99-85T08:00:00-ABC123',
    '',
    '1222-99-85T10:00:00-06:00',
    '2021-09-11',
    '2021-11-30T10:00:00',
    '2021-11-30T16:00:00-05:00:000333',
    '12021-11-30T16:00:00-05:00:000333',
    '2021-11-40T10:00:00-06:00',
    '2021-31-30T10:00:00-06:00',
    '2021-11-10T28:00:00-06:00'


];
foreach ($invalidDates as $invalidDate) {
    $_POST['datetime_start'] = $invalidDate;
    $result = $appointmentService->check();
    if ($result['status'] != 'error') {
        print "datetime_start:  {$invalidDate} validation failed \r\n";
        $success = false;
    }
}
if ($success) {
    print "Unit test pass!\r\n";
}