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
$profile = new Profile($db);
 
// get posted data
$hash = $_GET["id"];

 
// make sure data is not empty
if(!empty($hash)){
    
    //user object data
    $user->verify_hash = $hash;

    //verify user
    $result = $user->verifyUser();

    if($result){
        //get created user id
        $user_id = $user->getLastInserId();

        //profile object data : insert other data into profile with user_id reference
        $profile->user_id = $user_id;
        $profile->firstname = $data['firstname'];
        $profile->lastname = $data['lastname'];

        if($profile->save()){
            // set response code - 201 created
            http_response_code(201);
            echo json_encode(array("status" => "success", "message" => "User was created.","data" => $user_id));
        }else{
            // set response code - 503 service unavailable
            http_response_code(503);
            echo json_encode(array("status" => "error", "message" => "Error creating profile.","data" => null)); //user exist
        }        
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