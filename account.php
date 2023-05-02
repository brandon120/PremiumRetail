<?php 
session_start();
?>
<?php include 'head.php';?>

<?php 
// print_r($_SESSION);

if(!$_SESSION['email']) {
	
	
	
?>	
	<div class="card" style="margin:30px;">
	<div class="card-body text-center fit" style="margin:auto;">

			<h1>Login</h1>
			<form action="server.php" method="POST" class="mt-4 w-100">
				<div class="mb-3">
				<label for="email" class="form-label">Email</label>
				<input type="text" class="form-control" name="email" placeholder="Enter your email" id="email" required>
				</div>
				<div class="mb-3">
				<label for="password" class="form-label">Password</label>
				<input type="password" class="form-control" name="password" placeholder="Enter your password" id="password" required>
				</div>
				<div class="mb-3">
				<input type="submit" class="button1" value="Login">
				</div>
			</form>
			<p>Don't have an account? Click the button below to Register!</p>
			<button class="button1" onclick="window.location.href='https://premiumwirelessphones.com/register.php';">Register Account</button>

	</div>
	</div>

<?php
	
} else {
$name = $_SESSION['name'];
?>

	<div class="card" style="margin:30px;">
	<div class="card-body text-center fit" style="margin:auto;">
	<?php 
	echo "<h2>Welcome back $name!!</h2>";
 ?>
	<div>
	<button class="button1" onclick="window.location.href='https://premiumwirelessphones.com/testcode/logout.php';">Logout</button>
	</div>
	</div>
	</div>
<?php	
}
	
?>
<?php






if($_SESSION['role']== "1" || $_SESSION['role']== "2") { 
?>
<div class="card" style="margin:30px;">
<div class="card-body text-center fit" style="margin:auto;">
<h3>Admin Settings</h3>
<button class="button1" onclick="window.location.href='https://premiumwirelessphones.com/setinventory.php';">Set Inventory</button>
<p><br></p>
<button class="button1" onclick="window.location.href='https://premiumwirelessphones.com/seeappointments.php';">See Customer Appointments</button>
<?php 
if($_SESSION['role']== "2") { ?>
	<p><br></p>
	<button class="button1" onclick="window.location.href='https://premiumwirelessphones.com/addrole.php';">Set Admin Roles</button>
	

<?php
} ?>


</div>
</div>
<?php
}else {
	exit;
}
?>

</body>
</html>


