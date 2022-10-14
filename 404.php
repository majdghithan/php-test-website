<?php
$title = "Log in";
session_start();

$message = '';

include 'templates/header.php';
?>


<h1>
    <?php 

    ?>

<div class="center text-center" style="margin: 150px;" >
    <h5 ><?php echo $message . 'PLEASE, LOG IN!'; ?></h5>

    <i class="fas fa-exclamation"></i>
    </div>
</h1>


<?php

include 'templates/footer.php';

?>