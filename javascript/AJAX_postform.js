////-- JAVASCRIPT FOR CREATING AJAX POST FORM FOR THE 9 MENU ITEMS

// On document ready function
$(document).ready(function () {

    // For loop that loops 9 times
    for(let i = 1; i < 10; i++){

        // cart_form + i value in string submit function
        // Creates 9 cart form submit function for each menu item
        $('#cart_form' + i.toString()).submit(function(e){
            // prevent event default to prevent the page from refreshing (Refreshing will stop the BG music)
            e.preventDefault();
        
            // Use AJAX for data validation and sending the form values to handle_cart.php
            $.ajax({
                type: 'POST', // set method type to POST
                url: "php/handle_cart.php", // set url to php/handle_cart.php
                processData: false, // set processData to false for faster processing
                data: $(this).serialize(), // set data to the serialized value of form
                error: function(e){ // set error to alert that tells the user that there has been error processing your order
                    alert("Error processing your order. Please try again!");
                }
            });
        
            // return false to prevent the page from refreshing (Refreshing will stop the BG music)
            return false;
        })
    }
})