<?php
    session_start();
    include_once("functions.php");
    $_SESSION["selected_page_user"] = "phones";
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

            <h1 class="section-header">All Phones</h1>
            <?php

                if(!isset($_GET["page"])){
                    $_GET["page"] = 1;
                }
                $page_no = (int)($_GET["page"]);
                $offset = ($page_no - 1) * 25;
                $sql = "SELECT `phone_id`,`phone_image_filename`,`phone_model`,`phone_price`,`phone_internal_memory_size`,`phone_external_memory_size`,`phone_ram`,`phone_display_size`,`phone_display_resolution_high`,`phone_display_resolution_low`,`phone_primary_camera_pixel_size`,`phone_secondary_camera_pixel_size`,`phone_battery_size`,`phone_cpu_chipset`,`file_name` FROM phones ORDER BY phone_launch DESC LIMIT 25 OFFSET $offset";
                show_all_product("phones",$sql);

                if(!isset($conn1)){
                    $conn1 = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
                }
                $sql1 = "SELECT * FROM phones";
                $result1 =  mysqli_query($conn1,$sql1);
                $product_count = mysqli_num_rows($result1);
                $page_count = $product_count/25;
                if(($product_count % 25) > 0){
                    $page_count++;
                }
                echo "<div class=\"pages\">";
                for($i = 1;$i <= $page_count;$i++){
                    if($page_no = $i){
                        echo "<a class=\"page_link\" id=\"current_page_link\" href=\"?page=$i\">$i</a>";
                    }else{
                        echo "<a class=\"page_link\" href=\"?page=$i\">$i</a>";
                    }
                }
                echo "</div>";
            ?>

        <?php endif ?>
        </div>
    </main>
    <?php include_once("aside.php"); ?>
        </div>
    </div>
    <?php include_once("footer.php"); ?>
    <!-- infolinks ads start-->
    <script type="text/javascript">
        var infolinks_pid = 3015466;
        var infolinks_wsid = 0;
    </script>
    <script type="text/javascript" src="//resources.infolinks.com/js/infolinks_main.js"></script>
    <!-- infolinks ads end-->
</body>
</html>
