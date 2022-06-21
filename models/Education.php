<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) .$ds.'..').$ds;

require_once("{$base_dir}includes{$ds}Database.php");

class Education{
    private $table = 'education';

    public $education_id;
    public $school_name;
    public $graduate_date;
    public $graduate_grade;
    




    public function __construct(){

    }
    
    public function validate_params($value){
        return (!empty($value));
    }

    public function add_education_info(){
        global $database;

    $this->education_id = trim(htmlspecialchars(strip_tags($this->education_id)));
    $this->school_name = trim(htmlspecialchars(strip_tags($this->school_name)));
    $this->graduate_grade = trim(htmlspecialchars(strip_tags($this->graduate_grade)));
    $this->graduate_date = trim(htmlspecialchars(strip_tags($this->graduate_date)));

    

    $sql = "INSERT INTO $this->table (education_id, school_name, graduate_grade, graduate_date) VALUES (
      '".$database->escape_value($this->education_id)."',
      '".$database->escape_value($this->school_name)."',
      '".$database->escape_value($this->graduate_grade)."',
      '".$database->escape_value($this->graduate_date)."'
    

    
    )";

    $patient_saved = $database->query($sql);

    if($patient_saved){
        return true;
    }
    else{
        return false;
    }
    }
   

    /* public function patient_all_information(){
        global $database;

        $sql = "SELECT patient.patient_id,
         patient.user_id,
          patient.phone_number,
           patient.birth_date,
            patient.age,
             patient.situation,
             user.name,
             user.surname,
             user.email
             FROM 'patient'
             INNER JOIN 'user'
             ON  'patient'.'user_id' = 'user'.'user_id'";
     }*/
}

$education = new Education();

