<?php

include 'config.php';

session_start();
error_reporting(0);
$user_id = $_SESSION['user_id'];



if(isset($_POST['add_to_cart'])){

  $product_id=$_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];



   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if( $_SESSION['user_name']==NULL)
   {
      header('location:register.php');
   }
   else{
   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Already Added To Cart!';
   }else{
      mysqli_query($conn,"INSERT INTO `cart`(product_id, user_id, name, price, quantity, image) VALUES ('$product_id','$user_id','$product_name','$product_price','$product_quantity','$product_image')") or die('query failed');

      $message[] = 'Product Added To Cart!';
   }
   }

}
if(isset($_POST["b1"]))
{
  if( $_SESSION['user_name']==NULL)
  {
     header('location:register.php');
  }
  else{
  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_quantity = $_POST['product_quantity'];
  $_SESSION['product_price']=$product_price;
  $_SESSION['product_name']=$product_name;
  $_SESSION['product_quantity']=$product_quantity;

   header('location:direct_checkout.php');
 }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      .categories {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  padding: 5px;
  gap: 10px;
  margin-right:200px;
}

.category {
  text-align: center;
  width: 100px;
}

.category img,
.category .icon {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  color: white;
  text-align: center;
  font-weight: bold;
 
}

.category p {
  margin-top: 10px;
  font-size: 14px;
  font-weight: bold;
  color:    white;
  margin-right:150px;      
}

   </style>

</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3 style="border:6px solid rgb(24, 234, 237);">&nbsp;&nbsp;Our Shop&nbsp;&nbsp;</h3>
   <p style="text-decoration:5px underline; text-decoration-color:rgb(24, 234, 237);"> <a href="home.php" >Home</a> /<a href="shop.php"> Shop </a>/ Seeds</p>
</div>




<section class="products">

   <h1 class="title" style="text-decoration:5px underline; text-decoration-color:rgb(24, 234, 237);">Latest Products</h1>

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` where p_type='Seeds'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <input type="hidden" name="product_id" value="<?php echo $fetch_products['product_id'];?>">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="name"><h5>QTY:<?php echo $fetch_products['qty']; ?></h5></div>
      <input type="number" min="1" max="<?php echo $fetch_products['qty'];  ?>" name="product_quantity" value="1" class="qty"> 
      <div class="price"><?php echo 'RS.'. $fetch_products['price']; ?>/-</div>
      
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_qty" value="<?php echo  $fetch_products['qty']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="Buy Now" name="b1" class="btn">
      <input type="submit" value="Add To Cart" name="add_to_cart" class="btn">
               
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">No Products Added Yet!</p>';
      }
      ?>
   </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
