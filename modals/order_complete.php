<!-- Modal for telling users order has been completed -->

<?php 

    // Require database configuration file
    require '../php/config_db.php';

?>

<!-- Close Button -->
<div id="close" class="close clearSession">&times;</div>

<!-- Cart DIV -->
<div id="cart" class="cart">

    <!-- Order Submitted Heading-->
    <h1>Your Order has been Submitted</h1>
    
    <!-- Thank you DIV -->
    <div class="thank_you">

        <!-- Thank you Heading -->
        <h4>Hooraay! Thank you for ordering with us!</h4>

        <!-- Happy Robot Image -->
        <img src="assets/happy_robot.png">

        <!-- Order submitted message -->
        <p>
            Your order has been successfully submitted to our system and is currently being processed. 
            We will contact you in a bit! Thank you! 
        </p>
    </div>

    <!-- Close Buttons -->
    <div class="buttons">

        <!-- Create New Order Button -->
        <input type="button" class="clearSession" id="goToMenu" value="Create New Order">

        <!-- Finish Shopping Button -->
        <input type="button" class="clearSession" value="Finish Shopping">
    </div>

    <!-- Script for Clearing Cart Sessions (Set class to scripts_to_pass_to_index for the AJAX_htmlreq can get all the scripts to pass to index page) -->
    <script class="scripts_to_pass_to_index">

        // Close Buttons on click function
        $('.clearSession').click(function(e){

            // prevent event default to prevent the page from refreshing (Refreshing will stop the BG music)
            e.preventDefault();
        
            // Use AJAX for data validation and sending the form values to clear_cart_session.php
            $.ajax({
                type: 'POST', // set method type to POST
                url: "php/clear_cart_session.php", // set url to php/clear_cart_session.php
                error: function(e){ // set error to alert that tells the user that there has been error removing current item
                    alert("Error clearing session!");
                }
            });

            // If button clicked is Create New Order Button
            if($(this).attr("id") == "goToMenu"){

                // Display Menu Page, Show Footer, and Hide Modal
                displayPage(document.getElementById('menu_link'), 'Menu'); showFooter(); hideModal();
            }

            // User must have clicked the two other close buttons
            else {

                // Hide Modal
                hideModal();
            }
        
            // return false to prevent the page from refreshing (Refreshing will stop the BG music)
            return false;
        })
        
    </script>

</div>