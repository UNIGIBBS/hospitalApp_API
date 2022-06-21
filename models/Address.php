<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) .$ds.'..').$ds;

require_once("{$base_dir}includes{$ds}Database.php");

class Address{
    private $table = 'address';

    public $address_id;
    public $city_name;
    public $district_name;
    public $no;
    public $floor;
    public $neighbourhood;
    




    public function __construct(){

    }
    
    public function validate_params($value){
        return (!empty($value));
    }

    public function add_address_info(){
        global $database;

    $this->address_id = trim(htmlspecialchars(strip_tags($this->address_id)));
    $this->city_name = trim(htmlspecialchars(strip_tags($this->city_name)));
    $this->district_name = trim(htmlspecialchars(strip_tags($this->district_name)));
    $this->no = trim(htmlspecialchars(strip_tags($this->no)));
    $this->floor = trim(htmlspecialchars(strip_tags($this->floor)));
    $this->neighbourhood = trim(htmlspecialchars(strip_tags($this->neighbourhood)));

    

    $sql = "INSERT INTO $this->table (address_id, city_name, district_name, no, floor, neigbourhood) VALUES (
      '".$database->escape_value($this->address_id)."',
      '".$database->escape_value($this->city_name)."',
      '".$database->escape_value($this->district_name)."',
      '".$database->escape_value($this->no)."',
      '".$database->escape_value($this->floor)."',
      '".$database->escape_value($this->neighbourhood)."',
    

    
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

$address = new Address();

