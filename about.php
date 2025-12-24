<?php

include 'config.php';

session_start();
error_reporting(0);
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Us</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>  
<?php include 'header.php'; ?>

<div class="heading">
   <h3  style="border:6px solid rgb(24, 234, 237);">&nbsp; About Us&nbsp;</h3>
   <p style="text-decoration:5px underline; text-decoration-color:rgb(24, 234, 237);"> <a href="home.php">Home</a> / About </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about_img.jpg" alt="">
      </div>

      <div class="content">
         <h3>Why Choose Us?</h3>
         <p>Welcome to Thrive Nursery! At Thrive Nursery, we believe that plants bring life, beauty, and freshness to any space.  we offer a wide variety of plants, from vibrant flowers to lush greenery, perfect for homes, gardens, and offices.</p>
         <p> Our mission is to make plant care easy and enjoyable for everyone. Whether you’re an experienced gardener or just starting out, we provide healthy plants, helpful advice, and everything you need to help your garden thrive. We are passionate about nature and committed to offering high-quality plants and eco-friendly gardening solutions. Visit Thrive Nursery and let’s grow something beautiful together!</p>
      
         <a href="contact.php" class="btn">Contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title" style="text-decoration:5px underline; text-decoration-color:rgb(24, 234, 237);">Our Green Hero Details</h1>
   <div class="box-container">
   
   <?php 
      $q=mysqli_query($conn,"SELECT * FROM `green_hero`");
      if(mysqli_num_rows($q) > 0){ 
         while( $ab = mysqli_fetch_assoc($q)){
   ?>
   
      <div class="box">
         <img style ="width:300px; height:300px; border-redius:500%;" src="<?php echo 'images/'.$ab['hero_image']; ?>" alt="">
         <p><?php echo $ab['description']; ?></p>
         

         <h3><?php  echo $ab['hero_name']; ?></h3>
      </div>
        <?php  }
      }else{
         echo '<p class="empty">No Detail Of Hero Placed Yet!</p>';
      }?>
      </div>
     
</section>

<section class="authors">

   <h1 class="title" style="text-decoration:5px underline; text-decoration-color:rgb(24, 234, 237);"> Gallery </h1>

   <div class="box-container">
   <?php 
      $q=mysqli_query($conn,"SELECT * FROM `gallery`");
      if(mysqli_num_rows($q) > 0){ 
         while( $ab = mysqli_fetch_assoc($q)){
   ?>
   <div class="box">
   <img src="images/<?php echo $ab['image']; ?>" alt="">
    <h3><?php echo $ab['image_name']; ?></h3></a>
   </div>
   <?php  }
      }else{
         echo '<p class="empty">No Detail Of hero Images Placed Yet!</p>';
      }?>
</div>

</section>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>