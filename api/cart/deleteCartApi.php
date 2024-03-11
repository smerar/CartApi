<?php

// API  : localhost/CARTAPI/api/cart/deleteCartApi.php

include('../../include/headersForDelete.php');
include('cartController.php');

$requestMethod=$_SERVER["REQUEST_METHOD"];

if($requestMethod=='DELETE')   
{
    if(isset($_GET['cart_item_id']))
    {
        $response= deleteCart($_GET);
    } 
    else
    {
        $response="No item selected";
    }
    echo $response;
}
else
{
    $data=[
        'status'=>405,
        'message'=>$requestMethod.' Method Not Allowed',
    ];
    header("HTTP/1.0 Method Not Allowed");
    echo json_encode($data);
}
?>