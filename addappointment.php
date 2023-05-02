<?php 
session_start();
if(!$_SESSION['email']) {
$_SESSION['session'] = $_COOKIE['PHPSESSID'];
}
?>
<?php include 'config/database.php';?>

<?php

if(isset($_POST['addappointment'])){
//Event checker to see if they click the button to add appointment


// IF session 'name' has been set then they are logged in so run this
	if(isset($_SESSION['name'])){
	$phonecarrier = filter_input(INPUT_POST, 'carrier', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	$phonenametwo = filter_input(INPUT_POST, 'phonenametwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);	
	
	$phoneimagetwo = filter_input(INPUT_POST, 'phoneimagetwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


	$phoneidtwo = filter_input(INPUT_POST, 'phoneidtwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$useridtwo = $_SESSION['id'];
	
	//$transactionidtwo = filter_input(INPUT_POST, 'transidtwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	//$phonestoragetwo = filter_input(INPUT_POST, 'capacitytwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	$phonecolortwo = filter_input(INPUT_POST, 'colortwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	//$quantity = $_POST['quantity'];



// BELOW IS THE CODE FOR APPOINTMENTS



// Amount of lines customer has if any (dropdown)
//	$phonelines = filter_input(INPUT_POST, 'phonelines', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	
// Current carrier customer is using
//	$customercarrier = filter_input(INPUT_POST, 'carrier', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


// Current amount customer is paying for service
//	$monthlycost = filter_input(INPUT_POST, 'customermonthly', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


// Store they would like to purchase from
	$store = filter_input(INPUT_POST, 'stores', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Time of appointment
	$time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Customer name 
	$customername = $_SESSION['name'];

// Customers phone number
	$phonenumber = $_SESSION['phonenumber'];
	
	$date = filter_input(INPUT_POST, 'apptdate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	// The code for the appointment data form includes the following identifiers for data customer inputs
	// scheduledate, stores, time


	//Appointments table need the following: 
	// userid, phoneid, storelocation, image, PhoneName, appointmenttime, appointmentday, customercomments, admincomments. 
	// Will also need to gather linecount(amount of lines they have), current carrier, how much are you paying monthly for service 
	
	
	
	// So will need to setup the appointments insertion like so:
	// $addtoappt = "INSERT INTO appointments (userid, phoneid, storelocation, appointmenttime, appointmentday, image, PhoneName) VALUES (?,?,?,?,?,?,?)";
	
	$addappt = "INSERT INTO appointments (userid, phoneid, storelocation, PhoneName, appointmenttime, appointmentday, customername, phonecolor, carrier, image, phonenumber) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
	$stmt= $conn->prepare($addappt);
	$stmt->bind_param("sssssssssss", $useridtwo, $phoneidtwo, $store, $phonenametwo, $time, $date, $customername, $phonecolortwo, $phonecarrier, $phoneimagetwo, $phonenumber);
	$stmt->execute();
	

	header('Location: appointment.php');
	
	
	//Appointment table will need all of these values:
	// userid, phoneid, storelocation, image, PhoneName, appointmenttime, appointmentday, orderstatus, customercomments(will be updateable inside of appointments), admincomments, linecount, currentcarrier, currentmonthly, timestamp
	
	
	
// IF session 'name' is not set then run this to add appointment with just their 


	}else {
	
	$phonecarrier = filter_input(INPUT_POST, 'carrier', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	$phonenametwo = filter_input(INPUT_POST, 'phonenametwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);	
	
	$phoneimagetwo = filter_input(INPUT_POST, 'phoneimagetwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


	$phoneidtwo = filter_input(INPUT_POST, 'phoneidtwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$useridtwo = $_SESSION['session'];
	
	//$transactionidtwo = filter_input(INPUT_POST, 'transidtwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	//$phonestoragetwo = filter_input(INPUT_POST, 'capacitytwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	$phonecolortwo = filter_input(INPUT_POST, 'colortwo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	//$quantity = $_POST['quantity'];



// BELOW IS THE CODE FOR APPOINTMENTS



// Amount of lines customer has if any (dropdown)
	$phonelines = filter_input(INPUT_POST, 'phonelines', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	
// Current carrier customer is using
//	$customercarrier = filter_input(INPUT_POST, 'carrier', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


// Current amount customer is paying for service
//	$monthlycost = filter_input(INPUT_POST, 'customermonthly', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


// Store they would like to purchase from
	$store = filter_input(INPUT_POST, 'stores', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Time of appointment
	$time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Customer name 
	$customername = filter_input(INPUT_POST, 'custname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


// If Customer name was not set then set as Not Given
	
// Customers phone number
	$phonenumber = filter_input(INPUT_POST, 'phonenumber', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	
	
	
	$date = filter_input(INPUT_POST, 'apptdate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	// The code for the appointment data form includes the following identifiers for data customer inputs
	// scheduledate, stores, time


	//Appointments table need the following: 
	// userid, phoneid, storelocation, image, PhoneName, appointmenttime, appointmentday, customercomments, admincomments. 
	// Will also need to gather linecount(amount of lines they have), current carrier, how much are you paying monthly for service 
	
	
	
	// So will need to setup the appointments insertion like so:
	// $addtoappt = "INSERT INTO appointments (userid, phoneid, storelocation, appointmenttime, appointmentday, image, PhoneName) VALUES (?,?,?,?,?,?,?)";
	
	$addappt = "INSERT INTO appointments (userid, phoneid, storelocation, PhoneName, appointmenttime, appointmentday, customername, phonenumber, phonecolor, carrier, image) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
	$stmt= $conn->prepare($addappt);
	$stmt->bind_param("sssssssssss", $useridtwo, $phoneidtwo, $store, $phonenametwo, $time, $date, $customername, $phonenumber, $phonecolortwo, $phonecarrier, $phoneimagetwo);
	$stmt->execute();
	

	header('Location: appointment.php');
	
	
	
	
}
}
	
?>