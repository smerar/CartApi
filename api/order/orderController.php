<?php
//localhost/Cartlocalhost/Api/aplocalhost/i/order/orderController.php
function createOrder($param)
{
    $connection= mysqli_connect('localhost','root','','ecommerce');
    $user_id=mysqli_real_escape_string($connection,$param['user_id']);
    if(empty(trim($param['user_id'])) )
    {
        return validateEmptyUserInput('No proper data for updating orders');
       
        
    }
    else
    {
        $query1="INSERT INTO order_details (total_amount, user_id, order_date, status) VALUES ('0', '$user_id', CURRENT_TIMESTAMP, '1');";
        $result=mysqli_query($connection,$query1);
       if($result)
       {
           $data =[
               'status'=>201,
               'message'=>'Order created successfully',
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







?>