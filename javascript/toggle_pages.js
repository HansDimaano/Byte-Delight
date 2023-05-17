// Home DIV
var home = document.getElementById("home");

// Menu DIV
var menu = document.getElementById("menu");

// About DIV
var about = document.getElementById("about");

// Blog DIV
var blog = document.getElementById("blog");

// Header Links
var header_links = document.querySelectorAll(".header_link");

// Display Page Function
function displayPage(link, title){

    // Reset Active Links
    // For loop for iterating all header links
    for (header_link of header_links){

        // If current header link contains active class
        if (header_link.classList.contains("active")){

            // Remove active class from header link
            header_link.classList.remove("active");
        }
    }

    // Pages Array passing all 4 DIVS
    var pages = [home, menu, about, blog];

    // Hide Pages
    // For loop for iterating all pages
    for (page of pages){

        // Set page display to none
        page.style.display = "none";
    }

    // Set active page to null
    var activePage = null;

    // Check the value of title
    switch (title) {
        
        // Case for Home
        case "Home":

            // Set Active Page to Home
            activePage = home;
            break;

        // Case for Menu
        case "Menu":

            // Set Active Page to Menu
            activePage = menu;
            break;

        // Case for About
        case "About":

            // Set Active Page to About
            activePage = about;
            break;

        // Case for Blog
        case "Blog":

            // Set Active Page to Blog
            activePage = blog;
            break; 
    }

    // Set active page display to flex
    activePage.style.display = "flex";

    // Add active class to the clicked link
    link.classList.add("active");

    // Set the document title to Byte Delight + value of title
    document.title = "Byte Delight - " + title;
    
    // Set link Name to the value of the link's ID
    var linkName = $(link).attr("id");

    // Use AJAX for setting the Page Session
    $.ajax({
        type: 'POST', // set method type to POST
        url: "php/set_page_session.php", // set url to php/set_page_session.php
        data: {link: linkName}, // set data to link: linkName
        error: function(e){ // set error to alert that tells the user that there has been error in setting page session
            alert("Setting page session failed!");
        }
    });
}