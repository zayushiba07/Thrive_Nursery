<?php
error_reporting(0);
include 'config.php';
session_start();

$admin_email=$_SESSION['admin_email'];
if(!isset($admin_email)){
   header('location:admin.php');
}

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $det =  mysqli_real_escape_string($conn, $_POST['price']);
   $image = $_FILES['image']['name'];
   $image_type = $_FILES['image']['type'];
   $select_hero = mysqli_query($conn, "SELECT * FROM `green_hero` WHERE `hero_name` = '$name'") or die('query failed');

   if(mysqli_num_rows($select_hero) > 0){
      $message[] = 'Hero Name Already Added';
   }else{
      

      
         if($image_size > 2000000){
            $message[] = 'Image Size Is Too Large';
         }
         elseif($image_type != "image/png" && $image_type != "image/jpg" && $image_type != "image/jpeg")
         {
            $message[] = 'Enter Only Jpg , Png And Jpeg Images';
         } 
         else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $add_artist_query = mysqli_query($conn, "INSERT INTO `green_hero`(`hero_name`, `description`, `hero_image`) VALUES ('$name','$det','$image')") or die('query failed');
            $message[] = 'Hero Added Successfully!';
         }
      
   
}
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn,"DELETE FROM `green_hero` WHERE id = '$delete_id'")or die('query failed');
}
if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_hero=$_POST['update_hero'];
mysqli_query($conn,"UPDATE `green_hero` SET `hero_name`='$update_name',`description`='$update_hero' WHERE `id`='$update_p_id'");   
   
  
   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'images/'.$update_image;
   $update_old_image = $_POST['update_old_image'];
   $img_type= $_FILES['update_image']['type'];
   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'Image File Size Is Too Large';
      }
      elseif($img_type != "image/png" && $img_type != "image/jpg" && $img_type != "image/jpeg")
       {
            $message[] = 'Enter Only Jpg , Png And Jpeg Images';
       } 
      else{
         mysqli_query($conn, "UPDATE `green_hero` SET hero_image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:hero.php');

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Hero Detail</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- product CRUD section starts  -->

<section class="add-products">

   <h1 class="title">Detail Of Hero</h1>
   <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>

   <form action="" method="post" enctype="multipart/form-data">
      <h3 >Add Hero</h3>
      <input type="text" name="name" class="box" placeholder="Enter Hero Name" required  class="box">
      <textarea  name="price" class="box" placeholder="Enter Hero Detail"  required>
        </textarea>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="Add Green Hero" name="add_product" class="btn">
   </form>

</section>

<section class="show-products">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `green_hero`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <img src="images/<?php echo $fetch_products['hero_image']; ?>" alt="no photo">
         <div class="name"><?php echo $fetch_products['hero_name']; ?></div>
         <div class="name"><?php echo $fetch_products['description']; ?></div>
         <a href="hero.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Update</a>
         <a href="hero.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this hero?');">Delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">No Hero Added Yet!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `green_hero` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['hero_image']; ?>">
      <img src="images/<?php echo $fetch_update['hero_image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['hero_name']; ?>" class="box" required placeholder="Enter Product Name">
      <input type="text" name="update_hero" value="<?php echo $fetch_update['description']; ?>" class="box" required placeholder="Enter Product Hero Name">
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