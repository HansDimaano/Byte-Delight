<!-- Modal for cart -->

<?php 

    // Require database configuration file
    require '../php/config_db.php'; 

?>

<!-- Close Button -->
<div id="close" class="close" onclick="hideModal()">&times;</div>

<!-- Cart DIV -->
<div id="cart" class="cart">

    <!-- Your Cart Heading-->
    <h1>Your Cart</h1>

    <!-- Cart Table (Display of Orders) -->
    <table cellpadding="10" cellspacing="1">
        <tbody>

            <!-- Table Heading Row -->
            <tr style="padding-top: 0;">
                <td colspan="2">Order</td> <!-- Order Image and Name Column -->
                <td>No. of Items</td> <!-- Order Quantity Column -->
                <td>Cost</td> <!-- Order Cost Column -->
                <td>Total Cost</td> <!-- Order Total Cost Column -->
                <td style="width: 5%;"></td> <!-- Remove Order Column -->
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
                <td>
                    <!-- Remove Order Column (Make a form for sending the value of Product ID row when user presses the Remove Order Button) -->

                    <!-- Set the ID of form to remove_item + the current value of $i (Value of $i increments by 1 per loop) -->
                    <form id="remove_item<?php echo $i?>" method="POST">

                        <!-- Set a hidden input type and pass the value as the value of current Order ID -->
                        <input type="hidden" name="ID" value="<?php echo $order['ID']?>">

                        <!-- Submit Button for Form -->
                        <button type="submit">

                            <!-- This DIV is the remove button (When hovering, the BG image source changes! See Modal CSS for more info)-->
                            <div class="remove"></div>
                        </button>
                    </form>

                    <!-- Script for Removing Item (Set class to scripts_to_pass_to_index for the AJAX_htmlreq can get all the scripts to pass to index page) -->
                    <script class="scripts_to_pass_to_index">

                        // remove_item + current value of $i on Submit Function
                        $('#remove_item<?php echo $i?>').submit(function(e){

                            // prevent event default to prevent the page from refreshing (Refreshing will stop the BG music)
                            e.preventDefault();
                        
                            // Use AJAX for data validation and sending the form values to remove_cart_item.php
                            $.ajax({
                                type: 'POST', // set method type to POST
                                url: "php/remove_cart_item.php", // set url to php/remove_cart_item.php
                                processData: false, // set processData to false for faster processing
                                data: $(this).serialize(), // set data to the serialized value of form
                                error: function(e){ // set error to alert that tells the user that there has been error removing current item
                                    alert("Error removing the item to cart. Please try again!");
                                }
                            });

                            // call loadCartModal to refresh the CART ONLY (not the whole page) and load the new Cart Session values
                            loadCartModal('modals/cart.php', 'modal', false);
                        
                            // return false to prevent the page from refreshing (Refreshing will stop the BG music)
                            return false;
                        })
                        
                    </script>
                </td>
            </tr>

            <?php

                    // Increment total items to the value of Current Order Quantity
                    $total_items += $order["quantity"];

                    // Increment total cost to the value of Current Order Price
                    $total_cost += $total_order_price;

                    // Increment $i by 1
                    $i++;

                }

                $_SESSION["total_items"] = $total_items;
                $_SESSION["total_cost"] = $total_cost;

            ?>

            <tr>
                <!-- Set Total Heading Column to 2 column spans -->
                <th colspan="2">Total</th>

                <!-- Total Items Column (echo the value of total items) -->
                <th><?php echo $total_items ?></th>

                <!-- Set Total Cost Column to 3 column spans (echo the value of total cost) -->
                <th colspan="3"><?php echo $total_cost ?> AED</th>
            </tr>

            
        </tbody>
    </table>	

    <?php

        // Cart Session must unset or null
        } else {

            // set has_items to false
            $has_items = false;
    ?>
            </tbody>
        </table>

        <!-- Empty Cart DIV (Display this instead of Order Table since the cart is empty) -->
        <div class="empty_cart">

            <!-- Oooops! Heading Message -->
            <h1>Oooops!</h1>
            
            <!-- Empty Robot Image -->
            <img src="assets/empty_robot.png">

            <!-- Empty Cart Message (with Menu link that has hideCartModal and displayPage functions) -->
            <p>Looks like your Cart is currently empty, please select items in our <a onclick="hideModal(); displayPage(document.getElementById('menu_link'), 'Menu'); showFooter()">menu</a>.</p>
        </div>
    <?php
        }
    ?>

    <!-- Proceed to Checkout (disabled when has_items is false) -->
    <input type="button" value="Proceed to Checkout" onclick="loadCartModal('modals/contact_details.php', 'modal', false)" <?php if(!$has_items) echo "disabled" ?>>
</div>