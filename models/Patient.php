<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) .$ds.'..').$ds;

require_once("{$base_dir}includes{$ds}Database.php");

class Patient{
    private $table = 'patient';

    public $patient_id;
    public $user_id;
    public $phone_number;
    public $birth_date;
    public $age;
    public $illnes_name;
    public $situation;
    public $address_id;




    public function __construct(){

    }
    
    public function validate_params($value){
        return (!empty($value));
    }

    public function add_patient_profile(){
        global $database;

    $this->user_id = trim(htmlspecialchars(strip_tags($this->user_id)));
    $this->phone_number = trim(htmlspecialchars(strip_tags($this->phone_number)));
    $this->birth_date = trim(htmlspecialchars(strip_tags($this->birth_date)));
    $this->age = trim(htmlspecialchars(strip_tags($this->age)));
    $this->illnes_name = trim(htmlspecialchars(strip_tags($this->illnes_name)));
    $this->situation = trim(htmlspecialchars(strip_tags($this->situation)));
    

    $sql = "INSERT INTO $this->table (user_id, phone_number, birth_date, age, illnes_name, situation) VALUES (
      '".$database->escape_value($this->user_id)."',
      '".$database->escape_value($this->phone_number)."',
      '".$database->escape_value($this->birth_date)."',
      '".$database->escape_value($this->age)."',
      '".$database->escape_value($this->illness_name)."',
      '".$database->escape_value($this->situation)."'

    
    )";

    $patient_saved = $database->query($sql);

    if($patient_saved){
        return true;
    }
    else{
        return false;
    }
    }
    public function all_patients(){
        global $database;
   
        $sql = "SELECT patient_id, user_id, phone_number, birth_date, age, illnes_name, situation FROM $this->table";
   
        $result = $database->query($sql);
   
        return $database->fetch_array($result);
   
     }

     public function patient_all_information(){
        global $database;

        $sql = "SELECT * FROM patient JOIN user ON patient.user_id = user.user_id;";
             
             $result = $database->query($sql);

              return $database->fetch_array($result);
     }
}

$patient = new Patient();

