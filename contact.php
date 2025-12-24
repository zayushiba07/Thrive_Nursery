<?php

include 'config.php';

session_start();
error_reporting(0);

$user_id = $_SESSION['user_id'];


if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   
   $msg = mysqli_real_escape_string($conn, $_POST['message']);
   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'message sent already!';
   }else{
      mysqli_query($conn, "INSERT INTO `message` (`user_id`, `name`, `email`, `number`, `message`) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'Message Sent Successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>
   <style>
         .contact 
         {
            color:black;
         }
    </style>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3 style="border:6px solid rgb(24, 234, 237);">&nbsp;&nbsp;Contact Us&nbsp;&nbsp;</h3>
   <p style="text-decoration:5px underline; text-decoration-color:skyblue;"> <a href="home.php">Home</a> / Contact </p>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>Say Something!</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="Enter Your Name" pattern="[A-Za-z]+" title="only alphabet character is allowed" class="box">
      <input type="email" name="email" required placeholder="Enter Your Email" class="box">
      <input type="text" name="number"  placeholder="Enter Your Number"   pattern="[0-9]{10}" title="only 10 digit number is allowed" class="box" required>
      <textarea name="message" class="box" placeholder="Enter Your Message" id="" cols="30" rows="10" required></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>