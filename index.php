<?php 

    // Require database configuration file
    require 'php/config_db.php'; 

?>

<!-- 

    SUMMARY OF TECHNIQUES USED:

    -> The website uses a single-page application template for the BG music 
    to continuously play while the user is navigating through our website

    -> Loading pages is done through toggle_pages.js. It simply sets the active page
    style to display:flex and inactive pages style to display:none

    -> Loading modals is done through toggle_modal and AJAX_htmlreq.js. The toggle modal JS
    sets the modal DIV to display:flex if active, and display: none if inactive. The 
    AJAX_htmlreq.js is used for loading the content of the modal using XMLHTTPRequest method.

    -> Why did I use two different techniques in loading pages and loading modals?

    Answer: 
    
    The PAGES needs to be preloaded, specifically Menu page, mainly because of the AJAX_postform.js. 
    This JS performs the AJAX Form Submit and handles the addition of items to the cart and the 
    IDs of the menu form need to be set before document.ready() function. Additionally, preloading
    pages would make our website run smoothly and faster.
    
    The MODALS, specifically Cart Modal, needs to be refreshed in order to display the updated
    Cart Session Variables. As mentioned earlier, we highly need to restrain from refreshing the
    page because of the BG Music. Loading the modal through AJAX_htmlreq.js could refresh the MODAL content and not 
    the WHOLE PAGE

    -> How is the menu items (form) being displayed?

    Answer: 

    Through the use of SQL query and database. In bytedelight_db, there is a table named 
    menu_products and it contains the ID, product name, product image file source, and product
    price. An SQL query is performed, getting all the data from the menu_products table, and is
    iterated through while loop. Inside the loop is the use echo $product["ID"] and others to 
    create the form structure.

-->

<!DOCTYPE=html>

<html>

<head>

    <!-- Set viewport to width-device-width for responsive web design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Import Byte Delight Website Icon -->
    <link rel="shortcut icon" href="assets/bytedelight_icon.ico" type="image/x-icon">
    <link rel="icon" href="assets/bytedelight_icon.ico" type="image/x-icon">

    <!-- Import All CSS Files -->
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/reveal_animation.css">

    <!-- Import Jquery 3.6.0 Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Set initial title to Byte Delight -->
    <title>Byte Delight</title>
</head>

<body>
    
    <!-- HEADER FOR ALL PAGES -->
    <header>

        <!-- Music DIV -->
        <div class="music_div">

            <!-- BG Music Source -->
            <audio src="assets/bg_music.mp3" id="bg_music" loop></audio>

            <!-- BG Music Icon Button -->
            <button onclick="toggleMusic()"><img src="assets/mute.png" id="toggleMusic"></button>
            
            <!-- BG Music Volume Slider using input type="range" -->
            <div class="volume">
                <input type="range" id="volume" min="0" max="100" value="50" step="10">
            </div>
        </div>

        <!-- Blur DIV when hovering Music DIV -->
        <div class="blur"></div>

        <!-- Home Link (using toggle_pages.js and toggle_footer.js) -->
        <a class="header_link" id="home_link" onclick="displayPage(this, 'Home'); hideFooter();">Home</a>

        <!-- Menu Link (using toggle_pages.js and toggle_footer.js) -->
        <a class="header_link" id="menu_link" onclick="displayPage(this, 'Menu'); showFooter();">Menu</a>

        <!-- Byte Delight Logo -->
        <img src="assets/BDlogo.png" class="logo">

        <!-- About Link (using toggle_pages.js and toggle_footer.js) -->
        <a class="header_link" id="about_link" onclick="displayPage(this, 'About'); showFooter();">About</a>

        <!-- Blog Link (using toggle_pages.js and toggle_footer.js) -->
        <a class="header_link" id="blog_link" onclick="displayPage(this, 'Blog'); showFooter();">Blog</a>

        <!-- Cart Button -->
        <img src="assets/cart.png" class="cart" onclick="showModal(); loadCartModal('modals/cart.php', 'modal', true);">
    </header>


    <!-- 



        ////// PAGES SECTION //////



    -->

    <!-- HOME (initially displayed) -->
    <div id="home">

        <!-- Byte Delight Heading -->
        <h1>Byte <b>Delight</b></h1>

        <!-- Byte Delight Description -->
        <p>
            a Café that offers technologically-advanced experience, where you can satisfy your cravings and your curiosity, experiencing the best of both worlds.
        </p>

        <!-- Start the Delight Button (using toggle_pages.js and toggle_footer.js) -->
        <a onclick="displayPage(document.getElementById('menu_link'), 'Menu'); showFooter();">Start the Delight</a>
    </div>

    <!-- MENU (initially hidden) -->
    <div id="menu">

        <!-- Menu Title DIV -->
        <div class="title">

            <!-- Welcome to Subheading -->
            <p class="welcome">WELCOME TO</p>

            <!-- Our Menu Heading -->
            <h1>Our <b>Menu</b></h1>

            <!-- Menu Description -->
            <p>
                Our menu offers a variety of options for drinks and pastries. From hearty breads and specialty hot & cold drinks, we've got you covered! We also offer a friendly company from our staffs, and futuristic atmosphere, so come and visit us!
            </p>
        </div>

        <!-- Menu List DIV -->
        <div class="menu_list">

            <!-- PHP for displaying menu list derived from the database -->
            <?php

                // SQL search for all menu products arranged by id ascendingly
                $sql = "SELECT * from menu_products ORDER BY ID ASC";

                // Check if result is successful from performing SQL search
                if ($result = $conn->query($sql)){

                    // set $i to 1
                    $i = 1;

                    // While loop for iterating through the whole result array
                    while ($product = $result->fetch_assoc()) {
            ?>

            <!-- Create form with id cart_form + current value of $i -->
            <form id="cart_form<?php echo $i ?>" method="POST">

                <!-- Hidden input passing on the value of product ID from database -->
                <input type="hidden" name="ID" value="<?php echo $product["ID"] ?>">

                <!-- Hidden input passing on the value of product name from database -->
                <input type="hidden" name="product" value="<?php echo $product["name"] ?>">

                <!-- Hidden input passing on the value of product image from database -->
                <input type="hidden" name="image" value="<?php echo $product["image"] ?>">

                <!-- Hidden input passing on the value of product price from database -->
                <input type="hidden" name="price" value="<?php echo $product["price"] ?>">

                <!-- Image input type with the source of productname.png and onclick of showAddedtoCart() -->
                <input type="image" src="assets/<?php echo $product["name"] ?>.png" onclick="showAddedtoCart();">
            </form>

            <?php

                    // Increment $i by 1
                    $i++;

                    }
                }
            ?>
        </div>

        <!-- Booking DIV-->
        <div class="book">

            <!-- Left Design DIV-->
            <div class="left">

                <!-- Skip the line Text -->
                <p class="reveal left">SKIP THE LINE</p>

                <!-- Book Now Heading -->
                <h1 class="reveal left">Book <b>Now</b></h1>
            </div>

            <!-- Right Design DIV -->
            <div class="right">

                <!-- Book a reservation Text -->
                <p>Book a reservation now to enjoy a line & hassle free visit in our cafe!</p>
                
                <!-- Book Now Button -->
                <a>BOOK NOW</a>
            </div>
        </div>
    </div>

    <!-- ABOUT (initially hidden) -->
    <div id="about">

        <!-- About us DIV -->
        <div class="about_us">

            <!-- Side Design DIV -->
            <div class="side_design"></div>

            <!-- About Info DIV -->
            <div class="about_info">

                <!-- About Us Heading -->
                <h1 class="revealUp">About us</h1>

                <!-- About Us Description -->
                <p class="revealUp">
                    At our Café, we believe that the marriage of technology and food is a match made in heaven. 
                    We're not content with just serving up tasty meals - we want to push the boundaries of what's possible 
                    and offer our customers an experience that's both innovative and immersive. With a focus on cutting-edge 
                    technology, we're on a mission to create an atmosphere that satisfies both your hunger and your curiosity. <br><br>

                    From interactive menus and ordering systems to immersive dining experiences, we're always striving to bring 
                    the latest innovations to our customers.

                </p>
            </div>
        </div>

        <!-- Our Story DIV -->
        <div class="our_story">

            <!-- Our Story Heading DIV -->
            <div class="heading">

                <!-- Our Story Heading -->
                <h1>Our Story</h1>

                <!-- Cup of Coffee Image -->
                <img src="assets/about_cup.png" class="reveal up">
            </div>

            <!-- Story Info DIV -->
            <div class="story_info">

                <!-- Story Info Description -->
                <p class="reveal left">
                    Our Cafe is more than just a place to grab a bite to eat; it's a hub for innovation and a beacon of 
                    sustainability. We are committed to sourcing our ingredients responsibly, reducing our waste output, 
                    and utilizing energy-efficient equipment. Our menu is fully digital, allowing for a seamless and contactless 
                    ordering experience. <br><br>
                    
                    We are also heavily involved in our local community, participating in events and 
                    initiatives that support our neighbors. We value our employees and treat them with respect and fairness, 
                    ensuring a positive work environment that translates into an exceptional customer experience. At our Cafe, 
                    you'll not only satisfy your hunger but also learn about the importance of socially responsible practices 
                    in the food industry.
                </p>

                <!-- Story Images Row DIV -->
                <div class="story_row">

                    <!-- Story Images Row -->
                    <img src="assets/story_img1.png">
                    <img src="assets/story_img2.png">
                    <img src="assets/story_img3.png">
                </div>
            </div>
        </div>

        <!-- Meet our team DIV -->
        <div class="meet_our_team">

            <!-- Meet our team Heading DIV -->
            <div class="heading">

                <!-- Meet our team Heading -->
                <h1>MEET OUR TEAM</h1>
            </div>

            <!-- Team DIV -->
            <div class="team">

                <!-- Erlin Image -->
                <img src="assets/erlin.png" class="reveal up">

                <!-- Hans Image -->
                <img src="assets/hans.png" class="reveal up">

                <!-- Gerald Image -->
                <img src="assets/gerald.png" class="reveal up">

                <!-- Christian Image -->
                <img src="assets/christian.png" class="reveal up">

                <!-- Charlie Image -->
                <img src="assets/charlie.png" class="reveal up">

                <!-- Arjae Image -->
                <img src="assets/arjae.png" class="reveal up">

                <!-- Geremy Image -->
                <img src="assets/geremy.png" class="reveal up">
            </div>
        </div>
    </div>

    <!-- BLOG (initially hidden) -->
    <div id="blog">

        <!-- Blog Title DIV -->
        <div class="title">

            <!-- Blog Title Image -->
            <img src="assets/blog_title.png">
        </div>

        <!-- Our Blog DIV -->
        <div class="our_blog">

            <!-- Youtube Iframe -->
            <iframe src="https://www.youtube.com/embed/Aaqc2jFcYO8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            
            <!-- Our Blog Content DIV -->
            <div class="content">

                <!-- Our Blog Heading -->
                <h1 class="reveal left">Our <b>Blog</b></h1>

                <!-- Our Blog Description -->
                <p class="reveal left">
                    At our Café, we believe that the marriage of technology and food is a match made in heaven. 
                    We're not content with just serving up tasty meals - we want to push the boundaries of what's possible 
                    and offer our customers an experience that's both innovative and immersive. With a focus on cutting-edge 
                    technology, we're on a mission to create an atmosphere that satisfies both your hunger and your curiosity.

                </p>
            </div>
        </div>

        <!-- Recipes Revealed DIV -->
        <div class="recipes_revealed">

            <!-- Recipes Revealed Heading DIV -->
            <div class="heading">

                <!-- Line Image -->
                <img src="assets/line.png">

                <!-- Recipes Revealed Heading -->
                <h1>RECIPES <b>REVEALED</b></h1>

                <!-- Line Image -->
                <img src="assets/line.png">
            </div>

            <!-- Recipes DIV -->
            <div class="recipes">

                <!-- Strawberry Cheesecake Recipe -->
                <img src="assets/strawberry_cheesecake.png" class="reveal up" onclick="showModal(); loadModal('modals/strawberry.html', 'modal');">
                <img src="assets/hot_choco.png" class="reveal up" onclick="showModal(); loadModal('modals/hot_choco.html', 'modal');">
                <img src="assets/milk_choco.png" class="reveal up" onclick="showModal(); loadModal('modals/milk_choco.html', 'modal');">
                <img src="assets/dark_choco.png" class="reveal up" onclick="showModal(); loadModal('modals/dark_choco.html', 'modal');">
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>

        <!-- Contact Us DIV -->
        <div class="contact_us">

            <!-- Form DIV -->
            <div class="form_div">

                <!-- Question DIV -->
                <div class="question">

                    <!-- Feedback Question -->
                    <p>DO YOU HAVE QUESTIONS OR ANY FEEDBACKS?</p>

                    <!-- Write Email Text -->
                    <p class="cursive">write us an email</p>
                </div>

                <!-- Feedback Form (show thank you modal on submit) -->
                <form id="feedback_form" method="POST" onsubmit="showModal(); loadModal('modals/thank_you_feedback.html', 'modal');">

                    <!-- Text Input DIV -->
                    <div class="text_input">

                        <!-- Name Input -->
                        <input type="text" placeholder="Name" name="Name" maxlength="25" required><br>

                        <!-- Email Input -->
                        <input type="text" placeholder="Email" name="Email" maxlength="30" required><br>

                        <!-- Subject Input -->
                        <input type="text" placeholder="Subject" name="Subject" maxlength="30" required>
                    </div>

                    <!-- Textarea Input DIV -->
                    <div class="textarea_input">

                        <!-- Message Input -->
                        <textarea placeholder="Start writing..." name="Message" required></textarea>

                        <!-- Send Email Button -->
                        <input type="submit" value="SEND EMAIL" name="feedback_submit">
                    </div>
                    
                </form>
            </div>

            <!-- Social DIV -->
            <div class="social">

                <!-- Stay Connected Text -->
                <p>LET'S STAY CONNECTED!</p>

                <!-- Follow us Text -->
                <p class="cursive">follow us on all our social media accounts!</p>

                <!-- Social Media Logos -->
                <div class="logos">
                    
                    <!-- Facebook -->
                    <a><img src="assets/facebook.png"></a>

                    <!-- Instagram -->
                    <a><img src="assets/instagram.png"></a>

                    <!-- Tiktok -->
                    <a><img src="assets/tiktok.png"></a>
                </div>

                <!-- Byte Delight Gmail -->
                <p class="cursive">ByteDelightOfficial@gmail.com</p>
            </div>
        </div>

        <!-- Copyright DIV -->
        <div class="copyright">

            <!-- Copyright Text -->
            <p>&copy; All Rights Reserved 2023 ByteDelight</p>
        </div>
    </footer>


    <!-- MODALS -->

    <!-- CART MODAL -->
    <div id="modal">

        <!-- Content will be loaded through AJAX_htmlreq.js and toggle_modal.js -->
    </div>

    <!-- ADDED TO CART MODAL -->
    <div id="added_to_cart_modal">

        <!-- Content DIV -->
        <div class="content">

            <!-- Added to Cart Heading -->
            <h1>Added to Cart</h1>

            <!-- Right DIV -->
            <div class="right">
                
                <!-- View Cart Button (with functions to hide this modal and showModal and loadCartModal)-->
                <a onclick="hideAddedtoCart(); showModal(); loadCartModal('modals/cart.php', 'modal', true);">View Cart</a>

                <!-- Close Button -->
                <div class="close" onclick="hideAddedtoCart();">&times;</div>
            </div>
        </div>
    </div>

    <!-- JAVSCRIPTS -->
    <script src="javascript/AJAX_postform.js"></script>
    <script src="javascript/AJAX_htmlreq.js"></script>
    <script src="javascript/bg_music.js"></script>
    <script src="javascript/reveal_animation.js"></script>
    <script src="javascript/send_email.js"></script>
    <script src="javascript/toggle_modal.js"></script>
    <script src="javascript/toggle_pages.js"></script>
    <script src="javascript/toggle_footer.js"></script>

    <?php 

    // PHP for loading the current page whenever user reloads the page (for better user experience)

    // Check if Current Page Session is set
    if(isset($_SESSION["current_page"])){

        // Check for the value of Current Page Session
        switch($_SESSION["current_page"]){

            // Case for Home
            case "home":

                // Use displayPage function to display Home Page on load of window
                echo "<script>window.onload = displayPage(document.getElementById('home_link'), 'Home'); hideFooter();</script>";
                break;
    
            // Case for Menu
            case "menu":

                // Use displayPage function to display Menu Page on load of window
                echo "<script>window.onload = displayPage(document.getElementById('menu_link'), 'Menu'); showFooter()</script>";
                break;
    
            // Case for About
            case "about":

                // Use displayPage function to display About Page on load of window
                echo "<script>window.onload = displayPage(document.getElementById('about_link'), 'About'); showFooter();</script>";
                break;
    
            // Case for Blog
            case "blog":

                // Use displayPage function to display Blog Page on load of window
                echo "<script>window.onload = displayPage(document.getElementById('blog_link'), 'Blog'); showFooter();</script>";
                break;
        }
    }

    // Current Page Session must not be set
    else {

        // Set Current Page Session Variable to Home
        $_SESSION["current_page"] = "home";

        // Use displayPage function to display Home Page on load of window
        echo "<script>window.onload = displayPage(document.getElementById('home_link'), 'Home'); hideFooter();</script>";
    }

    ?>
    
</body>
<html>