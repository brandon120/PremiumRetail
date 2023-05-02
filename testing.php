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
	height: 265px;
	width: 205px;
}
.phonesavailable {
	padding-top: 10px;
	
}

.imagediv img{
	height: 165px;
	margin: auto;
	
}

.phoneimg {
	width: 115px;
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


</style>



<main>

	



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
	
	<form method="POST" style="margin-top:5px;" action="buyphone.php">
	<button type="submit" class="testingbutton" name="viewphone" value="Customize">
	<div class="card" style="margin:10px;">

	<div class="card-body text-center fit" style="margin:auto;">
	<div class="imagediv">
	<img class="phoneimg" style="object-fit:contain;" alt="Image of phone available for purchase" src="/<?=$item['image']?>" loading="lazy" decoding="async" async>
	</div>
	
	<div class="text-secondary mt-3" >
	<h6><?php echo $item['PhoneName']; ?></h6>
	


	<input type="hidden" name="phoneid" id="phoneid" value="<?=$item['phoneid']?>" >
	<input type="hidden" name="userid" id="userid" value="<?=$_SESSION['id']?>" >
	<input type="hidden" name="brand" id="brand" value="<?=$item['Brand']?>" >
	<input type="hidden" name="phonename" id="phonename" value="<?=$item['PhoneName']?>" >
	<input type="hidden" name="phoneimage" id="phoneimage" value="<?=$item['image']?>" >
	<input type="hidden" name="sessionid" id="sessionid" value="<?=session_id()?>" >



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
	
	
	<div class="card" style="margin:10px;">
	<div class="card-body text-center fit" style="margin:auto;">
	<div class="imagediv">
	<img class="phoneimg" style="object-fit:contain;" alt="Image of phone available for purchase" src="/<?=$item['image']?>" loading="lazy" decoding="async" async>
	</div>
	
	<div class="text-secondary mt-1" >
	<h6><?php echo $item['PhoneName']; ?></h6>
	

	<form method="POST" style="margin-top:5px;" class="button1" action="buyphone.php">
	<input type="hidden" name="phoneid" id="phoneid" value="<?=$item['phoneid']?>" >
	<input type="hidden" name="userid" id="userid" value="<?=$_SESSION['id']?>" >
	<input type="hidden" name="brand" id="brand" value="<?=$item['Brand']?>" >
	<input type="hidden" name="phonename" id="phonename" value="<?=$item['PhoneName']?>" >
	<input type="hidden" name="phoneimage" id="phoneimage" value="<?=$item['image']?>" >
	<input type="hidden" name="sessionid" id="sessionid" value="<?=session_id()?>" >
	<button type="submit" class="button1" name="viewphone" value="Customize">Customize</button>
	</form>

	</div>
	</div>
	</div>
	</div>
	</div>
<?php endforeach; ?>
</div>









<?php include 'inc/footer.php'; ?>