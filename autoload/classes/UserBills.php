<?php

class UserBills{
    
    static $num_of_rows;

    static function GetBills(){

        include 'autoload/config/userdb.php';

        $cart_id = $_SESSION['cart_id'];

        $sql = "SELECT * FROM invoices where cart_id = '$cart_id' group by created_at";

        $result = mysqli_query($conn,$sql);
        $array = mysqli_fetch_all($result, MYSQLI_ASSOC);

        self::$num_of_rows = count($array);

        return $array;
    }

    static function GetBillsDetails($created_at){
        include 'autoload/config/userdb.php';

        $cart_id = $_SESSION['cart_id'];
        $sql = "SELECT * FROM invoices where cart_id = '$cart_id' and created_at = '$created_at'";

        $result = mysqli_query($conn,$sql);
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // print_r($products);

        return $products;
    }
}

?>