<!-- PHP for handling the addition of items to cart -->

<?php

    // Require database configuration file
    require 'config_db.php';

    // Search for the product in database where the product ID is equal to the user chosen product ID
    $sql = "SELECT * from menu_products WHERE ID = '".$_POST["ID"]."'";

    // Get the result for the SQL Search Query
    $result = $conn->query($sql);

    // Get the array from the result and pass it to product ID variable
    $productID = $result->fetch_array();

    // Declare and intialize Product Array and pass on the product ID and the array of the user chosen product values (ID, name, image, quantity, price) associative array
    $productArr = array(
        $productID["ID"] => array(
            "ID"=>$_POST["ID"], 
            "name"=>$_POST["product"], 
            "image"=>$_POST["image"], 
            "quantity"=>1, 
            "price"=>$_POST["price"]));

    // Check if Cart Session is set and not null
    if (isset($_SESSION["cart"])){

        // Check if Cart Session is not empty
        if(!empty($_SESSION["cart"])) {

            // Create an array for the product IDs that are already in cart
            $IDs_in_cart = array();

            // Push all the product IDs in the cart through a foreach loop of Cart Session
            foreach($_SESSION["cart"] as $key=>$order){

                // Push the product ID to ID cart array
                array_push($IDs_in_cart, $order["ID"]);
            }

            // Check if user chosen product ID is already in cart
            if(in_array($_POST["ID"], $IDs_in_cart)) {

                // For each loop for iterating through the Cart Session
                foreach($_SESSION["cart"] as $ID => $i) {

                        // Check if current row matches the user chosen product ID
                        if($_POST["ID"] == $i["ID"]) {

                            // If the quantity of the current row is empty
                            if(empty($_SESSION["cart"][$ID]["quantity"])) {

                                // Set the quantity of the current row to 0
                                $_SESSION["cart"][$ID]["quantity"] = 0;
                            }

                            // Increment the current row quantity by 1
                            $_SESSION["cart"][$ID]["quantity"]++;
                        }
                }
            }

            // Current User chosen product must be new to the cart
            else {

                // Merge the current value of Cart Session to the Product Array
                $_SESSION["cart"] = array_merge($_SESSION["cart"], $productArr);
            }            
        }

        // Cart Session must be empty at the moment
        else {

            // Add the Product Array to Cart Session
            $_SESSION["cart"] = $productArr;
        }

    }

    // Cart Session must be unset or null
    else {

        // Add the Product Array to Cart Session
        $_SESSION["cart"] = $productArr;
    }
?>