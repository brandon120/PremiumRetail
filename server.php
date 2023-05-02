<?php 
session_start();
?>
<?php 

//session_start();

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'PremiumAdmin120');
define('DB_NAME', 'premiumretail');

//Creating connection 
//Using the SQLI method
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS, DB_NAME);

//Checking connection
if($conn->connect_error){
    die('Connection Failed'. $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];



$sql = "SELECT * FROM UserAccounts WHERE email='$email' AND Password='$password' ";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$count = mysqli_num_rows($result);

$hashedpass = password_hash($password,PASSWORD_DEFAULT);
	
	

	if($count > 0){
		echo 'success';
		
		
		$usepass = $row['Password'];
		$checkpassword = password_verify($password, $hashedpass);
		$useID = $row['id'];
		$username = $row['name'];
		if(!checkpassword) {
			echo 'Did not pass password check';
		} elseif ($checkpassword) {
			
			
			$apptsession = $_SESSION['session'];


			$updateappt = "UPDATE `appointments` SET `userid`='$useID' WHERE `appointments`.`userid`='$apptsession' ";
			
			$conn->query($updateappt);
			
			
			
			$transid = uniqid(rand());
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['phonenumber'] = $row['PhoneNumber'];
			$_SESSION['transid'] = $transid;
			$_SESSION['name'] = $username;
			$_SESSION['role'] = $row['role'];
			
			echo 'Welcome back ' . $_SESSION['email'] . '!';
			$sesId = session_id();
			
			
			
			$updatesession = "UPDATE `UserAccounts` SET `sessie`='$sesId' WHERE `UserAccounts`.`id`='$useID' ";
			
			$conn->query($updatesession);
			
			

			
			header('Location: index.php');
			
			
			
//			$updatesession = "UPDATE `UserAccounts` SET `sessie`='$sesId' WHERE `UserAccounts`.`id`='$useID' ";
			
//			$conn->query($updatesession);
			
			//$showchanged = prepared_query($conn, $updatesession, [$sesId]);
			//echo "Show update: $showchanged\n";
			
		}
	else{  
		  	echo "End:";
		}
	}
	if(!$count > 0){
	header('Location: index.php');	
		
		
	}
/*	
	
	else {

		echo "<center><h2>Wrong Password try again click below!</h2></center>";
		?>
		<p><a href="account.php">Click me to retry password!</a></p>
<?php
	}
	

*/
?>