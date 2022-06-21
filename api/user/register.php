<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($user->validate_params($_POST['name'])) {
    $user->name = $_POST['name'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'Name is required'));
    die();
  }

  if ($user->validate_params($_POST['surname'])){
    $user->surname = $_POST['surname'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'Surname is required'));
    die();
  }

  if ($user->validate_params(isset($_POST['user_type']))){
    $user->user_type = $_POST['user_type'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'user_type is required'));
    die();
  }


if ($user->validate_params($_POST['email'])){
    $user->email = $_POST['email'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'Email is required'));
    die();
  }

  if ($user->validate_params($_POST['password'])){
    $user->password = $_POST['password'];
  }
  else {
    echo json_encode(array('success' => 0, 'message' => 'Password is required'));
    die();
  }
  if ($user->check_unique_email()){
    if ($id = $user->register_user()){
      echo json_encode(array('success' => 1, 'message' => 'User is registered'));
    } else {
      http_response_code(500);
      echo json_encode(array('success'  => 0, 'message' => 'Internal Server Error'));
    }
  } else {
    http_response_code(401);
    echo json_encode(array('success' => 0, 'message' => 'Username already exists'));
  }
} else {
  die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
