<?php 
session_start();
?>
<?php include 'head.php';?>
<?php

//print_r($_SESSION);

//Pull inventory from Database using query 
//$sql = "SELECT * FROM `Inventory`";
//$result = mysqli_query($conn, $sql);
//$Inventory = mysqli_fetch_all($result, MYSQLI_ASSOC);
//include 'testingfunctions.php';
?>



<style>
.card-img-top {
    width: 80%;

}
.card {
	display: inline-block;
	vertical-align: top;
	height: 275px;
	width: 215px;
}
.phonesavailable {
	padding-top: 10px;
	
}


.phoneimg {
	width: 115px;
}

.card:hover{
     transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
}

.imagediv {
	height: 150px;
	margin: auto;
	
}

</style>



<main>

 <?php

	

if(isset($_POST['search'])){
	$phone = $_POST['phonename'];
	$carrier = $_POST['carrier'];
	$brand = $_POST['brand'];
	

	
	if($_POST['phonename']){
	
	$searchquery = "SELECT * FROM Inventory WHERE PhoneName LIKE '%$phone%'";
	}


	
	if($_POST['carrier']== "Any"){
		$searchquery .= "";
	} else {
		$searchquery .= " AND Carrier = '$carrier' ";
	}

	
//	if($_POST['brand'] != "0"){
//		
//		$searchquery += " AND Brand LIKE '%$brand%'";
//	}
	
	
	
	$stmt= $conn->prepare($searchquery);
	$stmt->bind_param("ss", $phone, $carrier);
	$stmt->execute();	
	$result = $stmt->get_result();
	$Inventory = $result->fetch_all(MYSQLI_ASSOC);
} else {

$sql = "SELECT * FROM `Inventory`";
$result = mysqli_query($conn, $sql);
$Inventory = mysqli_fetch_all($result, MYSQLI_ASSOC);

} 
	
	
	

?>







    <h3 class="phonesavailable"><center>All Phones</center></h3>
		
<form method="POST" style="margin-top:5px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	<div class="searchbar">	
			<div class="searchcontainer">
				<input type="text" placeholder="Search.." id="phonename" name="phonename" style="border-radius:25px 0px 0px 25px">
			</div>	
		
	
			<div class="searchcontainer">
				<button type="submit" name="search"><i class="fa fa-search"></i></button>
			</div>
	</div>	
</form>	


<script>
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>

<?php // include 'shoppingcart.php';?>
<?php // include 'buyphone.php';?>

<?php 
//if(isset($_POST['viewphone'])){
	
//header('Location: buyphone.php');
	
//}
?>
<div id="display"> 

    <?php if(empty($Inventory)): ?>
      <p class="lead mt3">There are no phones in the database!</p>
      <?php endif; ?>
	
	<div class="columns">
      <?php foreach($Inventory as $item): ?>
	
     <div class="card" style="margin:5px;">
      <div class="card-body text-center fit" style="margin:auto;">


	 	<div class="imagediv">
		<img class="phoneimg allphones" alt="Image of phone available for purchase" style="object-fit:contain;" src="/<?=$item['image']?>" loading="lazy" decoding="async" async>
		</div>

        <div class="text-secondary mt-3" >
		<?php $phonename = $item['PhoneName']; ?>
        <?php  echo "<h5>$phonename</h5>"; ?> 
		<?php // echo "<br>"; ?>
		
		

		<form method="POST" style="margin-top:5px;" action="buyphone.php">
		<input type="hidden" name="phoneid" id="phoneid" value="<?=$item['phoneid']?>" >
		<input type="hidden" name="userid" id="userid" value="<?=$_SESSION['id']?>" >
		<input type="hidden" name="transid" id="transid" value="<?=$_SESSION['transid']?>" >
		<input type="hidden" name="brand" id="brand" value="<?=$item['Brand']?>" >
		<input type="hidden" name="storage" id="storage" value="<?=$item['Storage']?>" >
		<input type="hidden" name="phonename" id="phonename" value="<?=$item['PhoneName']?>" >
		<input type="hidden" name="phoneimage" id="phoneimage" value="<?=$item['image']?>" >
		<input type="hidden" name="color" id="color" value="<?=$item['Color']?>" >
		<input type="hidden" name="sessionid" id="sessionid" value="<?=session_id()?>" >
		<input type="submit" class="button1" name="viewphone" value="Add to cart" style="position:bottom;">

		</form>
		</div>

     </div>
     </div>
        <?php endforeach; ?>
    </div>
	
</div>
<?php include 'inc/footer.php'; ?>