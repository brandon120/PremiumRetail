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


	$phonename = filter_input(INPUT_POST, 'phonename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);	
	
	$phoneimage = filter_input(INPUT_POST, 'phoneimage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
//	$phoneimage = $_POST['phoneimage'];
	
	
//	$sessionidentity = filter_input(INPUT_POST, 'sessionid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$phoneid = filter_input(INPUT_POST, 'phoneid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	$transactionid = filter_input(INPUT_POST, 'transid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	

	
	
	
	
	
?>



<div class="maincontent">

<div id="testbutton">
<ul class="breadcrumb">
  <li><a style="color:#333;" href="https://www.premiumwirelessphones.com/testcode/testing.php">Home </a></li>
  <li> / </li>
  <li><a style="color:#333;" href="javascript:"> <?php echo $phonename; ?> </a></li>
</ul>
</div>



<div class="phonename">
<?php  echo "<h3><b>$phonename</b></h3>"; ?>
</div>





<div class="productimage"><img alt="Image of phone available for purchase" class="card-img-top img-fluid" src="/<?=$phoneimage?>" />
</div>








	<div class="card my-3 w-contain">
     <div class="card-body text-center  border border-dark border-2">
        <div class="text-secondary mt-2">
		<form method="POST" action="shoppingcart.php">
		
		
		<button type="button" class="colorbutton" onclick="pickcolor()">Color</button>
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
		
		
		
		
		
<script>
function capacitypick() {
	
	
	var capacity=document.getElementById("capacityoption");
    var style=capacity.style.display;
        if(style=='none')
        	{
            capacity.style.display='block';
        	}
    	else{
            capacity.style.display='none';
        	}
}
</script>		
		
		
		
		<button type="button" class="capacitybutton" onclick="capacitypick()">Capacity</button>
		<div class="capacitydiv" role="radiogroup" id="capacityoption">
	
		<label class="container">64GB
		<input type="radio" checked="checked" name="capacitytwo" value="64">
		<span class="capacity"></span>
		</label>
		
		<label class="container">128GB
		<input type="radio" name="capacitytwo" value="128">
		<span class="capacity"></span>
		</label>
		
		<label class="container">512GB
		<input type="radio" name="capacitytwo" value="512">
		<span class="capacity"></span>
		</label>

		
		</div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		<button class="descriptionbutton" type="button" onclick="showdescription()">Description</button>
		
		<div role="radiogroup" id="descriptionshow" class="descriptionshow">
		 Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</div>
		
		
		
		<label for="quantity">Choose a quantity:</label>
		<select id="quantity" name="quantity">
		<?php echo "<br>"; ?>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		</select>
		
		
		<input type="hidden" name="phoneidtwo" id="phoneid" value="<?=$phoneid?>" >
		<input type="hidden" name="useridtwo" id="userid" value="<?=$_SESSION['id']?>" >
		<input type="hidden" name="transidtwo" id="transid" value="<?=$_SESSION['transid']?>" >
		<input type="hidden" name="brandtwo" id="brand" value="<?=$phonebrand?>" >
		<input type="hidden" name="phonenametwo" id="phonename" value="<?=$phonename?>" >
		<input type="hidden" name="phoneimagetwo" id="phoneimage" value="<?=$phoneimage?>" >
		
		<input type="submit" name="addtocart" value="Add to Cart">
		</form>
	 </div>
     </div>	
	 
	 
	 
	 
	 </div>
	
	
	
</div>