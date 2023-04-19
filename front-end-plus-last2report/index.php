<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Power generation.</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <style src = 'style.css'></style>
  <?php
	//die("hai");
    //error_reporting(E_ALL);
    ini_set('display_errors', 0);
  ?>
    <div class="container">
    <?php 
    include_once("action.php");
    if($_REQUEST['step'] == 'done'){
      echo "<h1>Submission complete!</h1>";
      echo "<p>Thank you for providing your information to Alternakraft!";
      echo "<p><a href = '?'>Return to home</a></p>";
      exit;
     }
     if(!$_REQUEST['step']){
      include_once("home.php");
      exit;
     }
     if($_REQUEST['step'] == 'report'){
      include_once("report.php");
      exit;
     }
    ?>
     <div class="progress-bar">
        <div class="step">
          <p>Household Info</p>
          <div class="bullet">
            <span>1</span>
          </div>
          <div class="check fas fa-check"></div>
        </div>
        <div class="step">
          <p>Appliances</p>
          <div class="bullet">
            <span>2</span>
          </div>
          <div class="check fas fa-check"></div>
        </div>
        <div class="step">
          <p>Power generation</p>
          <div class="bullet">
            <span>3</span>
          </div>
          <div class="check fas fa-check"></div>
        </div>
        <div class="step">
          <p>Done</p>
          <div class="bullet">
            <span>4</span>
          </div>
          <div class="check fas fa-check"></div>
        </div>
      </div>
      <div class="form-outer">
      <?php 
         if($_REQUEST['step'] == 'household'){
            include("household.php");
            exit;
         }
         if($_REQUEST['step'] == 'appliance'){ 
           include("appliance.php");
        } 
         if($_REQUEST['step'] == 'power'){
          include("power.php");
          exit;
        }
        ?>
    </div>
    <script src="script.js"></script>

  </body>
</html>