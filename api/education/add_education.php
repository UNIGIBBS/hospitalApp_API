<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Education.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($education->validate_params($_POST['education_id'])) {
      $education->education_id = $_POST['education_id'];
    }
    else {
      echo json_encode(array('success' => 0, 'message' => 'Education id is required'));
      die();
    }
    if ($education->validate_params($_POST['school_name'])) {
        $education->school_name = $_POST['school name'];
      }
      else {
        echo json_encode(array('success' => 0, 'message' => 'School name is required'));
        die();
      }

      if ($education->validate_params($_POST['graduate_date'])) {
        $education->graduate_date = $_POST['graduate_date'];
      }
      else {
        echo json_encode(array('success' => 0, 'message' => 'Graduate date is required'));
        die();
      }

      if ($education->validate_params($_POST['graduate_grade'])) {
        $education->graduate_grade = $_POST['graduate_grade'];
      }
      else {
        echo json_encode(array('success' => 0, 'message' => 'Graduate grade is required'));
        die();
      }
    
    
    
    
  
    if($id = $education->add_education_info()){
      echo json_encode(array('success' => 1, 'message' => 'Doctor education successfully added!', 'id' => $id));
    }
    else{
        http_response_code(500);
        echo json_encode(array('success' => 0, 'message' => 'Internal Server Error!'));
    }
  } else {
    die(header('HTTP/1.1 405 Request Method Not Allowed'));
  }
  
