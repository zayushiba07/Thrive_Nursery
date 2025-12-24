<?php

include 'config.php';
error_reporting(0);
session_start();

$admin_email=$_SESSION['admin_email'];
if(!isset($admin_email)){
   header('location:admin.php');
}


if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $image = $_FILES['image']['name'];
   $image_type = $_FILES['image']['type'];
   $select_tree_name = mysqli_query($conn,"SELECT * FROM `tree_type` WHERE `tree_type` = '$name'"); 
 
   if(mysqli_num_rows($select_tree_name) > 0){
      $message[] = 'Tree Image Name Already Added';
   }else{
      
      
         if($image_size > 2000000){
            $message[] = 'Image Size Is Too Large';
         }
         elseif($image_type != "image/png" && $image_type != "image/jpg" && $image_type != "image/jpeg")
         {
            $message[] = 'Enter Only Jpg , png And jpeg Images';
         } 
         else{
            move_uploaded_file($image_tmp_name, $image_folder);
            mysqli_query($conn,"INSERT INTO `gallery`( `image_name`, `image`) VALUES ('$name','$image')");
            $message[] = 'Tree Image Added Successfully!';
         }
      
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn,"DELETE FROM `gallery` WHERE id = '$delete_id'")or die('query failed');
}
if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   mysqli_query($conn,"UPDATE `gallery` SET `image_name`='$update_name'  WHERE `id`='$update_p_id'");   
   
  
   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'images/'.$update_image;
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
         mysqli_query($conn, "UPDATE `gallery` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('images/'.$update_old_image);
      }
   }

   header('location:admin_image_uplode.php');

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tree Images</title>

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

   <h1 class="title">Enter Gallery Images</h1>
   <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Add Tree Image</h3>
      <input type="text" name="name" class="box" placeholder="Enter image Name" required  class="box">
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="Add Image" name="add_product" class="btn">
   </form>

</section>

<section class="show-products">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `gallery`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <img src="images/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['image_name']; ?></div>
         <a href="admin_image_uplode.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Update</a>
         <a href="admin_image_uplode.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this Image?');">Delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">No Image Added Yet!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `gallery` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="images/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['image_name']; ?>" class="box" required placeholder="Enter Product Name">
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

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>