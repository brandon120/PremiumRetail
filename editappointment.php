<?php 
session_start();
?>
<?php include 'head.php';?>
<?php 

if($_SESSION['role']== "1" || $_SESSION['role']== "2") { ?>

<?php
//Code to display appointments for user
$appointmentdetails = filter_input(INPUT_POST, 'appointmentnumber', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$appointment = "SELECT * FROM appointments WHERE appointmentnumber=?";
	
$stmt= $conn->prepare($appointment);
$stmt->bind_param("s", $appointmentdetails);
$stmt->execute();	
$result = $stmt->get_result();
$appointmentdata = $result->fetch_all(MYSQLI_ASSOC);

?>
<style>


.imagediv img {
	height: 265px;
	margin: auto;
	
}

.phoneimg {
	width: 215px;
}

.card:hover{

  box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
}

@media screen and (max-width: 600px) {
	.appointmentholder {
	display: flex;
	flex-direction: column;
	height: 100%;
	margin: 10px;
}
.aptdetails.card {
	display: flex;
	flex-direction: column;
	width: 100%;
	
	
}

.editapt.card {
	display: flex;
	flex-direction: column;
	width: 100%;	
}
form {
	margin: 5px;
	padding: 5px;
	border: solid 2px;
	overflow: auto;
	
}	
	

	
	
	
}


@media only screen and (min-width: 768px) {
.appointmentholder {
	display: flex;
	flex-direction: row;
	height: 100%;
}
.aptdetails.card {
	display: flex;
	flex-direction: column;
	width: 50%;
	
	
}

.editapt.card {
	display: flex;
	flex-direction: column;
	justify-content: center;
	width: 50%;	
}
.info.text-secondary.mt-1 {
	width: 100%;
}
form {
	margin: 5px;
	padding: 5px;
	border: solid 2px;
	
}
form:hover {
	box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
}

}
</style>

<?php if(empty($appointmentdata)): ?>
      <h6 class="lead mt3"><center>There was a problem getting appointment details try again</center></h6>
      <?php endif; ?>
	  
<?php 
// The below file will be included to listen for inputs and adjust the appointment accordingly

?>

<?php
if(isset($_POST['delete'])){
$deleteapt = $_POST['appointmentnumber'];	
$deleteappointment = "DELETE FROM appointments WHERE appointmentnumber=$deleteapt";
$stmt = $conn->prepare($deleteappointment);
$stmt->bind_param("s", $deleteapt);
$stmt->execute();
header('Location: seeappointments.php');
}


if(isset($_POST['admincomment'])){
$admincomment = $_POST['comment'];	
$appointmentnumber = $_POST['appointmentnumber'];
$addcomment = "UPDATE `appointments` SET `admincomments`='$admincomment' WHERE `appointments`.`appointmentnumber`='$appointmentnumber' ";
$conn->query($addcomment);
header('Location: seeappointments.php');
}


if(isset($_POST['orderstatus'])){
$appointmentnumber = $_POST['appointmentnumber'];
$status = $_POST['order'];
$setstatus = "UPDATE `appointments` SET `orderstatus`='$status' WHERE `appointments`.`appointmentnumber`='$appointmentnumber' ";
$conn->query($setstatus);

header('Location: seeappointments.php');
}


if(isset($_POST['customermessage'])){
$customermessage = $_POST['message'];
$appointmentnumber = $_POST['appointmentnumber'];	
$addmessage = "UPDATE `appointments` SET `customermessage`='$customermessage' WHERE `appointments`.`appointmentnumber`='$appointmentnumber' ";
$conn->query($addmessage);
header('Location: seeappointments.php');
}


if(isset($_POST['setphonenumber'])){
$customernumber = $_POST['newnumber'];
$appointmentnumber = $_POST['appointmentnumber'];	
$setphonenumber = "UPDATE `appointments` SET `phonenumber`='$customernumber' WHERE `appointments`.`appointmentnumber`='$appointmentnumber' ";
$conn->query($setphonenumber);
header('Location: seeappointments.php');
}









?>

<div class="appointmentholder">

      <?php foreach($appointmentdata as $item): ?>

	<div class="aptdetails card">
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
		//echo $time_in_12_hour_format;
		
		?>
		<?php  echo "Appointment Time: ".$time_in_12_hour_format; ?>
		<?php echo "<br>"; ?>
		<?php  echo "Customer Name: ".$item['customername']; ?>
		<?php echo "<br>"; ?>
		<?php  echo "Phone Number: ".$item['phonenumber']; ?>
		<?php echo "<br>"; ?>
		<?php echo "Carrier: ".$item['carrier']; ?>
		<form method="POST" style="margin-top:5px;border:none;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<input type="hidden" name="appointmentnumber" id="appointmentnumber" value="<?=$item['appointmentnumber']?>" >
		<input type="submit" class="button1" name="delete" value="Delete Appointment">
		</form>
		
		<button class="button1" onclick="window.location.href='https://premiumwirelessphones.com/seeappointments.php';">Go Back</button>
	 </div>
	 </div>
     </div>	

	



	<div class="editapt card">
	<div class="card-body text-center fit" style="margin:auto;">
	
		
        <div class="info text-secondary mt-1">
		<h3>Edit Appointment</h3>
		
		<form method="POST" style="margin-top:5px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<div class="mb-3 comments" style="padding-top:10px;width:100%;">
		<p><b>Customer Comments:</b> <?php echo $item['customercomments']; ?></p>
		</div>
		</form>
		
		<form method="POST" style="margin-top:5px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<div class="mb-3" style="padding-top:10px;width:100%;">
			<label for="message" class="form-label"><b>Enter Message to be seen by Customer</b></label>
			<input type="text" class="form-control" name="message" placeholder="Enter message for customer" id="message" required>
		</div>
		<input type="hidden" name="appointmentnumber" id="appointmentnumber" value="<?=$item['appointmentnumber']?>" >
		<input type="submit" class="button1" name="customermessage" value="Update Customer Message">
		</form>
		
		
		<form method="POST" style="margin-top:5px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<label for="order">Set Order Status:</label>
		<select id="order" name="order" required>
		<option value="pending">Pending</option>
		<option value="completed">completed</option>
		<option value="cancelled">cancelled</option>
		<option value="orderissue">order issue</option>
		</select>
		<input type="hidden" name="appointmentnumber" id="appointmentnumber" value="<?=$item['appointmentnumber']?>" >
		<input type="submit" class="button1" name="orderstatus" value="Set Order Status">
		</form>
		

		
		<form method="POST" style="margin-top:5px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		
			<label for="comment" class="form-label"><b>Associate Comments</b></label>
			<input type="text" class="form-control" name="comment" placeholder="Please input work done on order" id="comment" required>
		
		<input type="hidden" name="appointmentnumber" id="appointmentnumber" value="<?=$item['appointmentnumber']?>" >
		<input type="submit" class="button1" name="admincomment" value="Add Comment">
		</form>
		
		
		
		<form method="POST" style="margin-top:5px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<label for="newnumber" class="form-label"><b>Update Customer Phone Number</b></label>
        <input type="text" class="form-control" <?php echo $PhoneNumberErr? 'is-invalid' : null; ?>" id="PhoneNumber" name="newnumber" placeholder="Enter phone number">
		
		
		<input type="hidden" name="appointmentnumber" id="appointmentnumber" value="<?=$item['appointmentnumber']?>" >
		<input type="submit" class="button1" name="setphonenumber" value="Update Customer Phone Number">
		</form>
	 </div>
	 </div>
     </div>	
	<?php endforeach; ?>

</div>











<?php
} else {
	echo "You do not have permission to view this page";
	exit;
}




?>