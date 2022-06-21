<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  
  if ($user->validate_params($_POST['user_id'])) {
    $user->user_id = $_POST['user_id'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'user_id is required'));
    die();
  }
  
  if ($user->validate_params($_POST['name'])) {
    $user->name = $_POST['name'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'name is required'));
    die();
  }

  if ($user->validate_params($_POST['surname'])) {
    $user->surname = $_POST['surname'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'surname is required'));
    die();
  }

  if ($user->validate_params($_POST['password'])) {
    $user->password = $_POST['password'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'password is required'));
    die();
  }

  

  if ($id = $user->update_user_info()){
    echo json_encode(array('success' => 1, 'message' => 'User is updated'));
  } else {
    http_response_code(500);
    echo json_encode(array('success'  => 0, 'message' => 'Internal Server Error'));
  }
}
else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}

