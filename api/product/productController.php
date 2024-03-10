<?php
//...........................display all products............................
function displayAllProducts(){

    $connection= mysqli_connect('localhost','root','','ecommerce');
    $query="SELECT * FROM products";
    $execute=mysqli_query($connection,$query);
    if($execute)
    {
        if(mysqli_num_rows($execute)>0){

            $response=mysqli_fetch_all($execute, MYSQLI_ASSOC);
            $data=[
                'status'=>200,
                'message'=>'Product List Fetched Successfully',
                'response'=>$response,
            ];
            header("HTTP/1.0 200 OK ");
            return json_encode($data);
        }
        else
        {
            $data=[
                'status'=>404,
                'message'=>'No Product Found',
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

//.......................display products based on category....................
function displayProductsByCategory($categoryParams){

    $connection= mysqli_connect('localhost','root','','ecommerce');
    if($categoryParams['category']==null)
    {
        return emptyParameterError('Not valid category');
    }

    $category = mysqli_real_escape_string($connection,$categoryParams['category']);
    $query="SELECT  * FROM products  where category = '$category'";

    $execute=mysqli_query($connection,$query);
    if($execute)
    {
        if(mysqli_num_rows($execute)>0){

            $response=mysqli_fetch_all($execute, MYSQLI_ASSOC);
            $data=[
                'status'=>200,
                'message'=>'Product List Fetched Successfully',
                'response'=>$response,
            ];
            header("HTTP/1.0 200 OK ");
            return json_encode($data);
        }
        else
        {
            $data=[
                'status'=>404,
                'message'=>'No Category Found',
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
//..............................list category...................................
function listCategory()
{

    $connection= mysqli_connect('localhost','root','','ecommerce');
    $query="SELECT * FROM product_category";
    $execute=mysqli_query($connection,$query);
    if($execute)
    {
        if(mysqli_num_rows($execute)>0){

            $response=mysqli_fetch_all($execute, MYSQLI_ASSOC);
            $data=[
                'status'=>200,
                'message'=>'Product Category List Fetched Successfully',
                'response'=>$response,
            ];
            header("HTTP/1.0 200 OK ");
            return json_encode($data);
        }
        else
        {
            $data=[
                'status'=>404,
                'message'=>'No Category Found',
            ];
            header("HTTP/1.0 404 No Category Found");
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
//.............................validation methods...............................

function emptyParameterError($message){

    $data=[
        'status'=>422,
        'message'=> $message,
    ];
    header("HTTP/1.0 422"."Unprocessable entity");
   echo(json_encode($data));
   exit();

}

?>