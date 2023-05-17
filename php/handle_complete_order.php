<!-- PHP for handling the complete order and sending it to the database -->

<?php

    // Require database configuration file
    require 'config_db.php';
    
    // Set the Payment Session to the Payment chosen by user
    $_SESSION["payment"] = $_POST["payment"];

    // Declare order array variable
    $order_array = array();

    // For each loop for iterating through the Cart Session Variables
    foreach($_SESSION["cart"] as $key=>$order){

        // Check if order is more than 1. If order = 1, set it to "order", else, set it to "orders"
        $order_plural_singular = $order["quantity"] > 1 ? "orders" : "order";

        // Set Order Summary to Format e.g. "2 orders of Cocoa Bronze"
        $order_summary = $order["quantity"] . " " .  $order_plural_singular . " of " . $order["name"] . ".";

        // Push the Current Order Summary to Order Array
        array_push($order_array, $order_summary);
    }

    // Encode the Order Array to JSON
    $order_array = json_encode($order_array);

    // Set the Order Timestamp to Current Date
    $order_timestamp = date("Y-m-d H:i:s");

    // Set the SQL Query to INSERT command, inserting all the Cart Session Variables and Order Array
    $sql = "INSERT INTO orders (orderDetails, totalItems, totalPrice, firstName, lastName, email, apartment, street, area, city, payment, orderTimestamp)
    VALUES ('".$order_array."', '".$_SESSION["total_items"]."', '".$_SESSION["total_cost"]."', '".$_SESSION["fname"]."', '".$_SESSION["lname"]."', '".$_SESSION["email"]."', '".$_SESSION["apartment"]."', '".$_SESSION["street"]."', '".$_SESSION["area"]."', '".$_SESSION["city"]."', '".$_SESSION["payment"]."', '".$order_timestamp."')";

    // Pass the Query to Database
    $conn->query($sql)


?>