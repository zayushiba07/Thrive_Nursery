

<?php
include 'config.php';
session_start();
error_reporting(0);

$user_id = $_SESSION['user_id'];

if(isset($_POST['order_btn'])){
      
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'Flat No. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products = [];
   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');

   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = $cart_item['price'] * $cart_item['quantity'];
         $cart_total += $sub_total;
         $qty1 = $cart_item['quantity'];
         $p_id = $cart_item['product_id'];

         // ✅ Update stock safely, ensuring it never goes negative
         mysqli_query($conn, "UPDATE `products` SET qty = GREATEST(qty - $qty1, 0) WHERE product_id = '$p_id'") or die('Query failed');
      }
   }

   $total_products = implode(', ', $cart_products);

   // Check if order already exists
   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND address = '$address' AND product_name = '$total_products' AND total_price = '$cart_total'") or die('Query failed');

   if($cart_total == 0){
      $message[] = 'Your Cart Is Empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'Order Already Placed!';
      }else{
         // Store order details in session
         $_SESSION['cart_total'] = $cart_total;
         $_SESSION['address'] = $address;
         $_SESSION['name'] = $name;
         $_SESSION['email'] = $email;
         $_SESSION['number'] = $number;
         $_SESSION['method'] = $method;
         $_SESSION['placed_on'] = $placed_on;
         $_SESSION['total_product'] = $total_products;
         $_SESSION['qty'] = $qty1;

         if($method == 'credit card'){
             header('location:dcard.php');
         }
         elseif($method == 'COD'){
               // Insert order into database
               mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, address, product_name, total_price, placed_on, total_product, payment_status,method,order_status) VALUES('$user_id', '$name', '$number', '$email', '$address', '$total_products', '$cart_total', '$placed_on', '$qty1' ,'Pending','COD','Pending')") or die('Query failed');

               // Insert payment status
               

               // Clear cart after order
               mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');

               header('location:orders.php');
         }
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
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3 style="border:6px solid rgb(24, 234, 237);">&nbsp;&nbsp;Checkout&nbsp;&nbsp;</h3>
   <p style="text-decoration:5px underline; text-decoration-color:rgb(24, 234, 237);"> <a href="home.php">Home</a> / Checkout </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $_SESSION['qu'] = $fetch_cart['quantity'];
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span style=" color:white;  ">(<?php echo 'RS.'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity'];    $_SESSION['namee']=$fetch_cart['name'];  ?>)</span> </p>
            
   <?php
      }
   }else{
      echo '<p class="empty">Your Cart Is Empty</p>';
   }
   ?>
   <div class="grand-total" style=" color:white;"> Grand Total : <span><?php echo 'RS.'. $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">
<?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>

   <form action="" method="post">
      <h3 style="text-decoration:5px underline; text-decoration-color:rgb(24, 234, 237);">Place Your Order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Your Name :</span>
            <input style=" color:white;"type="text" name="name" required  pattern="[A-Za-z]+" title="only alphabet character is allowed" placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>Your Number :</span>
            <input style=" color:white;" type="text" name="number" required  placeholder="enter your number" pattern="[0-9]{10}" title="only 10 digit number is allowed">
         </div>
         <div class="inputBox">
            <span>Your Email :</span>
            <input style=" color:white;" type="email" name="email" required placeholder="enter your email">
         </div>
         <div class="inputBox">
            <span>Payment Method :</span>
            <select name="method" style=" color:white; background-color:skyblue;">
               <option value="COD">Cod</option>
               <option value="credit card">Credit Card</option>
               
            </select>
         </div>
         <div class="inputBox">
            <span>Address Line 01 :</span>
            <input style=" color:white;" type="number" min="0" name="flat" required placeholder="e.g. Flat no.">
         </div>
         <div class="inputBox">
            <span>Address Line 01 :</span>
            <input style=" color:white;" type="text" name="street" required pattern="[A-Za-z]+" title="only alphabet character is allowed"  placeholder="e.g. Street Name">
         </div>
         <div class="inputBox">
            <span>City :</span>
            <input style=" color:white;" type="text" name="city" required pattern="[A-Za-z]+" title="only alphabet character is allowed" placeholder="e.g. Mumbai">
         </div>
         <div class="inputBox">
            <span>State :</span>
            <input style=" color:white;" type="text" name="state" required pattern="[A-Za-z]+" title="only alphabet character is allowed" placeholder="e.g. Maharashtra">
         </div>
         <div class="inputBox">
            <span>Country :</span>
            <input style=" color:white;" type="text" name="country" required pattern="[A-Za-z]+" title="only alphabet character is allowed" placeholder="e.g. India">
         </div>
         <div class="inputBox">
            <span>Pin Code :</span>
            <input style=" color:white;" type="number" min="0" name="pin_code" required placeholder="e.g. 123456" pattern="\d{6}" title="Pincode Is not valid">
         </div>
      </div>
      <input  style=" color:white;" type="submit" value="Order Now" class="btn" name="order_btn">
   </form>

</section>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>