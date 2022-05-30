<?php 
   session_start();
  $pageTitle = "Order Confirmation";
  include('inc/header.php');   
  include('inc/functions.php'); 
  require_once('open_db.php');
  
   //if user not logged in, redirect to index.php
  if (!isset($_SESSION['user'])){
      header('Location: index.php');
  }
?>
		
  <main class="confirm_notice">
    <h2>Order Confirmation</h2>
    
    <?php
	  
      $customer_fname = htmlspecialchars(filter_input(INPUT_POST, 'fname'));
      $customer_lname = htmlspecialchars(filter_input(INPUT_POST, 'lname'));
      $street_address = htmlspecialchars(filter_input(INPUT_POST, 'street'));
      $city = htmlspecialchars(filter_input(INPUT_POST, 'city'));
      $state = $_POST['state'];
      $zip = htmlspecialchars(filter_input(INPUT_POST, 'zip'));
      
       
      $order_total = get_order_total($db, $_SESSION['user']);
      $formatted_total = sprintf("$%.2f",$order_total);
     
      echo "<p>Your order was placed on ". date('F j' . ', ' . 'Y')." at ".date('g:i a')."</p>";

      echo "<p>Your order total is $formatted_total.</p>";
	  
      echo "<p>Your order will be shipped to the following address:</p>";
      echo '<p>';
      echo $customer_fname . ' ' . $customer_lname . '<br />';
      echo $street_address . '<br />';
      echo $city . ', ' . $state . '  ' . $zip . '<br />';
      echo '</p>';
      //only update if cart is not empty; shouldn't be possible to get here otherwise
      update_inventory($db, $_SESSION['user']);  
      empty_cart($db, $_SESSION['user']);
      echo '<a href="index.php"><input type="button" value="Continue Shopping"></a>';
    ?>  
  </main>
<?php include('inc/footer.php') ?>
