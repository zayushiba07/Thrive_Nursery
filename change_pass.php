<?php

include 'config.php';
session_start();
error_reporting(0);
if(isset($_POST['submit'])){
   extract($_POST);
   $w="SELECT * FROM `users` WHERE `email` = '$email' and `password` = '$password'";
   $d=mysqli_query($conn,$w);
   if($d>0)
   {
    if($password1==$password2)
     {
         $q="UPDATE `users` SET `password`='$password2' WHERE    `email` = '$email' ";
         mysqli_query($conn,$q);
    }
    else{
        $message[]= "Password Is Not Matched";
     }
   }
   else{
    $message[] = 'Incorrect Email Or Password!';
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
            margin-top: 100px;
        }
    </style>
   <title>Change Password</title>

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
      <h3>Change Password</h3>
      <input type="text" name="email" placeholder="Enter Your email" required class="box">
      <input type="password" name="password" placeholder="Enter Your Old Password" required class="box">
      <input type="password" name="password1" placeholder="Enter Your New Password" required class="box">
      <input type="password" name="password2" placeholder="Enter Your Conform  Password" required class="box">
      <input type="submit" name="submit" value="Confirm" class="btn"><br><br>
    
      <p style="color:white; font-size:20px;" >Back To Home <a style="text-decoration:underline; color:white;" href="home.php">Back</a></p>
   </form>

</div>

</body>
</html>
