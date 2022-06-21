<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) .$ds.'..').$ds;

require_once("{$base_dir}includes{$ds}Database.php");

class Doctor{
    private $table = 'doctor';

    public $doctor_id;
    public $user_id;
    public $department;
    public $appellation;
    public $education_id;

    // Foreign atributtes
    public $email;


    public function __construct(){

    }

    public function validate_params($value){
        return (!empty($value));
    }

    public function add_doctor_profile(){
        global $database;

    $this->user_id = trim(htmlspecialchars(strip_tags($this->user_id)));
    $this->department = trim(htmlspecialchars(strip_tags($this->department)));
    $this->appellation = trim(htmlspecialchars(strip_tags($this->appellation)));
    $this->education_id = trim(htmlspecialchars(strip_tags($this->education_id)));
    

    $sql = "INSERT INTO $this->table (user_id, department, appellation, education_id) VALUES (
      '".$database->escape_value($this->user_id)."',
      '".$database->escape_value($this->department)."',
      '".$database->escape_value($this->appellation)."',
      '".$database->escape_value($this->education_id)."'
    
    )";
    

    $doctor_saved = $database->query($sql);

    if($doctor_saved){
        return true;
    }
    else{
        return false;
    }
    }

    public function all_doctors(){
        global $database;
   
        $sql = "SELECT doctor_id, user_id, department, appellation, education_id FROM $this->table";
   
        $result = $database->query($sql);
   
        return $database->fetch_array($result);
   
     }
     public function an_doctor() {
        global $database;
    
        $sql = "SELECT doctor.doctor_id, doctor.department, doctor.appellation, doctor.education_id, doctor.user_id, user.name AS user_name, user.surname AS user_surname, user.email AS user_email
                FROM $this->table
                INNER JOIN user 
                ON doctor.user_id = user.user_id
                WHERE user.email = 'gulayekcan@gmail.com'";
    
        $result = $database->query($sql);
        return $database->fetch_row($result);
      }

     public function doctor_all_information(){
        global $database;

        $sql = "SELECT * FROM doctor JOIN user ON doctor.user_id = user.user_id;";
             
             $result = $database->query($sql);

              return $database->fetch_array($result);
     }
}

$doctor = new Doctor();

