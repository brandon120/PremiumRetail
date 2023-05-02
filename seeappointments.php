<?php 
session_start();
?>
<?php include 'head.php';?>
<?php 

if($_SESSION['role']== "1" || $_SESSION['role']== "2") {  ?>
<style>
.card {
	height: 315px;
	width: 180px;
}

.imagediv img {
	height: 265px;
	margin: auto;
	
}

.phoneimg {
	width: 215px;
}

.card:hover{
     transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
  
.button1.padding {
	padding-top: 10px;
	
	
}
}
</style>
	
	<h2><center>Customer Appointments</center></h2>
	
<?php



if(isset($_POST['clear'])){
	$sql = "SELECT * FROM `appointments`";
    $result = mysqli_query($conn, $sql);
	$appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);
}



if(isset($_POST['filter'])){

if($_POST['store'] == "Russellville") {
	$store = "Russellville";
}

if($_POST['store'] == "Dardanelle") {
	$store = "Dardanelle";
}
if($_POST['store'] == "Clarksville") {
	$store = "Clarksville";
}	
	if($store) {
		$attphones = "SELECT * FROM appointments WHERE storelocation LIKE '%$store%'";
		$stmt= $conn->prepare($attphones);
		$stmt->bind_param("s", $store);
		$stmt->execute();
		$result = $stmt->get_result();
		$appointments = $result->fetch_all(MYSQLI_ASSOC);
}
		
	


} else {

$sql = "SELECT * FROM `appointments`";
$result = mysqli_query($conn, $sql);
$appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);

}


	
?>

	<div class="d-flex flex-column justify-content-center align-items-center">


	<div class = "d-flex flex-column justify-content-center align-items-space-between">
	<form method="POST" style="margin-top:5px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	
        <center><label for="store">Filter Stores: </label></center>
		<select id="store" class="button1" name="store">
		<option value="Russellville">Russellville</option>
		<option value="Dardanelle">Dardanelle</option>
		<option value="Clarksville">Clarksville</option>
		</select>
	<br>
	<button type="submit" name="filter" class="button1 padding">Show appointments set for store</button>
	<center><button type="submit" class="button1" name="clear">Clear</button></center>
	</form>
	</div>
	<br>

	 <?php if(empty($appointments)): ?>
      <h6 class="lead mt3"><center>No Appointments have been set</center></h6>
      <?php endif; ?>

      <?php foreach($appointments as $item): ?>

	<div class="card" style="height:500px;width:450px;margin:10px;">
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
		
		
		<?php 
		if ($item['customercomments'] == "NA") {
		echo "Customer Comments: NA";
		} else {
		echo "Comments: New messages added"; }
		?>
		<form method="POST" style="margin-top:1px;" action="editappointment.php">
		<input type="hidden" name="appointmentnumber" id="appointmentnumber" value="<?=$item['appointmentnumber']?>" >
		<input type="submit" class="button1" name="viewappointment" value="View and Edit Appointment">
		</form>
	 </div>
	 </div>
     </div>	

		
	<?php endforeach; ?>
	</div>
	
	
	</div>
	
	
	
	
<?php
} else {
	echo "You do not have permission to view this page";
	exit;
}




?>