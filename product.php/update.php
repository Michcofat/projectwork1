<?php

error_reporting(0);   ///for error handling
// all this is the header commmand line for the resfull API
header('Access-Control-origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include('function.php');


$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "PUT") {
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (empty($inputData)) {

        parse_str(file_get_contents("php://input"), $inputData);
     $updateCustomerproduct = updateCustomerproduct($_POST, $_GET);  //form methode

    } else {
        $updateCustomerproduct = updateCustomerproduct($inputData, $_GET);  //raw methode

        
    }
    echo $updateCustomerproduct;

    //in postman form can be use to send data and raw
    //echo $inputData['name']; //this is use when sending data without form from postman
    // $productList = getProductsList();
    //echo $productList;
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . 'Method Not Allowd',
    ];
    header("HTTP/1.0.405 Method Not Allowed");
    echo json_encode($data); //o only in read file json can be echo

}
?>