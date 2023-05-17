<!-- PHP for clearing the cart session variables when order is complete -->

<?php 

    // Require database configuration file
    require '../php/config_db.php';

    // For each loop for iterating through the Session Variables
    foreach($_SESSION as $key => $val){

        // Check if Current Session Variable is not the Current Page Session
        // (Clear only Cart Session Variables, not Current Page Session)
        if ($key !== 'current_page'){

        // Unset Current Session Variable
        unset($_SESSION[$key]);

        }

    }

?>