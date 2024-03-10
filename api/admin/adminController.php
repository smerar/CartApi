<?php 


//........................... To add products to product table in database................................




function addProducts($products){

   
    $connection= mysqli_connect('localhost','root','','ecommerce');
    
    $description = mysqli_real_escape_string($connection,$products->description);
    $image = mysqli_real_escape_string($connection,$products->image);
    $pricing = mysqli_real_escape_string($connection,$products->pricing);
    $shipping_cost = mysqli_real_escape_string($connection,$products->shipping_cost);
    $no_of_days = mysqli_real_escape_string($connection,$products->no_of_days);
    $category=mysqli_real_escape_string($connection,$products->category);
    
    //Emptty Data Validation
    if(empty(trim($products->description)))
    {
        return validateEmptyProductInput('Enter the product description');
    }
    elseif(empty(trim($products->image)))
    {
        return validateEmptyProductInput('Enter the product image');
    }
    elseif(empty(trim($products->pricing))){
    
        return validateEmptyProductInput('Enter the product price');
    }
    elseif(empty(trim($products->shipping_cost))){
    
        return validateEmptyProductInput('Enter the product shipping price');
    }
    elseif(empty(trim($products->no_of_days))){
    
        return validateEmptyProductInput('Enter the product number of days to deliver');
    }
    elseif(empty(trim($products->category))){
    
        return validateEmptyProductInput('Enter the product Category');
    }
    else
    {
        $query = "INSERT INTO products (description,image,pricing,shipping_cost,no_of_days,category) VALUES ( '$products->description', '$products->image', '$products->pricing', '$products->shipping_cost', '$products->no_of_days', '$products->category')";
    
        $result=mysqli_query($connection,$query);
    
        if($result)
        {
            $data =[
                'status'=>201,
                'message'=>'Customer created successfully',
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


 function validateEmptyProductInput($message){

    $data=[
        'status'=>422,
        'message'=> $message,
    ];
    header("HTTP/1.0 422"."Unprocessable entity");
   echo(json_encode($data));
   exit();

}