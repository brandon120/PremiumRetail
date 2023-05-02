<?php 
session_start();
?>
<?php include 'head.php';?>


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


	  
	  



<?php
if(isset($_POST['delete'])){
$deleteapt = $_POST['appointmentnumber'];	
$deleteappointment = "DELETE FROM appointments WHERE appointmentnumber=$deleteapt";
$stmt = $conn->prepare($deleteappointment);
$stmt->bind_param("s", $deleteapt);
$stmt->execute();
header('Location: appointment.php');
}




if(isset($_POST['sendmessage'])){
$customermessage = $_POST['message'];	
$appointmentnumber = $_POST['appointmentnumber'];
$addcomment = "UPDATE `appointments` SET `customercomments`='$customermessage' WHERE `appointments`.`appointmentnumber`='$appointmentnumber' ";
$conn->query($addcomment);


$appointmentdetails = filter_input(INPUT_POST, 'appointmentnumber', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$appointment = "SELECT * FROM appointments WHERE appointmentnumber=?";
	
$stmt= $conn->prepare($appointment);
$stmt->bind_param("s", $appointmentdetails);
$stmt->execute();	
$result = $stmt->get_result();
$appointmentdata = $result->fetch_all(MYSQLI_ASSOC);

}



















?>


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

<?php if(empty($appointmentdata)): ?>
      <h6 class="lead mt3"><center>There was a problem getting appointment details try again</center></h6>
      <?php endif; ?>

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
		
		<button class="button1" onclick="window.location.href='https://premiumwirelessphones.com/appointment.php';">Go Back</button>
	 </div>
	 </div>
     </div>	



<div class="editapt card">
	<div class="card-body text-center">
	
		
        <div class="info text-secondary mt-1">
		<h3>Edit Appointment</h3>
		<form method="POST" style="margin-top:5px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<div class="mb-3 comments" style="padding-top:10px;width:100%;">
		<p><b>Message from our Premium Wireless Representative:</b> <?php echo $item['customermessage']; ?></p>
		</div>
		</form>
		
		<form method="POST" style="margin-top:5px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<div class="mb-3 comments" style="padding-top:10px;width:100%;">
		<p><b>Previous Messages from you:</b> <?php echo $item['customercomments']; ?></p>
		</div>
		</form>
		
		<form method="POST" style="margin-top:5px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<div class="mb-3" style="padding-top:10px;width:100%;">
		<label for="message" class="form-label"><b>Enter message to Representative:</b></label>
		<input type="text" class="form-control" name="message" placeholder="Enter Message" id="message" required>
		</div>
		<input type="hidden" name="appointmentnumber" id="appointmentnumber" value="<?=$item['appointmentnumber']?>" >
		<input type="submit" class="button1" name="sendmessage" value="Send Message">
		</form>
	</div>
	 </div>
     </div>


<?php endforeach; ?>

</div>



