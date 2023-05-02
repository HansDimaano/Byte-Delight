<!-- PHP for setting the Current Page Session variable -->

<?php 

    // Require database configuration file
    require 'config_db.php';

    // Check the value of link clicked by user
    switch($_POST["link"]){

        // Case for Home Link
        case "home_link":

            // Set Current Page Session Variable to Home
            $_SESSION["current_page"] = "home";
            break;

        // Case for Menu Link
        case "menu_link":

            // Set Current Page Session Variable to Menu
            $_SESSION["current_page"] = "menu";
            break;

        // Case for About Link
        case "about_link":

            // Set Current Page Session Variable to About
            $_SESSION["current_page"] = "about";
            break;

        // Case for Blog Link
        case "blog_link":

            // Set Current Page Session Variable to Blog
            $_SESSION["current_page"] = "blog";
            break;
    }
?>