<?php
// localhost/CARTAPI/api/user/addUserApi.php

include('../../include/headersForPost.php');
include('../../Models/Users.php');
include('userController.php');

$requestMethod=$_SERVER["REQUEST_METHOD"];
$user=new Users();

if($requestMethod=='POST')
{
    $input = json_decode(file_get_contents("php://input"),true);
    //check whether the data is form-data or raw data
    //if form-data
    if(empty($input))
    {
    
        $user->email=$_POST['email'];
        $user->password=$_POST['password'];
        $user->username=$_POST['username'];

        $addUser= addUser($user);
    }
    else
    {
        $user->email=$input['email'];
        $user->password=$input['password'];
        $user->username=$input['username'];
        $addUser= addUser($user);
        
    }

    echo $addUser;
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