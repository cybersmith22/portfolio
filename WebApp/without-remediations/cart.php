<?php
  session_start();
  $pageTitle = "Shopping Cart";
  include('inc/header.php'); 
  include('inc/functions.php');
  require_once('open_db.php');
  
   //if user not logged in, redirect to index.php
  if (!isset($_SESSION['user'])){
      echo "<script type='text/javascript'>alert('login to view the cart');</script>";
      header('Location: index.php');
  }
  if (isset($_POST['update'])) {
      update_cart($db, $_POST['itemNumber'], $_POST['select_quantity'], $_SESSION['user']);
  }
  $cart = get_cart($db, $_SESSION['user']);
  foreach ($cart as $item){
      $qty = get_qty_available($db, $item['itemNumber']);
      if ($item['quantity'] > $qty){
          $item['quantity'] = $qty;
          update_cart($db, $item['itemNumber'], $item['quantity'], $_SESSION['user']);
          echo "<script type='text/javascript'>alert('available quantities have changed');</script>";
      }
  }
  $cart = get_cart($db, $_SESSION['user']);
  if (count($cart) == 0) {
    echo '<section class="empty_cart"><p>Your cart is empty.</p>';
    echo "<p><a href='index.php'>Click here to return to the order page.</a></p></section>";
    include('inc/footer.php');
    exit();
  }
?>
  <main> 
    <table>
      <thead>
        <tr>
          <th colspan="6">Order Summary</th>
        </tr>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total Price</th>
        </tr>
      </thead>
      <tbody>
        <?php  
         $order_total = 0;
         
         foreach ($cart as $item) {
           $first_name = get_first_name($db, $item['itemNumber'], $_SESSION['user']);
           $last_name = get_last_name($db, $item['itemNumber'], $_SESSION['user']);
           $desc = get_description($db, $item['itemNumber']);
           $unit_price = get_price($db, $item['itemNumber']);
           $total_price = $unit_price * $item['quantity'];
           $formatted_unit_price = sprintf("$%.2f",$unit_price);
           $formatted_total_price = sprintf("$%.2f",$total_price);
        ?>
            <tr>
               <td><?php echo $first_name; ?></td>
               <td><?php echo $last_name; ?></td>
               <td><?php echo $desc; ?></td>
               <td><?php 
               echo "<form action='cart.php' method='post'>";       
               echo "<select name='select_quantity' value=''>";
               $item_qty = get_qty_available($db, $item['itemNumber']);
               for($x=0; $x <= $item_qty; $x++){
                   if ($x == $item['quantity']){
                       echo "<option selected='selected' value='$x'>$x</option>";
                   } else{
                        echo "<option value='$x'>$x</option>";
                   }
               } echo "</select>";?></td>
               <td><?php echo $formatted_unit_price; ?></td>
               <td><?php echo $formatted_total_price; ?></td>
               
               <td>
                   <input type="hidden" name="itemNumber" value="<?php echo $item['itemNumber'];?>">
                   <input type="hidden" name="quantity" value="<?php echo $_POST['select_quantity'];?>">
                   <input type="hidden" name="username" value="<?php echo $_SESSION['user'] ?>">
                   <input type="submit" name="update" value="Update Cart">  
               </td>
                </form>
            </tr>  
       <?php     
         }         
       ?>       
      </tbody>
          <tfoot>
            <tr>
              <td colspan="5" >Order Total</td>
              <?php $formatted_total = sprintf("$%.2f",get_order_total($db, $_SESSION['user'])); ?>
              <td><?php echo $formatted_total ?></td>
            </tr>
          </tfoot>
      </table>
                    
      <a href="index.php"><input type="button" value="Continue Shopping"></a>
      <a href="shipping.php"><input type="button" value="Place Order"></a>
</main>
<?php
   include('inc/footer.php'); 
?>