<?php 
session_start();
if(!$_SESSION['email']) {
$_SESSION['session'] = $_COOKIE['PHPSESSID'];
}
?>

<?php include 'head.php';?>

<style>
.card {
	height: 315px;
	width: 180px;
}

.imagediv img{
	height: 265px;
	margin: auto;
	
}

.phoneimg {
	width: 215px;
}

.card:hover{
     transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
}
</style>
 
 
<?php
//print_r($_SESSION);
if(!$_SESSION['email']) {
	?>
	<div class="container d-flex flex-column justify-content-center align-items-center">
	<br>
	<div class="card" style="height:205px;width:315px;margin:auto;">
	<div class="card-body text-center fit" style="margin:auto;">
	<?php 
	echo "<h1><center>Login to schedule an appointment</center></h1>";
	?>
	<button class="button1" onclick="window.location.href='https://premiumwirelessphones.com/account.php';">Click to login!</button>
	</div>
	</div>
	</div>
	
	<?php 
	$usernologin = $_SESSION['session'];
	$getcart = "SELECT * FROM cart WHERE userid=?";
	
	$stmt= $conn->prepare($getcart);
	$stmt->bind_param("s", $usernologin);
	$stmt->execute();	
	$result = $stmt->get_result();
	$phonedatanologin = $result->fetch_all(MYSQLI_ASSOC);
	?>
	
	
	
	
	
	

	<div class="d-flex flex-column justify-content-center align-items-center">
	<?php if(empty($phonedatanologin)): ?>
      <h6 class="lead mt3"><center>There are no items in your cart!</center></h6>
      <?php endif; ?>

      <?php foreach($phonedatanologin as $item): ?>

	<div class="card" style="height:585px;width:450px;margin:10px;">
	<div class="card-body text-center fit" style="margin:auto;">
	<div class="imagediv">
	<img alt="Image of phone available for purchase" class="phoneimg" style="object-fit:contain;" src="/<?=$item['image']?>" />
	</div>
	
        <div class="text-secondary mt-1">
        <?php  echo "<h3><b>".$item['PhoneName']."</b></h3>"; ?> 
		<?php  echo "Storage: ".$item['Storage']."GB"; ?> 
		<?php echo "<br>"; ?>	
		<?php  echo "Color: ".$item['Color']; ?>
		<?php echo "<br>"; ?>	
		<?php  echo "Quantity: ".$item['quantity']; ?>
		<?php echo "<br>"; ?>
		
		<form method="POST" style="margin-top:5px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<input type="hidden" name="ordernumber" id="ordernumber" value="<?=$item['ordernumber']?>" >
		<input type="submit" class="button1" name="deleteitem" value="Remove item from cart">
		</form>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<input type="hidden" name="ordernumber" id="ordernumber" value="<?=$item['ordernumber']?>" >
		<label for="quantity">Choose a quantity:</label>
		<select id="quantity" name="quantity">
		<?php echo "<br>"; ?>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<?php echo "<br>"; ?>
		<?php //echo "<br>"; ?>
		<input type="submit" class="button1" name="editquantity" value="Change Quantity">
		</form>
		</div>
		</div>
		</div>

   <?php endforeach; ?>
   
	   </div>
   <br>
   

<?php 
} else {

	



$userid = $_SESSION['id'];

$getcart = "SELECT * FROM cart WHERE userid=?";
	
$stmt= $conn->prepare($getcart);
$stmt->bind_param("s", $userid);
$stmt->execute();	
$result = $stmt->get_result();
$phonedata = $result->fetch_all(MYSQLI_ASSOC);

?>



<?php

if(isset($_POST['setappointment'])){


$userid = $_POST['userid'];
$appdate = $_POST['sheduledate'];
$appstore = $_POST['stores'];
$apptime = $_POST['time'];



foreach ($phonedata as $appvalues) {
	$userid = $appvalues['userid'];
	$phoneid = $appvalues['phoneid'];
	$phoneimage = $appvalues['image'];
	$phonename = $_POST['phonename'];
	
	$addtoappt = "INSERT INTO appointments (userid, phoneid, storelocation, appointmenttime, appointmentday, image, PhoneName) VALUES (?,?,?,?,?,?,?)";	
	$stmt = $conn->prepare($addtoappt);
	$stmt->bind_param("sssssss", $userid, $phoneid, $appstore, $apptime, $appdate, $phoneimage, $phonename);
	$stmt->execute();
	printf("Error: %s.\n", $stmt->error);
	
}

foreach ($phonedata as $phonevalue) {
$ordernumber = $phonevalue['ordernumber'];	
$deletecart = "DELETE FROM cart WHERE ordernumber=$ordernumber";
$stmt = $conn->prepare($deletecart);
$stmt->bind_param("s", $ordernumber);
$stmt->execute();
printf("Error: %s.\n", $stmt->error);	
}
header('Location: cart.php');
echo "Appointment Set";
}
?>
	<div class="d-flex flex-column justify-content-center align-items-center">
	
	<h2>Shopping Cart</h2>
	
    <?php if(empty($phonedata)): ?>
      <p class="lead mt3">There are no items in your cart!</p>
      <?php endif; ?>

      <?php foreach($phonedata as $item): ?>
	
	<div class="card" style="height:585px;width:450px;margin:10px;">
	<div class="card-body text-center fit" style="margin:auto;">
	<div class="imagediv">
	<img alt="Image of phone available for purchase" class="phoneimg" style="object-fit:contain;" src="/<?=$item['image']?>" />
	</div>

        <div class="text-secondary mt-1">
        <?php  echo "<h3><b>".$item['PhoneName']."</b></h3>"; ?> 
		<?php  echo "Storage: ".$item['Storage']."GB"; ?> 
		<?php echo "<br>"; ?>	
		<?php  echo "Color: ".$item['Color']; ?>
		<?php echo "<br>"; ?>	
		<?php  echo "Quantity: ".$item['quantity']; ?>
		<?php echo "<br>"; ?>

<?php
if(isset($_POST['deleteitem'])){
	
$ordernumber = $_POST['ordernumber'];
$deletefromcart = "DELETE FROM cart WHERE ordernumber=$ordernumber";
$stmt= $conn->prepare($deletefromcart);
$stmt->bind_param("i", $ordernumber);
$stmt->execute();
	
header('Location: cart.php');

}
?>
<?php
if(isset($_POST['editquantity'])){
	

$ordernumber = $_POST['ordernumber'];

$newquantity = $_POST['quantity'];
$updatequantity = "UPDATE cart SET quantity=$newquantity WHERE ordernumber=$ordernumber";
$stmt= $conn->prepare($updatequantity);
$stmt->bind_param("i", $ordernumber);
$stmt->execute();


header('Location: cart.php');

}
?>


		<form method="POST" style="margin-top:5px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<input type="hidden" name="ordernumber" id="ordernumber" value="<?=$item['ordernumber']?>" >
		<input type="submit" class="button1" name="deleteitem" value="Remove item from cart">
		</form>
		<br>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<input type="hidden" name="ordernumber" id="ordernumber" value="<?=$item['ordernumber']?>" >
		<label for="quantity">Choose a quantity:</label>
		<select id="quantity" name="quantity">
		<?php echo "<br>"; ?>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<?php echo "<br>"; ?>
		<?php //echo "<br>"; ?>
		<input type="submit" class="button1" name="editquantity" value="Change Quantity">
		</form>
		</div>
		</div>
		</div>

   <?php endforeach; ?>
   
	   </div>
   <br>


	<div class="d-flex flex-column justify-content-center align-items-center">
	<div class="card" style="height:200px;width:450px;margin:10px;">
	<div class="card-body text-center fit" style="margin:auto;">
	<?php echo "<h2>Set an Appointment</h2>"; ?>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<input type="hidden" name="phoneid" id="phoneid" value="<?=$item['phoneid']?>" >
		<input type="hidden" name="phonename" id="phonename" value="<?=$item['PhoneName']?>" >
		<input type="hidden" name="brand" id="brand" value="<?=$item['Brand']?>" >
		<input type="hidden" name="color" id="color" value="<?=$item['Color']?>" >
		<input type="hidden" name="image" id="image" value="<?=$item['image']?>" >
		<input type="hidden" name="quantity" id="quantity" value="<?=$item['quantity']?>" >
		<input type="hidden" name="userid" id="userid" value="<?=$_SESSION['id']?>" >
		<label for="date">Appointment Date:</label>
		<input type="date" name="sheduledate" id="date">
		<?php echo "<br>"; ?>
		<label for="stores">Choose a Store:</label>
		<select id="stores" name="stores">
		<?php echo "<br>"; ?>
		<option value="Russellville">Russellville</option>
		<option value="Dardanelle">Dardanelle</option>
		<option value="Clarksville">Clarksville</option>

		<label for="time">Choose a time:</label>
		<input type="time" id="time" name="time" min="10:00" max="20:00" placeholder="Set Time">
		
		<?php echo "<br>"; ?>
		<input type="submit" class="button1" name="setappointment" value="Set Appointment">
		</form>
		</div>
     </div>
	</div>


<?php
//Do not remove the } it is required for the first if loop to close it
}

?>



<?php include 'inc/footer.php'; ?>