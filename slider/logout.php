

<?php

if(isset($_POST['logout'])){

  session_destroy();   // function that Destroys Session 
  header("Location: testing.php");
}

?>
