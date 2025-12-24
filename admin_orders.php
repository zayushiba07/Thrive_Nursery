<?php

include 'config.php';
error_reporting(0);
session_start();

$admin_email=$_SESSION['admin_email'];
if(!isset($admin_email)){
   header('location:admin.php');
}


if(isset($_POST['update_order1'])){

   $order_update_id = $_POST['order_id'];
   //$update_payment = $_POST['update_payment'];
   $update_order=$_POST['update_order'];
   mysqli_query($conn,"UPDATE `orders` SET `order_status`='$update_order' WHERE `id` = '$order_update_id'");
   $message[] = 'Payment Status AND Order Status Has Been Updated!';

}

if(isset($_POST['update_payment1'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   //$update_order=$_POST['update_order'];
   mysqli_query($conn,"UPDATE `orders` SET `payment_status`='$update_payment' WHERE `id` = '$order_update_id'");
   $message[] = 'Payment Status AND Order Status Has Been Updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <style>
      .message{
         background-color: #2f26263d;
      }
   </style>
</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="orders">

   <h1 class="title">Placed Orders</h1>

   <div class="box-container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
      
      
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
         <p> User id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
         <p> Placed On : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Total Products : <span><?php echo $fetch_orders['total_product']; ?></span> </p>
         <p> Total Price : <span><?php echo 'RS.'. $fetch_orders['total_price']; ?>/-</span> </p>
         <p> Payment Method : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <form action="" method="post">
         <p> Payment Status :
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <select name="update_payment">
               <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
               <option value="Pending">Pending</option>
               <option value="completed">Completed</option>
            </select></p>
            <input type="submit" value="update" name="update_payment1" class="option-btn">
            <p>Order Status:
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <select name="update_order">
               <option value="" selected disabled><?php echo $fetch_orders['order_status']; ?></option>
               <option value="Pending">Pending</option>
               <option value="completed">Completed</option>
            </select></p>
            <input type="submit" value="update" name="update_order1" class="option-btn">
            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">Delete</a>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">No Orders Placed Yet!</p>';
      }
      ?>
   </div>

</section>










<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>