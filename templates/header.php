
<?php

if(isset($_POST['logout'])){
  unset($_SESSION['email']);
  unset($_SESSION['firstname']);
  unset($_SESSION['lastname']);
  unset($_SESSION['username']);
  session_destroy();

  header('Location: login.php');

  if(isset($_SESSION['cart_id'])){

    include 'autoload/autoload.php';
    Product::ClearCart($cart_id);
    
  }
  
}

if(isset($_SESSION['email']) and isset($_SESSION['firstname']) and isset($_SESSION['lastname'])){
  

  if(isset($_SESSION['LAST_ACTIVITY']) and (time()-$_SESSION['LAST_ACTIVITY'] > (-1800))){


    session_destroy();
    unset($_SESSION['email']);
    unset($_SESSION['firstname']);
    unset($_SESSION['lastname']);
    
  }
  else{
    
    $_SESSION['LAST_ACTIVITY'] = time() + 3600;
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/products.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<script src="assets/js/product.js"></script>
 
<?php if($_SERVER['REQUEST_URI'] == '/oop-php/login.php'){
  echo 'login';?>

    <body class="login-body">

    <?php
    
  }
  
  else if($_SERVER['REQUEST_URI'] == '/oop-php/index.php'){ echo '';?>
  

  <body class="signup-body">

<?php 
  } else{echo '';
  ?>

<body>

<?php } ?>


<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top sticky-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
  <a href="products.php">
  <img src="./assets/imgs/Logo.svg" alt="Majd Ghidhan Logo" style="height: 50px;" ></a>

    <a class="navbar-brand" style="font-family: 'Ubuntu', sans-serif;" href="index.php"></a>
   
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
   
      <li class="nav-item ">
        <a class="nav-link active" href="home.php">Home </a>
      </li>
      
      <li class="nav-item ">
        <a class="nav-link active" href="products.php">Calculators</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link active" href="products.php">Contact</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link active" href="bills.php">My Bills</a>
      </li>
      
      
    </ul>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-inline my-2 my-lg-0">
        <a class="nav-link nav-item" href="login.php" style="color:black;"><?php
        if(isset($_SESSION['email']) and isset($_SESSION['firstname']) and isset($_SESSION['lastname'])){
          $firstname = $_SESSION['firstname'];  ?>

          
          <img src="./assets/imgs/account.svg" alt="Account image" style="height: 30px;">
          <?php
          echo 'Welcome, '."$firstname";
          ?>
          <input type="submit" value="Logout" name="logout" class="btn btn-outline-danger my-2 my-sm-0 btn-sm">

        </form>
        
        <?php }
        else{?>
          <img src="./assets/imgs/account.svg" alt="Account image" style="height: 30px;">
          
          <?php echo 'Login';  }?>
        
        </a>
     

  </div>
</nav>
