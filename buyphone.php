<?php 
session_start();
if(!$_SESSION['email']) {
$_SESSION['session'] = $_COOKIE['PHPSESSID'];
}
?>
<?php include 'head.php';?>

<?php //print_r($_SESSION); ?>



<?php 
	$phonebrand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$phonecarrier = filter_input(INPUT_POST, 'carrier', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$phonename = filter_input(INPUT_POST, 'phonename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);	
	
	$phoneimage = filter_input(INPUT_POST, 'phoneimage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
//	$phoneimage = $_POST['phoneimage'];
	
	
//	$sessionidentity = filter_input(INPUT_POST, 'sessionid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$phoneid = filter_input(INPUT_POST, 'phoneid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	$transactionid = filter_input(INPUT_POST, 'transid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	$phonedescription = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$phonecolor = filter_input(INPUT_POST, 'phonecolor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
?>


<main>

<div class="pageholder">

<div id="testbutton">
<ul class="breadcrumb">
  <li><a style="color:#333;margin-right:2px;" href="https://www.premiumwirelessphones.com/index.php">Home </a></li>
  <li style="text-decoration:underline;"> / </li>
  <li><a style="color:#333;margin-left:2px;" href="javascript:"> <?php echo $phonename; ?> </a></li>
</ul>
</div>




<div class="phonename">
<h3><?php echo $phonename; ?></h3>
</div>

<div class="elementholder">








<div class="imageholder card">

<img alt="Image of phone available for purchase" class="objectimage"  src="/<?=$phoneimage;?>" />

</div>







	<div class="productinfo card">

        <div class="formholder">
		<form method="POST" action="addappointment.php" class="form">
		
		<?php 
		if($phonebrand == "Apple") { ?>
		<button type="button" class="button1" style="margin:5px 0px 5px 0px " onclick="pickcolor()">Color</button>

		<div class="colorclass" role="radiogroup" id="coloroption">
	
		<label class="container">Red
		<input type="radio" checked="checked" name="colortwo" value="Red">
		<span class="red"></span>
		</label>
		
		<label class="container">Black
		<input type="radio" name="colortwo" value="Black">
		<span class="black"></span>
		</label>
		
		<label class="container">Blue
		<input type="radio" name="colortwo" value="Blue">
		<span class="blue"></span>
		</label>
		
		<label class="container">Starlight
		<input type="radio" name="colortwo" value="Starlight">
		<span class="starlight"></span>
		</label>
		
		</div>
		<?php
		
		} else {
			end;
			
		} ?>

		
		
		
		<?php 
		if($phonedescription != "") { ?>
		
		<button class="button1" type="button" style="margin: 5px 0px 5px 0px" onclick="showdescription()">Description</button>
		
		
		<div role="radiogroup" id="descriptionshow" class="descriptionshow" style="margin:0px 0px 0px 0px ">
		<?php 
		echo $phonedescription;
		?>
		</div>
		<?php 
		} ?>
		
		<h4><center>Appointment Settings</center></h4>
		<label for="time">Choose a time:</label>
		<input type="time" id="time" name="time" min="10:00" max="20:00" placeholder="Set Time" required>
		
		<label for="date">Appointment Date:</label>
		<input type="date" name="apptdate" id="date" required>
		
		<label for="stores" required>Choose a Store:</label>
		<select id="stores" name="stores" required>
		<?php echo "<br>"; ?>
		<option value="Russellville">Russellville</option>
		<option value="Dardanelle">Dardanelle</option>
		<option value="Clarksville">Clarksville</option>
		</select>
		<br>
		<?php 
		//IF user is not logged in then request some additional information
		if(!$_SESSION['email']) { ?>

		
	  	<h3><center>Fill in the fields below for the best possible experience</center></h3>
	  <div class="seperate mb-3">
        <label for="phonenumber" class="form-label">Phone Number(optional)</label>
        <input type="number" class="form-control" <?php echo $PhoneNumberErr? 'is-invalid' : null; ?>" id="phonenumber" name="phonenumber" placeholder="Enter phone number" pattern="[1-9]{3}-[0-9]{3}-[1-9]{4}">
        <div class="invalid-feedback">
          <?php echo $PhoneNumberErr; ?>
        </div>
		</div>
		
		<div class="seperate mb-3">
		<label for="custname" class="form-label">Name (optional)</label>
        <input type="text" class="form-control <?php echo $nameErr? 'is-invalid' : null;?> " id="custname" name="custname" placeholder="Enter your name">
		</div>
		
		
		
		<?php 
		
		} else { 
			end;
		}

		?>

		<input type="hidden" name="colortwo" id="colortwo" value="<?=$phonecolor?>" >
		<input type="hidden" name="phoneidtwo" id="phoneid" value="<?=$phoneid?>" >
		<input type="hidden" name="useridtwo" id="userid" value="<?=$_SESSION['id']?>" >
		<input type="hidden" name="transidtwo" id="transid" value="<?=$_SESSION['transid']?>" >
		<input type="hidden" name="brandtwo" id="brand" value="<?=$phonebrand?>" >
		<input type="hidden" name="phonenametwo" id="phonename" value="<?=$phonename?>" >
		<input type="hidden" name="phoneimagetwo" id="phoneimage" value="<?=$phoneimage?>" >
		<input type="hidden" name="carrier" id="carrier" value="<?=$phonecarrier?>" >
		<input type="submit" class="button1" name="addappointment" value="Set Appointment">
		</form>
	 </div>

	 
	 
	 
	 
	 </div>
	
	
	

</div>

</div>
</main>