<?php 
  session_start();
  
  //Generate CSRF token, store in session
  if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
  }
  
  $pageTitle = "Available Games";
  $description = "Displays the games for sale at Game and Play";
  require_once('open_db.php');
  include('inc/functions.php');
  include('inc/header.php');
?>
		
<nav>
    <h1> help </h1>
    <?php 
        $inventory = get_inventory($db); 
        if (isset($_SESSION['user'])){
            echo '<a href="login_files/logout.php"><input type="button" value="logout"></a>';
            //adding item to cart
            if (isset($_POST['itemNumber']) && verify_token($_SESSION['token'], $_POST['token'])) {
              add_to_cart($db, $_POST['itemNumber'], $_SESSION['user']);
              unset($_POST['itemNumber']);      
            }
        } else {
            echo '<a href="login_files/login_start.php"><input type="button" value="login or create account"></a>';
            if (isset($_POST['itemNumber'])) {
              echo "<script type='text/javascript'>alert('login to add an item to the cart');</script>";
              unset($_POST['itemNumber']);      
            }
        }
    ?>
    <a href="cart.php"><img src="images/cart.png" alt="cart" class="cart"></a>
</nav>

<main class="flex_content">          
  <?php
    //display each game in the inventory
    $inv_html = "";
    foreach($inventory as $item) { 
          $inv_html = get_inventory_html($item) . $inv_html;
    }
    echo $inv_html;              
  ?> 

</main>

<?php include('inc/footer.php') ?>