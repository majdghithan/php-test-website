<?php
$title = "MY BILLS";
session_start();


include 'autoload/autoload.php';
include 'templates/header.php';
?>


<?php

if(!isset($_SESSION['email'])){
    header('location:404.php');
    } else{

    //get user bills:

    $bills = UserBills::GetBills();
    // echo UserBills::$num_of_rows;

    $count =1;
    // print_r($bills);
    foreach ($bills as $bill) {?>
        
    <p>Bill Number <?php echo $count++ ?></p>
        
    <p>
        <?php
         $products =UserBills::GetBillsDetails($bill['created_at']);
         
         ?>
    </p> 

    <table>
        <tr>
            <td>name</td>
            <td>quantity</td>
        </tr>
        <tr>
            <?php 
            // print_r($products);
echo $_SESSION['cart_id'];
foreach($products as $product){?>
            
            
            
            <td><?php echo $product['product_name'] ?></td>
            <td><?php echo $product['quantity'] ?></td>
            <td></td>
            <?php  }?>
        </tr>
    </table>


<?php    }
?>
    




<?php 
    }include 'templates/footer.php';
?>