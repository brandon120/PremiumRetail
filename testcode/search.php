<?php 
session_start();
?>
<?php include 'head.php';?>
<?php

//print_r($_SESSION);

//Pull inventory from Database using query 
//$sql = "SELECT * FROM `Inventory`";
//$result = mysqli_query($conn, $sql);
//$Inventory = mysqli_fetch_all($result, MYSQLI_ASSOC);
//include 'testingfunctions.php';
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
}
.phonesavailable {
	padding-top: 10px;
	
}


.phoneimg {
	width: 115px;
}

.card:hover{
     transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
}

.imagediv {
	height: 150px;
	margin: auto;
	
}

</style>



<main>

  


<?php
if(isset($_POST['clear'])){
	$sql = "SELECT * FROM `Inventory`";
    $result = mysqli_query($conn, $sql);
	$Inventory = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
	
	

if(isset($_POST['search'])){
	$phone = $_POST['phonename'];
	$searchquery = "SELECT * FROM Inventory WHERE PhoneName LIKE '%$phone%' LIMIT 10";
	$stmt= $conn->prepare($searchquery);
	$stmt->bind_param("s", $phone);
	$stmt->execute();	
	$result = $stmt->get_result();
	$Inventory = $result->fetch_all(MYSQLI_ASSOC);

} else {

$sql = "SELECT * FROM `Inventory`";
$result = mysqli_query($conn, $sql);
$Inventory = mysqli_fetch_all($result, MYSQLI_ASSOC);

}

?>



    <h3 class="phonesavailable"><center>All Phones</center></h3>
<div class="searchbar">	
	<div class="searchcontainer">
		<form method="POST" style="margin-top:5px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
			<input type="text" placeholder="Search.." id="phonename" name="phonename" style="border-radius:25px 0px 0px 25px">
			<button type="submit" name="search"><i class="fa fa-search"></i></button>
			<button type="submit" name="clear">Clear</button>
		</form>
	</div>
</div>



<?php // include 'shoppingcart.php';?>
<?php // include 'buyphone.php';?>

<?php 
//if(isset($_POST['viewphone'])){
	
//header('Location: buyphone.php');
	
//}
?>


    <?php if(empty($Inventory)): ?>
      <p class="lead mt3">There are no phones to display.</p>
      <?php endif; ?>
	
	<div class="columns">
      <?php foreach($Inventory as $item): ?>
	
     <div class="phoneoption card" style="margin:5px;">
      <div class="card-body text-center fit" style="margin:auto;">


	 	<div class="imagediv">
		<img class="phoneimg allphones" alt="Image of phone available for purchase" style="object-fit:contain;" src="/<?=$item['image']?>" loading="lazy" decoding="async" async>
		</div>

        <div class="text-secondary mt-3" >
		<?php $phonename = $item['PhoneName']; ?>
        <?php  echo "<h5>$phonename</h5>"; ?> 
		<?php // echo "<br>"; ?>
		
		

		<form method="POST" style="margin-top:5px;" action="/buyphone.php">
		<input type="hidden" name="phoneid" id="phoneid" value="<?=$item['phoneid']?>" >
		<input type="hidden" name="userid" id="userid" value="<?=$_SESSION['id']?>" >
		<input type="hidden" name="transid" id="transid" value="<?=$_SESSION['transid']?>" >
		<input type="hidden" name="brand" id="brand" value="<?=$item['Brand']?>" >
		<input type="hidden" name="storage" id="storage" value="<?=$item['Storage']?>" >
		<input type="hidden" name="phonename" id="phonename" value="<?=$item['PhoneName']?>" >
		<input type="hidden" name="phoneimage" id="phoneimage" value="<?=$item['image']?>" >
		<input type="hidden" name="color" id="color" value="<?=$item['Color']?>" >
		<input type="hidden" name="sessionid" id="sessionid" value="<?=session_id()?>" >
		<input type="submit" class="button1" name="viewphone" value="Add to cart" style="position:bottom;">

		</form>
		</div>

     </div>
     </div>
        <?php endforeach; ?>
    </div>
	

<?php include 'inc/footer.php'; ?>