<?php 
session_start();
?>
<?php include 'head.php';?>
<?php
if($_SESSION['role']== "2") { 


if(isset($_POST['clear'])){
	$role = "1";
	$sql = "SELECT * FROM UserAccounts WHERE role='$role' ";
    $result = mysqli_query($conn, $sql);
	$accounts = mysqli_fetch_all($result, MYSQLI_ASSOC);
}


if(isset($_POST['search'])){
	
	$email = $_POST['email'];
	$sql = "SELECT * FROM UserAccounts WHERE email='$email' ";
    $result = mysqli_query($conn, $sql);
	$accounts = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
} else {


	
$user = "1";
$sql = "SELECT * FROM UserAccounts WHERE role='$user' ";
$result = mysqli_query($conn, $sql);
$accounts = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	

}



if(isset($_POST['addrole'])){
	
$userid = $_POST['userid'];	
$newrole = "1";
$setrole = "UPDATE `UserAccounts` SET `role`='$newrole' WHERE `UserAccounts`.`id`='$userid' ";
$conn->query($setrole);
header('Location: addrole.php');	

}


if(isset($_POST['removerole'])){
	
$userid = $_POST['userid'];	
$newrole = "0";
$setrole = "UPDATE `UserAccounts` SET `role`='$newrole' WHERE `UserAccounts`.`id`='$userid' ";
$conn->query($setrole);
header('Location: addrole.php');	

}




?>

  <h3 class="phonesavailable"><center>Search accounts</center></h3>
<div class="searchbar">	
	<div class="searchcontainer">
		<form method="POST" style="margin-top:5px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
			<input type="text" placeholder="Enter an email" id="email" name="email" style="border-radius:25px 0px 0px 25px">
			<button type="submit" name="search"><i class="fa fa-search"></i></button>
			<button type="submit" name="clear" style="border-radius:25px;">Clear</button>
		</form>
	</div>
</div>
<br>



	<div class="d-flex flex-column justify-content-center align-items-center">








<?php if(empty($accounts)): ?>
      <p class="lead mt3">There are no accounts to display with that email.</p>
      <?php endif; ?>
	
	<div class="all accounts">
      <?php foreach($accounts as $item): ?>

<div class="card">
	<div class="card-body text-center fit" style="margin:auto;">
	
	
        <div class="text-secondary mt-1">
		<h2><?php echo $item['name']; ?></h2>
		<p><b>Email:</b> <?php echo $item['email']; ?></p>
		<p><b>Phone Number:</b> <?php echo $item['PhoneNumber']; ?></p>
		<p><b>Role:</b> <?php echo $item['role']; ?></p>
		<p>Role: 1 means account is associate. Role: 0 means account is customer</p>
		<form method="POST" style="margin-top:5px;border:none;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<input type="hidden" name="userid" id="userid" value="<?=$item['id']?>" >
		
		<input type="submit" class="button1" name="addrole" value="Add as associate account">
		
		
		
		<input type="submit" class="button1" name="removerole" value="Remove associate account rights">
		
		</form>

	 </div>
	 </div>
     </div>	

   <?php endforeach; ?>
</div>



</div>


<?php
}else {
	echo "You do not have permission to view this page";
	exit;
}
?>