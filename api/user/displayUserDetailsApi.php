<?php

// API  : localhost/CARTAPI/api/user/displayUserDetailsApi.php

include('../../include/headersForGet.php');
include('userController.php');

$requestMethod=$_SERVER["REQUEST_METHOD"];

if($requestMethod=='GET')   
{
    if(isset($_GET['user_id']))
    {
        $response=displayUserDetails($_GET);
    } 
    else
    {
        $response="No user selected";
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