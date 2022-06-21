<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Appointment.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($appointment->validate_params($_POST['patient_id'])) {
    $appointment->patient_id = $_POST['patient_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'patient_id is required'));
    die();
  }

  if ($appointment->validate_params($_POST['doctor_id'])) {
    $appointment->doctor_id = $_POST['doctor_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'doctor_id is required'));
    die();
  }


  if ($appointment->validate_params($_POST['date'])) {
    $appointment->date = $_POST['date'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'date is required'));
    die();
  }


  if ($id = $appointment->add_appointment()){
      echo json_encode(array('success' => 1, 'message' => 'Appointment is added', 'id' => $id));
  } else {
      http_response_code(500);
      echo json_encode(array('success'  => 0, 'message' => 'Internal Server Error'));
  }
} else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
