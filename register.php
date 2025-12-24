<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   $cpass = mysqli_real_escape_string($conn,$_POST['cpassword']);


   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm Password Not Matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$cpass')") or die('query failed');
         $message[] = 'Registered Successfully!';
         header('location:login.php');
      }
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
   <title>Register</title>

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
 <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>

   
<div class="add-products">

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="name" placeholder="Enter Your Name" required pattern="[A-Za-z]+" title="only alphabet character is allowed" class="box">
      <input type="email" name="email" placeholder="Enter Your Email" required class="box">
      <input type="password" name="password" placeholder="Enter Your Password" required class="box" pattern=".{6,}" title="Must be at least 6 characters" required>
      <input type="password" name="cpassword" placeholder="Confirm Your Password" required class="box" pattern=".{6,}" title="Must be at least 6 characters" required>
      <input type="submit" name="submit" value="Register Now" class="btn"><br><br>
      <p style="color:white; font-size:20px;">Already Have An Account? <a style="text-decoration:underline; color:white;" href="login.php">login Now</a></p>
   </form>

</div>

</body>
</html>