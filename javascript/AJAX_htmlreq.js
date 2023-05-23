////-- JAVASCRIPT FOR REQUESTING HTML CONTENT USING XHTTP

// Function for loading modals (Recipe and Thank you Modals)
function loadModal(url, div_ID) {
    const xhttp = new XMLHttpRequest(); // Create new XHTTP Request

    // XHTTP onload function
    xhttp.onload = function() {

        // Pass on the response text of XHTTP to the chosen DIV
        document.getElementById(div_ID).innerHTML = this.responseText;
    }

    // Open the URL using GET method
    xhttp.open("GET", url);

    // Send the XHTTP Request
    xhttp.send();
}

// Function for loading cart modals (requires url, div_ID, and animation bool)
function loadCartModal(url, div_ID, animation_bool) {

    // Cart DIV
    var cart_div = document.getElementById(div_ID);

    // Get all current temporary scripts
    var temporary_scripts = document.querySelectorAll(".temporary_script");

    // For each loop for temporary scripts
    temporary_scripts.forEach(temporary_script => {

        // Remove temporary script
        temporary_script.remove();
    });

    const xhttp = new XMLHttpRequest(); // Create new XHTTP Request

    // XHTTP onload function
    xhttp.onload = function() {

        // Pass on the response text of XHTTP to cart DIV
        cart_div.innerHTML = this.responseText;

        // Get all scripts to pass to index
        var scripts = document.querySelectorAll(".scripts_to_pass_to_index");

        // For each loop for scripts
        scripts.forEach(js => {

            // Create new script
            var script = document.createElement("script");

            // Add classlist to new script "temporary script"
            script.classList.add("temporary_script");

            // Set the script text content to the text of the javascript
            script.textContent = js.textContent;

            // Add the script to the body of document
            document.body.appendChild(script);
        });

        // Check if animation bool is true (Opening Cart Modal = true, Cart -> Contact Details ->  Payment Method -> Complete Order =  false)
        if (animation_bool){

            // Add animate class to last element child
            cart_div.lastElementChild.classList.add("animate");
        }
    }
    // Open the URL using GET method
    xhttp.open("GET", url);

    // Send the XHTTP Request
    xhttp.send();
}
