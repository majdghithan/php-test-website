<?php
echo 'hihi';
// session_start();

// $value = $_POST['value'];

// include 'autoload/config/userdb.php';

// $cart_id = $_SESSION['cart_id'];

// $sql = "SELECT * from cart_items where cart_id = '$cart_id'";
// $result = mysqli_query($conn,$sql);
// $products = mysqli_fetch_all($result, MYSQLI_ASSOC);


// $product_idd = '';
// foreach($products as $product){

//     $product_id = $product['product_id'];

//     $sql = "SELECT * from products where id = '$product_id'";

//     $result = mysqli_query($conn,$sql);
//     $array = mysqli_fetch_all($result,MYSQLI_ASSOC);
    
    
//     $aaa = $array[0]['name'];
//     $bbb = $_POST['name'];
//     echo '<br><br><br>';
//     echo '<br><br><br>';
    
//     echo ($_POST['name'] == 'MEAL PLAN');

//     switch ($_POST['name']) {
//         case ' '.$array[0]['name']:
//             echo 'ok';
//             break;
//         case ' '.'TRAINING PROGRAM':
//             echo 'not ok';
//             break;
//         default:
//             echo 'no';
//             break;
//     }
 
    
// }

// if($product_idd != ''){
//     $sql = "UPDATE cart_items SET quantity = '$value' WHERE cart_id = '$cart_id' and product_id = '$product_idd'";

//     if(!(mysqli_query($conn,$sql))){
//         echo mysqli_error($conn);
//     }
// }
// else{

// }

// exit();

?>

