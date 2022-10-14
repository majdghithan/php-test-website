
<?php 

session_start();

$title = 'OYOUN HOME';


include 'autoload/autoload.php';


if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $user = new UserValidator($username, $email, $password,$firstname,$lastname);

    if(UserValidator::errors() == ''){
    
        include 'autoload/config/userdb.php';

        // print_r(UserValidator::$data);

        $username = UserValidator::$data[0];
        $email = UserValidator::$data[1];
        $password = UserValidator::$data[2];
        $firstname = UserValidator::$data[3];
        $lastname = UserValidator::$data[4];

        // echo 'user is valid';

        $sql = "INSERT INTO users(firstname, lastname, password,email, username) VALUES ('$firstname', '$lastname', MD5('$password'), '$email', '$username')";
                
        if(!mysqli_query($conn,$sql)){
            echo mysqli_error($conn);
        }
        else{
            // echo "<br>" . 'USER INSERTED';

            
            $_SESSION['email'] = $email;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['username'] = $username;

            $sql = "SELECT id from users where password = MD5('$password') and email = '$email'";

            $result = mysqli_query($conn,$sql);
            $array = mysqli_fetch_assoc($result);

            $user_id = $array['id'];

            $_SESSION['user_id'] = $user_id;
            
            header('Location: home.php');
        }

    }

    
}

include 'templates/header.php';
?>


<?php 
if(isset($_SESSION['email']) and isset($_SESSION['firstname']) and isset($_SESSION['lastname'])){
    header('Location: home.php');
} else{
    ?>



<section class="login-b">

<div class="card" id="signup-card">
<h4 id="userForm">Register Account</h4>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id = "userForm">

<div class="row">


<div class="form-group col-md-6" >
    <label for="username">Username</label>
    <input type="text" name="username" id="username" class="form-control" value="mostafatest" required>
    
    <p id="error"> 
    <?php  
    echo UserValidator::$errors[0];
          
    ?>
</p>
</div>
    <div class="form-group col-md-6">
    <label for="email">Email</label>
    <input type="text" name="email" id="email" class="form-control" value ="example@gmail.com" required>

    <p id="error">
    <?php  
     echo UserValidator::$errors[1];
    ?>
    </p>
    </div>

    </div>

    <div class="row">
    <div class="form-group col">
    <label for="firstname">Firstname</label>
    <input type="text" name="firstname" id="firstname" class="form-control" value="Mostafa" required>

    <p id="error">
    <?php  
     echo UserValidator::$errors[3];
    ?>
    </p>
    </div>

    <div class="form-group col">
    <label for="lastname">Lastname</label>
    <input type="text" name="lastname" id="lastname" class="form-control" value="Khalil" required>

    <p id="error">
    <?php  
     echo UserValidator::$errors[4];
    ?>
    </p>
    </div>
    </div>

    <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control" value="555pp" required>

    <p id="error">
    <?php  
     echo UserValidator::$errors[2];
    ?>
    </p>
    </div>

   

    <input type="submit" value="Sign Up" name="submit" class="btn btn-primary">
    
</form>

<div id="userForm">
<p>
    Already a user? <a href="login.php">Log in</a>
</p>

</div>
</div>


<?php
}
?>

</section>
</body>
</html>