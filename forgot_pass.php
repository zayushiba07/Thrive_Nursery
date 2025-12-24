<?php

include 'config.php';
session_start();
error_reporting(0);
if(isset($_POST['submit'])){
   extract($_POST);
   if($password1==$password2)
   {
        $q="UPDATE `users` SET `password`='$password2' WHERE    `email` = '$email' ";
        mysqli_query($conn,$q);
   }
   else{
      $message[]= "password is not matched";
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <style>
        .add-products
        {
            margin-top: 150px;
        }
    </style>
   <title>Forgot Password</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<div class="add-products">

   <form action="" method="post">
      <h3>Forgot Password</h3>
      <input type="text" name="email" placeholder="Enter Your Email" required class="box">
      <input type="password" name="password1" placeholder="Enter Your New password" required class="box">
      <input type="password" name="password2" placeholder="Enter Your Conform  Password" required class="box">
      <input type="submit" name="submit" value="Confirm" class="btn"><br><br>
    
      <p style="color:white; font-size:20px;">Back To Home <a style="text-decoration:underline; color:white; " href="home.php">Back</a></p>
   </form>

</div>

</body>
</html>
