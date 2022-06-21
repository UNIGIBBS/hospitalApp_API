<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Doctor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($doctor->validate_params($_POST['user_id'])) {
      $doctor->user_id = $_POST['user_id'];
    }
    else {
      echo json_encode(array('success' => 0, 'message' => 'User id is required'));
      die();
    }
  
    if ($doctor->validate_params($_POST['department'])){
      $doctor->department = $_POST['department'];
    }
    else {
      echo json_encode(array('success' => 0, 'message' => 'Department is required'));
      die();
    }
 
  
   if ($doctor->validate_params($_POST['appellation'])){
      $doctor->appellation = $_POST['appellation'];
    }
    else {
      echo json_encode(array('success' => 0, 'message' => 'Appellation is required'));
      die();
    }

    if ($doctor->validate_params($_POST['education_id'])){
      $doctor->education_id = $_POST['education_id'];
    }
    else {
      echo json_encode(array('success' => 0, 'message' => 'Appellation is required'));
      die();
    }
  
    if($id = $doctor->add_doctor_profile()){
      echo json_encode(array('success' => 1, 'message' => 'Doctor profile successfully added!', 'id' => $id));
    }
    else{
        http_response_code(500);
        echo json_encode(array('success' => 0, 'message' => 'Internal Server Error!'));
    }
  } else {
    die(header('HTTP/1.1 405 Request Method Not Allowed'));
  }
  
