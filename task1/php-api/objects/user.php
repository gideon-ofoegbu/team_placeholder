<?php
include_once 'core.php';

class User{
 
    // database connection
    private $conn;
 
    // object properties should only be fields on object table
    private $user_id;
    public $role_id;
    public $email;
    public $password;
    public $token;
    public $auth;
    public $date_created;
    public $date_updated;
    public $lastInsertId;
    public $profile_id;
    public $phone;
    public $firstname;
    public $lastname;


 
    // constructor with $conn as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function register()
    {
        $Core = new Core(); 

        //clean and sanitize data
        $this->email = $Core->sanitize($this->email);
        $this->password = $Core->sanitize($this->password);
        $this->auth = $Core->sanitize($this->auth);

        $query = $this->conn->prepare("SELECT email, phone FROM user WHERE email = :email OR phone = :phone");
        //bind query params
        $query->bindParam("email", $this->email, PDO::PARAM_STR);
        $query->bindParam("phone", $this->phone, PDO::PARAM_STR);
        $query->execute();
        //get query result
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if($query->rowCount() == 1){
            return false; //"User already exist";
        }else{                       
            $active = 1;
            //create token for mail auth            
            $this->token = $Core->generateToken();
 
            //insert user
            $query = $this->conn->prepare("INSERT INTO user(fname, lname, email, phone, password, token, active) 
            VALUES (:fname, :lname, :email,:phone,:pass,:token,:uactive)");   
            //bind query params
            $query->bindParam("fname", $this->firstname, PDO::PARAM_STR);
            $query->bindParam("lname", $this->lastname, PDO::PARAM_STR);
            $query->bindParam("email", $this->email, PDO::PARAM_STR);
            $query->bindParam("phone", $this->phone, PDO::PARAM_STR);
            $query->bindParam("pass", $this->password, PDO::PARAM_STR);              
            $query->bindParam("token", $this->token, PDO::PARAM_STR);
            $query->bindParam("uactive", $active, PDO::PARAM_INT); //1 means user is active
            //execute query 
            $query->execute();                
            //get last inserted id    
            $this->lastInsertId = $this->conn->lastInsertId();      
            //convert to integer      
            settype($this->lastInsertId, "integer"); 
            //insert to logAction
            return true;            
        }   
    }
    function verifyUser(){

    }
    function getLastInserId(){
        return $this->lastInsertId;
    }

    function getUserId(){
        $Core = new Core();
        return $Core->getUserID();
    }
    
public  function login(){
        $Core = new Core();
        //clean and sanitize data
        $this->phone = $Core->sanitize($this->phone);
        $this->password = $Core->sanitize($this->password);

        $query = $this->conn->prepare("SELECT * FROM user WHERE phone = :phone AND password = :password");
        $query->bindParam("phone", $this->phone, PDO::PARAM_STR);
        $query->bindParam("password", $this->password, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
         if($query->rowCount() == 1){
                $this->user_id = $row["user_id"];
                $date_updated = date("Y-m-d");
                $stat = "expired";
               // echo $this->user_id;
                $query = $this->conn->prepare("UPDATE `log_session` SET `timestamp` = '$date_updated', `status` = '$stat' WHERE `user_id` = :uid"); 
                 // Bind params
                $query->bindParam("uid", $this->user_id, PDO::PARAM_INT);
                $query->execute();

                $timestamp = date("Y-m-d");
                $session_id = $Core->generateSession();
                $status = "active";

                $query = $this->conn->prepare("INSERT INTO log_session (session_id,user_id,timestamp, status) VALUES (:session_id,:user_id,:timestamp,:status)");
                
                //bind query params
                $query->bindParam("session_id", $session_id, PDO::PARAM_STR);
                $query->bindParam("user_id", $this->user_id, PDO::PARAM_STR);
                $query->bindParam("timestamp", $timestamp, PDO::PARAM_STR);
                $query->bindParam("status", $status, PDO::PARAM_STR);

                if($query->execute()){
                    $_SESSION['session_id'] = $session_id;
                    //insert to logAction
                    $log = $Core->logAction($this->user_id, "User login", "Login"); 
                    //check if log successfully insert or not
                    return $log ? true : false;
                }else{
                    return false;
                }

            
               
        }
        else{
            return false;
        }
    }

      public function getUserData(){
        $Core = new Core();
            $user_id = $this->user_id;
            $query = $this->conn->prepare("SELECT * FROM `user` WHERE user_id = :user_id");
            $query->bindParam("user_id", $user_id, PDO::PARAM_INT);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
           // extract($row);
            $name = $row['firstname']." ".$row['lastname'];
            $data = array('name' => $name, 'phone' => $row['phone'], 'email' => $row['email'], 'session_id'=> $_SESSION['session_id']);
            return $data;
       
    }
}