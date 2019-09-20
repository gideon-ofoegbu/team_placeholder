<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../../config/database.php';
// get user and profile object
include_once '../../objects/user.php';
include_once '../../objects/profile.php';
 
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$profile = new Profile($db);
 
// get posted data
$pass = hash('sha512', $_POST["password"]);
$data = array(
    "phone" => $_POST["phone"], 
    "password" => $pass
);

 
// make sure data is not empty
if(!empty($data['phone']) && !empty($data['password'])){
    
    //user object data
    $user->phone = $data['phone'];
    $user->password = $data['password'];

    //register user
    $result = $user->login();
    $data = $user->getUserData();
    if($result){
            
            // set response code - 201 created
            http_response_code(201);
            echo json_encode(array("status" => "success", "message" => "User login.","data" => $data));
        }else{
            // set response code - 503 service unavailable
            http_response_code(503);
            echo json_encode(array("status" => "error", "message" => "Invalid login details.","data" => null));
        }        
  }else{
      echo json_encode(array("status" => "error", "message" => "Cannot submit empty field.","data" => null));
  }
?>