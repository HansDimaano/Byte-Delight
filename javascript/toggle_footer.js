////-- JAVASCRIPT FOR SHOWING AND HIDING FOOTER (Home Page = footer hidden, Other Page = footer shown)

// Footer
var footer = document.getElementsByTagName("footer")[0];

// Show Footer Function
function showFooter() {

    // Set Footer Display to flex
    footer.style.display = "flex";
}

// Hide Footer Function
function hideFooter() {

    // Set Footer Display to none
    footer.style.display = "none";
}