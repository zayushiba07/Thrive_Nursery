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
   $mart= mysqli_real_escape_string($conn, $_POST['name1']);
   $det =  mysqli_real_escape_string($conn, $_POST['price']);
   $image = $_FILES['image']['name'];
   $image_type = $_FILES['image']['type'];
   $select_tree_name = mysqli_query($conn,"SELECT * FROM `tree_type` WHERE `tree_type` = '$name'"); 
  
   if(mysqli_num_rows($select_tree_name) > 0){
      $message[] = 'tree type  name already added';
   }else{
      
    
      
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }
         elseif($image_type != "image/png" && $image_type != "image/jpg" && $image_type != "image/jpeg")
         {
            $message[] = 'Enter Only Jpg , png and jepg  Image';
         }  
         else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $add_tree = mysqli_query($conn,"INSERT INTO `tree_type`(`tree_type`, `location`, `description`, `image`) VALUES ('$name','$mart','$det','$image')");
            $message[] = 'tree type added successfully!';
        
   }
}
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn,"DELETE FROM `tree_type` WHERE id = '$delete_id'")or die('query failed');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_det=$_POST['update_det'];
   $update_location=$_POST['update_location'];
   mysqli_query($conn,"UPDATE `tree_type` SET `tree_type`='$update_name',`location`='$update_location',`description`='$update_det' WHERE `id`='$update_p_id' ");   
   
  
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
            $message[] = 'Enter Only Jpg , Png and Jpeg Images';
       } 
      else{
         mysqli_query($conn, "UPDATE `tree_type` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('images/'.$update_old_image);
      }
   }

   header('location:admin_treetype.php');

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tree Types</title>

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

   <h1 class="title">Enter Tree Type</h1>
   <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Add Tree Type</h3>
      <input type="text" name="name" class="box" placeholder="Enter Tree Type Name" required  >
      <input type="text" name="name1" class="box" placeholder="Enter Location" required >
      <textarea  name="price" class="box" placeholder="Enter Tree Detail"  required>
        </textarea>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="Add Tree Type" name="add_product" class="btn">
   </form>

</section>

<section class="show-products">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `tree_type`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <img src="images/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['tree_type']; ?></div>
         <div class="name"><?php echo $fetch_products['location']; ?></div>
         <div class="name"><?php echo $fetch_products['description']; ?></div>
         <a href="admin_treetype.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Update</a>
         <a href="admin_treetype.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this Tree type?');">Delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">No Tree Type Added Yet!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `tree_type` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="images/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['tree_type']; ?>" class="box" required placeholder="Enter tree Name">
      <input type="text" name="update_location" value="<?php echo $fetch_update['location']; ?>" class="box" required placeholder="Enter tree location">
      <input type="text" name="update_det" value="<?php echo $fetch_update['description']; ?>" class="box" required placeholder="Enter tree detail">
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="update" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>
<!-- product CRUD section ends -->

<!-- show products  -->

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>