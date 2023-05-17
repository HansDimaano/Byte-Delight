<!-- Modal for contact details -->

<?php 

    // Require database configuration file
    require '../php/config_db.php';

?>

<!-- Close Button -->
<div id="close" class="close" onclick="hideModal()">&times;</div>

<!-- Cart DIV -->
<div id="contacts" class="cart">

    <!-- Confirm Contact Heading-->
    <h1>Confirm Contact Details</h1>

    <!-- Contact Details Form -->
    <form id="contact_details_form" method="POST">

        <!-- Form Row DIV -->
        <div class="form_row">

            <!-- First Name Input -->
            <input type="text" id="fname" name="fname" minlength="1" maxlength="20" placeholder="First Name" required
            value="<?php if (isset($_POST['fname'])) {$_SESSION['fname'] = $_POST['fname']; echo $_SESSION['fname'];} else if(isset($_SESSION['fname'])) {echo $_SESSION['fname'];} else{echo '';} ?>">

            <!-- Last Name Input -->
            <input type="text" id="lname" name="lname" minlength="1" maxlength="20" placeholder="Last Name" required 
            value="<?php if (isset($_POST['lname'])) {$_SESSION['lname'] = $_POST['lname']; echo $_SESSION['lname'];} else if(isset($_SESSION['lname'])) {echo $_SESSION['lname'];} else{echo '';} ?>">

            <!-- Email Input -->
            <input type="email" id="email" name="email" minlength="1" maxlength="50" placeholder="Email" required
            value="<?php if (isset($_POST['email'])) {$_SESSION['email'] = $_POST['email']; echo $_SESSION['email'];} else if(isset($_SESSION['email'])) {echo $_SESSION['email'];} else{echo '';} ?>">
        </div>

        <!-- Form Row DIV -->
        <div class="form_row">

            <!-- Apartment Input -->
            <input type="text" id="apartment" name="apartment" minlength="1" maxlength="50" placeholder="Apartment/Villa Number" required
            value="<?php if (isset($_POST['apartment'])) {$_SESSION['apartment'] = $_POST['apartment']; echo $_SESSION['apartment'];} else if(isset($_SESSION['apartment'])) {echo $_SESSION['apartment'];} else{echo '';} ?>">

            <!-- Street Input -->
            <input type="text" id="street" name="street" minlength="1" maxlength="50"  placeholder="Street" required
            value="<?php if (isset($_POST['street'])) {$_SESSION['street'] = $_POST['street']; echo $_SESSION['street'];} else if(isset($_SESSION['street'])) {echo $_SESSION['street'];} else{echo '';} ?>">
        </div>

        <!-- Form Row DIV -->
        <div class="form_row">

            <!-- Area Input -->
            <input type="text" id="area" name="area" minlength="1" maxlength="50" placeholder="Area" required
            value="<?php if (isset($_POST['area'])) {$_SESSION['area'] = $_POST['area']; echo $_SESSION['area'];} else if(isset($_SESSION['area'])) {echo $_SESSION['area'];} else{echo '';} ?>">
            
            <!-- Select Wrapper DIV -->
            <div class="select_wrapper">

                <!-- City Select -->
                <select id="city" name="city" required>

                    <!-- City Option (disabled) -->
                    <option disabled selected value>City</option>

                    <!-- Abu Dhabi Option -->
                    <option value="Abu Dhabi"
                    <?php if (isset($_POST['city']) && $_POST['city'] == "Abu Dhabi") {$_SESSION['city'] = "Abu Dhabi"; echo "selected";} else if(isset($_SESSION['city']) && $_SESSION['city'] == "Abu Dhabi") {echo "selected";} ; ?>>
                    Abu Dhabi
                    </option>

                    <!-- Dubai Option -->
                    <option value="Dubai"
                    <?php if (isset($_POST['city']) && $_POST['city'] == "Dubai") {$_SESSION['city'] = "Dubai"; echo "selected";} else if(isset($_SESSION['city']) && $_SESSION['city'] == "Dubai") {echo "selected";} ; ?>>
                    Dubai
                    </option>
                    
                    <!-- Sharjah Option -->
                    <option value="Sharjah"
                    <?php if (isset($_POST['city']) && $_POST['city'] == "Sharjah") {$_SESSION['city'] = "Sharjah"; echo "selected";} else if(isset($_SESSION['city']) && $_SESSION['city'] == "Sharjah") {echo "selected";} ; ?>>
                    Sharjah
                    </option>
                    
                    <!-- Ajman Option -->
                    <option value="Ajman"
                    <?php if (isset($_POST['city']) && $_POST['city'] == "Ajman") {$_SESSION['city'] = "Ajman"; echo "selected";} else if(isset($_SESSION['city']) && $_SESSION['city'] == "Ajman") {echo "selected";} ; ?>>
                    Ajman
                    </option>
                    
                    <!-- Umm Al-Quwain Option -->
                    <option value="Umm Al-Quwain"
                    <?php if (isset($_POST['city']) && $_POST['city'] == "Umm Al-Quwain") {$_SESSION['city'] = "Umm Al-Quwain"; echo "selected";} else if(isset($_SESSION['city']) && $_SESSION['city'] == "Umm Al-Quwain") {echo "selected";} ; ?>>
                    Umm Al-Quwain
                    </option>

                    <!-- Ras Al Khaimah Option -->
                    <option value="Ras Al Khaimah"
                    <?php if (isset($_POST['city']) && $_POST['city'] == "Ras Al Khaimah") {$_SESSION['city'] = "Ras Al Khaimah"; echo "selected";} else if(isset($_SESSION['city']) && $_SESSION['city'] == "Ras Al Khaimah") {echo "selected";} ; ?>>
                    Ras Al Khaimah
                    </option>
                    
                    <!-- Fujairah Option -->
                    <option value="Fujairah"
                    <?php if (isset($_POST['city']) && $_POST['city'] == "Fujairah") {$_SESSION['city'] = "Fujairah"; echo "selected";} else if(isset($_SESSION['city']) && $_SESSION['city'] == "Fujairah") {echo "selected";} ; ?>>
                    Fujairah
                    </option>
                </select>
            </div>
        </div>
        
        <!-- Proceed to Payment Method (calling confirmInputs function) -->
        <input type="submit" value="Proceed to Payment Method" onclick="confirmInputs()">
    </form>

    <!-- Script for Contact Details Validation (Set class to scripts_to_pass_to_index for the AJAX_htmlreq can get all the scripts to pass to index page) -->
    <script class="scripts_to_pass_to_index">

        var fname = document.getElementById("fname"); // First Name
        var lname = document.getElementById("lname"); // Last Name
        var area = document.getElementById("area"); // Area
        var check_inputs = [fname, lname, area]; // Check Inputs Array (passing the First Name, Last Name, and Area)

        var lettersOnlyPolicy = /^[A-Za-z\s]+$/; // Only Letters Policy

        // Confirm Input Function
        function confirmInputs(){

            // For loop iterating the inputs needed to be checked (Check Inputs Array)
            for (input of check_inputs){

                // If the input passes the letters only policy
                if(input.value.match(lettersOnlyPolicy)){

                    // Clear custom validity
                    input.setCustomValidity(""); 
                }

                // User must have not passed the letters only policy
                else {

                    // Set Custom Validity to enter letters only
                    input.setCustomValidity("Please enter letters only! This input does not accept numbers");
                }
            }
        }

        // contact_details_form on Submit Function
        $('#contact_details_form').submit(function(e){

            // prevent event default to prevent the page from refreshing (Refreshing will stop the BG music)
            e.preventDefault();
        
            // Use AJAX for data validation and sending the form values to handle_contact_details.php
            $.ajax({
                type: 'POST', // set method type to POST
                url: "php/handle_contact_details.php", // set url to php/handle_contact_details.php
                processData: false, // set processData to false for faster processing
                data: $(this).serialize(), // set data to the serialized value of form
                error: function(e){ // set error to alert that tells the user that there has been error processing the contact details
                    alert("Error processing the contact details. Please try again!");
                }
            });

            // Load Payment Cart Modal
            loadCartModal('modals/payment_method.php', 'modal', false);
        
            // return false to prevent the page from refreshing (Refreshing will stop the BG music)
            return false;
        })       
    </script>
</div>

<!-- Back Button -->
<div class="back" onclick="loadCartModal('modals/cart.php', 'modal', false);"></div>