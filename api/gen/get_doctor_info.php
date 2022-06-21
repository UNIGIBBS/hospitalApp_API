<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Doctor.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    echo json_encode(array('success'=> 1, 'get_patient_info' => $doctor->doctor_all_information()));
}else {
    die(header('HTTP/1.1 405 Request Method Not Allowed'));
  }