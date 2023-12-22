<?php

error_reporting(0);   ///for error handling
// all this is the header commmand line for the resfull API
header('Access-Control-origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: DELETE');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "DELETE") {

    //$productList = getProductsList();
    $deleteCustomerproductList = deleteCustomerProductList($_GET);
    echo $deleteCustomerproduct;
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . 'Method Not Allowd',
    ];
    header("HTTP/1.0.405 Method Not Allowed");
    echo json_encode($data); //o only in read file json can be echo


}
?>