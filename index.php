<?php 
session_start();
if(!$_SESSION['email']) {
$_SESSION['session'] = $_COOKIE['PHPSESSID'];
}
?>
<?php include 'head.php';?>
<?php

// print_r($_SESSION);

//Pull inventory from Database using query




//$phones = $result->fetch_all(MYSQLI_ASSOC);

?>
<style>
.card-img-top {
    width: 80%;

}
.card {
	display: inline-block;
	vertical-align: top;
	height: 275px;
	width: 215px;
	margin: 0;
}
.phonesavailable {
	padding-top: 10px;
	
}

.imagediv img{
	height: 145px;
	margin: auto;
	
}

.phoneimg {
	width: 130px;
}

.product-slider {
	height: 285px;
	
}


.card:hover{
     transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
}

.testingbutton {
	border: none;
	color: transparent;
	background-color: transparent;

}

body {
	background-color: #f8f9fa;
}

</style>



<main class="mainpageshades">

	



<?php 
$ATT = "AT&T";
$attphones = "SELECT * FROM Inventory WHERE Carrier=?";
$stmt= $conn->prepare($attphones);
$stmt->bind_param("s", $ATT);
$stmt->execute();
$result = $stmt->get_result();
$phonedata = $result->fetch_all(MYSQLI_ASSOC);
?>
<h3><center>AT&T</center></h3>



<div class="product-slider">

<?php foreach($phonedata as $item): ?>
<div class="d-flex flex-row align-items-center justify-content-center">
	<div class="slide">

	<form method="POST" style="margin-top:1px;" action="buyphone.php">
	<button type="submit" class="testingbutton" name="viewphone" value="Customize">

	<div class="card" style="margin:auto;">
	<div class="card-body text-center fit" style="margin:auto;">
	<div class="imagediv">
	<img class="phoneimg" style="object-fit:contain;" alt="Image of phone available for purchase" src="/<?=$item['image']?>" loading="lazy" decoding="async" async>
	</div>
	<?php
	
	$monthly = round($item['Price']/36,2);
	
	?>
	<div class="text-secondary mt-3" >
	<h6><b><?php echo $item['PhoneName']; ?></b></h6>
	<p><?php echo "Starts at <b>$".$monthly."/mo</b> <br>for 36 months"; ?></p>


	<input type="hidden" name="phoneid" id="phoneid" value="<?=$item['phoneid']?>" >
	<input type="hidden" name="description" id="phoneid" value="<?=$item['description']?>" >
	<input type="hidden" name="userid" id="userid" value="<?=$_SESSION['id']?>" >
	<input type="hidden" name="brand" id="brand" value="<?=$item['Brand']?>" >
	<input type="hidden" name="phonename" id="phonename" value="<?=$item['PhoneName']?>" >
	<input type="hidden" name="phoneimage" id="phoneimage" value="<?=$item['image']?>" >
	<input type="hidden" name="carrier" id="carrier" value="<?=$item['Carrier']?>" >
	<?php 
	if($item['Brand'] == "Samsung") { ?>
	<input type="hidden" name="phonecolor" id="phonecolor" value="<?=$item['Color']?>" >	
	<?php	
	}
	?>
	

	</div>
	</div>
	</div>
	</button>
	</form>
	</div>
	</div>
<?php endforeach; ?>


</div>















<?php 
$Verizon = "Verizon";
$attphones = "SELECT * FROM Inventory WHERE Carrier=?";
$stmt= $conn->prepare($attphones);
$stmt->bind_param("s", $Verizon);
$stmt->execute();
$result = $stmt->get_result();
$phonedata = $result->fetch_all(MYSQLI_ASSOC);
?>
<h3><center>Verizon</center></h3>
<div class="product-slider">

<?php foreach($phonedata as $item): ?>
<div class="d-flex flex-row align-items-center justify-content-center">
	<div class="slide">
	
	<form method="POST" style="margin-top:1px;" action="buyphone.php">
	<button type="submit" class="testingbutton" name="viewphone" value="Customize">

	<div class="card" style="margin:auto;">
	<div class="card-body text-center fit" style="margin:auto;">
	<div class="imagediv">
	<img class="phoneimg" style="object-fit:contain;" alt="Image of phone available for purchase" src="/<?=$item['image']?>" loading="lazy" decoding="async" async>
	</div>
	<?php
	
	$monthly = round($item['Price']/36,2);
	
	?>
	<div class="text-secondary mt-3" >
	<h6><b><?php echo $item['PhoneName']; ?></b></h6>
	<p><?php echo "Starts at <b>$".$monthly."/mo</b> <br>for 36 months"; ?></p>


	<input type="hidden" name="phoneid" id="phoneid" value="<?=$item['phoneid']?>" >
	<input type="hidden" name="description" id="phoneid" value="<?=$item['description']?>" >
	<input type="hidden" name="userid" id="userid" value="<?=$_SESSION['id']?>" >
	<input type="hidden" name="brand" id="brand" value="<?=$item['Brand']?>" >
	<input type="hidden" name="phonename" id="phonename" value="<?=$item['PhoneName']?>" >
	<input type="hidden" name="phoneimage" id="phoneimage" value="<?=$item['image']?>" >
	<input type="hidden" name="carrier" id="carrier" value="<?=$item['Carrier']?>" >
	<?php 
	if($item['Brand'] == "Samsung") { ?>
	<input type="hidden" name="phonecolor" id="phonecolor" value="<?=$item['Color']?>" >	
	<?php	
	}
	?>
	

	</div>
	</div>
	</div>
	</button>
	</form>
	</div>
	</div>
<?php endforeach; ?>


</div>


<?php 
$TMobile = "T-Mobile";
$tmobilephones = "SELECT * FROM Inventory WHERE Carrier=?";
$stmt= $conn->prepare($tmobilephones);
$stmt->bind_param("s", $TMobile);
$stmt->execute();
$result = $stmt->get_result();
$phonedata = $result->fetch_all(MYSQLI_ASSOC);
?>

<h3><center>T-Mobile</center></h3>

<div class="product-slider">

<?php foreach($phonedata as $item): ?>
<div class="d-flex flex-row align-items-center justify-content-center">
	<div class="slide">
	
	<form method="POST" style="margin-top:1px;" action="buyphone.php">
	<button type="submit" class="testingbutton" name="viewphone" value="Customize">

	<div class="card" style="margin:auto;">
	<div class="card-body text-center fit" style="margin:auto;">
	<div class="imagediv">
	<img class="phoneimg" style="object-fit:contain;" alt="Image of phone available for purchase" src="/<?=$item['image']?>" loading="lazy" decoding="async" async>
	</div>
	<?php
	
	$monthly = round($item['Price']/24,2);
	
	?>
	<div class="text-secondary mt-3" >
	<h6><b><?php echo $item['PhoneName']; ?></b></h6>
	<p><?php echo "Starts at <b>$".$monthly."/mo</b> <br>for 36 months"; ?></p>


	<input type="hidden" name="phoneid" id="phoneid" value="<?=$item['phoneid']?>" >
	<input type="hidden" name="description" id="phoneid" value="<?=$item['description']?>" >
	<input type="hidden" name="userid" id="userid" value="<?=$_SESSION['id']?>" >
	<input type="hidden" name="brand" id="brand" value="<?=$item['Brand']?>" >
	<input type="hidden" name="phonename" id="phonename" value="<?=$item['PhoneName']?>" >
	<input type="hidden" name="phoneimage" id="phoneimage" value="<?=$item['image']?>" >
	<input type="hidden" name="carrier" id="carrier" value="<?=$item['Carrier']?>" >
	<?php 
	if($item['Brand'] == "Samsung") { ?>
	<input type="hidden" name="phonecolor" id="phonecolor" value="<?=$item['Color']?>" >	
	<?php	
	}
	?>
	

	</div>
	</div>
	</div>
	</button>
	</form>
	</div>
	</div>
<?php endforeach; ?>


</div>

<?php include 'inc/footer.php'; ?>