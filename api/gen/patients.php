<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Patient.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    echo json_encode(array('success'=> 1, 'patients' => $patient->all_patients()));
}else {
    die(header('HTTP/1.1 405 Request Method Not Allowed'));
  }