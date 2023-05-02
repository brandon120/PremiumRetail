<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
  <meta charset="UTF-8">
   <title>Premium Wireless</title>
  <meta name="description" content="This website is for customers to be able to shop their local Russellville, Clarksville, and Dardanelle stores online.">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="/img/newfavicon.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="menu.js"></script>
  <script src="pickcolor.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <link rel="stylesheet" href="teststyles.css">
  
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <!-- Add the slick-theme.css if you want default styling -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <!-- Add the slick-theme.css if you want default styling -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>  
</head>
<body>
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

</script>
<div class="topnav" id="myTopnav">
  <a class="brand" id="premiumlogo" href="index.php"><img width="auto" height="auto" alt="Image of Premium Retail Logo" src="/img/premiumretail.svg" /></a>

  <a href="shopping.php">Shopping Cart</a>
  <a href="account.php">Account</a>
  <a href="register.php">Register</a>
  <a href="appointment.php">Appointments</a>
  <a href="testing.php" class="wasactive">Phones</a>
  <a style="font-size:28px" href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>


