<?php /*
error_reporting(0);
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

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_page.php">Home</a>
         <a href="admin_products.php">Products</a>
         <a href="admin_orders.php">Orders</a>
         <a href="admin_users.php">Users</a>
         <a href="admin_contacts.php">Messages</a>
         <a href="hero.php">Hero</a>
         <a href="admin_treetype.php">Tree Type</a>
         <a href="admin_planttype.php">Plant Type</a>
         <a href="admin_image_uplode.php">Gallery Image</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <a href="admin_logout.php" class="delete-btn">Logout</a>
      </div>

   </div>

</header> */?>
<?php
error_reporting(0);
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

<header class="header">
   <div class="flex">
      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>
      <nav class="navbar">
         <a href="admin_page.php">Home</a>
         <a href="admin_products.php">Products</a>
         <a href="admin_orders.php">Orders</a>
         <a href="admin_users.php">Users</a>
         <a href="admin_contacts.php">Messages</a>
         <a href="admin_tip.php">Tips</a>
         <a href="hero.php">Hero</a>
         <div class="dropdown">
            <a href="#" class="dropbtn">Type</a>
            <div class="dropdown-content">
               <a href="admin_treetype.php">Tree Type</a>
               <a href="admin_planttype.php">Plant Type</a>
            </div>
         </div>
         <a href="admin_image_uplode.php">Gallery Image</a>
      </nav>
      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>
      <div class="account-box">
         <a href="admin_logout.php" class="delete-btn">Logout</a>
      </div>
   </div>
</header>

<style>
   .dropdown {
      position: relative;
      display: inline-block;
   }
   .dropbtn {
      color: white;
      text-decoration: none;
      padding: 10px;
      display: block;
   }
   .dropdown-content {
      display: none;
      position: absolute;
      background-color:rgb(0, 0, 0);
      min-width: 160px;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
      z-index: 1;
   }
   .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
   }
   .dropdown-content a:hover {
      background-color: #f1f1f1;
   }
   .dropdown:hover .dropdown-content {
      display: block;
   }
</style>
