<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) .$ds.'..').$ds;

require_once("{$base_dir}includes{$ds}Database.php"); 

class Appointment {
    private $table = 'appointment';

    public $appointment_id;
    public $patient_id;
    public $doctor_id;
    public $date;


    public function __construct(){}

    public function validate_params($value){
        return (!empty($value));
    }

    public function add_appointment(){
        global $database;
    
        $this->date = trim(htmlspecialchars(strip_tags($this->date)));
        $this->patient_id = trim(htmlspecialchars(strip_tags($this->patient_id)));
        $this->doctor_id = trim(htmlspecialchars(strip_tags($this->doctor_id)));

         
          $sql = "INSERT INTO $this->table (date, patient_id, doctor_id) VALUES (
    
            '".$database->escape_value($this->date)."',
            '".$database->escape_value((int) $this->patient_id)."',
            '".$database->escape_value((int) $this->doctor_id)."'
          )";
    
          $saved = $database->query($sql);
    
          if ($saved) {
            return true;
          }
          else {
            return false;
          }
    }

    public function appointment_update(){
        global $database;

        $this->doctor_id = trim(htmlspecialchars(strip_tags($this->doctor_id)));
        $this->patient_id = trim(htmlspecialchars(strip_tags($this->patient_id)));
        $this->date = trim(htmlspecialchars(strip_tags($this->date)));

        $sql = "UPDATE $this->table 
    SET doctor_id = '" .(string) $this->doctor_id. "',
    date = '" .$this->date. "'
    WHERE user_id = '" .(int) $this->patient_id. "'";
    
    $user_updated = $database->query($sql);

    if ($user_updated) {
      return true;
    }
    else {
      return false;
    }
       

    }

    public function appointment_request() {
        global $database;

        $this->date = trim(htmlspecialchars(strip_tags($this->date)));
        $this->patient_id = trim(htmlspecialchars(strip_tags($this->patient_id)));
        $this->doctor_id = trim(htmlspecialchars(strip_tags($this->doctor_id)));

        $sql = "SELECT * FROM $this->table 
        WHERE patient_id = '" .$database->escape_value((int) $this->patient_id). "' 
        AND doctor_id = '" .$database->escape_value((int) $this->doctor_id). "' 
        AND date = '" .$database->escape_value($this->date)."'
        ";

        $result = $database->query($sql);
        return $database->fetch_row($result);
    }


}

$appointment = new Appointment();
