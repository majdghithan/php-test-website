<?php

$title = "Log in";
session_start();

include 'autoload/autoload.php';

if(isset($_POST['login'])){

    include 'autoload/config/userdb.php';

    $password = $_POST['password'];
    $email = $_POST['email'];

    $user = new UserLogIn($email, $password);

    // echo '<br>';
    // echo ($user->email);
    // echo '<br>';
    // echo ($user->password);
    // echo '<br>';
    // print_r ($user->data);
    // echo '<br>';
    

    if($user->data[0] != '' and $user->data[1] !=''){
        $_SESSION['email'] = $user->email;
        $_SESSION['firstname'] = $user->data[1];
        $_SESSION['lastname'] = $user->data[2];
        // $_SESSION['firstname'] = $user->data[2];

        // echo 'tamam';

        header('Location: training.php');

    }else{
        // echo '<br>';
        // echo 'DID NOT LOGGED IN !';
    }
}

include 'templates/header.php';
?>

<?php
 if(isset($_SESSION['email']) and isset($_SESSION['firstname']) and isset($_SESSION['lastname'])){
   
    header('Location: training.php');
} else{
    ?>

<main>

<section class="login-b">

<div class="card" style="width: 22rem; display:inline-block">

<h4 class="card-title">ACCOUNT LOGIN</h4>
<br>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id = "userForm" style="margin-left: 30px;">

    <div class="form-group" style="text-align: left;">
    <label for="email">Email</label>
    <input type="text" name="email" id="email" class="form-control" value ="example@gmail.com" required>

    <p id="error">
    <?php  
     echo UserLogIn::$errors[0];
    ?>
    </p>
    </div>

    <div class="form-group"  style="text-align: left;">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control" value="555pp" required>

    <p id="error">
    <?php  
     echo UserLogIn::$errors[1];
    ?>
    </p>
    </div>

    <input type="submit" value="Log In" name="login" class="btn btn-primary" style="width: 100%;">
    
</form>

<div id="userForm">
<p>
    Not a user? <a href="index.php">Creat new account</a>
</p>

</div>

<!-- card -->
</div>

</section>
</main>
<?php

// include 'templates/footer.php';
}
?>
  <script src="https://use.fontawesome.com/fa34200b5a.js"></script>
  <script src="https://kit.fontawesome.com/8285656d59.js" crossorigin="anonymous"></script>

<script src="https://use.fontawesome.com/fa34200b5a.js"></script>
<script src="https://kit.fontawesome.com/8285656d59.js" crossorigin="anonymous"></script>


</body>
</html>