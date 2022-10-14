<?php 
session_start();

$title = "Payment";
$checked = 0;

include 'autoload/autoload.php';

if(isset($_SESSION['order_email'])){
  $email = $_SESSION['order_email'];
  $firstname = $_SESSION['order_firstname']; 
  $lastname = $_SESSION['order_lastname']; 
  $adress = $_SESSION['order_adress']; 
  $zip = $_SESSION['order_zip']; 
  $state = $_SESSION['order_state'];
  $country = $_SESSION ['order_country'];
  $cart_id = $_SESSION['cart_id'];

  

  if(isset($_POST['pay'])){

    if($_POST['email'] != ""){
    
      $pay_email = $_POST['email'];
      $pay_password = $_POST['password'];
      
      if(ShippingValidator::check_paypal($pay_email,$pay_password) == 1){
          // echo 'it worked ';
          
          Product::Order($firstname,$lastname,$email,$adress,$country,$state,$zip,$cart_id);

          $errorr = 0;
          foreach(ShippingValidator::$errors as $error){
            if($error != ''){ 
            $errorr = 1;
            }
          else{
           continue;
          }
         }

       if($errorr == 0){

        Product::InsertIntoDB($cart_id);

        header('location: thankyou.php');
        }
        }
     
    
     }
    else if($_POST['name'] != ''){
        $name_on_card = $_POST['name'];
        $card_num = $_POST['card_num'];
        $exp = $_POST['exp'];
        $cvv = $_POST['cvv'];

        if(ShippingValidator::check_card($name_on_card,$card_num,$exp,$cvv) == 1){
          // echo 'it wokred ';

          Product::Order($firstname,$lastname,$email,$adress,$country,$state,$zip,$cart_id);



        }
        else{
          // echo 'naaaaaah';
        }
    }


   
  }
}

// echo $email .'<br>'. $firstname .'<br>'.$lastname.'<br>'.$adress.'<br>'.$zip.'<br>' . $state . '<br>' . $country;

?>

<div class="page">

<?php include 'templates/header.php'; ?>

<?php if(isset($_SESSION['email']) and isset($_SESSION['firstname']) and isset($_SESSION['lastname'])){
  
  $cart_id = $_SESSION['cart_id'];
  $products = Product::CartProducts($cart_id);
  if(!isset($cost)){
    $cost =0;
  }
  ?>

  <div class="container">
    <main>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-danger">Current Cart <i class="fas fa-shopping-cart" aria-hidden="true"></i></span>
          <span class="badge bg-danger rounded-pill" style="color: white;"><?php echo $_COOKIE['num_of_products'] ?></span>
        </h4>
        <ul class="list-group mb-3">
          <?php foreach($products as $product){ 
            $cost +=$product['quantity']*$product['price'];
            ?>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0"><?php echo $product['name'] ?>(<?php echo $product['quantity'] ?>)</h6>
              <small class="text-muted"><?php echo $product['info'] ?></small>
            </div>
            <span class="text-muted"><?php echo $product['price']?>$</span>
          </li>
          
          <?php }?>
        </ul>

        <!-- <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </form> -->

      


        <div class="" style="margin: 0; padding:0;">
            <p>Total Price:<strong> <?php echo $cost ?>$</strong></p>
          </div>

          </div>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="col-md-7 col-lg-8">
 <div class="">


<h4 class="mb-3"> <a href="./checkout.php"> <i class="far fa-arrow-alt-circle-left"></i></a> Payment</h4>

<div class="my-3">

<h5 class="testtt"><?php

// i will come back

foreach(ShippingValidator::$errors as $error){
    if($error != ''){ ?>
      <div id = "error">Please check your values </div>
    <?php }
}

 ?></h5>

<?php 
if(isset($_POST['name']) and $_POST['name'] != ""){
  $checked = "card";
}
elseif(isset($_POST['email']) and $_POST['email'] != ""){
  $checked = "paypal";
}
else{
  $checked = "default";
}

?>



<div class="checked"></div>

  <div class="form-check">
    <input id="credit" name="paymentMethod" type="radio" value="card"  class="form-check-input pp-ss common" <?php if($checked == "card"){
      // echo 'checked';
    } 
     ?> >
    <label class="form-check-label pp-ss" for="credit"><img src="assets/imgs/debit-card.svg" alt="Credit Card" height="40px"> &nbsp Credit card or Debit Card</label>
  </div>

  <div class="form-check">
    <input id="paypal" name="paymentMethod" type="radio" value="paypal" class="form-check-input pp-pp common" <?php if($checked == "paypal"){
      // echo 'checked';
    }
     ?> >
    <label class="form-check-label pp-pp" for="paypal"><img src="assets/imgs/paypal.svg" alt="Credit Card" height="40px"> &nbsp PayPal</label>
  </div>
</div>

<!-- not pay pal -->
<div class="row gy-3" id="n-paypal">
  <div class="col-md-6 form-group">
    <label for="cc-name" class="form-label">Name on card</label>
    <input type="text" class="form-control" id="cc-name" placeholder="Name On Card" name="name" value="<?php if(isset($_POST['name'])){
      echo $_POST['name'];
    }else{
      // echo 'majd';
    } ;?>">
    <small class="text-muted">Full name as displayed on card</small>
    
    <p id="error">
    <?php  
     echo ShippingValidator::$errors[6];
    ?>
    </p>

  </div>

  <div class="col-md-6 form-group">
    <label for="cc-number" class="form-label">Credit card number</label>
    <input type="text" class="form-control" id="cc-number" placeholder="i.e 4002 2205 9975 4455" name="card_num" value="">
    <p id="error">
    <?php  
     echo ShippingValidator::$errors[7];
    ?>
    </p>
  </div>
  
  <div class="col-md-6 form-group">
    <label for="cc-expiration" class="form-label">Expiration</label>
    <input type="text" class="form-control" id="cc-expiration" placeholder="08/21" name="exp" value="">
    <p id="error">
    <?php  
     echo ShippingValidator::$errors[8];
    ?>
    </p>
  </div>

  <div class="col-md-6 form-group">
    <label for="cc-cvv" class="form-label">CVV</label>
    <input type="text" class="form-control" id="cc-cvv" placeholder="i.e 212" name="cvv" value="">
    <p id="error">
    <?php  
     echo ShippingValidator::$errors[9];
    ?>
    </p>
  </div>
</div>

<!-- <div class="test"></div> -->


<!-- paypal -->


<div class="row gy-3" id="paypall">
  <div class="col-md-6 form-group">
    <label for="cc-name" class="form-label">Paypal E-mail</label>
    <input type="email" class="form-control" id="pp-name" placeholder="i.e example@example.com" name="email" >
    <p id="error">
    <?php  
     echo ShippingValidator::$errors[1];
    ?>
    </p>
  </div>

  <div class="col-md-6 form-group">
    <label for="pp-number" class="form-label">PayPal Password</label>
    <input type="password" class="form-control" id="pp-number" placeholder="Enter Password" name="password">
    <p id="error">
    <?php  
     echo ShippingValidator::$errors[2];
    ?>
    </p>
  </div>
  
  
</div>


<hr class="my-4">

<input type="submit" class="w-100 btn btn-danger" name="pay" value="Pay">



</form>


<div class="padding" style="padding-top:10vh"></div>
</div>



</div>
</div>
</main>

<?php  include 'templates/footer.php'; }else{
    header('location: 404.php');
} ?>

<script src="assets/js/jquery.js"></script>


</div>
