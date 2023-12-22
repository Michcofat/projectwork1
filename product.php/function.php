<?php
require '../inc/dbcon.php';    // '../ mean two step back forward slash the folder you want to includeand the file...... also make sure that the dbcon is not in the same spelling with te data base collection in form of $conn. '

 function error422($message){

    $data = [
       'status' => 422,
     'message' => $message,
    ];
    //header("HTTP/1.0.422 Unprocessable Entity");
    echo json_encode($data); //o only in read file json can be echo
     exit();

 }
    //this function is to create new customerproduct list in data base
function storeCustomerproduct($customerproductInput){

    global $conn;

    $name = mysqli_real_escape_string($conn, $customerproductInput['name']);
    $description = mysqli_real_escape_string($conn, $customerproductInput['description']);
    $quantity = mysqli_real_escape_string($conn, $customerproductInput['quantity']);
    $weight = mysqli_real_escape_string($conn, $customerproductInput['weight']);

    if(empty(trim($name))){

        return error422('Enter Your name');
    
    }elseif(empty(trim($description))){
        return error422('Enter Your description');

    }elseif(empty(trim($quantity))){
        return error422('Enter Your quantity');

    } elseif (empty(trim($weight))) {
        return error422('Enter Your weight');

    }else{
        $query = "INSERT INTO  customerproduct (name,description,quantity,weight) value('$name','$description','$quantity','$weight')";
        $result = mysqli_query($conn, $query);   //using this to excute the above query.
        if($result){
            $data = [
                'status' => 201,
                'message' => 'CustomerProduct Created Successfully',
            ];
            //header("HTTP/1.0.500 Internal Server Error");
            http_response_code(201);
            return json_encode($data);
        }else{
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            //header("HTTP/1.0.500 Internal Server Error");
            http_response_code(500);
            return json_encode($data);
        }
    }

}

  // function is to read  all data from te data base
function getCustomerProductList()
{
    // one need to call the response global.
    global $conn;

    $query = "SELECT * FROM customerproduct";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {

        if (mysqli_num_rows($query_run) > 0) {

            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            // this send the status of the custommer list fetch.
            $data = [
                'status' => 200,
                'message' => 'Product List Fetched Successfully',
                'data' => $res      //this will send the customer data as well. also will also help to get the status ,and the message including the customer list.
            ];
            // header("HTTP/1.0.200 ok");
            http_response_code(200);
            return json_encode($data);    //json command line can only be return in function file json  can not be echo in function file.


        } else {
            $data = [
                'status' => 404,
                'message' => 'No Product Found',
            ];
            // header("HTTP/1.0.404 No Customer Found");
            http_response_code(404);
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        //header("HTTP/1.0.500 Internal Server Error");
        http_response_code(500);
        return json_encode($data);
    }
}


// tis function is to fetch just one or read just only one customerproduct ist from the data base
function getCustomerProduct($customerproductparam){


    global $conn;

   


    if($customerproductparam['id'] == null){

    return error422('Enter Your Customerproduct id');
    
 } 
 
      $customerproductid = mysqli_real_escape_string($conn, $customerproductparam['id']);


      $query = "SELECT * FROM customerproduct WHERE id = '$customerproductid' LIMIT 1";  //add this sign $ behind customerproductid to be this $customerproductid 
      $result = mysqli_query($conn, $query);  //this function is use to excute the quer
      if($result){
        
        if(mysqli_num_rows($result) == 1 )
        {
          $res = mysqli_fetch_assoc($result);

            $data = [
                'status' => 200,
                'message' => 'Customer Product Fetched Successfully',
                'data'   => $res
            ];
            //header("HTTP/1.0.500 Internal Server Error");
            http_response_code(200);
            return json_encode($data);

        }else{
            $data = [
                'status' => 404,
                'message' => 'No Customer Product Found',
            ];
            //header("HTTP/1.0.500 Internal Server Error");
            http_response_code(404);
            return json_encode($data);

        }

      }else{
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        //header("HTTP/1.0.500 Internal Server Error");
        http_response_code(500);
        return json_encode($data);
        
      }

    }

function updateCustomerproduct($customerproductInput,$customerproductparam){


    global $conn;

   if(!isset($customerproductparam['id'])){
       // if (isset($_POST['id'])) {

    return error422('customerproduct id not found in url');
    }elseif($customerproductparam['id'] == null){
        
        return error422('Enter customerproduct id');
    }
    $customerproductid = mysqli_real_escape_string($conn, $customerproductparam['id']);
    

    $name = mysqli_real_escape_string($conn, $customerproductInput['name']);
    $description = mysqli_real_escape_string($conn, $customerproductInput['description']);
    $quantity = mysqli_real_escape_string($conn, $customerproductInput['quantity']);
    $weight = mysqli_real_escape_string($conn, $customerproductInput['weight']);

   if (empty(trim($name))) {

     return error422('Enter Your name');

 } elseif (empty(trim($description))) {
        return error422('Enter Your description');

} elseif (empty(trim($quantity))) {
        return error422('Enter Your quantity');

} elseif (empty(trim($weight))) {
      return error422('Enter Your weight');

   } else {
        
           $query = "UPDATE customerproduct SET name='$name',description='$description',quantity='$quantity',weight='$weight' WHERE id='$customerproductid' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $data = [
                'status' => 200,
                'message' => 'Product updated Successfully',
            ];
            //header("HTTP/1.0.500 Internal Server Error");
            http_response_code(200);
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            //header("HTTP/1.0.500 Internal Server Error");
            http_response_code(500);
            return json_encode($data);
        }
    }

    }


function deleteCustomerProductList($customerproductparam){

    global $conn;
    if (!isset($customerproductparam['id'])) {

        return error422('customerproduct id not found in url');
    } elseif ($customerproductparam['id'] == null) {

        return error422('Enter customerproduct id');
    }
    $customerproductid = mysqli_real_escape_string($conn, $customerproductparam['id']);

     $query = "DELETE FROM customerproduct where id='$customerproductid' LIMIT 1";
     $result = mysqli_query($conn, $query);

     if($result){
        $data = [
            'status' => 200,
            'message' => 'Customer Product List Deleted Successfully',

        ];
        //header("HTTP/1.0.500 Internal Server Error");
        http_response_code(200);
        return json_encode($data);
     }else{
        $data = [
            'status' => 404,
            'message' => 'Customer Product List Not Found',
        ];
        //header("HTTP/1.0.500 Internal Server Error");
        http_response_code(404);
        return json_encode($data);  
     }


}





?>