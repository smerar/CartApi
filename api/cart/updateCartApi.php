<?php
// localhost/CARTAPI/api/cart/updateCartApi.php
include('../../include/headersForPut.php');
include('cartController.php');

$requestMethod=$_SERVER["REQUEST_METHOD"];

if($requestMethod === 'PUT')
{
    $input = json_decode(file_get_contents("php://input"),true);
    if(empty($input))
    {
        $updateCart=updateCart($_POST,$_GET);
        echo $updateCart;
    }
    else
    {
        $updateCart=updateCart($input,$_GET);
        echo $updateCart;
        
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