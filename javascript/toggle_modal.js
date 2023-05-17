////-- JAVASCRIPT FOR SHOWING AND HIDING MODALS (recipe, thank you, and cart modals)

// Modal DIV
var modal = document.getElementById("modal");

// Added to Cart DIV 
var added_to_cart = document.getElementById("added_to_cart_modal");


// Show Modal Function (Recipe, Thank you, and Cart modals)
function showModal() {

  // Set Modal to flex
  modal.style.display = "flex";

}

// Hide Modal Function (Recipe, Thank you, and Cart modals)
function hideModal() {

  // Set Modal to none
  modal.style.display = "none";

}


// Show Added to Cart Modal Function (Added to Cart modal)
function showAddedtoCart() {

  // Set Added to Cart Modal to flex
  added_to_cart.style.display = "flex";

  // Set Timeout for Hiding the Added to Cart in 15 seconds
  hideAfter = setTimeout(hideAddedtoCart, 15000);
}

// Hide Added to Cart Modal Function (Added to Cart modal)
function hideAddedtoCart() {

  // Set Added to Cart Modal to none
  added_to_cart.style.display = "none";

  // Clear the hideAfter Timeout
  clearTimeout(hideAfter);
}