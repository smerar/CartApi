
<?php
include('../../include/headersForPost.php');
require '../admin/adminController.php';
include('../../Models/products.php');

$requestMethod=$_SERVER["REQUEST_METHOD"];
$products=new Products();

if($requestMethod=='POST')
{
    $input = json_decode(file_get_contents("php://input"),true);
    //check whether the data is form-data or raw data
    //if form-data
    if(empty($input))
    {
      
      $products->description=$_POST['description'];
      $products->image=$_POST['image'];
      $products->pricing=$_POST['pricing'];
      $products->shipping_cost=$_POST['shipping_cost'];  
      $products->no_of_days=$_POST['no_of_days']; 
      $products->category=$_POST['category'];

      $addProducts=addProducts($products);
      
    }
    //if rawdata
    else
    {
        $products->description=$input['description'];
        $products->image=$input['image'];
        $products->pricing=$input['pricing'];
        $products->shipping_cost=$input['shipping_cost'];  
        $products->no_of_days=$input['no_of_days']; 
        $products->category=$input['category'];

        $addProducts=addProducts($products);
    }

    echo $addProducts;
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


