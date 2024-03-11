<?php

// localhost/CARTAPI/api/ulocalhost/CARTAPI/api/user/updateShippingAddressApi.php
include('../../include/headersForPut.php');
include('../../Models/Address.php');
include('userController.php');

$requestMethod=$_SERVER["REQUEST_METHOD"];


if($requestMethod  === 'PUT')
{
    $input = json_decode(file_get_contents("php://input"),true);
    if(empty($input))
    {
    
        $upAdd = updateShippingAddress($_POST,$_GET);
        echo $upAdd;
    }
    else
    {
       
        $upAdd = updateShippingAddress($input,$_GET);
        echo $upAdd;   
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