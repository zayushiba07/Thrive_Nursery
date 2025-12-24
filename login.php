<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){
   extract($_POST);
   $query="SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password' ";
   $select_users=mysqli_query($conn,$query);
   if(mysqli_num_rows($select_users) > 0){
      $row = mysqli_fetch_assoc($select_users);

        $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');


   }else{
      $message[] = 'incorrect email or password!';
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
   <title>login</title>

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
      <h3>login now</h3>
      <input type="email" name="email" placeholder="Enter Your Email" required class="box">
      <input type="password" name="password" placeholder="Enter Your Password" required class="box">
      <input type="submit" name="submit" value="Login Now" class="btn"><br><br>
      <p style=" color:white; font-size:20px;">Don't Have An Account? <a href="register.php" style="text-decoration:underline; color:white;">Register Now</a></p><br>
      <p style=" color:white; font-size:20px; "><a href="forgot_pass.php"  style="text-decoration:underline; color:white; font-size:20px;">Forgot Password ?</a>&nbsp &nbsp &nbsp &nbsp &nbsp<a href="change_pass.php" style="text-decoration:underline; color:white;">Change Password</a></p><br>
      <p style=" color:white; font-size:20px;">Back To Home <a href="home.php" style="text-decoration:underline; color:white; font-size:20px;">Back</a></p>

   </form>

</div>

</body>
</html>
