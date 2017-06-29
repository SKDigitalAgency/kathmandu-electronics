<?php // include_once("facebook_sdk.php"); ?>
<?php // include_once("facebook_buttons_api.php"); ?>
<?php include_once("facebook_comments_api.php"); ?>
<?php include_once("google_analytics.php"); ?>
 <div class="top">
     <div class="container">
        <div class="top-logo-section">
            <h1 class="logo-text-desktop"><a href="http://www.kathmanduelectronics.com">KATHMANDU ELECTRONICS</a></h1>
            <h1 class="logo-text-mobile"><a href="http://www.kathmanduelectronics.com">KE</a></h1>
        </div>
         <div class="nav-mobile-place-holder">
             <a href="#"><img class="menu-icon" src="http://www.kathmanduelectronics.com/images/icon-svg-menu.svg" alt="menu icon" /></a>
         </div>
         <div class="search-mobile-place-holder">
             <a href="#"><img class="menu-icon" src="http://www.kathmanduelectronics.com/images/icon-svg-search.svg" alt="search icon" /></a>
         </div>
        <div class="top-search-section">
            <form action="" method="GET">
                <p class="search-fields-container">
                    <input class="search-input-text" type="text" name="keywords" value=""/>
                    <input class="search-button" type="submit" name="search" value="Search" />
                </p>
            </form>
        </div>
     </div>
     <nav>
         <div class="container">
             <ul class="nav-links">
                 <li><a <?php if($_SESSION["selected_page_user"] == "home"){echo "id=\"current_menu\" ";} ?>href="http://www.kathmanduelectronics.com"> Home </a></li>
                 <li><a <?php if($_SESSION["selected_page_user"] == "phones"){echo "id=\"current_menu\" ";} ?>href="http://www.kathmanduelectronics.com/phones.php"> Phones </a></li>
                 <li><a <?php if($_SESSION["selected_page_user"] == "tablets"){echo "id=\"current_menu\" ";} ?>href="http://www.kathmanduelectronics.com/tablets.php"> Tablets </a></li>
                 <li><a <?php if($_SESSION["selected_page_user"] == "laptops"){echo "id=\"current_menu\" ";} ?>href="http://www.kathmanduelectronics.com/laptops.php"> Laptops </a></li>
                 <li><a <?php if($_SESSION["selected_page_user"] == "filter"){echo "id=\"current_menu\" ";} ?>class="top-filter-button" href="http://www.kathmanduelectronics.com/filter.php">Filter</a></li>
                 <li><a <?php if($_SESSION["selected_page_user"] == "blog"){echo "id=\"current_menu\" ";} ?>href="http://www.kathmanduelectronics.com/blog.php">Blog</a></li>
             </ul>
         </div>
     </nav>
 </div>