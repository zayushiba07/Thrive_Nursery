<?php

include 'config.php';
//error_reporting(0);
session_start();

$admin_email=$_SESSION['admin_email'];
if(!isset($admin_email)){
   header('location:admin.php');
}

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $qty=$_POST['qty'];
   $price = $_POST['price'];
   $p_type=$_POST['ptype'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_type = $_FILES['image']['type'];

   $image_folder = 'uploaded_img/'.$image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'Product Name Already Added';
   }else{
      

         if($image_size > 2000000){
            $message[] = 'Image Size Is Too Large';
         }
         elseif($image_type != "image/png" && $image_type != "image/jpg" && $image_type != "image/jpeg")
         {
            $message[] = 'Enter Only Jpg , Png and Jpeg Image';
         } 
         else{

            move_uploaded_file($image_tmp_name, $image_folder);
             mysqli_query($conn, "INSERT INTO `products`(name,p_type,price, image,qty) VALUES('$name','$p_type', '$price', '$image','$qty')") or die('query failed');
            $message[] = 'Product Added Successfully!';
         }
     
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn,"DELETE FROM `cart` WHERE product_id = '$delete_id'")or die('query failed');
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE product_id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE  product_id = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_ptype=$_POST['update_ptype'];
   $update_qty=$_POST['update_qty'];
   $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE `products` SET name = '$update_name',p_type = '$update_ptype',price = '$update_price',qty='$update_qty' WHERE product_id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];
   $img_type= $_FILES['update_image']['type'];
   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }
      elseif($img_type != "image/png" && $img_type != "image/jpg" && $img_type != "image/jpeg")
         {
            $message[] = 'Enter Only Jpg , Png and Jpeg Image';
         } 
      else{
         mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE product_id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <style>
      .message{
         background-color: #2f26263d;
      }
   </style>
</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- product CRUD section starts  -->

<section class="add-products">

   <h1 class="title">Shop Products</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>add product</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" class="box" placeholder="Enter Product Name" required   class="box">
      <select name="ptype" class="box"  required>
         <option value="Palnt">Palnt</option>
         <option value="Gradaning_Tools">Gradaning Tools</option>
         <option value="Seeds">Seeds</option>
         <option value="Fertilizer">Fertilizer</option>
      </select>
      <input type="number" min=1 name="qty" class="box" placeholder="Enter Product Qty" required  class="box">
      <input type="number" min="0" name="price" class="box" placeholder="Enter Product Price" required>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="Add Product" name="add_product" class="btn">
   </form>

</section>

<!-- product CRUD section ends -->

<!-- show products  -->

<section class="show-products">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="name"><?php echo $fetch_products['qty']; ?></div>
         <div class="price"><?php echo'RS.'. $fetch_products['price']; ?>/-</div>
         <a href="admin_products.php?update=<?php echo $fetch_products['product_id']; ?>" class="option-btn">Update</a>
         <a href="admin_products.php?delete=<?php echo $fetch_products['product_id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">Delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">No Products Added Yet!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE  product_id
          = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['product_id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="Enter Product Name">
      <select name="update_ptype" class="box"  required>
         <option value="Palnt">Palnt</option>
         <option value="Gradaning_Tools">Gradaning Tools</option>
         <option value="Seeds">Seeds</option>
         <option value="Fertilizer">Fertilizer</option>
      </select>
      <input type="text" name="update_qty" value="<?php echo $fetch_update['qty']; ?>" class="box" required placeholder="Enter Product Qty">
      <input type="number" name="update_price" value="<?php echo 'RS.'. $fetch_update['price']; ?>" min="0" class="box" required placeholder="Enter Product Price">
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="Update" name="update_product" class="btn">
      <input type="reset" value="Cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>







<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>