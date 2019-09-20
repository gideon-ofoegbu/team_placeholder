<?php
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
//$profile = new Profile($db);
 
// get posted data
$pass = hash('sha512', $_POST["password"]);
$data = array(
    "email" => $_POST["email"], 
    "phone" => $_POST["phone"], 
    "password" => $pass, 
    "firstname" => $_POST["fname"], 
    "lastname" => $_POST["lname"]
);

 
// make sure data is not empty
if(!empty($data['email']) && !empty($data['password']) && !empty($data['firstname']) && !empty($data['lastname']) && !empty($data['phone'])){
    
    //user object data
    $user->email = $data['email'];
    $user->phone = $data['phone'];
    $user->firstname = $data['firstname'];
    $user->lastname = $data['lastname'];

    //register user
    $result = $user->register();

    if($result){
            // set response code - 201 created
            http_response_code(201);
            echo json_encode(array("status" => "success", "message" => "User was created.","data" => $data));
             
    }else{
        // set response code - 503 service unavailable
        http_response_code(503);
        echo json_encode(array("status" => "error", "message" => "User already exist.","data" => null)); //user exist
    }   
}else{
    // set response code - 400 bad request
    http_response_code(400);
    echo json_encode(array("status" => "error", "message" => "Unable to create user. Data is incomplete.","data" => $data));
}
?>