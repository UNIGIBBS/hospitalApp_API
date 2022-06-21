<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Patient.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($patient->validate_params($_POST['user_id'])) {
      $patient->user_id = $_POST['user_id'];
    }
    else {
      echo json_encode(array('success' => 0, 'message' => 'User id is required'));
      die();
    }
  
    if ($patient->validate_params($_POST['phone_number'])){
      $patient->phone_number = $_POST['phone_number'];
    }
    else {
      echo json_encode(array('success' => 0, 'message' => 'Phone number is required'));
      die();
    }
 
  
   if ($patient->validate_params($_POST['birth_date'])){
      $patient->birth_date = $_POST['birth_date'];
    }
    else {
      echo json_encode(array('success' => 0, 'message' => 'Birthdate is required'));
      die();
    }

    if ($patient->validate_params($_POST['age'])){
        $patient->age = $_POST['age'];
      }
      else {
        echo json_encode(array('success' => 0, 'message' => 'Age is required'));
        die();
      }

    if ($patient->validate_params($_POST['illnes_name'])){
        $patient->illnes_name = $_POST['illnes_name'];
      }
      else {
        echo json_encode(array('success' => 0, 'message' => 'Illnes name is required'));
        die();
      }
  
      if ($patient->validate_params($_POST['situation'])){
        $patient->situation = $_POST['situation'];
      }
      else {
        echo json_encode(array('success' => 0, 'message' => 'Situation is required'));
        die();
      }
    if($id = $patient->add_patient_profile()){
      echo json_encode(array('success' => 1, 'message' => 'Patient profile successfully added!', 'id' => $id));
    }
    else{
        http_response_code(500);
        echo json_encode(array('success' => 0, 'message' => 'Internal Server Error!'));
    }
  } else {
    die(header('HTTP/1.1 405 Request Method Not Allowed'));
  }
  
