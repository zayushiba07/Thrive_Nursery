
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
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $p_name = $_SESSION['product_name'];
   $p_price = $_SESSION['product_price'];
   $p_qty = $_SESSION['product_quantity'];
   $t_price = $p_price * $p_qty;

   $_SESSION['pri'] = $t_price;
   $_SESSION['name'] = $name;
   $_SESSION['address'] = $address;
   $_SESSION['email'] = $email;
   $_SESSION['number'] = $number;
   $_SESSION['method'] = $method;
   $_SESSION['placed_on'] = $placed_on;
   $_SESSION['total_product'] = $p_name;
   $_SESSION['qty'] = $p_qty;


   $product_query = mysqli_query($conn, "SELECT product_id FROM products WHERE name = '$p_name'") or die('Product Query Failed');
   if(mysqli_num_rows($product_query) > 0){
       $product_data = mysqli_fetch_assoc($product_query);
       $p_id = $product_data['product_id']; 
   } else {
       die('Product not found!');
   }

   if($method == 'credit card') {
      mysqli_query($conn, "UPDATE `products` SET qty = GREATEST(qty - 1, 0) WHERE product_id = '$p_id'") or die('Stock Update Failed');
      header('location:card.php');
   } elseif($method == 'cash on delivery') {
      
      mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, address, product_name, total_price, placed_on , total_product, payment_status,method,order_status) 
         VALUES('$user_id', '$name', '$number', '$email', '$address', '$p_name', '$t_price', '$placed_on', '$p_qty', 'Pending','COD','Pending')") or die('Order Query Failed');

      
     

      mysqli_query($conn, "UPDATE `products` SET qty = GREATEST(qty - 1, 0) WHERE product_id = '$p_id'") or die('Stock Update Failed');
      header('location:orders.php');
   }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3 style="border:8px solid rgb(24, 234, 237);">Checkout</h3>
   <p style="text-decoration:underline; text-decoration-color:rgb(24, 234, 237);"> <a href="home.php">Home</a> / Checkout </p>
</div>

<section class="display-order">

   <?php
     $grand_total=$_SESSION['product_price']*$_SESSION['product_quantity'];
   ?>
   <div class="grand-total" style=" color:white;"> Grand Total : <span style=" color:white;"><?php echo 'RS.'. $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>Place Your Order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Your Name :</span>
            <input style=" color:white;" type="text" name="name" required placeholder="Enter Your Name">
         </div>
         <div class="inputBox">
            <span>Your Number :</span>
            <input style=" color:white;" type="text" name="number" required placeholder="Enter Your Number" pattern="[0-9]{10}" title="only 10 digit number is allowed">
         </div>
         <div class="inputBox">
            <span>Your Email :</span>
            <input style=" color:white;" type="email" name="email" required placeholder="enter your email">
         </div>
         <div class="inputBox">
            <span>Payment Method :</span>
            <select name="method" style=" color:white; background-color:rgb(24, 234, 237);">
               <option value="cash on delivery">Cod</option>
               <option value="credit card">Credit Card</option>
                              
            </select>
         </div>
         <div class="inputBox">
            <span>Address Line 01 :</span>
            <input style=" color:white;" type="number" min="0" name="flat" required placeholder="e.g. Flat no.">
         </div>
         <div class="inputBox">
            <span>Address Line 01 :</span>
            <input style=" color:white;" type="text" name="street" required placeholder="e.g. Street Name" required required pattern="[A-Za-z]+" title="only alphabet character is allowed">
         </div>
         <div class="inputBox">
            <span>City :</span>
            <input style=" color:white;" type="text" name="city" required placeholder="e.g. Mumbai" required required pattern="[A-Za-z]+" title="only alphabet character is allowed">
         </div>
         <div class="inputBox">
            <span>State :</span>
            <input style=" color:white;" type="text" name="state" required placeholder="e.g. Maharashtra" required required pattern="[A-Za-z]+" title="only alphabet character is allowed">
         </div>
         <div class="inputBox">
            <span>Country :</span>
            <input style=" color:white;" type="text" name="country" required placeholder="e.g. India" required required pattern="[A-Za-z]+" title="only alphabet character is allowed">
         </div>
         <div class="inputBox">
            <span>Pin Code :</span>
            <input style=" color:white;" type="number" min="0" name="pin_code" required placeholder="e.g. 123456"  pattern="\d{3}" title="only numeric character is allowed">
         </div>
      </div>
      <input style=" color:white;" type="submit" value="order now" class="btn" name="order_btn">
   </form>

</section>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
