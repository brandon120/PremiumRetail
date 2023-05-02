<?php

if(isset($_POST['search'])){
	$phone = $_POST['phonename'];
	$searchquery = "SELECT * FROM Inventory WHERE PhoneName LIKE '%$Phone%' LIMIT 10";
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
