<?php
   include 'config.php';
   session_start();
   error_reporting(0);
   $user_id=$_SESSION['user_id'];
    $cart_total=$_SESSION['cart_total'];
    $address=$_SESSION['address'];
    $name=$_SESSION['name'];
    $email=$_SESSION['email'];
    $number=$_SESSION['number'];
    $method=$_SESSION['method'];
    $placed_on=$_SESSION['placed_on'];
    $total_products=$_SESSION['total_product'];
    $qty=$_SESSION['qty'];
    $qu=$_SESSION['qu'];
    if(isset($_POST['sub']))
    {
        mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, address, product_name, total_price, placed_on, total_product,payment_status,method,order_status) VALUES('$user_id', '$name', '$number', '$email',  '$address', '$total_products', '$cart_total', '$placed_on', ' $qty','Complete','Credit Card','Pending')") or die('query failed');
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        $name1=$_SESSION['namee'];
        //mysqli_query($conn,"DELETE FROM `products` WHERE name = '$name1'");
        header('location:orders.php');
    }
       
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/admin_style.css">
<style>
        .add-products
        {
            margin-top: 100px;
        }
    </style>
    <title>DCard</title>
</head>
<body>
<div class="add-products">

    <form method="post">
      <h1 style="color:white; font-size:40px;"> Cradit Card payment</h1><br><br>
      <h1 style="color:white">Cradit Number:</h1>
     <input type="text" name="cname" class="box"  pattern="[0-9\s]{8,19}" autocomplete="cc-number" maxlength="19" placeholder="xxxx xxxx xxxx xxxx"  required><br><br>
     <h1 style="color:white">Expiry Date:</h1>
     <input type="date" name="edate" class="box"  required><br><br>
     <h1 style="color:white">CVV:</h1>
     <input type="text" name="cname" class="box"  placeholder="CVV" pattern="\d{3}" title="cvv is not valid" required><br><br>
     <input type="submit" name="sub" value="Pay Now" class="btn">&nbsp &nbsp &nbsp  <a href="home.php" style="text-decoration:underline; color:white; font-size:20px;">Back</a></td>


    </form>
</body>
</html>   