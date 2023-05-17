<!-- PHP for handling the removal of items in cart -->

<?php 

    // Require database configuration file
    require 'config_db.php';

    // Check if Cart Session is not empty
    if(!empty($_SESSION["cart"])) {

        // For each loop for iterating throught the Cart Session
		foreach($_SESSION["cart"] as $key => $order) {

            // Check if current row matches the user chosen product ID to remove
			if($_POST["ID"] == $order["ID"]){

                // Unset the curent Cart Session row
                unset($_SESSION["cart"][$key]);
            }
								
            // If Cart Session is empty due to the current removal of Cart Session row
			if(empty($_SESSION["cart"])){

                // Unset the whole Cart Session
                unset($_SESSION["cart"]);
            }
		}
	}
?>