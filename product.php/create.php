<?php

error_reporting(0);
// all this is the header commmand line for the resfull API
header('Access-Control-origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST") {
   $inputData = json_decode(file_get_contents("php://input"), true);
   if(empty($inputData)){

        $storeCustomerproduct = storeCustomerproduct($_POST);  //form method
   }else{
        $storeCustomerproduct = storeCustomerproduct($inputData, $_GET);  //raw method
   }
   echo $storeCustomerproduct;

   //in postman form can be use to send data and raw
   //echo $inputData['name']; //this is use when sending data without form from postman
   // $productList = getProductsList();
    //echo $productList;
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed ',
    ];
    header("HTTP/1.0.405 Method Not Allowed");
    echo json_encode($data); //o only in read file json can be echo


}
?>