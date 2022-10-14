<?php 
$title = "Training Plan";
session_start();

if(isset($_SESSION['email'])){
  $id_session = session_id();
  
  include 'autoload/config/userdb.php';
  include 'autoload/autoload.php';
  $products = Product::getProducts();
 


  if(isset($_POST['add'])){

    $product_id = $_POST['id'];
    $email = $_SESSION['email'];

    Product::AddtoChart($email,$id_session,$product_id);

    
  }

}
else{
  $products = [];
  header('Location:login.php');
}




include './templates/header.php';
?>


<div id="cart-container">
  
<p class="text-center" id="cart">
<i class="fas fa-shopping-cart"></i>    
<strong><a href="cart.php">Cart:</a><?php
 if(isset($_SESSION['cart_id'])){
  $cart_id =  $_SESSION['cart_id'];
  $num_of_products = Product::NumOfProductsInChart($cart_id);
  setcookie("num_of_products", "$num_of_products", time() + (86400 * 30), "/");
  echo $num_of_products;
  }else{
    
  $num_of_products = 0;
  echo $num_of_products;
  }
 
?>
 </strong> 


</p>
</div>
<div id="row"></div>
<div class="row" style="margin: 10vh 8vw 10vh 5vw;" >

<?php foreach($products as $product){ ?>




  <div class="col-sm-4">
    <div class="card">
    <img src="./assets/imgs/<?php echo $product['name'];?>.svg" alt="<?php echo $product['name'];?> SVG" height="150px">
      <div class="card-body">
        <h5 class="card-title"><?php echo $product['name'];?></h5>
        <p class="card-text"><?php echo $product['info'];?></p>
        <h3><?php echo $product['price'];?>$</h3>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    
        <input type="submit" value="ADD TO CART"  class="btn btn-danger my-2 my-sm-0 btn-l text-center justify-content-center" name="add">
    
        <input type="hidden" name="price" value="<?php echo $product['price'];?>">
        <input type="hidden" name="name" value="<?php echo $product['name'];?>">
        <input type="hidden" name="id" value="<?php echo $product['id'];?>">
        
    </form>

        
      </div>
    </div>
  </div>
  <?php }?>
  </div>

 
  
<?php 

include './templates/footer.php';

?>