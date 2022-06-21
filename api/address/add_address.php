<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Address.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($address->validate_params($_POST['address_id'])) {
      $address->address_id = $_POST['address_id'];
    }
    else {
      echo json_encode(array('success' => 0, 'message' => 'Address id is required'));
      die();
    }
    if ($address->validate_params($_POST['city_name'])) {
        $address->city_name = $_POST['city_name'];
      }
      else {
        echo json_encode(array('success' => 0, 'message' => 'City name is required'));
        die();
      }
      if ($address->validate_params($_POST['district_name'])) {
        $address->district_name = $_POST['district_name'];
      }
      else {
        echo json_encode(array('success' => 0, 'message' => 'District name is required'));
        die();
      }

      if ($address->validate_params($_POST['no'])) {
        $address->no = $_POST['no'];
      }
      else {
        echo json_encode(array('success' => 0, 'message' => 'No is required'));
        die();
      }

      if ($address->validate_params($_POST['floor'])) {
        $address->floor = $_POST['floor'];
      }
      else {
        echo json_encode(array('success' => 0, 'message' => 'Floor is required'));
        die();
      }

      if ($address->validate_params($_POST['neighbourhood'])) {
        $address->neighbourhood = $_POST['neighbourhood'];
      }
      else {
        echo json_encode(array('success' => 0, 'message' => 'Neighbourhood is required'));
        die();
      }
    
    
    
  
    if($id = $address->add_address_info()){
      echo json_encode(array('success' => 1, 'message' => 'Patient address is successfully added!', 'id' => $id));
    }
    else{
        http_response_code(500);
        echo json_encode(array('success' => 0, 'message' => 'Internal Server Error!'));
    }
  } else {
    die(header('HTTP/1.1 405 Request Method Not Allowed'));
  }
  
