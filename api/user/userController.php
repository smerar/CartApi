<?php

//......................To add users..............................
function addUser($user)
{

    $connection= mysqli_connect('localhost','root','','ecommerce');
  
    $email = mysqli_real_escape_string($connection,$user->email);
    $password = mysqli_real_escape_string($connection,$user->password);
    $username=mysqli_real_escape_string($connection,$user->username);

    if(empty(trim($user->email)) )
    {
        return validateEmptyUserInput('Enter a valid email');
    }
    elseif(empty(trim($user->password)))
    {
        return validateEmptyUserInput('Enter the password');
    }
    elseif(empty(trim($user->username)))
    {
        return validateEmptyUserInput('Enter a valid username');
    }
    else if(!filter_var(trim($user->email), FILTER_VALIDATE_EMAIL)) //To check whether the email is valid or not
    {
        return validateEmptyUserInput('Enter a valid email');
    }
    else
    {
        $query="INSERT INTO user (email, password,username) VALUES ('$email', '$password','$username');";
        $result=mysqli_query($connection,$query);
        if($result)
        {
            $data =[
                'status'=>201,
                'message'=>'User account created successfully',
                'response'=>$result,
            ];
            return json_encode($data);
        }
        else
        {
            $data=[
                'status'=>500,
                'message'=>'Internal server error',
            ];
            header("HTTP/1.0 500 Error");
           return json_encode($data);
        }
    }


}

//...........................To add shipping address..................
function addShippingAddress($address)
{
    $connection= mysqli_connect('localhost','root','','ecommerce');

     $aptno= mysqli_real_escape_string($connection,$address->aptno) ;
     $street=mysqli_real_escape_string($connection,$address->street);
     $city=mysqli_real_escape_string($connection,$address->city);
     $province=mysqli_real_escape_string($connection,$address->province);
     $pincode=mysqli_real_escape_string($connection,$address->pincode);
     $phoneNumber=mysqli_real_escape_string($connection,$address->phoneNumber);
     $name=mysqli_real_escape_string($connection,$address->name);
     $user_id=mysqli_real_escape_string($connection,$address->user_id);
    //  $active=mysqli_real_escape_string($connection,$address->active);

     if(empty(trim($aptno)) )
     {
         return validateEmptyUserInput('Enter a apartment number');
     }
     elseif(empty(trim($street)))
     {
         return validateEmptyUserInput('Enter the street');
     }
     elseif(empty(trim($city)))
     {
         return validateEmptyUserInput('Enter the city');
     }
     elseif(empty(trim($province)))
     {
         return validateEmptyUserInput('Enter the province');
     }
     elseif(empty(trim($pincode)))
     {
         return validateEmptyUserInput('Enter the pincode');
     }
     elseif(empty(trim($phoneNumber)))
     {
         return validateEmptyUserInput('Enter the phone number');
     }
     elseif(empty(trim($name)))
     {
         return validateEmptyUserInput('Enter the name of customer');
     }
     elseif(empty(trim($user_id)))
     {
         return validateEmptyUserInput('user id missing');
     }
     else
     {
        $query="INSERT INTO shipping_address ( aptno, street, city, province, pincode, phoneNumber, name, user_id) VALUES ( '$aptno', '$street', '$city', '$province', '$pincode', '$phoneNumber', '$name', '$user_id');";
        
        $result=mysqli_query($connection,$query);

        if($result)
        {
            $data =[
                'status'=>201,
                'message'=>'Address added successfully',
            ];
            return json_encode($data);
        }
        else
        {
            $data=[
                'status'=>500,
                'message'=>'Internal server error',
            ];
            header("HTTP/1.0 201 Created");
           return json_encode($data);
        }
     }
     




}

//...............................To display user details.................
function displayUserDetails($userParams)

    {
        $connection= mysqli_connect('localhost','root','','ecommerce');
        if($userParams['user_id']==null)
        {
            return ValidateEmptyUserInput('No user selected');
        }
        $user_id = mysqli_real_escape_string($connection,$userParams['user_id']);
        $query="SELECT * FROM user WHERE user_id='$user_id';";
        $execute=mysqli_query($connection,$query);
        if($execute)
        {
            if(mysqli_num_rows($execute)>0){
    
                $response=mysqli_fetch_all($execute, MYSQLI_ASSOC);
                $data=[
                    'status'=>200,
                    'message'=>'User Details Fetched Successfully',
                    'response'=>$response,
                ];
                header("HTTP/1.0 200 OK ");
                return json_encode($data);
            }
            else
            {
                $data=[
                    'status'=>404,
                    'message'=>'Error',
                    
                ];
                header("HTTP/1.0 404 No Product Found");
                return json_encode($data);
            }
        }
        else
        {
    
            $data=[
                'status'=>500,
                'message'=>'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
           return json_encode($data);
    
        }
    }

//...................get the shipping address of a user...............

function displayShippingAddress($addressParams)
{


    $connection= mysqli_connect('localhost','root','','ecommerce');
    if($addressParams['user_id']==null)
    {
        return ValidateEmptyUserInput('No user selected');
    }
    $user_id = mysqli_real_escape_string($connection,$addressParams['user_id']);
    $query="SELECT * FROM shipping_address WHERE shipping_address.user_id='$user_id' and shipping_address.active=1;";
    $execute=mysqli_query($connection,$query);
    if($execute)
    {
        if(mysqli_num_rows($execute)>0){

            $response=mysqli_fetch_all($execute, MYSQLI_ASSOC);
            $data=[
                'status'=>200,
                'message'=>'Address Fetched Successfully',
                'response'=>$response,
            ];
            header("HTTP/1.0 200 OK ");
            return json_encode($data);
        }
        else
        {
            $data=[
                'status'=>404,
                'message'=>'No Address Found',
                
            ];
            header("HTTP/1.0 404 No Product Found");
            return json_encode($data);
        }
    }
    else
    {

        $data=[
            'status'=>500,
            'message'=>'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
       return json_encode($data);

    }
}
//......................Update shipping address........................
function updateShippingAddress($address,$addUpParam)
{
    $connection= mysqli_connect('localhost','root','','ecommerce');

    if(!isset($addUpParam))
    {
        return validateEmptyUserInput('Address not selected');
    }
 
    $address_id=mysqli_real_escape_string($connection,$addUpParam['address_id']);

     $aptno= mysqli_real_escape_string($connection, $address['aptno']) ;
     $street=mysqli_real_escape_string($connection, $address['street']);
     $city=mysqli_real_escape_string($connection, $address['city']);
     $province=mysqli_real_escape_string($connection, $address['province']);
     $pincode=mysqli_real_escape_string($connection, $address['pincode']);
     $phoneNumber=mysqli_real_escape_string($connection, $address['phoneNumber']);
     $name=mysqli_real_escape_string($connection, $address['name']);

     
    
     //  $active=mysqli_real_escape_string($connection,$address->active);

     if(empty(trim($aptno)) )
     {
         return validateEmptyUserInput('Enter a apartment number');
     }
     elseif(empty(trim($street)))
     {
         return validateEmptyUserInput('Enter the street');
     }
     elseif(empty(trim($city)))
     {
         return validateEmptyUserInput('Enter the city');
     }
     elseif(empty(trim($province)))
     {
         return validateEmptyUserInput('Enter the province');
     }
     elseif(empty(trim($pincode)))
     {
         return validateEmptyUserInput('Enter the pincode');
     }
     elseif(empty(trim($phoneNumber)))
     {
         return validateEmptyUserInput('Enter the phone number');
     }
     elseif(empty(trim($name)))
     {
         return validateEmptyUserInput('Enter the name of customer');
     }
     elseif(empty(trim($address_id)))
     {
         return validateEmptyUserInput('user id missing');
     }
     else
     {
        $query="UPDATE shipping_address SET aptno='$aptno', street='$street', city='$city', province='$province', pincode='$pincode', phoneNumber='$phoneNumber', name='$name' where address_id='$address_id'";
        
        $result=mysqli_query($connection,$query);

        if($result)
        {
            $data =[
                'status'=>200,
                'message'=>'Address updated successfully',
            ];
            return json_encode($data);
        }
        else
        {
            $data=[
                'status'=>500,
                'message'=>'Internal server error',
            ];
            header("HTTP/1.0 201 Created");
           return json_encode($data);
        }
     }
     




}
//..................ValidateEmptyUserInput.............................
function ValidateEmptyUserInput($message)
{
    $data=[
        'status'=>422,
        'message'=> $message,
    ];
    header("HTTP/1.0 422"."Unprocessable entity");
   echo(json_encode($data));
   exit();
}
?>