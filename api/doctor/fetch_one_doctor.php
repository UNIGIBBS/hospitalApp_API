<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Doctor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  if ($doctor->validate_params($_POST['email'])) {
    $doctor->email = $_POST['email'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'email is required'));
    die();
  }

  $u = $doctor->an_doctor();
  echo json_encode(array('success' => 1, 'message' => 'User is fetched', 'doctor' => $u));
}
else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
