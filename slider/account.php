<?php 
session_start();
?>
<?php include 'head.php';?>
<?php include 'logout.php';?>
<?php 


if(!$_SESSION['email']) {
	
	
	
?>	
	<div class="login">
			<h1>Login</h1>
			<form action="server.php" method="post">
				<label for="email">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="email" placeholder="Email" id="email" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
			</form>
	</div>
       <p>New Here?<a href="register.php">Click here to register!</a></p>
<?php
	
} else {
$name = $_SESSION['name'];
 echo "<h2>Welcome back $name!!</h2>";
 ?>
	<div>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	<input type="hidden" name="userid" id="userid" value="<?=$_SESSION['id']?>" >
	<input type="submit" name="logout" value="Logout">
	</form>
	</div>
<?php	
}
	
?>




</body>
</html>


