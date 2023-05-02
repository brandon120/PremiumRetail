<?php 
session_start();
$_SESSION['session'] = $_COOKIE['PHPSESSID'];
?>
<?php include 'db.php';?>
<?php 

if($_SESSION['role']== "0") { 
if(isset($_POST['addtocart'])){

	
	$phonenametwo = filter_input(INPUT_POST, 'phonenametwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);	
	$phoneimagetwo = filter_input(INPUT_POST, 'phoneimagetwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


	$phoneidtwo = filter_input(INPUT_POST, 'phoneidtwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$useridtwo = filter_input(INPUT_POST, 'useridtwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	$transactionidtwo = filter_input(INPUT_POST, 'transidtwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	$phonestoragetwo = filter_input(INPUT_POST, 'capacitytwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	$phonecolortwo = filter_input(INPUT_POST, 'colortwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


	
	$quantity = $_POST['quantity'];


	$addcart = "INSERT INTO cart (userid, phoneid, PhoneName, Storage, Color, image, quantity) VALUES (?,?,?,?,?,?,?)";
	$stmt= $conn->prepare($addcart);
	$stmt->bind_param("ssssssi", $useridtwo, $phoneidtwo, $phonenametwo, $phonestoragetwo, $phonecolortwo, $phoneimagetwo, $quantity);
	$stmt->execute();
	
	header('Location: shopping.php');
}
} else {
	$phonenametwo = filter_input(INPUT_POST, 'phonenametwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);	
	$phoneimagetwo = filter_input(INPUT_POST, 'phoneimagetwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


	$phoneidtwo = filter_input(INPUT_POST, 'phoneidtwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$usernologin = $_SESSION['session'];
	
	$transactionidtwo = filter_input(INPUT_POST, 'transidtwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	$phonestoragetwo = filter_input(INPUT_POST, 'capacitytwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	$phonecolortwo = filter_input(INPUT_POST, 'colortwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


	
	$quantity = $_POST['quantity'];


	$addcart = "INSERT INTO cart (userid, phoneid, PhoneName, Storage, Color, image, quantity) VALUES (?,?,?,?,?,?,?)";
	$stmt= $conn->prepare($addcart);
	$stmt->bind_param("ssssssi", $usernologin, $phoneidtwo, $phonenametwo, $phonestoragetwo, $phonecolortwo, $phoneimagetwo, $quantity);
	$stmt->execute();
	
	header('Location: shopping.php');
}
	
?>