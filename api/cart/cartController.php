<?php

// INSERT INTO cart_items (cart_item_id, product_id, quantity, user_id) VALUES (NULL, '4', '1', '3');
function addToCart($cartitems)
{
    $connection= mysqli_connect('localhost','root','','ecommerce');
    $product_id=mysqli_real_escape_string($connection,$cartitems['product_id']);
    $quantity=mysqli_real_escape_string($connection,$cartitems['quantity']);
    $user_id=mysqli_real_escape_string($connection,$cartitems['user_id']);

    if(empty(trim($cartitems['product_id'])) )
    {
        return validateEmptyUserInput('Select a product');
    }
    elseif(empty(trim($cartitems['quantity'])))
    {
        return validateEmptyUserInput('Enter the quantity');
    }
    elseif(empty(trim($cartitems['user_id'])))
    {
        return validateEmptyUserInput('No User selected');
    }
    else
    {
       $query= "INSERT INTO cart_items ( product_id, quantity, user_id) VALUES ( '$product_id', '$quantity', '$user_id');";
       $result=mysqli_query($connection,$query);
       if($result)
       {
           $data =[
               'status'=>201,
               'message'=>'Cart updated successfully',
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
function updateCart($POST,$GET)
{
    $connection= mysqli_connect('localhost','root','','ecommerce');
    if(!isset($GET))
    {
        return validateEmptyUserInput('Address not selected');
    }
    $cart_id=mysqli_real_escape_string($connection,$GET['cart_item_id']);
    $quantity=mysqli_real_escape_string($connection,$POST['quantity']);
    if(empty(trim($POST['quantity'])) )
    {
        return validateEmptyUserInput('No value for quantity');
    }
    else
    {
        $query="UPDATE cart_items set quantity='$quantity'where cart_item_id='$cart_id'";
        $result=mysqli_query($connection,$query);

        if($result)
        {
            $data =[
                'status'=>200,
                'message'=>'Cart Updated successfully',
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

function displayCart($getparams)
{
    $connection= mysqli_connect('localhost','root','','ecommerce');
    if($getparams['user_id']==null)
    {
        return ValidateEmptyUserInput('No user selected');
    }
    $user_id = mysqli_real_escape_string($connection,$getparams['user_id']);
    $query="SELECT * FROM cart_items inner join products on cart_items.product_id=products.product_id where user_id='$user_id'";
    $execute=mysqli_query($connection,$query);
    if($execute)
    {
        if(mysqli_num_rows($execute)>0){

            $response=mysqli_fetch_all($execute, MYSQLI_ASSOC);
            $data=[
                'status'=>200,
                'message'=>'Cart Fetched Successfully',
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
function deleteCart($getparams)
{
    $connection= mysqli_connect('localhost','root','','ecommerce');
    if($getparams['cart_item_id']==null)
    {
        return ValidateEmptyUserInput('No cart item selected');
    }
    $cart_item_id = mysqli_real_escape_string($connection,$getparams['cart_item_id']);
    $query="delete from cart_items where cart_item_id='$cart_item_id'";
    $result=mysqli_query($connection,$query);

    if($result)
    {
        $data =[
            'status'=>200,
            'message'=>'Cart item deleted successfully',
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