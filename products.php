<?php 

session_start();

if(isset($_SESSION['email']) and isset($_SESSION['firstname']) and isset($_SESSION['lastname'])){

    $title = "PRODUCTS";
    include 'templates/header.php';

}else{
    header('Location: 404.php');
}


?>



<?php 
include 'templates/footer.php';
?>