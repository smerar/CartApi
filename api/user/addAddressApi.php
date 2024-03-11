<?php

// localhost/CARTAPI/api/ulocalhost/CARTAPI/user/addAddressApi.php
include('../../include/headersForPost.php');
include('../../Models/Address.php');
include('userController.php');

$requestMethod=$_SERVER["REQUEST_METHOD"];
$address=new Address();

if($requestMethod=='POST')
{
    $input = json_decode(file_get_contents("php://input"),true);
    if(empty($input))
    {
    
        $address->aptno=$_POST['aptno'];
        $address->street=$_POST['street'];
        $address->city=$_POST['city'];
        $address->province=$_POST['province'];
        $address->pincode=$_POST['pincode'];
        $address->phoneNumber=$_POST['phoneNumber'];
        $address->name=$_POST['name'];
        $address->user_id=$_POST['user_id'];


        $addAddress= addShippingAddress($address);
    }
    else
    {
        $address->aptno=$input['aptno'];
        $address->street=$input['street'];
        $address->city=$input['city'];
        $address->province=$input['province'];
        $address->pincode=$input['pincode'];
        $address->phoneNumber=$input['phoneNumber'];
        $address->name=$input['name'];
        $address->user_id=$input['user_id'];
        $addaddress= addShippingAddress($address);
        
    }

    echo $addAddress;

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