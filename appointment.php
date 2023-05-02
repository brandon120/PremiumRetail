<?php 
session_start();
?>
<?php include 'head.php';?>

<style>
.card {
	height: 315px;
	width: 180px;
}

.imagediv img {
	height: 180px;
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
//Check the user session if email is not set then ask them to login, else display appointment data
if(!$_SESSION['email']) {
	?>
	<div class="container d-flex flex-column justify-content-center align-items-center">
	<div class="card" style="height:400px;width:350px;margin:10px;">
	<div class="card-body text-center fit" style="margin:auto;">
	<?php
	echo "<h2>Login or signup to link appointments to account</h2>";
?>
	<p>Already have an account? Click the button below to login!</p><button class="button1" onclick="window.location.href='https://premiumwirelessphones.com/account.php';">Login Page</button>
	<p>Don't have an account? Click the button below to Register!</p><button class="button1" onclick="window.location.href='https://premiumwirelessphones.com/register.php';">Register Account</button>
	</div>
	</div>
	</div>
<?php
// Appointments view if not logged in

	$usernologin = $_SESSION['session'];

	$viewappointments = "SELECT * FROM appointments WHERE userid=?";
	
	$stmt= $conn->prepare($viewappointments);
	$stmt->bind_param("s", $usernologin);
	$stmt->execute();	
	$result = $stmt->get_result();
	$phonedatalogin = $result->fetch_all(MYSQLI_ASSOC);
	
?>

	<div class="d-flex flex-column justify-content-center align-items-center">

	<h2><center>Appointments</center></h2>

  <?php if(empty($phonedatalogin)): ?>
      <h6 class="lead mt3"><center>You have no appointments set start shopping!</center></h6>
      <?php endif; ?>

      <?php foreach($phonedatalogin as $item): ?>

	<div class="card" style="height:450px;width:450px;margin:10px;">
	<div class="card-body text-center fit" style="margin:auto;">
	<div class="imagediv">
	<img alt="Image of phone available for purchase" class="phoneimg" style="object-fit:contain;" src="/<?=$item['image']?>" />
	</div>
	
        <div class="text-secondary mt-1">
		<?php $phonename = $item['PhoneName']; ?>
		<?php $color = $item['phonecolor']; ?>
        <?php  echo "<h3><b>$phonename</b></h3>"; ?>
		<?php  echo "Location: ".$item['storelocation']; ?> 
		<?php echo "<br>"; ?>
		<?php  echo "Appointment Date: ".$item['appointmentday']; ?>
		<?php echo "<br>"; ?>
		<?php
		$appt = $item['appointmenttime'];
		$time_in_12_hour_format = date("g:i a", strtotime($appt));
		
		
		?>
		<?php  echo "Appointment Time: ".$time_in_12_hour_format; ?>

		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<input type="hidden" name="appointmentnumber" id="appointmentnumber" value="<?=$item['appointmentnumber']?>" >
		<input type="submit" class="button1" name="deleteappointment" value="Remove Appointment">
		</form>
	 </div>
	 </div>
     </div>	

		
	<?php endforeach; ?>
	</div>



<?php


//End of not logged in appointment view
} else {


?>



<?php
//Code to display appointments for user
$userid = $_SESSION['id'];
$viewappointments = "SELECT * FROM appointments WHERE userid=?";
	
$stmt= $conn->prepare($viewappointments);
$stmt->bind_param("s", $userid);
$stmt->execute();	
$result = $stmt->get_result();
$appointmentdata = $result->fetch_all(MYSQLI_ASSOC);

?>

<?php
if(isset($_POST['deleteappointment'])){
$appointmentnumber = $_POST['appointmentnumber'];
$deletefromappointments = "DELETE FROM appointments WHERE appointmentnumber=$appointmentnumber";
$stmt= $conn->prepare($deletefromappointments);
$stmt->bind_param("i", $appointmentnumber);
$stmt->execute();
header('Location: appointment.php');
}
?>


<?php
/*
foreach ($appointmentdata as $phonevalue) {
$phoneid = $phonevalue['phoneid'];
$phonedata = "SELECT * FROM Inventory WHERE phoneid=?";
$stmt = $conn->prepare($viewappointments);
$stmt->bind_param("s", $phoneid);
$stmt->execute();
printf("Error: %s.\n", $stmt->error);	

}
*/
?>


	<div class="d-flex flex-column justify-content-center align-items-center">

	<h2>Appointments</h2>

  <?php if(empty($appointmentdata)): ?>
      <h6 class="lead mt3">You have no appointments set start shopping!</h6>
      <?php endif; ?>

      <?php foreach($appointmentdata as $item): ?>

	<div class="card" style="height:450px;width:400px;margin:10px;">
	<div class="card-body text-center fit" style="margin:auto;">
	<div class="imagediv">
	<img alt="Image of phone available for purchase" class="phoneimg" style="object-fit:contain;" src="/<?=$item['image']?>" />
	</div>
	
        <div class="text-secondary mt-1">
		<?php $phonename = $item['PhoneName']; ?>
        <?php  echo "<h3><b>$phonename</b></h3>"; ?>
		<?php  echo "Location: ".$item['storelocation']; ?> 
		<?php echo "<br>"; ?>
		<?php  echo "Appointment Date: ".$item['appointmentday']; ?>
		<?php echo "<br>"; ?>
		<?php
		$appt = $item['appointmenttime'];
		$time_in_12_hour_format = date("g:i a", strtotime($appt));
		
		
		?>
		<?php  echo "Appointment Time: ".$time_in_12_hour_format; ?>
		<br>
		<form method="POST" style="margin-top:1px;" action="custappointment.php">
		<input type="hidden" name="appointmentnumber" id="appointmentnumber" value="<?=$item['appointmentnumber']?>" >
		<input type="submit" class="button1" name="openappointment" value="View Appointment">
		</form>
		<br>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<input type="hidden" name="appointmentnumber" id="appointmentnumber" value="<?=$item['appointmentnumber']?>" >
		<input type="submit" class="button1" name="deleteappointment" value="Remove Appointment">
		</form>
	 </div>
	 </div>
     </div>	

		
	<?php endforeach; ?>
	</div>
		
		
		
<?php

//Do not remove the } it is requred to make sure that if user is logged in the above information will display
}
?>
<?php include 'inc/footer.php'; ?>