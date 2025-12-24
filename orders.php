<?php

include 'config.php';

session_start();
error_reporting(0);
$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3 style="border:6px solid rgb(24, 234, 237);">&nbsp;&nbsp;Your Orders&nbsp;&nbsp;</h3>
   <p style="text-decoration:5px underline; text-decoration-color:rgb(24, 234, 237);"> <a href="home.php">Home</a> / Orders </p>
</div>

<section class="placed-orders">

   <h1 class="title" style="text-decoration:5px underline; text-decoration-color:rgb(24, 234, 237);">Placed Orders</h1>

   <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE `user_id` = '$user_id'") or die('query failed');
         
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query) ){
      ?>
      <div class="box">
         <p> Placed On : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Payment Method : <span><?php if($fetch_orders['method'] == 'COD'){echo 'COD';} else{ echo $fetch_orders['method']; } ?></span> </p>
         <p> Your Orders : <span><?php echo $fetch_orders['product_name']; ?></span> </p>
         <p> Total Price : <span><?php echo 'RS.'. $fetch_orders['total_price']; ?>/-</span> </p>
         <p> Payment Status : <span style="color:<?php if($fetch_orders['payment_status'] == 'Pending'){ echo 'rgb(24, 234, 237)'; }else{ echo 'rgb(24, 234, 237)'; } ?>;"><?php if($fetch_orders['payment_status'] == 'Pending'){ echo 'Pending'; }else{ echo 'Completed'; } ?></span> </p>
         <p> Order Status : <span style="color:<?php if($fetch_orders['order_status'] == 'Pending'){ echo 'rgb(24, 234, 237)'; }else{ echo 'rgb(24, 234, 237)'; } ?>;"><?php if($fetch_orders['order_status'] == 'Pending'){ echo 'Pending'; }else{ echo 'Completed'; } ?></span> </p>
          <form align="center" method="post">
            <?php
               if($fetch_orders['order_status'] == 'Pending')
               {
            ?>
              <a href="orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" style=" background-color:rgb(24, 234, 237);" class="delete-btn">Delete</a>
              <?php
               }
              ?>
              <?php
              if(isset($_GET['delete'])){
                 $delete_id = $_GET['delete'];
                 $name=$fetch_orders['name'];
                  $number=$fetch_orders['number'];
                  $email=$fetch_orders['email'];
                  $address=$fetch_orders['address'];
                  $tpe=$fetch_orders['product_name'];
                  $tpr=$fetch_orders['total_price'];
                  $date=$fetch_orders['placed_on'];
                 mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
                 mysqli_query($conn,"INSERT INTO `cancel_order`(`user_id`, `name`, `number`, `email`, `address`, `product_name`, `total_price`, `placed_on`) VALUES ('$user_id','$name','$number','$email','$address','$tpe','$tpr','$date')");
                 header('location:orders.php');
              }

                

               ?>
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








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
