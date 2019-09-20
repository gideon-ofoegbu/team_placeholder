<?php
include_once 'core.php';

class Profile{
 
    // database connection
    private $conn;
 
    // object properties should only be fields on object table
    public $user_id;
    private $profile_id;
    public $avatar;
    public $firstname;
    public $lastname;
    public $gender;
    public $date_created;
    public $date_updated;

 
    // constructor with $conn as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function save()
    {
        $Core = new Core();

        //clean and sanitize data
        $this->firstname = $Core->sanitize($this->firstname);
        $this->lastname = $Core->sanitize($this->lastname);

        //insert user profile
        $query = $this->conn->prepare("INSERT INTO profile(user_id, firstname, lastname) VALUES (:uid,:fname,:lname)");   
        //bind query params 
        $query->bindParam("uid", $this->user_id, PDO::PARAM_STR);
        $query->bindParam("fname", $this->firstname, PDO::PARAM_STR);
        $query->bindParam("lname", $this->lastname, PDO::PARAM_STR);
        //execute query 
        $query->execute();
        $this->profile_id = $this->conn->lastInsertId();               
        if($this->profile_id){
             //check if log successfully insert or not
            return true;
        }else{
            return false;
        }         
        
    }     

    public function update(){
        $Core = new Core();

        //clean and sanitize data
        $this->avatar = $Core->sanitize($this->avatar);
        $this->firtsname = $Core->sanitize($this->firtsname);
        $this->lastname = $Core->sanitize($this->lastname);
        $this->gender = $Core->sanitize($this->gender);

        //insert user profile
        $query = $this->conn->prepare("UPDATE profile SET avatar :avatar, firstname :fname,	lastname :lname, gender	:gender, date_updated :date_updated WHERE user_id = :uid");   
        //bind query params 
        $query->bindParam("avatar", $this->avatar, PDO::PARAM_STR);
        $query->bindParam("fname", $this->firtsname, PDO::PARAM_STR);
        $query->bindParam("lname", $this->lastname, PDO::PARAM_STR);
        $query->bindParam("gender", $this->gender, PDO::PARAM_STR);
        $query->bindParam("date_updated", date("Y-m-d"), PDO::PARAM_STR);
        $query->bindParam("uid", $Core->getUserID(), PDO::PARAM_STR);
        
        //execute query                   
        if($query->execute()){
            //get last inserted id    
            $this->profile_id = $this->conn->lastInsertId();
            //insert to logAction
            $log = $Core->logAction($this->user_id, "User profile created", "Sign up"); 
            //check if log successfully insert or not
            return $log ? true : false;
        }else{
            return false;
        }   

    }

    function getUserId(){
        $Core = new Core();
        return $Core->getUserID();
    }

}