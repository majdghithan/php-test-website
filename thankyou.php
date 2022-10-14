<?php 

$title = "THANK YOU!";
session_start();

include 'autoload/autoload.php';

include 'templates/header.php';
?>


<?php 
if(isset($_SESSION['email']) and isset($_SESSION['cart_id'])){ ?>



<?php
    $cart_id = $_SESSION['cart_id'];
    $products = Product::invoice($cart_id);

    
    // print_r($products[1]['quantity']);


    ?>

<div class="container-cart">
  <div class="row" id="row-cart">
  <h4 class="mb-4 card" style="color: green;"><i class="fa fa-check" aria-hidden="true"> THANK YOU FOR YOUR ORDER</i>
 </h4>
    <div class="col-sm-9">
      
		<table class="table table-image">
      
        <caption><i class="fas fa-shopping-cart" aria-hidden="true"></i>    Your Order is ready, we will contact you soon /  <a href="training.php" style="text-decoration-color: b;">Order Again</a></caption>
		  <thead>
		    <tr>
		      
		      <th scope="col">Product</th>
		      <th scope="col">Product image</th>
		      <th scope="col">Price($)</th>
		      <th scope="col">Quantity</th>
		      
		      
		    </tr>
		  </thead>
		  <tbody>
    <?php
    if(!isset($total_price)){   
    $total_price =0;
    }
    ?>

    <?php
        $i = 0;

        for ($i=0; $i < count($products) ; $i++) { 
            
         ?>
		    <tr>
		      <th scope="row">
                  <?php echo $products[$i][0]['name'];?></th>
		      <td class="w-25">
			      <img src="./assets/imgs/<?php echo $products[$i][0]['name'];?>.svg" class="img-fluid " alt="<?php echo $products[$i][0]['name'];?> image" style="height: 60px;">
		      </td>
		      <td><?php echo $products[$i][0]['price'];?>$</td>
		      <td>
                  <?php echo $products[$i]['quantity'];?>
                  
                </td>
		      <td>
                       
            <?php
          
              ?></td>
		      
		    </tr>

 
    
    <?php 
    if(isset($total_price)){   
    $total_price += ($products[$i][0]['price']) * ($products[$i]['quantity']);

    }
} ?>


</tbody>
</table>  
</div>
    <div class="col-sm-3">
    <div class="card">
    <p><strong>Total price paid:</strong></p>

    <p> <strong>
        <?php if(isset($total_price)){   
        echo $total_price;
    } ?>$
    </strong>
    </p>
    
    </div>
    </div>
  </div>

</div>

<?php
}
else{
    header('location: 404.php');
}
?>


<?php 

include 'templates/footer.php';

?>