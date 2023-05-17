<!-- PHP for handling the contact details of the customer and storing it into session variables -->

<?php

    // Require database configuration file
    require 'config_db.php';
    
    // Function for cleaning the user input and avoid SQL injection
    function clean_input($input) {

        $input = strip_tags($input, "@"); // Strip HTML tags
        $input = stripslashes($input); // Strip slashes
        $input = htmlspecialchars($input); // Erase all special characters
        return $input; // Return input
    }

    $_SESSION["fname"] = clean_input($_POST["fname"]); // Clean first name and store it to Fname Session
    $_SESSION["lname"] = clean_input($_POST["lname"]); // Clean last name and store it to Lname Session
    $_SESSION["email"] = clean_input($_POST["email"]); // Clean email and store it to Email Session
    $_SESSION["apartment"] = clean_input($_POST["apartment"]); // Clean apartment and store it to Apartment Session
    $_SESSION["street"] = clean_input($_POST["street"]); // Clean street and store it to Street Session
    $_SESSION["area"] = clean_input($_POST["area"]);  // Clean area and store it to Area Session
    $_SESSION["city"] = clean_input($_POST["city"]); // Clean city and store it to City Session

?>