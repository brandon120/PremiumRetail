<?php 
session_start();
?>
<?php include 'head.php';?>
<?php 
//print_r($_SESSION);
if($_SESSION['role']== "1" || $_SESSION['role']== "2") { 

	
if(isset($_POST['updatequantity'])){
	

$phoneid = $_POST['phoneid'];

$newquantity = $_POST['quantity'];
$updatequantity = "UPDATE Inventory SET Quantity=$newquantity WHERE phoneid=$phoneid";
$stmt= $conn->prepare($updatequantity);
$stmt->bind_param("i", $phoneid);
$stmt->execute();


header('Location: setinventory.php');

}





if(isset($_POST['addphone'])){
	
$target_dir = "img/";
$tempname = $_FILES['fileToUpload']['tmp_name'];
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$filename = $_FILES["fileToUpload"]["name"];

$folder = "img/".$filename;

if(move_uploaded_file($tempname,$folder)){
	$msg = "Uploaded Successfully";
}else {
	$msg = "Image Upload Failed!!";
}

echo "<h3><center>File Upload: ".$msg."</center></h3>";



$brand = $_POST['brand'];

$phonename = $_POST['name'];

$price = $_POST['price'];	

$carrier = $_POST['carrier'];

$storage = $_POST['storage'];	

$color = $_POST['color'];

$quantityone = $_POST['quantity'];
$description = $_POST['description'];

//$phonedescription = $_POST['description']; 
// also needs to be added to sql statement.




//if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//    echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])) . " has been uploaded.";
//} else {
//    echo "Sorry, there was an error uploading your file.";
// }






$sql = "INSERT INTO Inventory (PhoneName, Brand, Storage, Carrier, Color, Quantity, image, Price, description) VALUES ('$phonename', '$brand', '$storage', '$carrier', '$color', '$quantityone', '$target_file', '$price', '$description' )";
	

if (mysqli_query($conn, $sql)) {
    echo "<h2><center>New phone added to inventory database</center></h2>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);

	
}
?>









	<div class="d-flex flex-column justify-content-center align-items-center">
<?php
	echo "<h3>Welcome back ".$_SESSION['name']."</h3>";	
?>
	<div class="card" style="margin:30px;width:350px;">
	<div class="card-body text-center fit" style="margin:auto;">	
<div class="mb-3">
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?> " enctype="multipart/form-data">
		
<div class="mb-3">
        <label for="name" class="form-label">Phone Name</label>
        <input type="text" class="form-control <?php echo $nameErr? 'is-invalid' : null;?> " id="name" name="name" placeholder="Enter name of new phone">
</div>

<div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="text" class="form-control <?php echo $nameErr? 'is-invalid' : null;?> " id="price" name="price" placeholder="Enter Retail Price">
</div>
<div class="mb-3">
        <label for="description" class="form-label">Description of Phone</label>
        <input type="text" class="form-control <?php echo $nameErr? 'is-invalid' : null;?> " id="description" name="description" placeholder="Type Description Here">
</div>

<div class="mb-3">
        <label for="carrier" class="form-label">Carrier: </label>
		<select id="carrier" name="carrier">
		<?php echo "<br>"; ?>
		<option value="AT&T">ATT</option>
		<option value="Verizon">Verizon</option>
		<option value="T-Mobile">T-Mobile</option>
		<option value="Any">Any Carrier(Iphones Only)</option>		
		</select>
</div>

<div class="mb-3">
        <label for="brand" class="form-label">Brand: </label>
		<select id="brand" name="brand">
		<?php echo "<br>"; ?>
		<option value="Apple">Apple</option>
		<option value="Samsung">Samsung</option>
		<option value="Motorola">Motorola</option>		
		</select>
</div>



<div class="mb-3">
	  <label for="storage" class="form-label">Storage: </label>
       
		<select id="storage" name="storage">
		<?php echo "<br>"; ?>
		<option value="64GB">64GB</option>
		<option value="128GB">128GB</option>
		<option value="256GB">256GB</option>
		<option value="512GB">512GB</option>
		</select>
</div>

 
<div class="mb-3">
        <label for="color" class="form-label">Color</label>
        <input type="text" class="form-control <?php echo $nameErr? 'is-invalid' : null;?> " id="color" name="color" placeholder="Enter Color">
</div>     
		
		
<div class="mb-3">
		<label for="quantity">Choose a quantity:</label>
		<select id="quantity" name="quantity">
		<?php echo "<br>"; ?>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		</select>
		<?php echo "<br>"; ?>
</div>


<label for="image">Pick an image to display:</label>
<input type="file" id="fileToUpload" name="fileToUpload"><br>
<br>
<div class="mb-3">
        <input type="submit" name="addphone" value="Add Phone to Inventory" class="btn btn-dark w-100">
</div>
		</form>
</div>
	</div>
	</div>
	
	
	
	

    <h3 class="phonesavailable">Change Inventory</h3>
	
<?php 

if(isset($_POST['clear'])){
	$sql = "SELECT * FROM `Inventory`";
    $result = mysqli_query($conn, $sql);
	$Inventory = mysqli_fetch_all($result, MYSQLI_ASSOC);
}





if(isset($_POST['filter'])){

if($_POST['carrier'] == "ATT") {
	$carrier = "AT&T";
}

if($_POST['carrier'] == "Verizon") {
	$carrier = "Verizon";
}
if($_POST['carrier'] == "T-Mobile") {
	$carrier = "T-Mobile";
}		
	if($carrier) {
		$attphones = "SELECT * FROM Inventory WHERE Carrier LIKE '%$carrier%'";
		$stmt= $conn->prepare($attphones);
		$stmt->bind_param("s", $carrier);
		$stmt->execute();
		$result = $stmt->get_result();
		$Inventory = $result->fetch_all(MYSQLI_ASSOC);
}
		
	

echo $carrier;
} else {

$sql = "SELECT * FROM `Inventory`";
$result = mysqli_query($conn, $sql);
$Inventory = mysqli_fetch_all($result, MYSQLI_ASSOC);

}







if(isset($_POST['newprice'])){
	
$price = $_POST['priceupdate'];	
$phoneid = $_POST['phoneid'];
$setprice = "UPDATE `Inventory` SET `Price`='$price' WHERE `Inventory`.`phoneid`='$phoneid' ";
$conn->query($setprice);
header('Location: setinventory.php');	

}



	//include 'testingfunctions.php';	
?>
	<div>
	<form method="POST" style="margin-top:5px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	
        <label for="carrier">Filter Carriers: </label>
		<select id="carrier" name="carrier" class="button1">
		<option value="ATT">ATT</option>
		<option value="Verizon">Verizon</option>
		<option value="T-Mobile">T-Mobile</option>	
		</select>

	<button type="submit" name="filter" class="button1">Filter Inventory</button>
	<center><button type="submit" class="button1" name="clear">Clear</button></center>
	</form>
	</div>
	
	
	
	

    <?php if(empty($Inventory)): ?>
      <p class="lead mt3">There are no phones in the database!</p>
      <?php endif; ?>

      <?php foreach($Inventory as $item): ?>


<div class="d-flex flex-column justify-content-center align-items-center">
	 	
		<div class="card"style="height:590px;width:350px;margin:5px;">
		<div class="card-body text-center fit" style="margin:auto;">

		<img alt="Image of phone available for purchase" style="object-fit:contain;height:180px;" class="card-img-top img-fluid" src="<?=$item['image']?>" />


        
        <div class="text-secondary mt-2">
		<?php $phonename = $item['PhoneName']; ?>
        <?php  echo "<h3>$phonename</h3>"; ?> 
		<?php // echo "<br>"; ?>
		<?php  echo "Brand: ".$item['Brand']; ?> 
		<?php echo "<br>"; ?>
		<?php  echo "Storage: ".$item['Storage']; ?> 
		<?php echo "<br>"; ?>
		<?php  echo "Wireless Carrier: ".$item['Carrier']; ?>
		<?php echo "<br>"; ?>		
		<?php  echo "Color: ".$item['Color']; ?>
		<?php echo "<br>";?>
		<?php echo "Quantity: ".$item['Quantity']; ?>
		
		<div class="mb-3" style="border-top:solid;">
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <label for="priceupdate" class="form-label"><b>Price: <?php echo "$".$item['Price']; ?></b></label>
        <input type="text" class="form-control <?php echo $nameErr? 'is-invalid' : null;?> " id="price" name="priceupdate" placeholder="Enter new price">
		</div>
		<br>
		<input type="hidden" name="phoneid" id="phoneid" value="<?=$item['phoneid']?>" >
		<input type="submit" class="button1" name="newprice" value="Update Price">
		</form>
		
		
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<input type="hidden" name="phoneid" id="phoneid" value="<?=$item['phoneid']?>" >
		<label for="quantity"><b>Choose a quantity:</b></label>
		<select id="quantity" name="quantity">
		<?php echo "<br>"; ?>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		
		<?php echo "<br>"; ?>
		<input type="hidden" name="sessionid" id="sessionid" value="<?=session_id()?>" >
		<input type="submit" class="button1" name="updatequantity" value="Set to Inventory">
		</form>
		</div>
		</div>
     </div>
   </div>
        <?php endforeach; ?>
		
		
		
<?php include 'inc/footer.php'; ?>
	
	
	
	
	
	
	
	
<?php
} else {
	echo "You do not have permission to view this page";
	exit;
}

?>

	
	
	
	