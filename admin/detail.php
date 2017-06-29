<?php ob_start();
session_start();
include_once("../functions.php");
if(!check_login()){
    header("Location: http://www.kathmanduelectronics.com/admin");
    ob_end_flush();
    exit();
}
$_SESSION["selected_page"] = "submit-phone";
?>
<?php include_once ("meta-admin.php"); ?>
<body>
<div class="container">
    <?php include_once ("header-admin.php"); ?>
    <main>
        <div class="container">
            <?php

            if(!isset($conn)){
                $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
            }
            if(isset($_GET["action"]) && $_GET["action"] == "delete"){
                foreach($_GET as $key => $value){
                    switch($key){
                        case "phone":
                            $sql1 = "DELETE FROM `phones` WHERE file_name = '".$value."'";
                            break;
                        case "tablet":
                            $sql1 = "DELETE FROM `tablets` WHERE file_name = '".$value."'";
                            break;
                        case "laptop":
                            $sql1 = "DELETE FROM `laptops` WHERE file_name = '".$value."'";
                            break;
                        case "store":
                            $sql1 = "DELETE FROM `stores` WHERE store_name = '".$value."'";
                            break;
                    }
                    if($key !== "store"){
                        $sql2 = "DELETE FROM `pages` WHERE page_name = '".$value."'";
                        if(mysqli_query($conn,$sql1) && mysqli_query($conn,$sql2)){
                            header("Location: manage-website.php");
                            ob_end_flush();
                            exit();
                        }
                    }
                }
            }
            foreach($_GET as $key => $value){
                if($key == "page" || $key == "phone" || $key == "tablet" || $key == "laptop" || $key == "store"){
                    $context = $key;
                    $item = $value;
                }
            }
            echo "<br />";
            switch($context){
                case "page":
                    echo "<a href=\"submit-page-info.php?$context=$_GET[$context]&&action=edit\">Update</a><br />";
                    $sql = "SELECT * FROM pages WHERE page_name = '$item'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        foreach($row as $key => $value){
                            if($value == NULL){
                                echo "N/A<br />";
                                $_SESSION[$key] = $value;
                            }else{
                                echo $value."<br />";
                                $_SESSION[$key] = $value;
                            }
                        }
                    }
                    break;
                case "phone":
                    echo "<a href=\"submit-phone.php?$context=$_GET[$context]&&action=edit\">Update</a><br />";
                    echo "<a href=\"detail.php?phone=".$item."&&action=delete\">Delete</a><br />";
                    $sql = "SELECT * FROM phones WHERE file_name = '$item'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        foreach($row as $key => $value) {
                            if ($key == "phone_network" || $key == "phone_alert_types" || $key == "phone_sensors" || $key == "phone_messaging" || $key == "phone_other_features" || $key == "phone_colors") {
                                $value = unserialize($value);
                                foreach($value as $k => $v){
                                    if($v == NULL){
                                        echo "N/A<br />";
                                    }else{
                                        echo $v . "<br />";
                                    }
                                }
                            }else{
                                if($value == NULL){
                                    echo "N/A<br />";
                                }else{
                                    echo $value."<br />";
                                }
                            }
                        }
                    }
                    break;
                case "tablet":
                    echo "<a href=\"submit-tablet.php?$context=$_GET[$context]&&action=edit\">Update</a><br />";
                    echo "<a href=\"detail.php?tablet=".$item."&&action=delete\">Delete</a><br />";
                    $sql = "SELECT * FROM tablets WHERE file_name = '$item'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        foreach($row as $key => $value) {
                            if ($key == "tablet_network" || $key == "tablet_alert_types" || $key == "tablet_sensors" || $key == "tablet_messaging" || $key == "tablet_other_features" || $key == "tablet_colors") {
                                $value = unserialize($value);
                                foreach($value as $k => $v) {
                                    if($v == NULL){
                                        echo "N/A<br />";
                                        $_SESSION[$key] = $value;
                                    }else{
                                        echo $v . "<br />";
                                        $_SESSION[$key] = $value;
                                    }
                                }
                            }else{
                                if($value == NULL){
                                    echo "N/A<br />";
                                    $_SESSION[$key] = $value;
                                }else{
                                    echo $value."<br />";
                                    $_SESSION[$key] = $value;
                                }
                            }
                        }
                    }
                    break;
                case "laptop":
                    echo "<a href=\"submit-laptop.php?$context=$_GET[$context]&&action=edit\">Update</a><br />";
                    echo "<a href=\"detail.php?laptop=".$item."&&action=delete\">Delete</a><br />";
                    $sql = "SELECT * FROM laptops WHERE file_name = '$item'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)) {
                        foreach ($row as $key => $value) {
                            if ($key == "laptop_connectivity_and_ports" || $key == "laptop_other_features" || $key == "laptop_colors") {
                                $value = unserialize($value);
                                foreach($value as $k => $v) {
                                    if($v == NULL){
                                        echo "N/A<br />";
                                        $_SESSION[$key] = $value;
                                    }else{
                                        echo $v . "<br />";
                                        $_SESSION[$key] = $value;
                                    }
                                }
                            }else{
                                if($value == NULL){
                                    echo "N/A<br />";
                                    $_SESSION[$key] = $value;
                                }else{
                                    echo $value."<br />";
                                    $_SESSION[$key] = $value;
                                }
                            }
                        }
                    }
                    break;
                case "store":
                    echo "<a href=\"submit-store.php?$context=$_GET[$context]&&action=edit\">Update</a><br />";
                    echo "<a href=\"detail.php?store=".$item."&&action=delete\">Delete</a><br />";
                    $sql = "SELECT * FROM stores WHERE store_name = '$item'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        foreach($row as $key => $value) {
                            echo $value . "<br />";
                        }
                    }
                    break;
            }
            echo "</form>";

            ?>
        </div>
    </main>
    <?php include_once ("aside-admin.php"); ?>
    <?php include_once ("footer-admin.php"); ?>
</div>
<script>
    (function(){
        var count = ($(".availability_input").length)/4;
        $(".add_availability").click(function(){
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(){
                if((xhr.readyState == 4) && (xhr.status == 200 || xhr.status == 304)){
                    var xml = xhr.responseXML, $xml = $( xml );

                    var $new_form_section = $("<div class=\"form-section\"></div>");
                    var $label_availability_store_name = $("<label class=\"flt_left\" for=\"selectfield-availability-store-name\">Store Name</label>");
                    var $select_availability_store_name = $("<select class=\"availability_input\" id=\"selectfield-availability-store-name\" name=\"availability["+count+"][]\"></select>");
                    $xml.find("store_name").each(function(idx, v){
                        var $option_availability_store_name = $("<option></option>");
                        var $option_availability_store_name_value = $(v).text();
                        $option_availability_store_name.append($option_availability_store_name_value);
                        $select_availability_store_name.append($option_availability_store_name);
                    });
                    var $p1 = $("<p></p>");
                    $p1.append($label_availability_store_name);
                    $p1.append($select_availability_store_name);

                    var $label_availability_location = $("<label class=\"flt_left\" for=\"selectfield-availability-location\">Store Name</label>");
                    var $select_availability_location = $("<select class=\"availability_input\" id=\"selectfield-availability-location\" name=\"availability["+count+"][]\"></select>");
                    $xml.find("store_location").each(function(idx, v){
                        var $option_availability_location = $("<option></option>");
                        var $option_availability_location_value = $(v).text();
                        $option_availability_location.append($option_availability_location_value);
                        $select_availability_location.append($option_availability_location);
                    });
                    var $p2 = $("<p></p>");
                    $p2.append($label_availability_location);
                    $p2.append($select_availability_location);

                    var $label_availability_price = $("<label class=\"flt_left\">Price</label>");
                    var $input_availability_price = $("<input class=\"availability_input\" type=\"text\" name=\"availability["+count+"][]\" />");
                    var $p3 = $("<p></p>");
                    $p3.append($label_availability_price);
                    $p3.append($input_availability_price);

                    var $label_availability_note = $("<label class=\"flt_left\">Addition Information</label>");
                    var $input_availability_note = $("<textarea class=\"availability_input\" type=\"text\" name=\"availability["+count+"][]\"></textarea>");
                    var $p4 = $("<p></p>");
                    $p4.append($label_availability_note);
                    $p4.append($input_availability_note);

                    var $remove_button = $("<input type=\"button\" class=\"remove_availability_form_section\" value=\"Remove\" />");

                    $new_form_section.append($p1);
                    $new_form_section.append($p2);
                    $new_form_section.append($p3);
                    $new_form_section.append($p4);
                    $new_form_section.append($remove_button);

                    $(".submit_phone_form").append($new_form_section);
                    count++;

                    $('.remove_availability_form_section').bind('click', function ()
                    {
                        $(this).parent(".form-section").remove();
                        count--;
                    });
                }
            };
            xhr.open("POST", "process-add-availability.php", true);
            xhr.send("");
        });
        $('input.remove_availability_form_section').click(function ()
        {
            $(this).parent(".form-section").remove();
        });
    })();
</script>
</body>
</html>
