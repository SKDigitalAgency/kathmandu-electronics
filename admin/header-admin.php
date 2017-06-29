<?php // include_once("facebook_sdk.php"); ?>
<?php // include_once("facebook_buttons_api.php"); ?>
<?php include_once("google_analytics.php"); ?>
<div class="top">
    <div class="container">
        <div class="top-logo-section">
            <h1 class="logo-text"><a href="http://www.kathmanduelectronics.com//admin">KE</a></h1>
        </div>
        <div class="nav-mobile-place-holder">
            <a href="#">Menu</a>
        </div>
        <!--navigation start-->
        <nav id="nav-admin">
            <ul>
                <li><a <?php if($_SESSION["selected_page"] == "admin-dashboard"){echo "id=\"current_menu\" ";} ?>href="admin-dashboard.php">Home</a></li>
                <li><a href="../process/attempt-logout.php">Logout</a></li>
                <li><a <?php if($_SESSION["selected_page"] == "submit-phone"){echo "id=\"current_menu\" ";} ?>href="submit-phone.php">Submit Phone</a></li>
                <li><a <?php if($_SESSION["selected_page"] == "submit-tablet"){echo "id=\"current_menu\" ";} ?>href="submit-tablet.php">Submit Tablet</a></li>
                <li><a <?php if($_SESSION["selected_page"] == "submit-laptop"){echo "id=\"current_menu\" ";} ?>href="submit-laptop.php">Submit Laptop</a></li>
                <li><a <?php if($_SESSION["selected_page"] == "submit-store"){echo "id=\"current_menu\" ";} ?>href="submit-store.php">Submit Store</a></li>
                <li><a <?php if($_SESSION["selected_page"] == "manage-website"){echo "id=\"current_menu\" ";} ?>href="manage-website.php">Manage Website</a></li>
                <li><a <?php if($_SESSION["selected_page"] == "submit-article"){echo "id=\"current_menu\" ";} ?>href="submit-article.php">Submit Article</a></li>
            </ul>
        </nav>
        <!--navigation end-->
    </div>
</div>
