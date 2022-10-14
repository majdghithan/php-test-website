<?php 

session_start();


$title = "Majd Ghidhan | Online Coaching";
    include 'templates/header.php';
    
?>

<!-- <head>
    <link rel="stylesheet" href="./assets/css/home.css">
</head> -->

<div class="cover">
<!-- To have the image on full screen always  -->
<div class="home-cover">
</div>
</div>

<div class="on-img">
    <p id="on-img-p1" class="line-1 anim-typewriter">Get in shape, now!</p>
    <p id="on-img-p2">Online Coaching, Meal plans, Training programs
        based on science.
    </p>
    
    <a href="#row" class="btn btn-danger" id="unnnormal-button"> GET TRAINED </a>
    
</div> 

<div id="row"></div>

<div class="row" style="margin: 10vh 8vw 10vh 5vw;" >
  <div class="col-sm-4">
    <div class="card">
    <img src="./assets/imgs/TRAINING PROGRAM.svg" alt="Calories SVG" height="150px">
      <div class="card-body">
        <h5 class="card-title">Training Program</h5>
        <p class="card-text">Designed to give you an optimal muscle growth and fat loss.</p>
        
        <a href="./training.php" class="btn btn-danger my-2 my-sm-0 btn-l text-center justify-content-center" style="text-align: center !important" id="unnormal-button">Buy Now</a>
      </div>
    </div>
  </div>


  <div class="col-sm-4">
    <div class="card">
    <img src="./assets/imgs/MEAL PLAN.svg" alt="MUSCLE SVG" height="150px">
      <div class="card-body">
        <h5 class="card-title">Meal Plan</h5>
        <p class="card-text">Based on your favourable diet, time and budget.</p>
        <a href="./mealplan.php" class="btn btn-danger my-2 my-sm-0 btn-l text-center justify-content-center" style="text-align: center !important" id="unnormal-button">Buy Now</a>
      </div>
    </div>
  </div>


  <div class="col-sm-4">
    <div class="card">
    <img src="./assets/imgs/Supplement Plan.svg" alt="Supplement SVG" height="150px">
      <div class="card-body">
        <h5 class="card-title text-center" >Supplement Plan</h5>
        <p class="card-text text-center">Supplements to boost your results based on your budget</p>
        
        <a href="./supp.php" class="btn btn-danger my-2 my-sm-0 btn-l text-center  justify-content-center" style="text-align: center !important" id="unnormal-button">Buy Now</a>
      </div>
    </div>
  </div>
</div>

<div class="going-img1">
    <div class="on-img">
    <p id="on-img-p1" style="text-align: center;">WE LOVE SCIENCE</p>
    <p id="on-img-p2"  style="text-align: center;">Every service we provide in based on latest studies.</p>
    </div>
</div>

<?php 
include 'templates/footer.php';
?>