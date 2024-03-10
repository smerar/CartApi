<?php

// API  : localhost/CARTAPI/api/product/displayProductByCategoryApi.php

include('../../include/headersForGet.php');
include('productController.php');

$requestMethod=$_SERVER["REQUEST_METHOD"];

if($requestMethod=='GET')   
{
    if(isset($_GET['category']))
    {
        $response=displayProductsByCategory($_GET);
       
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