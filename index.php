<?php
session_start();
include_once("functions.php");
$_SESSION["selected_page_user"] = "home";

if(isset($_GET["product"])){
    $_SESSION["product_name"] = $_GET["name"];
}
?>
<?php include_once("meta.php"); ?>
<body>
    <?php include_once("header.php"); ?>
    <div class="main-body">
        <div class="container">
    <main>
        <div class="container">
        <?php if(isset($_GET["search"]) && isset($_GET["keywords"]) && $_GET["keywords"] != NULL): ?>

            <?php search($_GET["keywords"]); ?>

        <?php else: ?>

            <h1 class="section-header">Latest Smart Phones Right Now</h1>
            <?php
                $sql = "SELECT `phone_id`,`phone_image_filename`,`phone_model`,`phone_price`,`phone_internal_memory_size`,`phone_external_memory_size`,`phone_ram`,`phone_display_size`,`phone_display_resolution_high`,`phone_display_resolution_low`,`phone_primary_camera_pixel_size`,`phone_secondary_camera_pixel_size`,`phone_battery_size`,`phone_cpu_chipset`,`file_name` FROM phones ORDER BY phone_launch DESC LIMIT 10";
                show_all_product("phones",$sql);

            ?>
            <h1 class="section-header">Latest Tablets This year</h1>
            <?php

                $sql = "SELECT `tablet_id`,`tablet_image_filename`,`tablet_model`,`tablet_price`,`tablet_internal_memory_size`,`tablet_external_memory_size`,`tablet_ram`,`tablet_display_size`,`tablet_display_resolution_high`,`tablet_display_resolution_low`,`tablet_primary_camera_pixel_size`,`tablet_secondary_camera_pixel_size`,`tablet_battery_size`,`tablet_cpu_chipset`,`file_name` FROM tablets ORDER BY tablet_launch DESC LIMIT 10";
                show_all_product("tablets",$sql);

            ?>
            <h1 class="section-header">New Laptops Launched Recently</h1>
            <?php

                $sql = "SELECT `laptop_id`,`laptop_image_filename`,`laptop_model`,`laptop_price`,`file_name` FROM laptops ORDER BY laptop_launch_date DESC LIMIT 10";
                show_all_product("laptops",$sql);

            ?>
            <?php /*echo "<h1 class=\"section-header\">Our Blog</h1>"; extract_articles("published");*/ ?>

        <?php endif ?>
        </div>
    </main>
    <?php include_once("aside.php"); ?>
        </div>
</div>
    <?php include_once("footer.php"); ?>
</body>
</html>
