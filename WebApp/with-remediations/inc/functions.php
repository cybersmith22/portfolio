<?php
    function get_inventory($db){
        $query = 'SELECT * FROM inventory';
        $statement = $db->prepare($query);
        $statement->execute();  
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();  
        return $results;
    }
    function get_cart($db, $username){
        $query = 'SELECT * FROM cart WHERE username = :username';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();  
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();  
        return $results;
    }
    function add_to_cart($db, $itemNumber, $username){
        $qty_desired = qty_in_cart($db, $itemNumber, $username) + 1;
        if (get_qty_available($db, $itemNumber) < $qty_desired) {
            echo "There is insufficient quantity to fulfill your request.";
        } else {
            if (qty_in_cart($db, $itemNumber, $username) > 0) {     
                //update quantity
                $query = 'UPDATE cart
                    SET quantity = quantity + 1
                    WHERE itemNumber = :itemNumber AND username = :username';
            } else {
                $query = 'INSERT INTO cart (itemNumber, quantity, username) VALUES(:itemNumber, 1, :username)';
            }
            $statement = $db->prepare($query);
            $statement->bindValue(':itemNumber', $itemNumber);
            $statement->bindValue(':username', $username);
            $statement->execute();  
            $statement->closeCursor();
        }
    }
    function qty_in_cart($db, $itemNumber, $username) {
        $query = 'SELECT quantity FROM cart WHERE itemNumber = :itemNumber AND username = :username';
        $statement = $db->prepare($query);
        $statement->bindValue(':itemNumber', $itemNumber);
        $statement->bindValue(':username', $username);
        $statement->execute();  
        $qty = $statement->fetch();
        $statement->closeCursor();
        if ($qty == false){
          return 0;
        }
        else {
         return $qty[0];
        }
    }
    function empty_cart($db, $username){
        $query = 'DELETE FROM cart WHERE username = :username';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();  
    }
    function get_description($db, $itemNumber) {
        $query = 'SELECT description
                 FROM inventory            
                 WHERE itemNumber = :itemNumber';
         $statement = $db->prepare($query);
         $statement->bindValue(':itemNumber', $itemNumber);
         $statement->execute();    
         $result = $statement->fetch();
         $statement->closeCursor();
         return $result[0];
   }
   function get_price($db, $itemNumber) {
        $query = 'SELECT price
                 FROM inventory            
                 WHERE itemNumber = :itemNumber';
         $statement = $db->prepare($query);
         $statement->bindValue(':itemNumber', $itemNumber);
         $statement->execute();    
         $result = $statement->fetch();
         $statement->closeCursor();
         return $result[0];
    }
    function get_qty_available($db, $itemNumber) {
        $query = 'SELECT quantity
                 FROM inventory            
                 WHERE itemNumber = :itemNumber';
         $statement = $db->prepare($query);
         $statement->bindValue(':itemNumber', $itemNumber);
         $statement->execute();    
         $result = $statement->fetch();
         $statement->closeCursor();
         return $result[0];
    }
    function get_order_total($db, $username) {
        $total = 0;
        $cart = get_cart($db, $username);
        foreach ($cart as $item)
        {
          $total = $total + $item['quantity'] * get_price($db, $item['itemNumber']);
        }
        return $total;
    }
    function update_inventory($db, $username){  
        //decrease inventory of purchased items
        $cart = get_cart($db, $username);
        foreach ($cart as $item){
           update_qty_available($db, $item['itemNumber'],$item['quantity']);
        }
    }
    function update_qty_available($db, $itemNumber, $qty_decrease){
        $query = 'UPDATE inventory
                 SET quantity = quantity - :qty_decrease
                 WHERE :itemNumber = itemNumber';
       $statement = $db->prepare($query);
       $statement->bindValue(':itemNumber', $itemNumber);
       $statement->bindValue(':qty_decrease', $qty_decrease);
       $statement->execute();    
       $statement->closeCursor();  
    }
    function get_inventory_html($item) {
        $image_file = "images/".$item['itemNumber'].".jpg";
        $formatted_price = sprintf("$%.2f",$item['price']);
        $html_out = "";    
        $html_out = <<<EOD
            <figure>
              <img src="$image_file" alt="{$item['itemNumber']}">
              <figcaption>
                <span class='game'>{$item['description']}</span><br>
                {$formatted_price}<br>
                Quantity available: {$item['quantity']}<br>
                <form action="." method='post'>
                  <input type="hidden" name="csrf" value={$_SESSION['token']}>
                  <input type="hidden" name="itemNumber" value={$item['itemNumber']}>
                  <input type="submit" value="Add to Cart">        
                </form>
            </figcaption>
          </figure>
EOD;
            return $html_out;
    }
    function update_cart($db, $itemNumber, $quantity, $username){
        if ($quantity == 0){
            $query = 'DELETE FROM cart WHERE itemNumber = :itemNumber AND username = :username';
        $statement = $db->prepare($query);
        $statement->bindValue(':itemNumber', $itemNumber);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $statement->closeCursor();
        } else{ 
            $query = 'UPDATE cart SET quantity = :quantity WHERE itemNumber = :itemNumber AND username = :username';
            $statement = $db->prepare($query);
            $statement->bindValue(':itemNumber', $itemNumber);
            $statement->bindValue(':quantity', $quantity);
            $statement->bindValue(':username', $username);
            $statement->execute();
            $statement->closeCursor();
        }
    }
    function get_first_name($db, $itemNumber, $username) {
        $query = 'SELECT firstName
                 FROM customer
                 INNER JOIN cart on cart.username = customer.username
                 WHERE itemNumber = :itemNumber AND cart.username = :username';
         $statement = $db->prepare($query);
         $statement->bindValue(':itemNumber', $itemNumber);
         $statement->bindValue(':username', $username);
         $statement->execute();    
         $result = $statement->fetch();
         $statement->closeCursor();
         return $result[0];
   }
   function get_last_name($db, $itemNumber, $username) {
        $query = 'SELECT lastName
                 FROM customer
                 INNER JOIN cart on cart.username = customer.username
                 WHERE itemNumber = :itemNumber AND cart.username = :username';
         $statement = $db->prepare($query);
         $statement->bindValue(':itemNumber', $itemNumber);
         $statement->bindValue(':username', $username);
         $statement->execute();    
         $result = $statement->fetch();
         $statement->closeCursor();
         return $result[0];
   }
   function get_streetAddress($db, $username) {
        $query = 'SELECT streetAddress
                 FROM customer
                 WHERE username = :username';
         $statement = $db->prepare($query);
         $statement->bindValue(':username', $username);
         $statement->execute();    
         $result = $statement->fetch();
         $statement->closeCursor();
         return $result[0];
   }
   function get_city($db, $username) {
        $query = 'SELECT city
                 FROM customer
                 WHERE username = :username';
         $statement = $db->prepare($query);
         $statement->bindValue(':username', $username);
         $statement->execute();    
         $result = $statement->fetch();
         $statement->closeCursor();
         return $result[0];
   }
   function get_state($db, $username) {
        $query = 'SELECT userState
                 FROM customer
                 WHERE username = :username';
         $statement = $db->prepare($query);
         $statement->bindValue(':username', $username);
         $statement->execute();    
         $result = $statement->fetch();
         $statement->closeCursor();
         return $result[0];
   }
   function get_zip($db, $username) {
        $query = 'SELECT zip
                 FROM customer
                 WHERE username = :username';
         $statement = $db->prepare($query);
         $statement->bindValue(':username', $username);
         $statement->execute();    
         $result = $statement->fetch();
         $statement->closeCursor();
         return $result[0];
   }
   function get_cust_fname($db, $username) {
        $query = 'SELECT firstName
                 FROM customer
                 WHERE username = :username';
         $statement = $db->prepare($query);
         $statement->bindValue(':username', $username);
         $statement->execute();    
         $result = $statement->fetch();
         $statement->closeCursor();
         return $result[0];
   }
   function get_cust_lname($db, $username) {
        $query = 'SELECT lastName
                 FROM customer
                 WHERE username = :username';
         $statement = $db->prepare($query);
         $statement->bindValue(':username', $username);
         $statement->execute();    
         $result = $statement->fetch();
         $statement->closeCursor();
         return $result[0];
   }
   function update_customer($db, $firstName, $lastName, $streetAddress, $city, $state, $zip, $username){
       $query = 'UPDATE customer '
               . 'SET firstName = :firstName, '
               . 'lastName = :lastName, '
               . 'streetAddress = :streetAddress, '
               . 'city = :city, '
               . 'userState = :state, '
               . 'zip = :zip '
               . 'WHERE username = :username';
            $statement = $db->prepare($query);
            $statement->bindValue(':firstName', $firstName);
            $statement->bindValue(':lastName', $lastName);
            $statement->bindValue(':streetAddress', $streetAddress);
            $statement->bindValue(':city', $city);
            $statement->bindValue(':state', $state);
            $statement->bindValue(':zip', $zip);
            $statement->bindValue(':username', $username);
            $statement->execute();
            $statement->closeCursor();
   }
   // Verify CSRF Token
   function verify_token($session_token, $post_token){
       if (!empty($post_token)){
            if (hash_equals($session_token, $post_token)) {
                return true;
            } else {
            return false;
            }
        }
   }
?>