<?php

if(isset($_POST["data_to_send"])) {
    $data_received = $_POST["data_to_send"];
    echo $data_received;
    exit(); 
    include 'autoload/autoload.php';
    include 'autoload/config/userdb.php';

    $sql = "UPDATE test SET test = '$data_received'";


    if(!mysqli_query($conn,$sql)){
        echo mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    
</head>
<body>
    
    <div >

    <input type="text" name="text" id="value" value="">

</body>



<script>

$(document).ready(function(){
    
    $("#value").keyup(function(){
    $.ajax({
        type:"POST",
        url: "testJQUERY.php",
        data:{
            data_to_send: $("#value").attr("value"),
        },
        success:function(data){
            $("#value").val(data);
            
            console.log($("#value").attr("value"));
        }
    })

})
})



</script>
<style>
   
   
</style>

</html>