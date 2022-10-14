<?php
$title = "CART | MAJD GHIDHAN";
session_start();

if(!isset($cart_id)){
  $cart_id=0;
}

include 'autoload/autoload.php';

if(isset($_POST['delete'])){
    $product_id = $_POST['id'];
    $cart_id = $_POST['cart_id'];

    PRODUCT::DeleteFromCart($product_id, $cart_id);
}


include 'templates/header.php';

?>

<?php
if(isset($_SESSION['email']) and isset($_SESSION['lastname']) and isset($_SESSION['firstname']))  {
    if(isset($_COOKIE['num_of_products']) and ($_COOKIE['num_of_products']==0)){  ?>

        <h1>ADD PRODUCTS</h1>
        <a href="training.php">Shop now</a>

    <?php }
    else{
        if(isset($_SESSION['cart_id'])){
        $cart_id = $_SESSION['cart_id'];
      }
        $products = Product::CartProducts($cart_id);
        
    ?>
        <!-- add content -->

    <div class="container-cart">
  <div class="row" id="row-cart">
      
    <div class="col-sm-9">
      <a href="./training.php">
    <i class="far fa-arrow-alt-circle-left"></i>
    </a>
		<table class="table table-image">
      
        <caption><i class="fas fa-shopping-cart" aria-hidden="true"></i>    CURRENT CART  /  <a href="training.php" style="text-decoration-color: b;">Add more products</a></caption>
		  <thead>
		    <tr>
		      
		      <th scope="col">Product</th>
		      <th scope="col">Product image</th>
		      <th scope="col">Price($)</th>
		      <th scope="col">Quantity</th>
		      <th scope="col"></th>
		      
		    </tr>
		  </thead>
		  <tbody>
<?php
if(!isset($total_price)){   
    $total_price =0;
    }
if(count($products)==0){ ?>
              <tr>
                  <td rowspan="0" colspan="3"><h4>Empty Cart, Add products from <a href="training.php">Shop<i class="fas fa-cart-plus"></i>

                    </a></h4></td>
                  <td></td>
                  <td></td>
                  <td></td>
              </tr>
    <?php } else{
        foreach($products as $product){
    
 ?>

		    <tr>
		      <th scope="row">
            <div id="product_name">
                  <?php echo $product['name'];?></div>
                
                <!-- <input type="hidden" name="product_name" id='product_name' value=""> -->
              
              </th>
		      <td class="w-25">
			      <img src="./assets/imgs/<?php echo $product['name'];?>.svg" class="img-fluid " alt="<?php echo $product['name'];?> image" style="height: 60px;">
		      </td>
		      <td><?php echo $product['price'];?>$</td>
		      <td>
             
                  <input type="number" name="quantity" id="quantity" value="<?php echo $product['quantity'];?>" min="1" max="1000" class="form-control">
                  

                </td>
		      <td>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                
               <label for="delete"></label>

               <input type="submit" value="Delete" name="delete" class="btn btn-danger btn-sm ">

                <input type="hidden" name="id" value="<?php echo $product['id'];?>">
                <input type="hidden" name="cart_id" value="<?php echo $cart_id;?>">
            </form>          
            <?php
          
              ?></td>
		      
		    </tr>

 
    
    <?php 
    if(isset($total_price)){   
    $total_price += $product['price'] * $product['quantity'];
    }
} }?>


</tbody>
</table>  
</div>
    <div class="col-sm-3">
    <div class="card">
    <p><strong>Total price:</strong></p>
<!-- product price -->
    <p> <strong>
        <?php if(isset($total_price)){   
        echo $total_price;
    } ?>$
    </strong>
    </p>
    
    <a href="checkout.php" class="btn btn-outline-success" id="normal-button">Checkout</a>


    </div>
    </div>
  </div>

</div>

    

    

<?php }} else{ header('Location:404.php'); ?>

<?php }?>


<?php include 'templates/footer.php'; ?>


<script src="input.js"></script>