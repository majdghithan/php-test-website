<?php 
$title = "Admin Dashboard";

include 'autoload/autoload.php';

$success = "";

if(isset($_POST['insert'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $info = $_POST['info'];

    Product::AddtoDB($name,$price,$info);
    
}

include 'templates/header.php';
?>


<div style="margin: 50px;">

<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

<h1>Inserting a product</h1>

  <div class="mb-3">
    <label for="exampleInput1" class="form-label">Product name</label>
    <input type="text" class="form-control" id="exampleInput1" name="name" aria-describedby="Help" value = "MEAL PLAN" required>
   
  </div>
  <div class="mb-3">
    <label for="exampleInputprice1" class="form-label">Price in $</label>
    <input type="text" class="form-control" name="price" id="exampleInputprice1" value = "55" required>
  </div>

  <div class="mb-3">
    <label for="exampleInputprice1" class="form-label">Description</label>
    <input type="text" class="form-control" name="info" id="exampleInputinfo1" value = "Based on science and your demands." required>
  </div>
<br>
<h6 style="color: green;">
  <?php echo $success; ?>
  </h6>
<br>
  <button type="submit" name="insert" class="btn btn-primary">Insert Product</button>
</form>

</div>

</body>
</html>