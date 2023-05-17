<!-- Modal for payment details -->

<?php 

    // Require database configuration file
    require '../php/config_db.php';

?>

<!-- Close Button -->
<div id="close" class="close" onclick="hideModal()">&times;</div>

<!-- Cart DIV -->
<div id="cart" class="cart">

    <!-- Choose Payment Heading-->
    <h1>Choose Your Payment Method</h1>

    <!-- Order Recap DIV -->
    <div class="recap_order">

        <!-- Cart Table (Display of Orders) -->
        <table cellpadding="1" cellspacing="0" id="recap_cart">
            <tbody>

                <!-- Table Heading Row -->
                <tr style="padding-top: 0;">
                    <td colspan="2">Order</td> <!-- Order Image and Name Column -->
                    <td>No. of Items</td> <!-- Order Quantity Column -->
                    <td>Cost</td> <!-- Order Cost Column -->
                    <td>Total Cost</td> <!-- Order Total Cost Column -->
                </tr>

                <?php 

                // Bool for checking if cart has items or not (For Submit Button)
                $has_items = true;

                // Check if Cart Session is set and not null
                if (isset($_SESSION["cart"])) {

                    // Set total items and cost to 0
                    $total_items = 0;
                    $total_cost = 0;

                    // Set $i to 1
                    $i = 1;

                    // For Each loop for iterating through the Cart Session and Displaying all the Cart Session Values
                    foreach($_SESSION["cart"] as $key=>$order){

                        // Declare and Initialize Total Order Prize by multiplying Order Quantity and Order Price
                        $total_order_price = $order["quantity"] * $order["price"];
                ?>

                <tr>
                    <td><img src="<?php echo $order["image"] ?>"></td> <!-- Order Image Column (echo the value of Current Order Image Value to Image Source) -->
                    <td><?php echo $order["name"] ?></td> <!-- Order Name Column (echo the value of Current Order Name Value) -->
                    <td><?php echo $order["quantity"] ?></td> <!-- Order Quantity Column (echo the value of Current Order Quantity Value) -->
                    <td><?php echo $order["price"] ?> AED</td> <!-- Order Price Column (echo the value of Current Order Price Value) -->
                    <td><?php echo $total_order_price ?> AED</td> <!-- Order Total Price Column (echo the value of Current Order Total Price Value) -->
                </tr>

                <?php

                        // Increment total items to the value of Current Order Quantity
                        $total_items += $order["quantity"];

                        // Increment total cost to the value of Current Order Price
                        $total_cost += $total_order_price;

                        // Increment $i by 1
                        $i++;

                    }
                }

                ?>

                <tr>
                    <!-- Set Total Heading Column to 2 column spans -->
                    <th colspan="2">Total</th>

                    <!-- Total Items Column (echo the value of total items) -->
                    <th><?php echo $total_items ?></th>

                    <!-- Set Total Cost Column to 3 column spans (echo the value of total cost) -->
                    <th colspan="2"><?php echo $total_cost ?> AED</th>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Payment Method Form -->
    <form id="payment_method_form" method="POST">

        <!-- Payment Choice DIV -->
        <div class="payment_choices">

            <!-- Card Radio Button (Hidden) -->
            <input type="radio" id="card" name="payment" value="Card" onclick="enableCompleteOrder()"
            <?php if (isset($_POST['payment']) && $_POST['payment'] == "Card") {$_SESSION['payment'] = "Card"; echo "checked";} else if(isset($_SESSION['payment']) && $_SESSION['payment'] == "Card") {echo "checked";} ; ?>> 

            <!-- Card Label -->
            <label for="card">

                <!-- Card Image -->
                <img src="assets/card.png">

                <!-- Pay with Card Text -->
                <p>Pay with Card</p>
            </label>
    
            <!-- Cash Radio Button (Hidden) -->
            <input type="radio" id="cash" name="payment" value="Cash" onclick="enableCompleteOrder()"
            <?php if (isset($_POST['payment']) && $_POST['payment'] == "Cash") {$_SESSION['payment'] = "Cash"; echo "checked";} else if(isset($_SESSION['payment']) && $_SESSION['payment'] == "Cash") {echo "checked";} ; ?>>
             
            <!-- Cash Label -->
            <label for="cash">

                <!-- Cash Image -->
                <img src="assets/cash.png">

                <!-- Pay with Cash Text -->
                <p>Pay with Cash</p>
            </label>
        </div>

        <!-- Complete Order Button -->
        <input type="submit" value="Complete Order" id="complete_order_btn" disabled>
    </form>

    <!-- Script for Payment Method (Set class to scripts_to_pass_to_index for the AJAX_htmlreq can get all the scripts to pass to index page) -->
    <script class="scripts_to_pass_to_index">

        // Complete Order Button
        var complete_order_btn = document.getElementById("complete_order_btn");

        // Function for enabling the complete order button
        function enableCompleteOrder(){

            // Set the complete order button disabled to false
            complete_order_btn.disabled = false;
        }

        // On Submit of Payment Method Form
        $('#payment_method_form').submit(function(e){

            // prevent event default to prevent the page from refreshing (Refreshing will stop the BG music)
            e.preventDefault();
        
            // Use AJAX for data validation and sending the form values to handle_complete_order.php
            $.ajax({
                type: 'POST', // set method type to POST
                url: "php/handle_complete_order.php", // set url to php/handle_complete_order.php
                processData: false, // set processData to false for faster processing
                data: $(this).serialize(), // set data to the serialized value of form
                error: function(e){ // set error to alert that tells the user that there has been error removing current item
                    alert("Error processing your complete order. Please try again!");
                }
            });

            loadCartModal('modals/order_complete.php', 'modal', false);
        
            // return false to prevent the page from refreshing (Refreshing will stop the BG music)
            return false;
        })
        
    </script>
</div>

<!-- Back Button -->
<div class="back" onclick="loadCartModal('modals/contact_details.php', 'modal', false);"></div>