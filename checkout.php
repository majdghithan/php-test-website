  <?php
  $title = "CHECKOUT";
  session_start();

  include 'autoload/autoload.php';

  if(isset($_POST['continue'])){

    $country = $_POST['country'];
    $state = $_POST['state'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $adress = $_POST['adress'];
    $zip = $_POST['zip'];

    // echo $email . '<br>' . $firstname . '<br>' . $lastname. '<br>' .$adress. '<br>' .$zip .'<br>';


    ShippingValidator::check($email,$firstname,$lastname,$adress,$zip,$state);

    if(ShippingValidator::errors() == ''){

      $email = ShippingValidator::$data[1];
      $adress = ShippingValidator::$data[2];
      $firstname = ShippingValidator::$data[3];
      $lastname = ShippingValidator::$data[4];
      $zip = ShippingValidator::$data[5];
      $state = ShippingValidator::$data[6];
      

      // echo $email .'<br>'. $firstname .'<br>'.$lastname.'<br>'.$adress.'<br>'.$zip.'<br>' . $state . '<br>' . $country;


      $_SESSION['order_email'] = $email; 
      $_SESSION['order_firstname'] = $firstname; 
      $_SESSION['order_lastname'] = $lastname; 
      $_SESSION['order_adress'] = $adress; 
      $_SESSION['order_zip'] = $zip; 
      $_SESSION['order_state'] = $state;
      $_SESSION['order_country'] = $country;


      //save information in mysql database(fatoora)
      // next page

      
      header('location:payment.php');
    }
  }

  include 'templates/header.php';
  ?>



<?php



if(isset($_SESSION['email']) and isset($_SESSION['lastname']) and isset($_SESSION['firstname'])){

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


        <div class="" style="margin: 0; padding:0;">
            <p>Total Price:<strong> <?php echo $cost ?>$</strong></p>
          </div>

        <!-- <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </form> -->

      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3"> <a href="cart.php"><i class="far fa-arrow-alt-circle-left"></i></a> Shipping address</h4>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

          <div class="row g-3">

            <div class="col-sm-6 form-group">
              <label for="firstName" class="form-label">First name</label>
              <input type="text" class="form-control" id="firstName" placeholder="i.e <?php echo $_SESSION['firstname']?>" value="<?php echo $_SESSION['firstname']?>" name="firstname" required>

              <div id="error"><?php if(isset(ShippingValidator::$errors[3])) echo ShippingValidator::$errors[3]; ?></div>

            </div>

            <div class="col-sm-6 form-group" >
              <label for="lastName" class="form-label">Last name</label>
              <input type="text" class="form-control" id="lastName" name="lastname" placeholder="" value="<?php echo $_SESSION['lastname']?>" required>
              
              <div id="error"><?php if(isset(ShippingValidator::$errors[4])) echo ShippingValidator::$errors[4]; ?></div>


            </div>

            <div class="col-12 form-group">
              <label for="email" class="form-label">Email <span class="text-muted"></span></label>
              <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" value="<?php echo $_SESSION['email']; ?>" required>
              <div id="error"><?php if(isset(ShippingValidator::$errors[1])) echo ShippingValidator::$errors[1]; ?></div>

            </div>

            <div class="col-12 form-group">
              <label for="address" class="form-label">Address</label>
              <input type="text" name="adress" class="form-control" id="address" placeholder="1234 Main St" value="Ramallah" required>
              <div id="error"><?php if(isset(ShippingValidator::$errors[2])) echo ShippingValidator::$errors[2]; ?></div>

            </div>

            <?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://restcountries-v1.p.rapidapi.com/all",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: restcountries-v1.p.rapidapi.com",
		"x-rapidapi-key: c22be2c0e2msh14e3037595f2883p1d508ejsn2064bfcfa9db"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
  $countries = json_decode($response, true);
  
}
if(!isset($c)){
  $c = 0;
}
?>

            

            <div class="col-md-4 mb-3">
            <label class="form-label" for="state">State/City</label>
            <input type="text" class="form-control" name="state" value="Ramallah" id="state" placeholder="i.e Ramallah" required>
            
          </div>

            
            <div class="col-md-3 ">
              <label for="zip" class="form-label">Zip</label>
              <input type="number" name="zip" class="form-control" min="0" value="6444" id="zip" placeholder="i.e 87125" required>
              <div id="error"><?php if(isset(ShippingValidator::$errors[5])) echo ShippingValidator::$errors[5]; ?></div>

            </div>
          </div>

          <!-- <hr class="my-4"> -->

          <!-- <div class="form-check">
            <input type="checkbox" class="form-check-input" id="same-address">
            <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
          </div> -->

          <!-- <div class="form-check">
            <input type="checkbox" class="form-check-input" id="save-info">
            <label class="form-check-label" for="save-info">Save this information for next time</label>
          </div> -->

          <hr class="my-4">


          <button class="w-100 btn btn-danger btn-lg" type="submit" name="continue">Continue to payment</button>
        </form>
      </div>
    </div>
  </main>

 
</div>
<br><br>
<?php
include 'templates/footer.php'; 
} 

else{
  header('Location:404.php');
}
// print_r($countries);
?>