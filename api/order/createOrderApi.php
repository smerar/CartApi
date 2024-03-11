<?php
// localhost/CARTAPI/api/cart/createOrderApi.php
include('../../include/headersForPut.php');
include('orderController.php');

$requestMethod=$_SERVER["REQUEST_METHOD"];

if($requestMethod === 'POST')
{
    $input = json_decode(file_get_contents("php://input"),true);
    if(empty($input))
    {
        $createOrder=createOrder($_POST);
        echo $createOrder;
    }
    else
    {
        $createOrder=createOrder($input);
        echo $createOrder;
        
    }
   
}
else
{
    $data=[
        'status'=>405,
        'message'=>$requestMethod. 'Method not allowed',
    ];
    header("HTTP/1.0 405 Methodnot allowed");
   return json_encode($data);
   exit();
}



?>