<?php
//print_r($_SESSION);


$userid = $phoneid = $phonename = $phonebrand = $phonestorage = $phonecolor = $phoneimage = '';




if(isset($_POST['add'])){

if(!$_SESSION['email']) {
	echo "Login to add item to cart";
} else {

	
	$phonebrand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$phonestorage = filter_input(INPUT_POST, 'storage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$phonename = filter_input(INPUT_POST, 'phonename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);	
	
	$phoneimage = filter_input(INPUT_POST, 'phoneimage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

//	$phoneimage = $_POST['phoneimage'];
	
	$phonecolor = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

//	$sessionidentity = filter_input(INPUT_POST, 'sessionid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$phoneid = filter_input(INPUT_POST, 'phoneid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	$transactionid = filter_input(INPUT_POST, 'transid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	$quantity = $_POST['quantity'];
	
//	$addcart = "INSERT INTO cart(userid, phoneid, PhoneName, Brand, Storage, Color, image) VALUES (`$userid`,`$phoneid`,`$phonename`,`$phonebrand`,`$phonestorage`,`$phonecolor`,`$phoneimage`)";


$addcart = "INSERT INTO cart (userid, phoneid, PhoneName, Brand, Storage, Color, image, quantity) VALUES (?,?,?,?,?,?,?,?)";
$stmt= $conn->prepare($addcart);
$stmt->bind_param("sssssssi", $userid, $phoneid, $phonename, $phonebrand, $phonestorage, $phonecolor, $phoneimage, $quantity);
$stmt->execute();


echo "Item added to cart to view cart ".'<a href="/cart.php">Go to Cart</a>';

}
}


	
?>
	










