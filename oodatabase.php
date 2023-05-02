


<?php 
require "scripts/class.php"; 



$db = new Database("localhost", "root", "PremiumAdmin120", "premiumretail");


if ($db->connect()) {
    $db->update('mysqlcrud',array('name'=>'Updated Foo Bar'), array('id',1));
} else {
    echo "There was some error connecting to the database.";
}

?>