<?php 
session_start();
if(!$_SESSION['email']) {
$_SESSION['session'] = $_COOKIE['PHPSESSID'];
}
?>

<?php include 'head.php';?>


 
 
<?php
//print_r($_SESSION);
if(!$_SESSION['email']) {
	echo "<h1><center>Login to schedule an appointment</center></h1>";
	echo "<p><center><a href='account.php'>Click here to login!</a></center></p>";
	
	$usernologin = $_SESSION['session'];
	$getcart = "SELECT * FROM cart WHERE userid=?";
	
	$stmt= $conn->prepare($getcart);
	$stmt->bind_param("s", $usernologin);
	$stmt->execute();	
	$result = $stmt->get_result();
	$phonedatanologin = $result->fetch_all(MYSQLI_ASSOC);
	?>
	
	
	
	
	
	
	
	
	<?php if(empty($phonedatanologin)): ?>
      <p class="lead mt3">There are no items in your cart!</p>
      <?php endif; ?>

      <?php foreach($phonedatanologin as $item): ?>
	
	<div class="card my-3 w-auto">
     <div class="card-body text-center  border border-dark border-2">
	 	<div class="card"><img alt="Image of phone available for purchase" class="card-img-top img-fluid" src="/<?=$item['image']?>" />
        <?php  echo $item['body']; ?>
        <div class="text-secondary mt-2">
        <?php  echo "<h3><b>".$item['PhoneName']."</b></h3>"; ?> 
		<?php  echo "Storage: ".$item['Storage']."GB"; ?> 
		<?php echo "<br>"; ?>	
		<?php  echo "Color: ".$item['Color']; ?>
		<?php echo "<br>"; ?>	
		<?php  echo "Quantity: ".$item['quantity']; ?>
		<?php echo "<br>"; ?>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<input type="hidden" name="ordernumber" id="ordernumber" value="<?=$item['ordernumber']?>" >
		<input type="submit" name="deleteitem" value="Remove item from cart">
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
		<input type="submit" name="editquantity" value="Change">
		</form>
		</div>
		</div>
		</div>
		</div>
	
   <?php endforeach; ?>
   
   
   
<?php 
} else {
	echo "<h2>Shopping Cart</h2>";
	



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

    <?php if(empty($phonedata)): ?>
      <p class="lead mt3">There are no items in your cart!</p>
      <?php endif; ?>

      <?php foreach($phonedata as $item): ?>
	
	<div class="card my-3 w-auto">
     <div class="card-body text-center  border border-dark border-2">
	 	<div class="card"><img alt="Image of phone available for purchase" class="card-img-top img-fluid" src="/<?=$item['image']?>" />
        <?php  echo $item['body']; ?>
        <div class="text-secondary mt-2">
        <?php  echo "<h3><b>".$item['PhoneName']."</b></h3>"; ?> 
		<?php  echo "Brand: ".$item['Brand']; ?> 
		<?php echo "<br>"; ?>
		<?php  echo "Storage: ".$item['Storage']; ?> 
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
	
header('Location: shopping.php');

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


header('Location: shopping.php');

}
?>




		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<input type="hidden" name="ordernumber" id="ordernumber" value="<?=$item['ordernumber']?>" >
		<input type="submit" name="deleteitem" value="Remove item from cart">
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
		<input type="submit" name="editquantity" value="Change">
		</form>
		</div>
	   </div>
     </div>
   </div>
   <?php endforeach; ?>


<?php echo "<h2>Set an Appointment</h2>"; ?>

	<div class="card my-3 w-100%">
		<div class="card-body text-center  border border-dark border-2">
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
		<input type="submit" name="setappointment" value="Set Appointment">
		</form>
		</div>
     </div>



<?php
//Do not remove the } it is required for the first if loop to close it
}

?>



<?php include 'inc/footer.php'; ?>