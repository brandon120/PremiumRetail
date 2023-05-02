<?php 
session_start();
?>
<?php
session_destroy();   // function that Destroys Session 
header("Location: /index.php");
?>
