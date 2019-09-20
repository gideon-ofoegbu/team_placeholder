<?php

// get database connection
include_once '../../config/database.php';


class Core {

    private $conn;

    public $session_id;

    // constructor with $db as database connection
    public function __construct(){
        $database = new Database();
        $db = $database->getConnection();
        $this->conn = $db;
    }

    //sanitize data
    public function sanitize($value){
        return htmlspecialchars(strip_tags($value));
    }

    //token block
    public function generateToken(){
        $length = 72;
        return $token = bin2hex(random_bytes($length));
    }

    //session block
    public function generateSession(){
        $StringTable = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $Shuffle_string = str_shuffle($StringTable);
        $Get_half = substr($Shuffle_string, 0, strlen($StringTable)/2);
        $Generate_code = strrev(substr($Get_half, 0,8)).'-'.strrev(substr($Get_half, 5,4)).'-'.strrev(substr($Get_half, 9,4)).'-'.strrev(substr($Get_half, 12,4)).'-'.strrev(substr($Get_half, 0,12));
        return $Generate_code;
    }

    //get user id
    public function isActive($session_id){
        $sess_id = $session_id;
        if(isset($sess_id)){
        $query = $this->conn->prepare("SELECT status FROM log_session WHERE session_id = :sess");
        $query->bindParam("sess", $sess_id, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $status = $row['status'];
        if($status == 'active'){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

    //get user id
    public function getUserID($session_id){
        $sess_id = $session_id;
        $query = $this->conn->prepare("SELECT user_id FROM log_session where session_id = :sess");
        $query->bindParam("sess", $sess_id, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $uid = $row['user_id']; 
        if($uid){
            return $uid;
        }
        return $_SESSION;
    }

   
  

}

?>