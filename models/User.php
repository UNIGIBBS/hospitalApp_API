<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) .$ds.'..').$ds;

require_once("{$base_dir}includes{$ds}Database.php");

// Class Student Start
class User{
  private $table = 'user';

  public $user_id;
  public $email;
  public $name;
  public $surname;
  public $password;
  public $user_type;


  // constructor
  public function __construct(){

  }

  // validating if params existing or not
  public function validate_params($value){
    return (!empty($value));
  }

  // to check if username is unique or not
  public function check_unique_email(){
    global $database;

    $this->email = trim(htmlspecialchars(strip_tags($this->email)));

    $sql = "SELECT user_id FROM $this->table WHERE email = '" .$database->escape_value($this->email). "'";

    $result = $database->query($sql);
    $user_id = $database->fetch_row($result);

    return empty($user_id);
  }

  // Saving new data in our database
  public function register_user() {
    global $database;

    $this->name = trim(htmlspecialchars(strip_tags($this->name)));
    $this->surname = trim(htmlspecialchars(strip_tags($this->surname)));
    $this->email = trim(htmlspecialchars(strip_tags($this->email)));
    $this->password = trim(htmlspecialchars(strip_tags($this->password)));
    $this->user_type = trim(htmlspecialchars(strip_tags($this->user_type)));
    

    $sql = "INSERT INTO $this->table (name, surname, email, password, user_type) VALUES (
      '".$database->escape_value($this->name)."',
      '".$database->escape_value($this->surname)."',
      '".$database->escape_value($this->email)."',
      '".$database->escape_value($this->password)."',
      '".$database->escape_value($this->user_type)."'
    )";

    $user_saved = $database->query($sql);

    if ($user_saved) {
      return true;
    }
    else {
      return false;
    }
  }

  // Login Function
  public function login(){
    global $database;

    $this->email = trim(htmlspecialchars(strip_tags($this->email)));
    $this->password = trim(htmlspecialchars(strip_tags($this->password)));

    $sql = "SELECT * FROM $this->table WHERE email = '" .$database->escape_value($this->email). "'";

    $result = $database->query($sql);
    $user = $database->fetch_row($result);

    if (empty($user)) {
      return "User doesn't exist.";
    }
    else {
      if ($this->password == $user['password']) {
        unset($user['password']);
        return $user;
      }
      else{
        return "Password doesn't match";
      }
    }
  }

  public function all_users(){
     global $database;

     $sql = "SELECT user_id, name, surname, user_type FROM $this->table";

     $result = $database->query($sql);

     return $database->fetch_array($result);

  }

  public function an_user() {
    global $database;

    $sql = "SELECT * FROM $this->table WHERE email = '" .$database->escape_value($this->email). "'";

    $result = $database->query($sql);
    return $database->fetch_row($result);
  }

  public function update_user_info() {
    global $database;

    $sql = "UPDATE $this->table 
    SET name = '" .(string) $this->name. "',
    surname = '" .(string) $this->surname. "',
    password = '" .(string) $this->password. "' WHERE user_id = '" .(int) $this->user_id. "'";
    
    $user_updated = $database->query($sql);

    if ($user_updated) {
      return true;
    }
    else {
      return false;
    }
  }

  public function delete_user() {
    global $database;

    $sql = "DELETE FROM $this->table
    WHERE user_id = '".(int) $this->user_id."' AND email = '".(string) $this->email."'";


    $user_saved = $database->query($sql);
    

    if ($user_saved) {
      return true;
    }
    else {
      return false;
    }
  }

  // method to return the list of seller


  
}

$user = new User();
