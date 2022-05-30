<?php
  session_start();
  $pageTitle = "Shipping Information";
  include('inc/header.php'); 
  include('inc/functions.php');
  require_once('open_db.php');
  
  //if user not logged in, redirect to index.php
  if (!isset($_SESSION['user'])){
      header('Location: index.php');
  }
  
  if (isset($_POST['update'])) {
      update_customer($db, $_POST['fname'], $_POST['lname'], $_POST['street'], $_POST['city'], $_POST['state'], $_POST['zip'], $_SESSION['user']);
      echo "<br />";
      echo "user's information has been updated";
  }
?>
  <main> 
    <h2>Shipping Information</h2>
      <form action="confirm.php" method="post" class="cust_info_form">
        <label for="fname">Customer's First Name</label>
        <?php $fname = get_cust_fname($db, $_SESSION['user']);?>
        <input type="text" name="fname" value="<?php echo $fname?>"><br />
        <label for="lname">Customer's Last Name</label>
        <?php $lname = get_cust_lname($db, $_SESSION['user']);?>
        <input type="text" name="lname" value="<?php echo $lname?>"><br />
        <label for="street">Street Address</label>
        <?php $street = get_streetAddress($db, $_SESSION['user']);?>
        <input type="text" name="street" value="<?php echo $street?>"><br />
        <label for="city">City</label>
        <?php $city = get_city($db, $_SESSION['user']);?>
        <input type="text" name="city" value="<?php echo $city?>"><br /> 
        <label for="state">State</label>
        <?php $state = get_state($db, $_SESSION['user']);?>
        <input type="text" name="state" value="<?php echo $state?>"><br />
        <label for="zip">Zip Code</label>
         <?php $zip = get_zip($db, $_SESSION['user']);?>
        <input type="text" name="zip" value="<?php echo $zip?>"><br />
        <input type="submit" formaction="shipping.php" name="update" value="Update Information">
        <input type="submit" name="action" value="Place Order">
      </form>
    <a href="cart.php"><input type="button" value="Return to Cart"></a>
</main>
<?php
   include('inc/footer.php'); 
?>