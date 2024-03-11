<?php
// localhost/CARTAPI/api/localhost/CARTAPI/user/addToCartApi.php
include('../../include/headersForPost.php');
include('../../Models/Address.php');
include('cartController.php');

$requestMethod=$_SERVER["REQUEST_METHOD"];

if($requestMethod=='POST')
{
    $input = json_decode(file_get_contents("php://input"),true);
    if(empty($input))
    {
        $addCart=addToCart($_POST);
    }
    else
    {
        $addCart=addToCart($input);
        
    }
    echo $addCart;
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