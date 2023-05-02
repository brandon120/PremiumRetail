<?php include 'head.php';?>
<?php print_r($_SESSION);?>
<?php 

$name = $email = $PhoneNumber = $password = '';
$nameErr = $emailErr = $PhoneNumberErr = $passwordErr = '';

//Form Submission
if(isset($_POST['submit'])){

  //Validate the name
  if(empty($_POST['name'])){
    $nameErr = 'Name is required!';
  } else {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }



  //Validate the email
  if(empty($_POST['email'])){
    $emailErr = 'Email is required!';
  } else {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  }




  //Validate the PhoneNumber
  if(empty($_POST['PhoneNumber'])){
    $PhoneNumberErr = 'Phone Number is required!';
  } else {
    $PhoneNumber = filter_input(INPUT_POST, 'PhoneNumber', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }
  
  
  
    if(empty($_POST['Password'])){
    $passwordErr = 'Password is required!';
  } else {
    $password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }



if(empty($nameErr) && empty($emailErr) && empty($PhoneNumberErr) && empty($passwordErr)){
  //Then add to database

  $sql = "INSERT INTO UserAccounts(name, email, PhoneNumber, Password) VALUES ('$name','$email','$PhoneNumber','$password')";


  if(mysqli_query($conn, $sql)){
    //If all went well then 

    header('Location: account.php');

  

  } else{
    //If error then echo error
    echo 'Error: '.mysqli_error($conn);
  }
  

}

}
?>


<div class="card" style="margin:30px;">
<div class="card-body text-center fit" style="margin:auto;">
<h2>Register Account</h2>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="mt-4 w-100">
      <div class="mb-3">
        <label for="name" class="form-label">Name (First and Last)</label>
        <input type="text" class="form-control <?php echo $nameErr? 'is-invalid' : null;?> " id="name" name="name" placeholder="Enter your name">
        <div class="invalid-feedback">
          <?php echo $nameErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo $emailErr? 'is-invalid' : null;?>" id="email" name="email" placeholder="Enter your email">
        <div class="invalid-feedback">
          <?php echo $emailErr;?>
        </div>
      </div>
      <div class="mb-3">
        <label for="PhoneNumber" class="form-label">Phone Number</label>
        <input type="number" class="form-control" <?php echo $PhoneNumberErr? 'is-invalid' : null; ?>" id="PhoneNumber" name="PhoneNumber" placeholder="Enter phone number" pattern="[1-9]{3}-[0-9]{3}-[1-9]{4}">
        <div class="invalid-feedback">
          <?php echo $PhoneNumberErr; ?>
        </div>
		</div>
		<div class="mb-3">
        <label for="Password" class="form-label">Password</label>
        <input type="password" class="form-control <?php echo $passwordErr? 'is-invalid' : null;?>" id="Password" name="Password" placeholder="Enter your Password" required>
        <div class="invalid-feedback">
          <?php echo $passwordErr;?>
        </div>
      </div>
      <div class="mb-3">
        <input type="submit" name="submit" value="Sign up" class="button1">
      </div>
    </form>
	<p>Already have an account? Click the button below to login!</p><button class="button1" onclick="window.location.href='https://premiumwirelessphones.com/account.php';">Login Page</button>

</div>
</div>
       