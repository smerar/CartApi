<?php

// localhost/CARTAPI/product/api/product/displayAllProductsApi.php

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');

include('productController.php');

$requestMethod=$_SERVER["REQUEST_METHOD"];

if($requestMethod=='GET')   
{
    $response=displayAllProducts();
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