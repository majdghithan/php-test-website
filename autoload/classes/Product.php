<?php 

class Product{

    static $NumerOfProductsInChart = 0;
   

    static function AddtoDB($name, $price, $info){
        include 'autoload/config/userdb.php';

        $sql = "INSERT INTO products(name,price,info) VALUES ('$name', '$price', '$info')";
        if(!mysqli_query($conn, $sql)){
            echo 'ERROR INSERTING ITEM:' .mysqli_error($conn);
        }else{
            echo 'item inserted';

        }
    }

    static function getProducts(){
        include 'autoload/config/userdb.php';

        $sql = "Select * from products";
        $result = mysqli_query($conn,$sql);

        if(!$result){
            echo 'ERROR GETTING PRODUCTS' .mysqli_error($conn);
            return [];
        }else{
            $array = mysqli_fetch_all($result, MYSQLI_ASSOC);

            return $array;
        }
        
    }
    static function AddtoChart($email, $id_session, $product_id){
        include 'autoload/config/userdb.php';

        $sql = "SELECT id_session from cart";
        $result = mysqli_query($conn, $sql);
    
        $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
        $exist = 0;
  
        foreach($array as $a){
            if($a['id_session'] == $id_session){
             $exist = 1;
             }}

        if($exist ==1){
        // echo 'ID EXIST';
        }
        else{
        // echo 'NEW SESSION ADDED';

        $sql = "INSERT INTO cart(email,id_session) VALUES ('$email', '$id_session')";
        
        if(!mysqli_query($conn, $sql)){
            echo 'ERROR ADDING TO CART' . mysqli_error($conn);
            exit();
        }else{
            // echo '<br>' . 'ID IS ADDED!' . '<br>';
        }}

            //add items to chart:

            //get cart_id:
            $sql = "SELECT id from cart where id_session = '$id_session'";
            $result = mysqli_query($conn,$sql);
            $arrayID = mysqli_fetch_assoc($result);


            $cart_id = $arrayID['id'];
            $_SESSION['cart_id'] = $cart_id;


            $sql = "SET FOREIGN_KEY_CHECKS=0";
            mysqli_query($conn, $sql);

            $sql = "SELECT * from cart_items where product_id = '$product_id' and cart_id ='$cart_id'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_row($result);
            $count = mysqli_num_rows($result);
          
            if($count ==1){
              
          
              $increase = ++$row[3];
              $sql = "UPDATE cart_items
              SET quantity = '$increase' where product_id = '$product_id' and cart_id = '$cart_id'";

              if(!mysqli_query($conn,$sql)){
                  echo 'INCREASING QUANTITY ERROR' . mysqli_error($conn);

              }else{
                // echo 'item exists and its quantity is increased';
              }
          
            }
            else{
          
              $sql = "INSERT INTO cart_items(product_id, cart_id, quantity) VALUES ('$product_id', '$cart_id', 1)";
          
              if(!mysqli_query($conn,$sql)){
                echo mysqli_error($conn);
              }else{

                
                // echo 'PRODUCT ADDED';
                $sql = "SET FOREIGN_KEY_CHECKS=1";
                mysqli_query($conn, $sql);
              }
          
            }
        }

    static function NumOfProductsInChart($cart_id){
            include 'autoload/config/userdb.php';

            $sql = "SELECT * from cart_items where cart_id = '$cart_id'";

            $result = mysqli_query($conn,$sql);

            $arrays = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $product_count =0;
            foreach($arrays as $product){
                    $product_count += $product['quantity'];
            }

            return $product_count;

    }

    static function CartProducts($cart_id){
        include 'autoload/config/userdb.php';

        $sql = "SELECT * from cart_items join products on cart_items.product_id = products.id where cart_id = '$cart_id' ";
        $result = mysqli_query($conn,$sql);
        $arrays = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $arrays;
    }
    static function DeleteFromCart($product_id, $cart_id){
        include 'autoload/config/userdb.php';

        $sql = "SET FOREIGN_KEY_CHECKS=0";
        mysqli_query($conn,$sql);

        $sql = "DELETE from cart_items where product_id = '$product_id' and cart_id ='$cart_id'";

        $result = mysqli_query($conn,$sql);
        if(!$result){
            // echo 'NOT deleted';
            return false;
        }
        else{
            // echo 'deleted';
            $sql = "SET FOREIGN_KEY_CHECKS=1";
            mysqli_query($conn, $sql);
            return true;
        }
    }
    static function ClearCart($cart_id){
        include 'autoload/config/userdb.php';

        $sql = "SET FOREIGN_KEY_CHECKS=0";
        mysqli_query($conn,$sql);

        $sql = "DELETE from cart_items where cart_id ='$cart_id'";

        $result = mysqli_query($conn,$sql);
        if(!$result){
            // echo 'NOT deleted';
            return false;
        }
        else{
            // echo 'deleted';
            $sql = "SET FOREIGN_KEY_CHECKS=1";
            mysqli_query($conn, $sql);
            return true;
        }
    }

    static function Order($firstname, $lastname, $email, $adress, $country, $state, $zip, $cart_id){
        include 'autoload/config/userdb.php';

        $sql = "INSERT INTO orders(firstname, lastname, email, adress, country, states, zip, cart_id) VALUES ('$firstname', '$lastname', '$email', '$adress', '$country', '$state', '$zip', '$cart_id')";

        if(!mysqli_query($conn,$sql)){
            echo mysqli_error($conn);
        }
        else{
            echo 'ORDERED';
        }

    }

    static function invoice($cart_id){

        include 'autoload/config/userdb.php';

        $sql = "SELECT product_id,quantity from cart_items where cart_id = '$cart_id'";
        $result = mysqli_query($conn,$sql);
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $productss;

        $i = 0;

        foreach($products as $product){
            $product_id = $product['product_id'];

            $sql = $sql = "SELECT * from products where id = '$product_id'";
            $result = mysqli_query($conn, $sql);
            $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $details['quantity'] = $product['quantity'];

            $productss[$i++] = $details;
            
            
        }

        return $productss;
       
    }

    static function InsertIntoDB($cart_id){

        include 'autoload/config/userdb.php';

        $sql = "SELECT product_id,quantity from cart_items where cart_id = '$cart_id'";
        $result = mysqli_query($conn,$sql);
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $productss;

        $i = 0;

        
        foreach($products as $product){
            $product_id = $product['product_id'];

            $sql = $sql = "SELECT * from products where id = '$product_id'";
            $result = mysqli_query($conn, $sql);
            $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $details['quantity'] = $product['quantity'];
            
            $productss[$i++] = $details;
            
            $price = $details[0]['price'];
            $product_name = $details[0]['name'];

            $quantity = $details['quantity'];
            // $session_id = session_id();
            $user_id = $_SESSION['user_id'];

            $sql = "INSERT INTO invoices(product_id, price, quantity, cart_id, user_id,product_name) VALUES ('$product_id', '$price', '$quantity', '$cart_id', '$user_id', '$product_name')";

            if(!mysqli_query($conn,$sql)){
                echo mysqli_error($conn);
            }
        }
        
    }

}

?>