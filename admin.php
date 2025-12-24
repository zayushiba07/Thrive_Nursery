<?php
error_reporting()
include 'config.php';
session_start();

if(isset($_POST['submit'])){
   extract($_POST);
$select_users = mysqli_query($conn, "SELECT * FROM `admins` WHERE email = '$email' AND password = '$password'") or die('query failed');
   if(mysqli_num_rows($select_users) == 1){
      $_SESSION['admin_email']=$email;
      header('location:admin_page.php');
   }
   else{
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
   <title>Admin login</title>
   <style>
        .add-products
        {
            margin-top: 150px;
        }
    </style>

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
      <h3 >Admin login now</h3>
      <input type="email" name="email" placeholder="Enter Your Email" required class="box">
      <input type="password" name="password" placeholder="Enter Your Password" required class="box" pattern=".{6,}" title="Must be at least 6 characters" required>
      <input type="submit" name="submit" value="Login Now" class="btn"><br><br>
      
      <p style="color:white; font-size:20px;">Back To Home <a href="home.php"style=" color:white; font-size:20px; text-decoration:underline;">Back</a></p>
   </form>

</div>

</body>
</html>