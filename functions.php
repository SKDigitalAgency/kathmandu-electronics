<?php

function attempt_login(){

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

        $hostname = "localhost";
        $dbusername = $username;
        $dbpassword = $pwd;
        if($_POST["username"] == NULL || $_POST["pwd"] == NULL){
            echo "<p class=\"message_empty\">Please enter username and password.</p>";
        }else{
            mysqli_connect($hostname, $dbusername, $dbpassword);
            if(mysqli_connect_errno()){
                echo "<p class=\"message_incorrect\">Incorrect username or password.</p>";
            }else{
                $_SESSION["logged_in"] = 1;
                $_SESSION["username"] = $username;
                    header("Location: admin-dashboard.php");
                    ob_end_flush();
                    exit();
            }
        }
}

function check_login(){
    if(isset($_SESSION["logged_in"]) && isset($_SESSION["username"])){
        return TRUE;
    }
}

function show_phone_details_by_id($phone_id){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }

    // extracting availability
    $sql = "SELECT * FROM `availability_phones` WHERE phone_id = ".$phone_id;
    $result = mysqli_query($conn,$sql);
        echo "<div class=\"detail_menu\">";
            echo "<input type=\"button\" class=\"show_availability\" name=\"show_availability\" value=\"Availability &amp; Price\" />";
            echo "<input type=\"button\" id=\"current_detail_menu\" class=\"show_full_specification\" name=\"show_full_specification\" value=\"Specification\" />";
        echo "</div>";

    if(mysqli_num_rows($result) > 0){
        echo "<div class=\"availability-section\">";
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class=\"availability\">";
            echo "<p class=\"availability_price\">NRs. ".$row["price"]."</p>";
            echo "<p class=\"availability_store_name\">".$row["store_name"]."</p>";
            echo "<p class=\"availability_store_location\">".$row["store_location"]."</p>";
            echo "<p class=\"availability_note\">".$row["note"]."</p>";
            echo "</div>";
        }
        echo "</div>";
    }else{
        echo "<div class=\"availability-section\">";
        echo "<p class=\"no_availability_info\">No availability information.</p>";
        echo "</div>";
    }

    // extracting full specification

    $sql = "SELECT * FROM phones WHERE phone_id = '".mysqli_real_escape_string($conn,$phone_id)."'";
    $result = mysqli_query($conn,$sql);
    echo "<div class=\"full-specification-section\">";
    echo "<table class=\"full_specification_table\">";
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if($key == "phone_image_filename"){
                echo "<img class=\"product-image\" src=\"../images/".$row["phone_image_filename"]."\" alt=\"".$row["phone_model"]."\" />";
            }
            if($key != "phone_id" && $key != "phone_submitter" && $key != "phone_submitted_date" && $key != "file_name" && $key != "phone_image_filename"){
                if($key == "phone_network" || $key == "phone_alert_types" || $key == "phone_sensors" || $key == "phone_messaging" || $key == "phone_other_features" || $key == "phone_colors"){
                    $key = remove_substring($key,"phone_");
                    $key = preg_replace("/[_]+/"," ",$key);
                    echo "<tr><th>".$key."</th>";
                    $value = unserialize($value);
                    echo "<td>";
                        if($value){
                            if($key == "other features"){
                                echo implode("<br />",$value);
                            }else{
                                echo implode(", ",$value);
                            }
                        }else{
                            echo "N/A";
                        }
                    echo "</td></tr>";
                }else{
                    $key = remove_substring($key,"phone_");
                    $key = preg_replace("/[_]+/"," ",$key);
                    if($key != "height" && $key != "width" && $key != "thickness" && $key != "sim size" && $key != "sim count" && $key !="display type" && $key != "display size" && $key != "screen to body ratio" && $key != "display resolution high" && $key != "display resolution low" && $key != "cpu chipset" && $key != "cpu core count" && $key != "cpu clock freq" && $key != "cpu model" && $key != "primary camera pixel size" && $key != "primary camera description" && $key !== "secondary camera pixel size" && $key != "secondary camera description" && $key != "battery size" && $key != "battery removable" && $key != "battery type"){
                        echo "<tr><th>".$key."</th>";
                        echo "<td>";
                    }
                        if($key == "launch"){
                            $date = $value;
                            $month = date("F",strtotime($date));
                            $year = date("Y",strtotime($date));
                            echo $year." ".$month;
                        }else if($key == "height" || $key == "width" || $key == "thickness"){
                            $dimension[] = $value;
                            if(count($dimension) == 3){
                                echo "<tr><th>Body</th>";
                                echo "<td>";
                                echo implode(" x ",$dimension) . " mm";
                            }
                        }else if($key == "weight"){
                            echo $value . " g";
                        }else if($key == "sim size"){
                            if($row["phone_sim_count"] == "1"){
                                $row["phone_sim_count"] = "Single";
                            }else if($row["phone_sim_count"] == "2"){
                                $row["phone_sim_count"] = "Dual";
                            }else if($row["phone_sim_count"] == "2"){
                                $row["phone_sim_count"] = "Triple";
                            }else if($row["sim_count"] == "4"){
                                $row["phone_sim_count"] = "Quad";
                            }else{
                                // do nothing
                            }
                            $sim = $row["phone_sim_count"]." , ".$row["phone_sim_size"];
                            echo "<tr><th>SIM</th>";
                            echo "<td>";
                            echo $sim;
                        }else if($key == "sim count"){
                            // do nothing
                        }else if($key == "price"){
                            if($value == NULL){
                                echo "N/A";
                            }else{
                                echo "NRs. ".$value;
                            }
                        }else if($key == "display type"){
                            $display = $row["phone_display_type"]." ".$row["phone_display_size"]." inch ".$row["phone_display_resolution_high"]." x ".$row["phone_display_resolution_low"]." pixels ".$row["phone_screen_to_body_ratio"]."% screen-to-body ratio";
                            echo "<tr><th>Display</th>";
                            echo "<td>";
                            echo $display;
                        }else if($key == "display size" || $key == "screen to body ratio" || $key == "display resolution high" || $key == "display resolution low"){
                            // do nothing
                        }else if($key == "cpu clock freq"){
                            if($row["phone_cpu_core_count"] == "1"){
                                $row["phone_cpu_core_count"] = "Single-core";
                            }else if($row["phone_cpu_core_count"] == "2"){
                                $row["phone_cpu_core_count"] = "Dual-core";
                            }else if($row["phone_cpu_core_count"] == "3"){
                                $row["phone_cpu_core_count"] = "Triple-core";
                            }else if($row["phone_cpu_core_count"] == "4"){
                                $row["phone_cpu_core_count"] = "Quad-core";
                            }else if($row["phone_cpu_core_count"] == "5"){
                                $row["phone_cpu_core_count"] = "Penta-core";
                            }else if($row["phone_cpu_core_count"] == "6"){
                                $row["phone_cpu_core_count"] = "Hexa-core";
                            }else if($row["phone_cpu_core_count"] == "7"){
                                $row["phone_cpu_core_count"] = "Hepta-core";
                            }else if($row["phone_cpu_core_count"] == "8"){
                                $row["phone_cpu_core_count"] = "Octa-core";
                            }
                            $cpu = $row["phone_cpu_chipset"]." ".$row["phone_cpu_core_count"]." ".$row["phone_cpu_clock_freq"]."GHz ".$row["phone_cpu_model"];
                            echo "<tr><th>CPU</th>";
                            echo "<td>";
                            echo $cpu;
                        }else if($key == "cpu core count" || $key == "cpu chipset" || $key == "cpu model"){
                            // do nothing
                        }else if($key == "external memory size" || $key == "ram" || $key == "internal memory size"){
                            if($value == NULL){
                                echo "N/A";
                            }else{
                                echo $value." GB";
                            }
                        }else if($key == "primary camera pixel size"){
                            echo "<tr><th>Primary Camera</th>";
                            echo "<td>";
                            $primary_camera = $row["phone_primary_camera_pixel_size"]." MP, ".$row["phone_primary_camera_description"];
                            echo $primary_camera;
                        }else if($key == "primary camera description"){
                            // do nothing
                        }else if($key == "secondary camera pixel size"){
                            echo "<tr><th>Secondary Camera</th>";
                            echo "<td>";
                            $secondary_camera = $row["phone_secondary_camera_pixel_size"]." MP, ".$row["phone_secondary_camera_description"];
                            echo $secondary_camera;
                        }else if($key == "secondary camera description"){
                            // do nothing
                        }else if($key == "battery type"){
                            echo "<tr><th>Battery</th>";
                            echo "<td>";
                            if($row["phone_battery_removable"] == "0"){
                                $row["phone_battery_removable"] = "Non-removable";
                            }else{
                                $row["phone_battery_removable"] = "Removable";
                            }
                            $battery = $row["phone_battery_removable"]." ".$row["phone_battery_type"]." ".$row["phone_battery_size"]." mAh";
                            echo $battery;
                        }else if($key == "battery size" || $key == "battery removable"){
                            // do nothing
                        }else{
                            if($key == "multi touch display" || $key == "external memory" || $key == "loudspeaker" || $key == "3 5mm jack" || $key == "radio" || $key == "java" || $key == "battery removable"){
                                if($value == "0"){
                                    $value = "No";
                                }else{
                                    $value = "Yes";
                                }
                            }
                                if($value){
                                    echo $value;
                                }else{
                                    echo "N/A";
                                }
                        }
                    echo "</td></tr>";
                }
            }
        }
    }
    echo "</table>";
    echo "</div>";
    mysqli_close($conn);
}

function show_tablet_details_by_id($tablet_id){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }

// extracting availability
    $sql = "SELECT * FROM `availability_tablets` WHERE tablet_id = ".$tablet_id;
    $result = mysqli_query($conn,$sql);
    echo "<div class=\"detail_menu\">";
        echo "<input type=\"button\" class=\"show_availability\" name=\"show_availability\" value=\"Availability &amp; Price\" />";
        echo "<input type=\"button\" id=\"current_detail_menu\" class=\"show_full_specification\" name=\"show_full_specification\" value=\"Specification\" />";
    echo "</div>";

    if(mysqli_num_rows($result) > 0){
        echo "<div class=\"availability-section\">";
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class=\"availability\">";
            echo "<p class=\"availability_price\">NRs. ".$row["price"]."</p>";
            echo "<p class=\"availability_store_name\">".$row["store_name"]."</p>";
            echo "<p class=\"availability_store_location\">".$row["store_location"]."</p>";
            echo "<p class=\"availability_note\">".$row["note"]."</p>";
            echo "</div>";
        }
        echo "</div>";
    }else{
        echo "<div class=\"availability-section\">";
        echo "<p class=\"no_availability_info\">No availability information.</p>";
        echo "</div>";
    }

// extracting full specification

    $sql = "SELECT * FROM tablets WHERE tablet_id = '".mysqli_real_escape_string($conn,$tablet_id)."'";
    $result = mysqli_query($conn,$sql);
    echo "<div class=\"full-specification-section\">";
    echo "<table class=\"full_specification_table\">";
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if($key == "tablet_image_filename"){
                echo "<img class=\"product-image\" src=\"../images/".$row["tablet_image_filename"]."\" alt=\"".$row["tablet_model"]."\" />";
            }
            if($key != "tablet_id" && $key != "tablet_submitter" && $key != "tablet_submitted_date" && $key != "file_name" && $key != "tablet_image_filename"){
                if($key == "tablet_network" || $key == "tablet_alert_types" || $key == "tablet_sensors" || $key == "tablet_messaging" || $key == "tablet_other_features" || $key == "tablet_colors"){
                    $key = remove_substring($key,"tablet_");
                    $key = preg_replace("/[_]+/"," ",$key);
                    echo "<tr><th>".$key."</th>";
                    $value = unserialize($value);
                    echo "<td>";
                    if($value){
                        if($key == "other features"){
                            echo implode("<br />",$value);
                        }else{
                            echo implode(", ",$value);
                        }
                    }else{
                        echo "N/A";
                    }
                    echo "</td></tr>";
                }else{
                    $key = remove_substring($key,"tablet_");
                    $key = preg_replace("/[_]+/"," ",$key);
                    if($key != "height" && $key != "width" && $key != "thickness" && $key != "sim size" && $key != "sim count" && $key !="display type" && $key != "display size" && $key != "screen to body ratio" && $key != "display resolution high" && $key != "display resolution low" && $key != "cpu chipset" && $key != "cpu core count" && $key != "cpu clock freq" && $key != "cpu model" && $key != "primary camera pixel size" && $key != "primary camera description" && $key !== "secondary camera pixel size" && $key != "secondary camera description" && $key != "battery size" && $key != "battery removable" && $key != "battery type"){
                        echo "<tr><th>".$key."</th>";
                        echo "<td>";
                    }
                    if($key == "launch"){
                        $date = $value;
                        $month = date("F",strtotime($date));
                        $year = date("Y",strtotime($date));
                        echo $year." ".$month;
                    }else if($key == "height" || $key == "width" || $key == "thickness"){
                        $dimension[] = $value;
                        if(count($dimension) == 3){
                            echo "<tr><th>Body</th>";
                            echo "<td>";
                            echo implode(" x ",$dimension) . " mm";
                        }
                    }else if($key == "weight"){
                        echo $value . " g";
                    }else if($key == "sim size"){
                        if($row["tablet_sim_count"] == "1"){
                            $row["tablet_sim_count"] = "Single";
                        }else if($row["tablet_sim_count"] == "2"){
                            $row["tablet_sim_count"] = "Dual";
                        }else if($row["tablet_sim_count"] == "2"){
                            $row["tablet_sim_count"] = "Triple";
                        }else if($row["sim_count"] == "4"){
                            $row["tablet_sim_count"] = "Quad";
                        }else{
                            // do nothing
                        }
                        $sim = $row["tablet_sim_count"]." , ".$row["tablet_sim_size"];
                        echo "<tr><th>SIM</th>";
                        echo "<td>";
                        echo $sim;
                    }else if($key == "sim count"){
                        // do nothing
                    }else if($key == "price"){
                        if($value == NULL){
                            echo "N/A";
                        }else{
                            echo "NRs. ".$value;
                        }
                    }else if($key == "display type"){
                        $display = $row["tablet_display_type"]." ".$row["tablet_display_size"]." inch ".$row["tablet_display_resolution_high"]." x ".$row["tablet_display_resolution_low"]." pixels ".$row["tablet_screen_to_body_ratio"]."% screen-to-body ratio";
                        echo "<tr><th>Display</th>";
                        echo "<td>";
                        echo $display;
                    }else if($key == "display size" || $key == "screen to body ratio" || $key == "display resolution high" || $key == "display resolution low"){
                        // do nothing
                    }else if($key == "cpu clock freq"){
                        if($row["tablet_cpu_core_count"] == "1"){
                            $row["tablet_cpu_core_count"] = "Single-core";
                        }else if($row["tablet_cpu_core_count"] == "2"){
                            $row["tablet_cpu_core_count"] = "Dual-core";
                        }else if($row["tablet_cpu_core_count"] == "3"){
                            $row["tablet_cpu_core_count"] = "Triple-core";
                        }else if($row["tablet_cpu_core_count"] == "4"){
                            $row["tablet_cpu_core_count"] = "Quad-core";
                        }else if($row["tablet_cpu_core_count"] == "5"){
                            $row["tablet_cpu_core_count"] = "Penta-core";
                        }else if($row["tablet_cpu_core_count"] == "6"){
                            $row["tablet_cpu_core_count"] = "Hexa-core";
                        }else if($row["tablet_cpu_core_count"] == "7"){
                            $row["tablet_cpu_core_count"] = "Hepta-core";
                        }else if($row["tablet_cpu_core_count"] == "8"){
                            $row["tablet_cpu_core_count"] = "Octa-core";
                        }
                        $cpu = $row["tablet_cpu_chipset"]." ".$row["tablet_cpu_core_count"]." ".$row["tablet_cpu_clock_freq"]."GHz ".$row["tablet_cpu_model"];
                        echo "<tr><th>CPU</th>";
                        echo "<td>";
                        echo $cpu;
                    }else if($key == "cpu core count" || $key == "cpu chipset" || $key == "cpu model"){
                        // do nothing
                    }else if($key == "external memory size" || $key == "ram" || $key == "internal memory size"){
                        if($value == NULL){
                            echo "N/A";
                        }else{
                            echo $value." GB";
                        }
                    }else if($key == "primary camera pixel size"){
                        echo "<tr><th>Primary Camera</th>";
                        echo "<td>";
                        $primary_camera = $row["tablet_primary_camera_pixel_size"]." MP, ".$row["tablet_primary_camera_description"];
                        echo $primary_camera;
                    }else if($key == "primary camera description"){
                        // do nothing
                    }else if($key == "secondary camera pixel size"){
                        echo "<tr><th>Secondary Camera</th>";
                        echo "<td>";
                        $secondary_camera = $row["tablet_secondary_camera_pixel_size"]." MP, ".$row["tablet_secondary_camera_description"];
                        echo $secondary_camera;
                    }else if($key == "secondary camera description"){
                        // do nothing
                    }else if($key == "battery type"){
                        echo "<tr><th>Battery</th>";
                        echo "<td>";
                        if($row["tablet_battery_removable"] == "0"){
                            $row["tablet_battery_removable"] = "Non-removable";
                        }else{
                            $row["tablet_battery_removable"] = "Removable";
                        }
                        $battery = $row["tablet_battery_removable"]." ".$row["tablet_battery_type"]." ".$row["tablet_battery_size"]." mAh";
                        echo $battery;
                    }else if($key == "battery size" || $key == "battery removable"){
                        // do nothing
                    }else{
                        if($key == "multi touch display" || $key == "external memory" || $key == "loudspeaker" || $key == "3 5mm jack" || $key == "radio" || $key == "java" || $key == "battery removable"){
                            if($value == "0"){
                                $value = "No";
                            }else{
                                $value = "Yes";
                            }
                        }
                        if($value){
                            echo $value;
                        }else{
                            echo "N/A";
                        }
                    }
                    echo "</td></tr>";
                }
            }
        }
    }
    echo "</table>";
    echo "</div>";
    mysqli_close($conn);
}

function show_laptop_details_by_id($laptop_id){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    // extracting availability
    $sql = "SELECT * FROM `availability_laptops` WHERE laptop_id = ".$laptop_id;
    $result = mysqli_query($conn,$sql);
    echo "<div class=\"detail_menu\">";
    echo "<input type=\"button\" class=\"show_availability\" name=\"show_availability\" value=\"Availability &amp; Price\" />";
    echo "<input type=\"button\" id=\"current_detail_menu\" class=\"show_full_specification\" name=\"show_full_specification\" value=\"Specification\" />";
    echo "</div>";

    if(mysqli_num_rows($result) > 0){
        echo "<div class=\"availability-section\">";
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class=\"availability\">";
            echo "<p class=\"availability_price\">NRs. ".$row["price"]."</p>";
            echo "<p class=\"availability_store_name\">".$row["store_name"]."</p>";
            echo "<p class=\"availability_store_location\">".$row["store_location"]."</p>";
            echo "<p class=\"availability_note\">".$row["note"]."</p>";
            echo "</div>";
        }
        echo "</div>";
    }else{
        echo "<div class=\"availability-section\">";
        echo "<p class=\"no_availability_info\">No availability information.</p>";
        echo "</div>";
    }

    // extracting full specification
    $sql = "SELECT * FROM laptops WHERE laptop_id = '".mysqli_real_escape_string($conn,$laptop_id)."'";
    $result = mysqli_query($conn,$sql);
    echo "<div class=\"full-specification-section\">";
    echo "<table class=\"full_specification_table\">";
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if($key == "laptop_image_filename"){
                echo "<img class=\"product-image\" src=\"../images/".$row["laptop_image_filename"]."\" alt=\"".$row["laptop_model"]."\" />";
            }
            if($key != "laptop_id" && $key != "laptop_submitter" && $key != "laptop_submitted_date" && $key != "file_name" && $key != "laptop_image_filename"){
                // Array values
                if($key == "laptop_connectivity_and_ports" || $key == "laptop_other_features" || $key == "laptop_colors"){
                    $key = remove_substring($key,"laptop_");
                    $key = preg_replace("/[_]+/"," ",$key);
                    echo "<tr><th>".$key."</th>";
                    $value = unserialize($value);
                    echo "<td>";
                    if(!is_null($value)){
                        if($key == "connectivity and ports" || $key == "other features"){
                            echo implode("<br />",$value);
                        }else{
                            echo implode(", ",$value);
                        }
                    }else{
                        echo "N/A";
                    }
                    echo "</td></tr>";
                }else{
                    // Non-Array values
                    $key = remove_substring($key,"laptop_");
                    $key = preg_replace("/[_]+/"," ",$key);
                    if($key != "display size" && $key != "display pixel density" && $key != "display resolution high" && $key != "display resolution low" && $key != "display aspect ratio high" && $key != "display aspect ratio low" && $key != "processor type" && $key != "processor cores count" && $key != "processor cache" && $key != "processor speed" && $key != "battery cell count" && $key != "battery type" && $key != "battery power" && $key != "ram type" && $key != "ram speed" && $key != "ram size" && $key != "storage technology" && $key != "storage size"){
                        echo "<tr><th>".$key."</th><td>";
                    }
                    if($key == "launch date"){
                        $date = $value;
                        $month = date("F",strtotime($date));
                        $year = date("Y",strtotime($date));
                        echo $year." ".$month;
                    }else if($key == "display size"){
                        echo "<tr><th>Display</th><td>";
                        $display = $row["laptop_display_size"]." inch ".$row["laptop_display_resolution_high"]." x ".$row["laptop_display_resolution_low"]." pixels, ".$row["laptop_display_pixel_density"]." ppi Pixels Density, ".$row["laptop_display_aspect_ratio_high"].":".$row["laptop_display_aspect_ratio_low"]." Aspect Ratio";
                        echo $display;
                    }else if($key == "display pixel density" || $key == "display resolution high" || $key == "display resolution low" || $key == "display aspect ratio high" || $key == "display aspect ratio low"){
                        // do nothing
                    }else if($key == "processor speed"){
                        if($row["laptop_processor_cores_count"] == "1"){
                            $row["laptop_processor_cores_count"] = "Single-core";
                        }else if($row["laptop_processor_cores_count"] == "2"){
                            $row["laptop_processor_cores_count"] = "Dual-core";
                        }else if($row["laptop_processor_cores_count"] == "3"){
                            $row["laptop_processor_cores_count"] = "Tri-core";
                        }else if($row["laptop_processor_cores_count"] == "4"){
                            $row["laptop_processor_cores_count"] = "Quad-core";
                        }else if($row["laptop_processor_cores_count"] == "8"){
                            $row["laptop_processor_cores_count"] = "Octa-core";
                        }
                        $processor = $row["laptop_processor_cores_count"]." ".$row["laptop_processor_speed"]." GHz ".$row["laptop_processor_type"]." with ".$row["laptop_processor_cache"]." MB Cache";
                        echo "<tr><th>Processor</th><td>";
                        echo $processor;
                    }else if($key == "processor type" || $key == "processor cores count" || $key == "processor cache"){
                        // do nothing
                    }else if($key == "battery power"){
                        $battery = $row["laptop_battery_cell_count"]." Cell ".$row["laptop_battery_power"]." Wh ".$row["laptop_battery_type"];
                        echo "<tr><th>Battery</th><td>";
                        echo $battery;
                    }else if($key == "battery cell count" || $key == "battery type"){
                        // do nothing
                    }else if($key == "ram size"){
                        $ram = $row["laptop_ram_size"]." GB ".$row["laptop_ram_speed"]." MHz ".$row["laptop_ram_type"];
                        echo "<tr><th>RAM</th><td>";
                        echo $ram;
                    }else if($key == "ram type" || $key == "ram speed"){
                        // do nothing
                    }else if($key == "storage size"){
                        $storage = $row["laptop_storage_size"]." GB ".$row["laptop_storage_technology"];
                        echo "<tr><th>Storage</th><td>";
                        echo $storage;
                    }else if($key == "storage technology"){
                        // do nothing
                    }else if($key == "battery life"){
                        echo $value." hours";
                    }else if($key == "thickness" || $key == "length" || $key == "width"){
                        echo $value." mm";
                    }else if($key == "weight"){
                        echo $value." kg";
                    }else{
                        echo $value;
                    }
                    echo "</td></tr>";
                }
            }
        }
    }
    echo "</table>";
    echo "</div>";

    mysqli_close($conn);
}

function show_all_product($product,$sql){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    switch($product) {
        case "phones":
            $result = mysqli_query($conn, $sql);
            echo "<div class=\"product-section\">";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class=\"product\">";
                foreach ($row as $key => $value) {
                    if ($key == "phone_model") {
                        echo "<div class=\"product-sec2\">";
                        echo "<p class=\"product-title\"><a class=\"product-title\" href=\"phones/" . $row["file_name"] . ".php\"" . ">" . $row["phone_model"] . "</a></p>";
                        if(!is_null($row["phone_price"])){
                            echo "<p class=\"product-price\">Starting at NRs. ".$row["phone_price"]."</p>";
                        }
                        echo "<p class=\"specification-overview\">";
                        echo $row["phone_internal_memory_size"]." GB Internal";
                        if(!is_null($row["phone_external_memory_size"])){
                            echo ", expandable up to ".$row["phone_external_memory_size"]." GB";
                        }
                        echo ", ".$row["phone_ram"]." GB RAM";
                        echo ", ".$row["phone_display_size"]." inch";
                        echo " ".$row["phone_display_resolution_high"];
                        echo " x ".$row["phone_display_resolution_low"]." pixels Display";
                        echo ", ".$row["phone_primary_camera_pixel_size"]." MP Primary camera";
                        echo ", ".$row["phone_secondary_camera_pixel_size"]." MP Secondary camera";
                        echo ", ".$row["phone_battery_size"]." mAh Battery";
                        echo ", ".$row["phone_cpu_chipset"]." Processor";
                        echo "</p>";
                        echo "</div>";
                    }
                    if ($key == "phone_image_filename") {
                        echo "<div class=\"product-sec1\">";
                        echo "<a href=\"phones/" . $row["file_name"] . ".php\"><img class=\"product-image\" src=\"images/" . $row["phone_image_filename"] . "\" /></a>";
                        echo "</div>";
                    }
                }
                echo "</div>";
            }
            echo "</div>";
            break;
        case "tablets":
            $result = mysqli_query($conn, $sql);
            echo "<div class=\"product-section\">";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class=\"product\">";
                foreach ($row as $key => $value) {
                    if ($key == "tablet_model") {
                        echo "<div class=\"product-sec2\">";
                        echo "<p class=\"product-title\"><a class=\"product-title\" href=\"tablets/" . $row["file_name"] . ".php\"" . ">" . $row["tablet_model"] . "</a></p>";
                        if(!is_null($row["tablet_price"])){
                            echo "<p class=\"product-price\">Starting at NRs. ".$row["tablet_price"]."</p>";
                        }
                        echo "<p class=\"specification-overview\">";
                        echo $row["tablet_internal_memory_size"]." GB Internal";
                        if(!is_null($row["tablet_external_memory_size"])){
                            echo ", expandable up to ".$row["tablet_external_memory_size"]." GB";
                        }
                        echo ", ".$row["tablet_ram"]." GB RAM";
                        echo ", ".$row["tablet_display_size"]." inch";
                        echo " ".$row["tablet_display_resolution_high"];
                        echo " x ".$row["tablet_display_resolution_low"]." pixels Display";
                        echo ", ".$row["tablet_primary_camera_pixel_size"]." MP Primary camera";
                        echo ", ".$row["tablet_secondary_camera_pixel_size"]." MP Secondary camera";
                        echo ", ".$row["tablet_battery_size"]." mAh Battery";
                        echo ", ".$row["tablet_cpu_chipset"]." Processor";
                        echo "</p>";
                        echo "</div>";
                    }
                    if ($key == "tablet_image_filename") {
                        echo "<div class=\"product-sec1\">";
                        echo "<a href=\"tablets/" . $row["file_name"] . ".php\"><img class=\"product-image\" src=\"images/" . $row["tablet_image_filename"] . "\" /></a>";
                        echo "</div>";
                    }
                }
                echo "</div>";
            }
            echo "</div>";
            break;
        case "laptops":
            $result = mysqli_query($conn, $sql);
            echo "<div class=\"product-section\">";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class=\"product\">";
                foreach ($row as $key => $value) {
                    if ($key == "laptop_model") {
                        echo "<div class=\"product-sec2\">";
                        echo "<p class=\"product-title\"><a class=\"product-title\" href=\"laptops/" . $row["file_name"] . ".php\"" . ">" . $row["laptop_model"] . "</a></p>";
                        if(!is_null($row["laptop_price"])){
                            echo "<p class=\"product-price\">Starting at NRs. ".$row["laptop_price"]."</p>";
                        }
                        echo "</div>";
                    }
                    if ($key == "laptop_image_filename") {
                        echo "<div class=\"product-sec1\">";
                        echo "<a href=\"laptops/" . $row["file_name"] . ".php\"><img class=\"product-image\" src=\"images/" . $row["laptop_image_filename"] . "\" /></a>";
                        echo "</div>";
                    }
                }
                echo "</div>";
            }
            echo "</div>";
            break;
    }
    mysqli_close($conn);
}

function beautify_column_name($key){
    switch($key){
        case "phone_id":
            return "ID";
            break;
        case "phone_model":
            return "Model";
            break;
        case "url":
            return "URL";
            break;
    }
}

function create_filename($str){
    $b = strtolower(preg_replace("/[^a-zA-Z0-9\s-_]+/","",$str));
    $c = preg_replace("/[\s]+/","-",$b);
    return $c;
}

function remove_substring($str,$substring){
    $str = preg_replace("/$substring/","",$str);
    return $str;
}

function get_requested_page_file_name(){
    $page_file_name = basename($_SERVER["SCRIPT_FILENAME"]);
    $page_file_name = remove_substring($page_file_name,".php");
    return $page_file_name;
}

function get_id_of_requested_page_by_url_filename($context){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }

    switch($context){
        case "phones":
            $sql = "SELECT `phone_id` from phones where file_name = '".get_requested_page_file_name()."'";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                foreach($row as $key=>$value){
                    $phone_id = $value;
                    return $phone_id;
                }
            }
            break;
        case "tablets":
            $sql = "SELECT `tablet_id` from tablets where file_name = '".get_requested_page_file_name()."'";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                foreach($row as $key=>$value){
                    $tablet_id = $value;
                    return $tablet_id;
                }
            }
            break;
        case "laptops":
            $sql = "SELECT `laptop_id` from laptops where file_name = '".get_requested_page_file_name()."'";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                foreach($row as $key=>$value){
                    $laptop_id = $value;
                    return $laptop_id;
                }
            }
            break;
    }

}

function create_new_page($new_page_file_name,$target_dir){
    switch($target_dir){
        case "phones":
            $new_file = fopen("../".$target_dir."/".$new_page_file_name.".php",'w');
            $data = file_get_contents("../phones/mobile-detail-template.php");
            break;
        case "tablets":
            $new_file = fopen("../".$target_dir."/".$new_page_file_name.".php",'w');
            $data = file_get_contents("../tablets/tablet-detail-template.php");
            break;
        case "laptops":
            $new_file = fopen("../".$target_dir."/".$new_page_file_name.".php",'w');
            $data = file_get_contents("../laptops/laptop-detail-template.php");
            break;
        case "articles":
            $new_file = fopen("../".$target_dir."/".$new_page_file_name.".php",'w');
            $data = file_get_contents("../articles/article-detail-template.php");
            break;
    }

    if(fwrite($new_file,$data)){
        fclose($new_file);
        return TRUE;
    }else{
        fclose($new_file);
        return FALSE;
    }
}

function display_message(){
    if(isset($_SESSION["msg"])){
        echo "<br />". $_SESSION["msg"];
    }
    $_SESSION["msg"] = "";
}

function get_unused_theme_names($holder_tag){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT theme_name from themes WHERE is_used = '0'";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            echo "<".$holder_tag.">".$value."</".$holder_tag.">";
        }
    }
}

function get_used_theme_name($holder_tag){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT theme_name from themes WHERE is_used = '1'";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            echo "<".$holder_tag.">".$value."</".$holder_tag.">";
        }
    }
}

function get_all_theme_names($holder_tag){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT theme_name from themes";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            echo "<".$holder_tag.">".$value."</".$holder_tag.">";
        }
    }
}

function set_new_theme(){
    $new_theme = $_POST["theme_name_used"];
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "UPDATE themes SET is_used = '0'";
    mysqli_query($conn,$sql);
    $sql = "UPDATE themes SET is_used = '1' WHERE theme_name = '".$new_theme."'";
    if(mysqli_query($conn,$sql)){
        echo "<p class=\"msg_box\">".$new_theme." set as new theme</p>";
    }else{
        echo "Failed to set new theme";
    }
    mysqli_close($conn);
}

function get_all_css($holder_tag,$associated_component){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT file_name from css_files WHERE associated_component ='".$associated_component."'";
    echo $sql;
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            echo "<".$holder_tag.">".$value."</".$holder_tag.">";
        }
    }
}

function process_edit_theme(){
//    [theme_name_edit] => 1
    $theme_name = $_POST["theme_name_edit"];
//    [save-edit-button] => Save
//    [theme_header_edit] => header1
    $header_name = $_POST["theme_header_edit"];
//    [theme_main_index_edit] => main-index1
    $main_index_name = $_POST["theme_main_index_edit"];
    $main_phones_name = $_POST["theme_main_phones_edit"];
    $main_tablets_name = $_POST["theme_main_tablets_edit"];
    $main_laptops_name = $_POST["theme_main_laptops_edit"];
    $main_filter_name = $_POST["theme_main_filter_edit"];
//    [theme_aside_edit] => aside1
    $aside_name = $_POST["theme_aside_edit"];
//    [theme_footer_edit] => footer1
    $footer_name = $_POST["theme_footer_edit"];

    $sql = "UPDATE `themes` SET `header_css` = '".$header_name."', `main_index_css` = '".$main_index_name."', `main_phones_css` = '".$main_phones_name."', `main_tablets_css` = '".$main_tablets_name."', `main_laptops_css` = '".$main_laptops_name."', `main_filter_css` = '".$main_filter_name."', `aside_css` = '".$aside_name."', `footer_css` = '".$footer_name."' WHERE `themes`.`theme_name` = '".$theme_name."'";
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    if(mysqli_query($conn,$sql)){
        echo "<p class=\"msg_box\">".$theme_name." updated successfully.</p>";
    }
    mysqli_close($conn);
}

function create_new_theme(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $new_theme_name = $_POST["theme_name_create"];
    $header_css = $_POST["theme_header_create"];
    $body_css = $_POST["theme_body_create"];
    $aside_css = $_POST["theme_aside_create"];
    $footer_css = $_POST["theme_footer_create"];

    $sql = "INSERT INTO `themes` (`is_used`, `theme_name`, `header_css`, `body_css`, `aside_css`, `footer_css`) VALUES ('0', '".$new_theme_name."', '".$header_css."', '".$body_css."', '".$aside_css."', '".$footer_css."')";
    if(mysqli_query($conn,$sql)){
        echo "<p class=\"msg_box\">".$new_theme_name." created successfully.</p>";
    }
    mysqli_close($conn);
}

function upload_file($file_key_identifier,$selected_file_type){
    switch($selected_file_type){
        case "css":
            $target_dir = "../css/";
            $css_associated_component = $_POST["css_associated_component"];
            break;
        case "image":
            $target_dir = "../images/";
            break;
    }
    if($_FILES["$file_key_identifier"]["name"] == NULL){
        return;
    }
    $_FILES["new_file"] = $_FILES["$file_key_identifier"];
    $target_file = $target_dir . basename($_FILES["new_file"]["name"]); // gets filename with extension
    $uploadOk = 1;
    $fileType = pathinfo($target_file,PATHINFO_EXTENSION);// gets file extension
    $fileName = pathinfo($target_file,PATHINFO_FILENAME);
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<p class=\"msg_box\"> Sorry, file already exists.</p>";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["new_file"]["size"] > 500000) {
        echo "<p class=\"msg_box\">Sorry, your file is too large.</p>";
        $uploadOk = 0;
    }
    // Allow certain file formats
    switch($selected_file_type){
        case "css":
            if($fileType != "css") {
                echo "<p class=\"msg_box\">Sorry, only CSS files are allowed.</p>";
                $uploadOk = 0;
            }
            break;
        case "image":
            if($fileType == "jpg" || $fileType == "png" || $fileType == "jpeg" ){
                break;
            }else{
                echo "<p class=\"msg_box\">Sorry, only .jpg, .jpeg and .png files are allowed.</p>";
                $uploadOk = 0;
            }
            break;
    }
    // Check if $uploadOk is set to 0 by an error
    if($uploadOk !== 0){
        if (move_uploaded_file($_FILES["new_file"]["tmp_name"], $target_file)) {
            echo "<p class=\"msg_box\">". basename( $_FILES["new_file"]["name"]). " has been uploaded successfully.</p>";
        }
    }
    switch($selected_file_type){
        case "css":
            update_table_css_files($fileName,$css_associated_component);
            break;

    }
}

function update_table_css_files($fileName,$css_associated_component){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "INSERT INTO `css_files` (`file_name`, `associated_component`) VALUES ('".$fileName."', '".$css_associated_component."')";
    mysqli_query($conn,$sql);
    mysqli_close($conn);
}

function submit_phone($action){
    if(!check_login()){
        header("Location: http://www.kathmanduelectronics.com/admin");
        ob_end_flush();
        exit();
    }
    //[submit] => submit
    $submitted = isset($_POST["submit"]);
    if($submitted){
        if(!isset($conn)){
            $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
        }

        //[image] => image1.jpg
        $phone_image_filename = !isset($_FILES["phone_image"]["name"])?"NULL":"'".mysqli_real_escape_string($conn,$_FILES["phone_image"]["name"])."'";
        //[brand] => brand value
        $brand = $_POST["brand"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["brand"])."'";
        //[model] => model value
        $model = $_POST["model"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["model"])."'";
        //    [network] => Array
        //(
        //    [0] => lte
        //    [1] => hsdpa
        //[2] => umts
        //        )
        //
        $serialized_empty_array = "a:1:{i:0;s:0:"."\"\"".";}";
        $network = !isset($_POST["network"])?"'".mysqli_real_escape_string($conn,$serialized_empty_array)."'":"'".mysqli_real_escape_string($conn,serialize($_POST["network"]))."'";
        //    [launch_date] => 2017-01-03
        $launch_date = $_POST["launch_date"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["launch_date"])."'";
        //    [height] => 123.9
        $height = $_POST["height"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["height"])."'";
        //    [width] => 76.9
        $width = $_POST["width"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["width"])."'";
        //    [thickness] => 7.9
        $thickness = $_POST["thickness"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["thickness"])."'";
        //    [weight] => 123
        $weight = $_POST["weight"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["weight"])."'";
        //    [sim_size] => Nano
        $sim_size = $_POST["sim_size"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["sim_size"])."'";
        //[sim_count] => 1
        $sim_count = $_POST["sim_count"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["sim_count"])."'";
        //    [os] => ios
        $os = !isset($_POST["os"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["os"])."'";
        //[os_version] => Apple ios 10
        $os_version = $_POST["os_version"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["os_version"])."'";
        //    [display_type] => display type
        $display_type = $_POST["display_type"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_type"])."'";
        //[display_size] => 5.0
        $display_size = $_POST["display_size"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_size"])."'";
        //    [display_screen_to_body_ratio] => 78
        $display_screen_to_body_ratio = $_POST["display_screen_to_body_ratio"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_screen_to_body_ratio"])."'";
        //    [display_resolution_high] => 1920
        //    [display_resolution_low] => 1920
        $display_resolution_high = $_POST["display_resolution_high"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_resolution_high"])."'";
        $display_resolution_low = $_POST["display_resolution_low"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_resolution_low"])."'";
        //    [display-touch] => 1
        $display_touch = !isset($_POST["display_touch"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_touch"])."'";
        //    [display_protection] => protection value
        $display_protection = $_POST["display_protection"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_protection"])."'";
        //[chipset] => chipset value
        $chipset = $_POST["chipset"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["chipset"])."'";
        //[cpu_cores_count] => Dual
        $cpu_cores_count = $_POST["cpu_cores_count"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["cpu_cores_count"])."'";
        //[cpu_clock_freq] => 1.8
        $cpu_clock_freq = $_POST["cpu_clock_freq"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["cpu_clock_freq"])."'";
        //    [cpu_model] => cpu model value
        $cpu_model = $_POST["cpu_model"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["cpu_model"])."'";
        //[gpu] => gpu value
        $gpu = $_POST["gpu"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["gpu"])."'";
        //[external_memory] => 0
        $external_memory = !isset($_POST["external_memory"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["external_memory"])."'";
        //    [external_memory_size] =>
        $external_memory_size = $_POST["external_memory_size"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["external_memory_size"])."'";
        //    [internal_memory_size] => Array
        //(
        //    [0] => 128
        //)
        //
        $internal_memory_size = !isset($_POST["internal_memory_size"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["internal_memory_size"])."'";
        //[ram] => Array
        //(
        //    [0] => 2
        //)
        //
        $ram = $_POST["ram"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["ram"])."'";
        //[primary_camera_size] => 12
        $primary_camera_size = $_POST["primary_camera_size"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["primary_camera_size"])."'";
        //    [primary_camera_description] => primary camera description
        $primary_camera_description = $_POST["primary_camera_description"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["primary_camera_description"])."'";
        //[secondary_camera_size] => 5
        $secondary_camera_size = $_POST["secondary_camera_size"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["secondary_camera_size"])."'";
        //    [secondary_camera_description] => secondary camera description
        $secondary_camera_description = $_POST["secondary_camera_description"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["secondary_camera_description"])."'";
        //[video] => video value
        $video = $_POST["video"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["video"])."'";
        //[alert_types] => Array
        //(
        //    [0] => alert types val 1
        //        )
        //
        $alert_types = !isset($_POST["alert_types"])?"NULL":"'".mysqli_real_escape_string($conn,serialize($_POST["alert_types"]))."'";
        //    [loudspeaker] => 1
        $loudspeaker = !isset($_POST["loudspeaker"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["loudspeaker"])."'";
        //    [3_5mm_jack] => 0
        $three_5mm_jack = !isset($_POST["3_5mm_jack"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["3_5mm_jack"])."'";
        //    [wlan] => wlan value
        $wlan = $_POST["wlan"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["wlan"])."'";
        //[bluetooth] => bluetooth value
        $bluetooth = $_POST["bluetooth"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["bluetooth"])."'";
        //[gps] => gps value
        $gps = $_POST["gps"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["gps"])."'";
        //[usb] => usb value
        $usb = $_POST["usb"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["usb"])."'";
        //[radio] => 0
        $radio = !isset($_POST["radio"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["radio"])."'";
        //[sensors] => Array
        //(
        //    [0] => sensors val 1
        //        )
        //
        $sensors = !isset($_POST["sensors"])?"NULL":"'".mysqli_real_escape_string($conn,serialize($_POST["sensors"]))."'";
        //    [messaging] => Array
        //(
        //    [0] => messaging val
        //        )
        //
        $messaging = !isset($_POST["messaging"])?"NULL":"'".mysqli_real_escape_string($conn,serialize($_POST["messaging"]))."'";
        //    [browser] => HTML5
        $browser = $_POST["browser"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["browser"])."'";;
        //[java] => 0
        $java = !isset($_POST["java"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["java"])."'";;
        //    [other_features] => Array
        //(
        //    [0] => other features val 1
        //        )
        //
        $other_features = !isset($_POST["other_features"])?"NULL":"'".mysqli_real_escape_string($conn,serialize($_POST["other_features"]))."'";
        //    [colors] => Array
        //(
        //    [0] => gpace grey
        //        )
        //
        $colors = !isset($_POST["colors"])?"NULL":"'".mysqli_real_escape_string($conn,serialize($_POST["colors"]))."'";
        //    [battery_size] => 1800
        $battery_size = $_POST["battery_size"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["battery_size"])."'";
        //    [battery_removable] => 0
        $battery_removable = !isset($_POST["battery_removable"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["battery_removable"])."'";
        //    [battery_type] => Li-Polymer
        $battery_type = $_POST["battery_type"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["battery_type"])."'";

        switch($action){
            case "insert":
                $new_file = create_filename($model);
                $_SESSION["new_page"] = $new_file; // This value is passed to SESSION so that submit-page-info can use this value (newly created filename) to udpate the page information.
                $sql = "INSERT INTO `phones` (`phone_brand`, `phone_model`, `phone_network`, `phone_launch`, `phone_height`, `phone_width`, `phone_thickness`, `phone_weight`, `phone_sim_size`, `phone_sim_count`, `phone_display_type`, `phone_display_size`, `phone_screen_to_body_ratio`, `phone_display_resolution_high`, `phone_display_resolution_low`, `phone_multi_touch_display`, `phone_display_protection`, `phone_os`, `phone_os_version`, `phone_cpu_chipset`, `phone_cpu_core_count`, `phone_cpu_clock_freq`, `phone_cpu_model`, `phone_gpu`, `phone_external_memory`, `phone_external_memory_size`, `phone_internal_memory_size`, `phone_ram`, `phone_primary_camera_pixel_size`, `phone_primary_camera_description`, `phone_secondary_camera_pixel_size`, `phone_secondary_camera_description`, `phone_video`, `phone_alert_types`, `phone_loudspeaker`, `phone_3_5mm_jack`, `phone_wlan`, `phone_bluetooth`, `phone_gps`, `phone_radio`, `phone_usb`, `phone_sensors`, `phone_messaging`, `phone_browser`, `phone_java`, `phone_other_features`, `phone_battery_size`, `phone_battery_removable`, `phone_battery_type`, `phone_colors`, `phone_submitter`, `phone_submitted_date`,`file_name`,`phone_image_filename`) VALUES (" . $brand. ",".$model.",".$network.",".$launch_date.",".$height.",".$width.",".$thickness.",".$weight.",".$sim_size.",".$sim_count.",".$display_type.",".$display_size.",".$display_screen_to_body_ratio.",".$display_resolution_high.",".$display_resolution_low.",".$display_touch.",".$display_protection.",".$os.",".$os_version.",".$chipset.",".$cpu_cores_count.",".$cpu_clock_freq.",".$cpu_model.",".$gpu.",".$external_memory.",".$external_memory_size.",".$internal_memory_size.",".$ram.",".$primary_camera_size.",".$primary_camera_description.",".$secondary_camera_size.",".$secondary_camera_description.",".$video.",".$alert_types.",".$loudspeaker.",".$three_5mm_jack.",".$wlan.",".$bluetooth.",".$gps.",".$radio.",".$usb.",".$sensors.",".$messaging.",".$browser.",".$java.",".$other_features.",".$battery_size.",".$battery_removable.",".$battery_type.",".$colors.",'".$_SESSION["username"]."','".date("y-m-d")."','".$new_file."',".$phone_image_filename.")";
                if(mysqli_query($conn,$sql) && create_new_page($new_file,"phones")){
                    upload_file("phone_image","image");

                    // adding availability
                    $_POST["availability"] = array_values($_POST["availability"]);

                    $sql = "SELECT phone_id FROM `phones` WHERE phone_model = $model";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        foreach($row as $key => $value){
                            $phone_id = $value;
                        }
                    }
                    foreach($_POST["availability"] as $key => $value){
                        for($i = 0; $i < count($value); $i++){
                            if($value[$i] == ""){
                                $value[$i] = "NULL";
                            }
                        }
                        $sql = "INSERT INTO availability_phones(`phone_id`,`store_name`,`store_location`,`price`,`note`) VALUES('$phone_id','".$value[0]."','".$value[1]."','".$value[2]."','".$value[3]."')";
                        if(mysqli_query($conn,$sql)){
                            echo "<p class=\"msg_box\">Availability updated successfully.</p>";
                        }else{
                            echo "<p class=\"msg_box_failed\">Failed to update availability.</p>";
                        }
                    }

                    $sql = "SELECT price FROM availability_phones WHERE phone_id = $phone_id AND price =  ( SELECT MIN(price) FROM availability_phones WHERE phone_id = $phone_id)";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $price = $row["price"];
                        }
                        $sql = "UPDATE phones SET phone_price = ".$price." WHERE phone_id = $phone_id";
                    }else{
                        $sql = "UPDATE phones SET phone_price = NULL";
                    }
                    mysqli_query($conn,$sql);
                    echo "<p class=\"msg_box\">Phone added successfully. Now add phone page information.<a href=\"submit-page-info.php\">Go to submit page info</a></p>";
                }else{
                    echo "<p class=\"msg_box_failed\">Failed to add new phone.</p>";
                }
                break;
            case "update":
                $sql = "UPDATE `phones` SET ";
                $sql .= "phone_brand = $brand ";
                $sql .= ",phone_model = $model ";
                $sql .=",phone_network = $network ";
                $sql .=",phone_launch = $launch_date ";
                $sql .=",phone_height = $height ";
                $sql .=",phone_width = $width ";
                $sql .=",phone_thickness = $thickness ";
                $sql .=",phone_weight = $weight ";
                $sql .=",phone_sim_size = $sim_size ";
                $sql .=",phone_sim_count = $sim_count ";
                $sql .=",phone_display_type = $display_type ";
                $sql .=",phone_display_size = $display_size ";
                $sql .=",phone_screen_to_body_ratio = $display_screen_to_body_ratio ";
                $sql .=",phone_display_resolution_high = $display_resolution_high ";
                $sql .=",phone_display_resolution_low = $display_resolution_low ";
                $sql .=",phone_multi_touch_display = $display_touch ";
                $sql .=",phone_display_protection = $display_protection ";
                $sql .=",phone_os = $os ";
                $sql .=",phone_os_version = $os_version ";
                $sql .=",phone_cpu_chipset = $chipset ";
                $sql .=",phone_cpu_core_count = $cpu_cores_count ";
                $sql .=",phone_cpu_clock_freq = $cpu_clock_freq ";
                $sql .=",phone_cpu_model = $cpu_model ";
                $sql .=",phone_gpu = $gpu ";
                $sql .=",phone_external_memory = $external_memory ";
                $sql .=",phone_external_memory_size = $external_memory_size ";
                $sql .=",phone_internal_memory_size = $internal_memory_size ";
                $sql .=",phone_ram = $ram ";
                $sql .=",phone_primary_camera_pixel_size = $primary_camera_size ";
                $sql .=",phone_primary_camera_description = $primary_camera_description ";
                $sql .=",phone_secondary_camera_pixel_size = $secondary_camera_size ";
                $sql .=",phone_secondary_camera_description = $secondary_camera_description ";
                $sql .=",phone_video = $video ";
                $sql .=",phone_alert_types = $alert_types ";
                $sql .=",phone_loudspeaker = $loudspeaker ";
                $sql .=",phone_3_5mm_jack = $three_5mm_jack ";
                $sql .=",phone_wlan = $wlan ";
                $sql .=",phone_bluetooth = $bluetooth ";
                $sql .=",phone_gps = $gps ";
                $sql .=",phone_radio = $radio ";
                $sql .=",phone_usb = $usb ";
                $sql .=",phone_sensors = $sensors ";
                $sql .=",phone_messaging = $messaging ";
                $sql .=",phone_browser = $browser ";
                $sql .=",phone_java = $java ";
                $sql .=",phone_other_features = $other_features ";
                $sql .=",phone_battery_size = $battery_size ";
                $sql .=",phone_battery_removable = $battery_removable ";
                $sql .=",phone_battery_type = $battery_type ";
                $sql .=",phone_colors = $colors ";
                if($phone_image_filename !== "''"){
                    upload_file("phone_image","image");
                    $sql .=",phone_image_filename = $phone_image_filename ";
                }
                $sql .=" WHERE file_name = '".$_SESSION["file_name"]."'";
                if(mysqli_query($conn,$sql)){
                    echo "<p class=\"msg_box\">Phone information updated successfully.</p>";

                    // updating availability
                    $_POST["availability"] = array_values($_POST["availability"]);

                    $sql = "SELECT phone_id FROM `phones` WHERE phone_model = $model";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        foreach($row as $key => $value){
                            $phone_id = $value;
                        }
                    }
                    $sql = "DELETE FROM `availability_phones` WHERE phone_id = ".$phone_id;
                    mysqli_query($conn,$sql);
                    foreach($_POST["availability"] as $key => $value){
                        for($i = 0; $i < count($value); $i++){
                            if($value[$i] == ""){
                                $value[$i] = "NULL";
                            }
                        }
                        $sql = "INSERT INTO availability_phones(`phone_id`,`store_name`,`store_location`,`price`,`note`) VALUES('$phone_id','".$value[0]."','".$value[1]."','".$value[2]."','".$value[3]."')";
                        if(mysqli_query($conn,$sql)){
                            echo "<p class=\"msg_box\">Availability updated successfully.</p>";
                        }else{
                            echo "<p class=\"msg_box_failed\">Failed to update availability.</p>";
                        }
                    }
                    $sql = "SELECT price FROM availability_phones WHERE phone_id = $phone_id AND price =  ( SELECT MIN(price) FROM availability_phones WHERE phone_id = $phone_id)";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $price = $row["price"];
                        }
                        $sql = "UPDATE phones SET phone_price = ".$price." WHERE phone_id = $phone_id";
                    }else{
                        $sql = "UPDATE phones SET phone_price = NULL WHERE phone_id = $phone_id";
                    }
                    mysqli_query($conn,$sql);
                }else{
                    echo "<p class=\"msg_box_failed\">Failed to update phone information.</p>";
                }
                break;
        }
    }
}

function submit_tablet($action){
    if(!check_login()){
        header("Location: http://www.kathmanduelectronics.com/admin");
        ob_end_flush();
        exit();
    }
//[submit] => submit
    $submitted = isset($_POST["submit"]);
    if($submitted){
        if(!isset($conn)){
            $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
        }

//[image] => image1.jpg
        $tablet_image_filename = !isset($_FILES["tablet_image"]["name"])?"NULL":"'".mysqli_real_escape_string($conn,$_FILES["tablet_image"]["name"])."'";
//[brand] => brand value
        $brand = $_POST["brand"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["brand"])."'";
//[model] => model value
        $model = $_POST["model"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["model"])."'";
//    [network] => Array
//(
//    [0] => lte
//    [1] => hsdpa
//[2] => umts
//        )
//
        $serialized_empty_array = "a:1:{i:0;s:0:"."\"\"".";}";
        $network = !isset($_POST["network"])?"'".mysqli_real_escape_string($conn,$serialized_empty_array)."'":"'".mysqli_real_escape_string($conn,serialize($_POST["network"]))."'";
//    [launch_date] => 2017-01-03
        $launch_date = $_POST["launch_date"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["launch_date"])."'";
//    [height] => 123.9
        $height = $_POST["height"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["height"])."'";
//    [width] => 76.9
        $width = $_POST["width"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["width"])."'";
//    [thickness] => 7.9
        $thickness = $_POST["thickness"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["thickness"])."'";
//    [weight] => 123
        $weight = $_POST["weight"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["weight"])."'";
//    [sim_size] => Nano
        $sim_size = $_POST["sim_size"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["sim_size"])."'";
//[sim_count] => 1
        $sim_count = $_POST["sim_count"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["sim_count"])."'";
//    [os] => ios
        $os = !isset($_POST["os"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["os"])."'";
//[os_version] => Apple ios 10
        $os_version = $_POST["os_version"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["os_version"])."'";
//    [display_type] => display type
        $display_type = $_POST["display_type"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_type"])."'";
//[display_size] => 5.0
        $display_size = $_POST["display_size"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_size"])."'";
//    [display_screen_to_body_ratio] => 78
        $display_screen_to_body_ratio = $_POST["display_screen_to_body_ratio"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_screen_to_body_ratio"])."'";
//    [display_resolution_high] => 1920
//    [display_resolution_low] => 1920
        $display_resolution_high = $_POST["display_resolution_high"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_resolution_high"])."'";
        $display_resolution_low = $_POST["display_resolution_low"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_resolution_low"])."'";
//    [display-touch] => 1
        $display_touch = !isset($_POST["display_touch"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_touch"])."'";
//    [display_protection] => protection value
        $display_protection = $_POST["display_protection"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_protection"])."'";
//[chipset] => chipset value
        $chipset = $_POST["chipset"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["chipset"])."'";
//[cpu_cores_count] => Dual
        $cpu_cores_count = $_POST["cpu_cores_count"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["cpu_cores_count"])."'";
//[cpu_clock_freq] => 1.8
        $cpu_clock_freq = $_POST["cpu_clock_freq"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["cpu_clock_freq"])."'";
//    [cpu_model] => cpu model value
        $cpu_model = $_POST["cpu_model"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["cpu_model"])."'";
//[gpu] => gpu value
        $gpu = $_POST["gpu"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["gpu"])."'";
//[external_memory] => 0
        $external_memory = !isset($_POST["external_memory"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["external_memory"])."'";
//    [external_memory_size] =>
        $external_memory_size = $_POST["external_memory_size"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["external_memory_size"])."'";
//    [internal_memory_size] => Array
//(
//    [0] => 128
//)
//
        $internal_memory_size = !isset($_POST["internal_memory_size"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["internal_memory_size"])."'";
//[ram] => Array
//(
//    [0] => 2
//)
//
        $ram = $_POST["ram"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["ram"])."'";
//[primary_camera_size] => 12
        $primary_camera_size = $_POST["primary_camera_size"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["primary_camera_size"])."'";
//    [primary_camera_description] => primary camera description
        $primary_camera_description = $_POST["primary_camera_description"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["primary_camera_description"])."'";
//[secondary_camera_size] => 5
        $secondary_camera_size = $_POST["secondary_camera_size"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["secondary_camera_size"])."'";
//    [secondary_camera_description] => secondary camera description
        $secondary_camera_description = $_POST["secondary_camera_description"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["secondary_camera_description"])."'";
//[video] => video value
        $video = $_POST["video"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["video"])."'";
//[alert_types] => Array
//(
//    [0] => alert types val 1
//        )
//
        $alert_types = !isset($_POST["alert_types"])?"NULL":"'".mysqli_real_escape_string($conn,serialize($_POST["alert_types"]))."'";
//    [loudspeaker] => 1
        $loudspeaker = !isset($_POST["loudspeaker"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["loudspeaker"])."'";
//    [3_5mm_jack] => 0
        $three_5mm_jack = !isset($_POST["3_5mm_jack"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["3_5mm_jack"])."'";
//    [wlan] => wlan value
        $wlan = $_POST["wlan"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["wlan"])."'";
//[bluetooth] => bluetooth value
        $bluetooth = $_POST["bluetooth"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["bluetooth"])."'";
//[gps] => gps value
        $gps = $_POST["gps"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["gps"])."'";
//[usb] => usb value
        $usb = $_POST["usb"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["usb"])."'";
//[radio] => 0
        $radio = !isset($_POST["radio"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["radio"])."'";
//[sensors] => Array
//(
//    [0] => sensors val 1
//        )
//
        $sensors = !isset($_POST["sensors"])?"NULL":"'".mysqli_real_escape_string($conn,serialize($_POST["sensors"]))."'";
//    [messaging] => Array
//(
//    [0] => messaging val
//        )
//
        $messaging = !isset($_POST["messaging"])?"NULL":"'".mysqli_real_escape_string($conn,serialize($_POST["messaging"]))."'";
//    [browser] => HTML5
        $browser = $_POST["browser"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["browser"])."'";;
//[java] => 0
        $java = !isset($_POST["java"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["java"])."'";;
//    [other_features] => Array
//(
//    [0] => other features val 1
//        )
//
        $other_features = !isset($_POST["other_features"])?"NULL":"'".mysqli_real_escape_string($conn,serialize($_POST["other_features"]))."'";
//    [colors] => Array
//(
//    [0] => gpace grey
//        )
//
        $colors = !isset($_POST["colors"])?"NULL":"'".mysqli_real_escape_string($conn,serialize($_POST["colors"]))."'";
//    [battery_size] => 1800
        $battery_size = $_POST["battery_size"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["battery_size"])."'";
//    [battery_removable] => 0
        $battery_removable = !isset($_POST["battery_removable"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["battery_removable"])."'";
//    [battery_type] => Li-Polymer
        $battery_type = $_POST["battery_type"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["battery_type"])."'";
        switch($action){
            case "insert":
                $new_file = create_filename($model);
                $_SESSION["new_page"] = $new_file; // This value is passed to SESSION so that submit-page-info can use this value (newly created filename) to udpate the page information.
                $sql = "INSERT INTO `tablets` (`tablet_brand`, `tablet_model`, `tablet_network`, `tablet_launch`, `tablet_height`, `tablet_width`, `tablet_thickness`, `tablet_weight`, `tablet_sim_size`, `tablet_sim_count`, `tablet_display_type`, `tablet_display_size`, `tablet_screen_to_body_ratio`, `tablet_display_resolution_high`, `tablet_display_resolution_low`, `tablet_multi_touch_display`, `tablet_display_protection`, `tablet_os`, `tablet_os_version`, `tablet_cpu_chipset`, `tablet_cpu_core_count`, `tablet_cpu_clock_freq`, `tablet_cpu_model`, `tablet_gpu`, `tablet_external_memory`, `tablet_external_memory_size`, `tablet_internal_memory_size`, `tablet_ram`, `tablet_primary_camera_pixel_size`, `tablet_primary_camera_description`, `tablet_secondary_camera_pixel_size`, `tablet_secondary_camera_description`, `tablet_video`, `tablet_alert_types`, `tablet_loudspeaker`, `tablet_3_5mm_jack`, `tablet_wlan`, `tablet_bluetooth`, `tablet_gps`, `tablet_radio`, `tablet_usb`, `tablet_sensors`, `tablet_messaging`, `tablet_browser`, `tablet_java`, `tablet_other_features`, `tablet_battery_size`, `tablet_battery_removable`, `tablet_battery_type`, `tablet_colors`, `tablet_submitter`, `tablet_submitted_date`,`file_name`,`tablet_image_filename`) VALUES (" . $brand. ",".$model.",".$network.",".$launch_date.",".$height.",".$width.",".$thickness.",".$weight.",".$sim_size.",".$sim_count.",".$display_type.",".$display_size.",".$display_screen_to_body_ratio.",".$display_resolution_high.",".$display_resolution_low.",".$display_touch.",".$display_protection.",".$os.",".$os_version.",".$chipset.",".$cpu_cores_count.",".$cpu_clock_freq.",".$cpu_model.",".$gpu.",".$external_memory.",".$external_memory_size.",".$internal_memory_size.",".$ram.",".$primary_camera_size.",".$primary_camera_description.",".$secondary_camera_size.",".$secondary_camera_description.",".$video.",".$alert_types.",".$loudspeaker.",".$three_5mm_jack.",".$wlan.",".$bluetooth.",".$gps.",".$radio.",".$usb.",".$sensors.",".$messaging.",".$browser.",".$java.",".$other_features.",".$battery_size.",".$battery_removable.",".$battery_type.",".$colors.",'".$_SESSION["username"]."','".date("y-m-d")."','".$new_file."',".$tablet_image_filename.")";
                if(mysqli_query($conn,$sql) && create_new_page($new_file,"tablets")){
                    upload_file("tablet_image","image");

                    // adding availability
                    $_POST["availability"] = array_values($_POST["availability"]);

                    $sql = "SELECT tablet_id FROM `tablets` WHERE tablet_model = $model";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        foreach($row as $key => $value){
                            $tablet_id = $value;
                        }
                    }
                    foreach($_POST["availability"] as $key => $value){
                        for($i = 0; $i < count($value); $i++){
                            if($value[$i] == ""){
                                $value[$i] = "NULL";
                            }
                        }
                        $sql = "INSERT INTO availability_tablets(`tablet_id`,`store_name`,`store_location`,`price`,`note`) VALUES('$tablet_id','".$value[0]."','".$value[1]."','".$value[2]."','".$value[3]."')";
                        if(mysqli_query($conn,$sql)){
                            echo "<p class=\"msg_box\">Availability updated successfully.</p>";
                        }else{
                            echo "<p class=\"msg_box_failed\">Failed to update availability.</p>";
                        }
                    }

                    $sql = "SELECT price FROM availability_tablets WHERE tablet_id = $tablet_id AND price =  ( SELECT MIN(price) FROM availability_tablets WHERE tablet_id = $tablet_id)";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $price = $row["price"];
                        }
                        $sql = "UPDATE tablets SET tablet_price = ".$price." WHERE tablet_id = $tablet_id";
                    }else{
                        $sql = "UPDATE tablets SET tablet_price = NULL WHERE tablet_id = $tablet_id";
                    }
                    mysqli_query($conn,$sql);
                    echo "<p class=\"msg_box\">tablet added successfully. Now add tablet page information.<a href=\"submit-page-info.php\">Go to submit page info</a></p>";
                }else{
                    echo "<p class=\"msg_box_failed\">Failed to add new tablet.</p>";
                }
                break;
            case "update":
                $sql = "UPDATE `tablets` SET ";
                $sql .= "tablet_brand = $brand ";
                $sql .= ",tablet_model = $model ";
                $sql .=",tablet_network = $network ";
                $sql .=",tablet_launch = $launch_date ";
                $sql .=",tablet_height = $height ";
                $sql .=",tablet_width = $width ";
                $sql .=",tablet_thickness = $thickness ";
                $sql .=",tablet_weight = $weight ";
                $sql .=",tablet_sim_size = $sim_size ";
                $sql .=",tablet_sim_count = $sim_count ";
                $sql .=",tablet_display_type = $display_type ";
                $sql .=",tablet_display_size = $display_size ";
                $sql .=",tablet_screen_to_body_ratio = $display_screen_to_body_ratio ";
                $sql .=",tablet_display_resolution_high = $display_resolution_high ";
                $sql .=",tablet_display_resolution_low = $display_resolution_low ";
                $sql .=",tablet_multi_touch_display = $display_touch ";
                $sql .=",tablet_display_protection = $display_protection ";
                $sql .=",tablet_os = $os ";
                $sql .=",tablet_os_version = $os_version ";
                $sql .=",tablet_cpu_chipset = $chipset ";
                $sql .=",tablet_cpu_core_count = $cpu_cores_count ";
                $sql .=",tablet_cpu_clock_freq = $cpu_clock_freq ";
                $sql .=",tablet_cpu_model = $cpu_model ";
                $sql .=",tablet_gpu = $gpu ";
                $sql .=",tablet_external_memory = $external_memory ";
                $sql .=",tablet_external_memory_size = $external_memory_size ";
                $sql .=",tablet_internal_memory_size = $internal_memory_size ";
                $sql .=",tablet_ram = $ram ";
                $sql .=",tablet_primary_camera_pixel_size = $primary_camera_size ";
                $sql .=",tablet_primary_camera_description = $primary_camera_description ";
                $sql .=",tablet_secondary_camera_pixel_size = $secondary_camera_size ";
                $sql .=",tablet_secondary_camera_description = $secondary_camera_description ";
                $sql .=",tablet_video = $video ";
                $sql .=",tablet_alert_types = $alert_types ";
                $sql .=",tablet_loudspeaker = $loudspeaker ";
                $sql .=",tablet_3_5mm_jack = $three_5mm_jack ";
                $sql .=",tablet_wlan = $wlan ";
                $sql .=",tablet_bluetooth = $bluetooth ";
                $sql .=",tablet_gps = $gps ";
                $sql .=",tablet_radio = $radio ";
                $sql .=",tablet_usb = $usb ";
                $sql .=",tablet_sensors = $sensors ";
                $sql .=",tablet_messaging = $messaging ";
                $sql .=",tablet_browser = $browser ";
                $sql .=",tablet_java = $java ";
                $sql .=",tablet_other_features = $other_features ";
                $sql .=",tablet_battery_size = $battery_size ";
                $sql .=",tablet_battery_removable = $battery_removable ";
                $sql .=",tablet_battery_type = $battery_type ";
                $sql .=",tablet_colors = $colors ";
                if($tablet_image_filename !== "''"){
                    $sql .=",tablet_image_filename = $tablet_image_filename ";
                }
                $sql .=" WHERE file_name = '".$_SESSION["file_name"]."'";
                if(mysqli_query($conn,$sql)){
                    echo "<p class=\"msg_box\">Tablet information updated successfully.</p>";
                    // updating availability
                    $_POST["availability"] = array_values($_POST["availability"]);

                    $sql = "SELECT tablet_id FROM `tablets` WHERE tablet_model = $model";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        foreach($row as $key => $value){
                            $tablet_id = $value;
                        }
                    }
                    $sql = "DELETE FROM `availability_tablets` WHERE tablet_id = ".$tablet_id;
                    mysqli_query($conn,$sql);
                    foreach($_POST["availability"] as $key => $value){
                        for($i = 0; $i < count($value); $i++){
                            if($value[$i] == ""){
                                $value[$i] = "NULL";
                            }
                        }
                        $sql = "INSERT INTO availability_tablets(`tablet_id`,`store_name`,`store_location`,`price`,`note`) VALUES('$tablet_id','".$value[0]."','".$value[1]."','".$value[2]."','".$value[3]."')";
                        if(mysqli_query($conn,$sql)){
                            echo "<p class=\"msg_box\">Availability updated successfully.</p>";
                        }else{
                            echo "<p class=\"msg_box_failed\">Failed to update availability.</p>";
                        }
                    }
                    $sql = "SELECT price FROM availability_tablets WHERE tablet_id = $tablet_id AND price =  ( SELECT MIN(price) FROM availability_tablets WHERE tablet_id = $tablet_id)";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $price = $row["price"];
                        }
                        $sql = "UPDATE tablets SET tablet_price = ".$price." WHERE tablet_id = $tablet_id";
                    }else{
                        $sql = "UPDATE tablets SET tablet_price = NULL WHERE tablet_id = $tablet_id";
                    }
                    mysqli_query($conn,$sql);
                }else{
                    echo "<p class=\"msg_box_failed\">Failed to update tablet information.</p>";
                }
                break;
        }
    }
}

function submit_laptop($action){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
//
//    [submit] => submit
    $laptop_image_filename = !isset($_FILES["laptop_image"]["name"])?"NULL":"'".mysqli_real_escape_string($conn,$_FILES["laptop_image"]["name"])."'";
//    [brand] =>
    $brand = $_POST["brand"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["brand"])."'";
//    [type] =>
    $type = $_POST["type"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["type"])."'";
//    [model] =>
    $model = $_POST["model"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["model"])."'";
//    [launch_date] =>
    $launch_date = $_POST["launch_date"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["launch_date"])."'";
//    [length] =>
    $length = $_POST["length"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["length"])."'";
//    [width] =>
    $width = $_POST["width"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["width"])."'";
//    [thickness] =>
    $thickness = $_POST["thickness"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["thickness"])."'";
//    [weight] =>
    $weight = $_POST["weight"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["weight"])."'";
//    [display_size] =>
    $display_size = $_POST["display_size"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_size"])."'";
//    [display_pixel_density] =>
    $display_pixel_density = $_POST["display_pixel_density"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_pixel_density"])."'";
//    [display_resolution_high] =>
    $display_resolution_high = $_POST["display_resolution_high"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_resolution_high"])."'";
//    [display_resolution_low] =>
    $display_resolution_low = $_POST["display_resolution_low"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_resolution_low"])."'";
//    [display_aspect_ratio_high] =>
    $display_aspect_ratio_high = $_POST["display_aspect_ratio_high"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_aspect_ratio_high"])."'";
//    [display_aspect_ratio_low] =>
    $display_aspect_ratio_low = $_POST["display_aspect_ratio_low"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["display_aspect_ratio_low"])."'";
//    [os] =>
    $os = !isset($_POST["os"])?"NULL":"'".mysqli_real_escape_string($conn,$_POST["os"])."'";
//    [os_version] =>
    $os_version = $_POST["os_version"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["os_version"])."'";
//    [processor_type] =>
    $processor_type = $_POST["processor_type"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["processor_type"])."'";
//    [processor_speed] =>
    $processor_speed = $_POST["processor_speed"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["processor_speed"])."'";
//    [processor_cores_count] => 1
    $processor_cores_count = $_POST["processor_cores_count"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["processor_cores_count"])."'";
//    [processor_cache] =>
    $processor_cache = $_POST["processor_cache"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["processor_cache"])."'";
//    [graphics] =>
    $graphics = $_POST["graphics"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["graphics"])."'";
//    [storage_size] =>
    $storage_size = $_POST["storage_size"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["storage_size"])."'";
//    [storage_technology] =>
    $storage_technology = $_POST["storage_technology"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["storage_technology"])."'";
//    [ram_size] =>
    $ram_size = $_POST["ram_size"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["ram_size"])."'";
//    [ram_type] =>
    $ram_type = $_POST["ram_type"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["ram_type"])."'";
//    [ram_speed] =>
    $ram_speed = $_POST["ram_speed"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["ram_speed"])."'";
//    [battery_power] =>
    $battery_power = $_POST["battery_power"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["battery_power"])."'";
//    [battery_type] => Li-Ion
//    [battery_cell_count] => 3
    $battery_cell_count = $_POST["battery_cell_count"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["battery_cell_count"])."'";
    $battery_type = $_POST["battery_type"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["battery_type"])."'";
//    [battery_life] =>
    $battery_life = $_POST["battery_life"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["battery_life"])."'";
//    [connectivity_and_ports] => Array
//    (
//        [0] =>
//        )
//
    $connectivity_and_ports = $_POST["connectivity_and_ports"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,serialize($_POST["connectivity_and_ports"]))."'";
//    [additional_features] => Array
//    (
//        [0] =>
//        )
//
    $other_features = $_POST["other_features"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,serialize($_POST["other_features"]))."'";
//    [colors] => Array
//    (
//        [0] =>
//        )
    $colors = $_POST["colors"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,serialize($_POST["colors"]))."'";
    switch($action){
        case "insert":
            $new_file = create_filename($model);
            $_SESSION["new_page"] = $new_file;
            $sql = "INSERT INTO `laptops` (`laptop_brand`, `laptop_type`, `laptop_model`,`laptop_launch_date`, `laptop_display_size`, `laptop_display_pixel_density`, `laptop_display_resolution_high`, `laptop_display_resolution_low`, `laptop_display_aspect_ratio_high`, `laptop_display_aspect_ratio_low`, `laptop_graphics`, `laptop_processor_type`, `laptop_processor_speed`, `laptop_processor_cores_count`, `laptop_processor_cache`, `laptop_os`, `laptop_os_version`, `laptop_battery_cell_count`, `laptop_battery_power`, `laptop_battery_type`, `laptop_battery_life`, `laptop_ram_size`, `laptop_ram_type`, `laptop_ram_speed`, `laptop_storage_size`, `laptop_storage_technology`, `laptop_connectivity_and_ports`, `laptop_thickness`, `laptop_length`, `laptop_width`, `laptop_weight`, `laptop_colors`, `laptop_other_features`, `laptop_submitter`, `laptop_submitted_date`, `file_name`, `laptop_image_filename`) VALUES (".$brand.",".$type.",".$model.",".$launch_date.",".$display_size.",".$display_pixel_density.",".$display_resolution_high.",".$display_resolution_low.",".$display_aspect_ratio_high.",".$display_aspect_ratio_low.",".$graphics.",".$processor_type.",".$processor_speed.",".$processor_cores_count.",".$processor_cache.",".$os.",".$os_version.",".$battery_cell_count.",".$battery_power.",".$battery_type.",".$battery_life.",".$ram_size.",".$ram_type.",".$ram_speed.",".$storage_size.",".$storage_technology.",".$connectivity_and_ports.",".$thickness.",".$length.",".$width.",".$weight.",".$colors.",".$other_features.",'".$_SESSION["username"]."','".date("y-m-d")."','".$new_file."',".$laptop_image_filename.")";
            if(mysqli_query($conn,$sql) && create_new_page($new_file,"laptops")){
                upload_file("laptop_image","image");
                // adding availability
                $_POST["availability"] = array_values($_POST["availability"]);

                $sql = "SELECT laptop_id FROM `laptops` WHERE laptop_model = $model";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    foreach($row as $key => $value){
                        $laptop_id = $value;
                    }
                }
                foreach($_POST["availability"] as $key => $value){
                    for($i = 0; $i < count($value); $i++){
                        if($value[$i] == ""){
                            $value[$i] = "NULL";
                        }
                    }
                    $sql = "INSERT INTO availability_laptops(`laptop_id`,`store_name`,`store_location`,`price`,`note`) VALUES('$laptop_id','".$value[0]."','".$value[1]."','".$value[2]."','".$value[3]."')";
                    if(mysqli_query($conn,$sql)){
                        echo "<p class=\"msg_box\">Availability updated successfully.</p>";
                    }else{
                        echo "<p class=\"msg_box_failed\">Failed to update availability.</p>";
                    }
                }

                $sql = "SELECT price FROM availability_laptops WHERE laptop_id = $laptop_id AND price =  ( SELECT MIN(price) FROM availability_laptops WHERE laptop_id = $laptop_id)";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $price = $row["price"];
                    }
                    $sql = "UPDATE laptops SET laptop_price = ".$price." WHERE laptop_id = $laptop_id";
                }else{
                    $sql = "UPDATE laptops SET laptop_price = NULL WHERE laptop_id = $laptop_id";
                }
                mysqli_query($conn,$sql);
                echo "<p class=\"msg_box\">laptop added successfully. Now add laptop page information.<a href=\"submit-page-info.php\">Go to submit page info</a></p>";
            }else{
                echo "<p class=\"msg_box_failed\">Failed to add new laptop.</p>";
            }
            break;
        case "update":
            $sql = "UPDATE `laptops` SET ";
            $sql .= "laptop_brand = $brand ";
            $sql .= ",laptop_type = $type ";
            $sql .= ",laptop_model = $model ";
            $sql .= ",laptop_launch_date = $launch_date ";
            $sql .= ",laptop_display_size = $display_size ";
            $sql .= ",laptop_display_pixel_density = $display_pixel_density ";
            $sql .= ",laptop_display_resolution_high = $display_resolution_high ";
            $sql .= ",laptop_display_resolution_low = $display_resolution_low ";
            $sql .= ",laptop_display_aspect_ratio_high = $display_aspect_ratio_high ";
            $sql .= ",laptop_display_aspect_ratio_low = $display_aspect_ratio_low ";
            $sql .= ",laptop_graphics = $graphics ";
            $sql .= ",laptop_processor_type = $processor_type ";
            $sql .= ",laptop_processor_speed = $processor_speed ";
            $sql .= ",laptop_processor_cores_count = $processor_cores_count ";
            $sql .= ",laptop_processor_cache = $processor_cache ";
            $sql .= ",laptop_os = $os ";
            $sql .= ",laptop_os_version = $os_version ";
            $sql .= ",laptop_battery_cell_count = $battery_cell_count ";
            $sql .= ",laptop_battery_power = $battery_power ";
            $sql .= ",laptop_battery_type = $battery_type ";
            $sql .= ",laptop_battery_life = $battery_life ";
            $sql .= ",laptop_ram_size = $ram_size ";
            $sql .= ",laptop_ram_type = $ram_type ";
            $sql .= ",laptop_ram_speed = $ram_speed ";
            $sql .= ",laptop_storage_size = $storage_size ";
            $sql .= ",laptop_storage_technology = $storage_technology ";
            $sql .= ",laptop_connectivity_and_ports = $connectivity_and_ports ";
            $sql .= ",laptop_thickness = $thickness ";
            $sql .= ",laptop_length = $length ";
            $sql .= ",laptop_width = $width ";
            $sql .= ",laptop_weight = $weight ";
            $sql .= ",laptop_colors = $colors ";
            $sql .= ",laptop_other_features = $other_features ";
            if($laptop_image_filename !== "''"){
                $sql .=",laptop_image_filename = $laptop_image_filename ";
            }
            $sql .= "WHERE file_name = '".$_SESSION["file_name"]."'";
            if(mysqli_query($conn,$sql)){
                echo "<p class=\"msg_box\">Laptop information updated successfully.</p>";
                // updating availability
                $_POST["availability"] = array_values($_POST["availability"]);

                $sql = "SELECT laptop_id FROM `laptops` WHERE laptop_model = $model";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    foreach($row as $key => $value){
                        $laptop_id = $value;
                    }
                }
                $sql = "DELETE FROM `availability_laptops` WHERE laptop_id = ".$laptop_id;
                mysqli_query($conn,$sql);
                foreach($_POST["availability"] as $key => $value){
                    for($i = 0; $i < count($value); $i++){
                        if($value[$i] == ""){
                            $value[$i] = "NULL";
                        }
                    }
                    $sql = "INSERT INTO availability_laptops(`laptop_id`,`store_name`,`store_location`,`price`,`note`) VALUES('$laptop_id','".$value[0]."','".$value[1]."','".$value[2]."','".$value[3]."')";
                    if(mysqli_query($conn,$sql)){
                        echo "<p class=\"msg_box\">Availability updated successfully.</p>";
                    }else{
                        echo "<p class=\"msg_box_failed\">Failed to update availability.</p>";
                    }
                }
                $sql = "SELECT price FROM availability_laptops WHERE laptop_id = $laptop_id AND price =  ( SELECT MIN(price) FROM availability_laptops WHERE laptop_id = $laptop_id)";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $price = $row["price"];
                    }
                    $sql = "UPDATE laptops SET laptop_price = ".$price." WHERE laptop_id = $laptop_id";
                }else{
                    $sql = "UPDATE laptops SET laptop_price = NULL WHERE laptop_id = $laptop_id";
                }
                mysqli_query($conn,$sql);
            }else{
                echo "<p class=\"msg_box_failed\">Failed to update laptop information.</p>";
            }
            break;
            break;
    }
}

function submit_store($action){
    if(!check_login()){
        header("Location: http://www.kathmanduelectronics.com/admin");
        ob_end_flush();
        exit();
    }
    //[submit] => submit
    $submitted = isset($_POST["submit"]);
    if($submitted){
        if(!isset($conn)){
            $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
        }

        //[store_name] => store_name value
        $store_name = $_POST["store_name"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["store_name"])."'";
        //[store_location] => store_location value
        $store_location = $_POST["store_location"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["store_location"])."'";
        //[store_contact] => store_contact value
        $store_contact = $_POST["store_contact"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["store_contact"])."'";
        //[store_email] => store_email value
        $store_email = $_POST["store_email"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["store_email"])."'";
        //[store_website] => store_website value
        $store_website = $_POST["store_website"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["store_website"])."'";

        switch($action){
            case "insert":
                $sql = "INSERT INTO `stores` (`store_name`, `store_location`, `store_contact`, `store_email`, `store_website`) VALUES (" . $store_name . ",".$store_location.",".$store_contact.",".$store_email.",".$store_website.")";
                if(mysqli_query($conn,$sql)){
                    echo "<p class=\"msg_box\">Store added successfully.</p>";
                }else{
                    echo "<p class=\"msg_box_failed\">Failed to add new store.</p>";
                }
                break;
            case "update":
                $sql = "UPDATE `stores` SET ";
                $sql .= "store_name = $store_name ";
                $sql .= ",store_location = $store_location ";
                $sql .=",store_contact = $store_contact ";
                $sql .=",store_email = $store_email ";
                $sql .=",store_website = $store_website ";
                $sql .=" WHERE store_name = '".$_SESSION["store_name"]."'";
                if(mysqli_query($conn,$sql)){
                    echo "<p class=\"msg_box\">Store information updated successfully.</p>";
                }else{
                    echo "<p class=\"msg_box_failed\">Failed to update store information.</p>";
                }
                break;
        }
    }
}

function submit_page_info($action){
    if(!check_login()){

        header("Location: http://www.kathmanduelectronics.com/admin");
        ob_end_flush();
        exit();
    }
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
//[submit] => submit
    if(isset($_POST["submit"])){
//[page_title] => title
        $page_title = $_POST["page_title"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["page_title"])."'";;
//[page_description] => description
        $page_description = $_POST["page_description"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["page_description"])."'";
//[page_keywords] => Array
//(
//    [0] => keyword1
//    [1] => keyword2
//[2] => keyword3
//        )
//

        $page_keywords = $_POST["page_keywords"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["page_keywords"])."'";
//    [page_canonical] => canonical
        $page_canonical = $_POST["page_canonical"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["page_canonical"])."'";
//[fb_meta_title] => fb title
        $fb_meta_title = $_POST["fb_meta_title"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["fb_meta_title"])."'";
//[fb_meta_type] => Product
        $fb_meta_type = $_POST["fb_meta_type"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["fb_meta_type"])."'";
//[fb_meta_url] => fb url
        $fb_meta_url = $_POST["fb_meta_url"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["fb_meta_url"])."'";
//[fb_meta_image] => top-logo.png
        $fb_meta_image = $_FILES["fb_meta_image"]["name"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_FILES["fb_meta_image"]["name"])."'";
//[fb_meta_description] => fb description
        $fb_meta_description = $_POST["fb_meta_description"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["fb_meta_description"])."'";
//[fb_meta_sitename] => fb sitename
        $fb_meta_sitename = $_POST["fb_meta_sitename"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["fb_meta_sitename"])."'";
//[fb_meta_admins] => ab admins
        $fb_meta_admins = $_POST["fb_meta_admins"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["fb_meta_admins"])."'";
//[fb_meta_app_id] => fb app id
        $fb_meta_app_id = $_POST["fb_meta_app_id"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["fb_meta_app_id"])."'";
//[twitter_meta_card] => summary_large_image
        $twitter_meta_card = $_POST["twitter_meta_card"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["twitter_meta_card"])."'";
//[twitter_meta_site] => twitter site
        $twitter_meta_site = $_POST["twitter_meta_site"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["twitter_meta_site"])."'";
//[twitter_meta_title] => twitter title
        $twitter_meta_title = $_POST["twitter_meta_title"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["twitter_meta_title"])."'";
//[twitter_meta_description] => twitter description
        $twitter_meta_description = $_POST["twitter_meta_description"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["twitter_meta_description"])."'";
//[twitter_meta_creator] => @ktmelectronics
        $twitter_meta_creator = $_POST["twitter_meta_creator"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_POST["twitter_meta_creator"])."'";
//[twitter_meta_image] => top-logo.png
        $twitter_meta_img = $_FILES["twitter_meta_image"]["name"] == NULL?"NULL":"'".mysqli_real_escape_string($conn,$_FILES["twitter_meta_image"]["name"])."'";
        switch($action){
            case "insert":
                $sql = "INSERT INTO `pages` (`page_name`, `page_title`, `page_description`, `page_keywords`, `page_canonical`, `fb_meta_title`, `fb_meta_type`, `fb_meta_url`, `fb_meta_image`, `fb_meta_description`, `fb_meta_site_name`, `fb_meta_admins`, `fb_meta_app_id`, `twitter_meta_card`, `twitter_meta_site`, `twitter_meta_title`, `twitter_meta_description`, `twitter_meta_creator`, `twitter_meta_image`) VALUES ('".$_SESSION["new_page"]."',". $page_title.",". $page_description.",". $page_keywords.",". $page_canonical.",". $fb_meta_title.",". $fb_meta_type.",". $fb_meta_url.",". $fb_meta_image.",". $fb_meta_description.",". $fb_meta_sitename.",". $fb_meta_admins.",". $fb_meta_app_id.",". $twitter_meta_card.",". $twitter_meta_site.",". $twitter_meta_title.",". $twitter_meta_description.",". $twitter_meta_creator.",". $twitter_meta_img.")";
                if(mysqli_query($conn,$sql)){
                    upload_file("fb_meta_image","image");
                    upload_file("twitter_meta_image","image");
                    mysqli_close($conn);
                    echo "<p class=\"msg_box\">Page information has been successfully updated.</p>";
                }else{
                    mysqli_close($conn);
                    echo "<p class=\"msg_box\">Failed to add page information.</p>";
                    echo $sql;
                }
                break;
            case "update":
                $sql = "UPDATE `pages` SET page_title = $page_title ";
                $sql .= ",page_description = $page_description ";
                $sql .= ",page_keywords = $page_keywords ";
                $sql .= ",page_canonical = $page_canonical ";
                $sql .= ",fb_meta_title = $fb_meta_title ";
                $sql .= ",fb_meta_type = $fb_meta_type ";
                $sql .= ",fb_meta_url = $fb_meta_url ";
                $sql .= ",fb_meta_description = $fb_meta_description ";
                $sql .= ",fb_meta_site_name = $fb_meta_sitename ";
                $sql .= ",fb_meta_admins = $fb_meta_admins ";
                $sql .= ",fb_meta_app_id = $fb_meta_app_id ";
                $sql .= ",twitter_meta_card = $twitter_meta_card ";
                $sql .= ",twitter_meta_title = $twitter_meta_title ";
                $sql .= ",twitter_meta_description = $twitter_meta_description ";
                $sql .= ",twitter_meta_creator = $twitter_meta_creator ";
                $sql .= "WHERE page_name = '".$_SESSION["page_name"]."'";
                if(mysqli_query($conn,$sql)){
                    if($fb_meta_image !== "NULL"){
                        upload_file("fb_meta_image","image");
                        mysqli_query($conn,"UPDATE `pages` SET fb_meta_image = $fb_meta_image WHERE page_name = '".$_SESSION["page_name"]."'");
                    }
                    if($twitter_meta_img !== "NULL"){
                        upload_file("twitter_meta_image","image");
                        mysqli_query($conn,"UPDATE `pages` SET twitter_meta_image = $twitter_meta_img WHERE page_name = '".$_SESSION["page_name"]."'");
                    }
                    echo "<p class=\"msg_box\">Page information updated successfully</p>";
                }else{
                    echo "<p class=\"msg_box_failed\">Failed to update page information</p>";
                }
        }
    }
}

function get_general_meta_data(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $page_name = get_requested_page_file_name();
    $sql = "SELECT * FROM pages where page_name = '".$page_name."'";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            $meta[] = $value;
        }
    }
    return $meta;
}

function show_all_pages(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT * FROM pages";
    $result = mysqli_query($conn,$sql);
    echo "<ul class=\"manage-list\">";
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if($key == "page_name" || $key == "page_title"){
                $key == "page_name"?$page_name = $value:$page_title = $value;
                if(isset($page_name) && isset($page_title)){
                    echo "<li><a href=\"detail.php?page=".$page_name."\" class =\"pages\">$page_title</a></li>";
                    unset($page_name);
                    unset($page_title);
                }
            }
        }
    }
    echo "</ul>";
    mysqli_close($conn);
}

function show_all_phones(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT * FROM phones";
    $result = mysqli_query($conn,$sql);
    echo "<ul class=\"manage-list\">";
    while($row = mysqli_fetch_assoc($result)){
        echo "<li><a href=\"detail.php?phone=".$row["file_name"]."\" class =\"phones\">".$row["phone_model"]."</a></li>";
        echo "<a href=\"submit-phone.php?phone=".$row["file_name"]."&&action=edit\">Update</a>";
        echo "<a href=\"detail.php?phone=".$row["file_name"]."&&action=delete\">Delete</a>";
    }
    echo "</ul>";
    mysqli_close($conn);
}

function show_all_tablets(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT * FROM tablets";
    $result = mysqli_query($conn,$sql);
    echo "<ul class=\"manage-list\">";
    while($row = mysqli_fetch_assoc($result)){
        echo "<li><a href=\"detail.php?tablet=".$row["file_name"]."\" class =\"tablets\">".$row["tablet_model"]."</a></li>";
        echo "<a href=\"submit-tablet.php?tablet=".$row["file_name"]."&&action=edit\">Update</a>";
        echo "<a href=\"detail.php?tablet=".$row["file_name"]."&&action=delete\">Delete</a>";
    }
    echo "</ul>";
    mysqli_close($conn);
}

function show_all_laptops(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT * FROM laptops";
    $result = mysqli_query($conn,$sql);
    echo "<ul class=\"manage-list\">";
    while($row = mysqli_fetch_assoc($result)){
        echo "<li><a href=\"detail.php?laptop=".$row["file_name"]."\" class =\"laptops\">".$row["laptop_model"]."</a></li>";
        echo "<a href=\"submit-laptop.php?laptop=".$row["file_name"]."&&action=edit\">Update</a>";
        echo "<a href=\"detail.php?laptop=".$row["file_name"]."&&action=delete\">Delete</a>";
    }
    echo "</ul>";
    mysqli_close($conn);
}

function show_all_stores(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT * FROM stores";
    $result = mysqli_query($conn,$sql);
    echo "<ul class=\"manage-list\">";
    while($row = mysqli_fetch_assoc($result)){
        echo "<li><a href=\"detail.php?store=".$row["store_name"]."\" class =\"stores\">".$row["store_name"]."</a></li>";
        echo "<a href=\"submit-store.php?store=".$row["store_name"]."&&action=edit\">Update</a>";
        echo "<a href=\"detail.php?store=".$row["store_name"]."&&action=delete\">Delete</a>";
    }
    echo "</ul>";
    mysqli_close($conn);
}

function update_db($context){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    switch($context){
        case "page":
            $unique_key = $_POST["page_name"];
            foreach($_POST as $key => $value){
                if($key != "submit"){
                    $sql = "UPDATE `pages` SET $key = '$value' WHERE page_name = '$unique_key'";
                    echo $sql."<br />";
                }
            }
            break;
        case "phone":
            $unique_key = $_POST["phone_id"];
            foreach($_POST as $key => $value){
                if($key != "submit"){
                    $sql = "UPDATE `phones` SET $key = '$value' WHERE phone_id = '$unique_key'";
                    echo $sql."<br />";
                }
            }
            break;
        case "tablet":
            $unique_key = $_POST["tablet_id"];
            foreach($_POST as $key => $value){
                if($key != "submit"){
                    $sql = "UPDATE `tablets` SET $key = '$value' WHERE tablet_id = '$unique_key'";
                    echo $sql."<br />";
                }
            }
            break;
        case "laptop":
            $unique_key = $_POST["laptop_id"];
            foreach($_POST as $key => $value){
                if($key != "submit"){
                    $sql = "UPDATE `laptops` SET $key = '$value' WHERE laptop_id = '$unique_key'";
                    echo $sql."<br />";
                }
            }
            break;
    }
}

function search($keywords){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $keyword_array = explode(" ",$keywords);
    $construct = "";
    foreach($keyword_array as $key => $value){
        if($key == 0){
            $construct .= "'%$value%'";
        }else{
            $construct .= " OR "."'%$value%'";
        }
    }
    $sql = "SELECT * FROM `pages` WHERE page_title LIKE ".$construct;
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) == 0){
        echo "<div class=\"search-result\">";
        echo "<p>No results found.</p>";
        echo "</div>";
    }else{
        while($row = mysqli_fetch_assoc($result)){
                echo "<div class=\"search-result\">";
                foreach($row as $key => $value){
                    if($key == "page_title"){
                        echo "<div class=\"search-result-sec1\">";
                        echo "<a class=\"search-result-image-link\" href=\"http://".$row["page_canonical"].".php\">"."<img class =\"search-result-image\" src=\"http://www.kathmanduelectronics.com/images/".$row["fb_meta_image"]."\" alt=\"".$row["page_title"]."\" /></a>";
                        echo "</div>";
                        echo "<div class=\"search-result-sec2\">";
                        echo "<a class=\"search-result-link\" href=\"http://".$row["page_canonical"].".php\">".$row["page_title"]."</a>";
                        echo "<p class=\"search-result-url\">".$row["page_canonical"]."</p>";
                        echo "<p class=\"search-result-description\">".$row["page_description"]."</p>";
                        echo "</div>";
                    }
                }
                echo "</div>";
        }
    }
}

function convert_phone_brand_to_input(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT DISTINCT phone_brand FROM `phones`";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if(!is_null($value)) {
                echo "<label>";
                echo "<input id=\"phone_brand_$value\" class=\"filter-field\" type=\"checkbox\" name=\"brand[]\" value=\"" . $value . "\" />";
                echo "<span></span>";
                echo $value . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo "</label>";
            }
        }
    }
}

function convert_tablet_brand_to_input(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT DISTINCT tablet_brand FROM `tablets`";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if(!is_null($value)) {
                echo "<label>";
                echo "<input id=\"tablet_brand_$value\" class=\"filter-field\" type=\"checkbox\" name=\"brand[]\" value=\"" . $value . "\" />";
                echo "<span></span>";
                echo $value . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo "</label>";
            }
        }
    }
}

function convert_laptop_brand_to_input(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT DISTINCT laptop_brand FROM `laptops`";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if(!is_null($value)) {
                echo "<label>";
                echo "<input id=\"laptop_brand_$value\" class=\"filter-field\" type=\"checkbox\" name=\"brand[]\" value=\"" . $value . "\" />";
                echo "<span></span>";
                echo $value . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo "</label>";
            }
        }
    }
}

function convert_laptop_type_to_input(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT DISTINCT laptop_type FROM `laptops`";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if(!is_null($value)){
                echo "<label>";
                echo "<input id=\"laptop_type_$value\" class=\"filter-field\" type=\"checkbox\" name=\"type[]\" value=\"".$value."\" />";
                echo "<span></span>";
                echo $value."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo "</label>";
            }
        }
    }
}

function convert_laptop_processor_to_input(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT DISTINCT laptop_processor_type FROM `laptops`";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if(!is_null($value)){
                echo "<label>";
                echo "<input id=\"laptop_processor_type_$value\" class=\"filter-field\" type=\"checkbox\" name=\"processor_type[]\" value=\"".$value."\" />";
                echo "<span></span>";
                echo $value."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo "</label>";
            }
        }
    }
}

function convert_laptop_os_to_input(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT DISTINCT laptop_os FROM `laptops`";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if(!is_null($value)){
                echo "<label>";
                echo "<input id=\"laptop_os_$value\" class=\"filter-field\" type=\"checkbox\" name=\"os[]\" value=\"".$value."\" />";
                echo "<span></span>";
                echo $value."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo "</label>";
            }
        }
    }
}

function get_store_names($arg){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT store_name FROM stores";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if($arg != "" && $arg == $value){
                echo "<option selected>$value</option>";
            }else{
                echo "<option>$value</option>";
            }
        }
    }
}

function get_store_locations($arg){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT store_location FROM stores";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if($arg != "" && $arg == $value){
                echo "<option selected>$value</option>";
            }else{
                echo "<option>$value</option>";
            }
        }
    }
}

function get_latest_phones(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }

    $sql = "SELECT * FROM `phones` WHERE phone_launch >= '2017-01-01'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        echo "<div class=\"latest_phones_section\">";
        echo "<h2 class=\"section-header\">Latest Phones</h2>";
        echo "<ul>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<li class=\"latest_phone\">";
            foreach($row as $key => $value){
                if($key == "phone_model"){
                    echo "<a class=\"latest_phone_title\" href=\"http://www.kathmanduelectronics.com/phones/".$row["file_name"].".php\">".$row["phone_model"]."</a>";
                }
            }
            echo "</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
}

function get_latest_tablets(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }

    $sql = "SELECT * FROM `tablets` WHERE tablet_launch >= '2017-01-01'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        echo "<div class=\"latest_tablets_section\">";
        echo "<h2 class=\"section-header\">Latest Tablets</h2>";
        echo "<ul>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<li class=\"latest_tablet\">";
            foreach($row as $key => $value){
                if($key == "tablet_model"){
                    echo "<a class=\"latest_tablet_title\" href=\"http://www.kathmanduelectronics.com/tablets/".$row["file_name"].".php\">".$row["tablet_model"]."</a>";
                }
            }
            echo "</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
}

function get_latest_laptops(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }

    $sql = "SELECT * FROM `laptops` WHERE laptop_launch_date >= '2017-01-01'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        echo "<div class=\"latest_laptops_section\">";
        echo "<h2 class=\"section-header\">Latest Laptops</h2>";
        echo "<ul>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<li class=\"latest_laptop\">";
            foreach($row as $key => $value){
                if($key == "laptop_model"){
                    echo "<a class=\"latest_laptop_title\" href=\"http://www.kathmanduelectronics.com/laptops/".$row["file_name"].".php\">".$row["laptop_model"]."</a>";
                }
            }
            echo "</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
}

function get_best_list_titles(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT list_title FROM `best_list`";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            echo "<option>$value</option>";
        }
    }
}

function get_list_items($list_title){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT * FROM `best_list` WHERE list_title = '$list_title'";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        for($i = 0; $i <= 9; $i++){
            echo "<div class=\"best-list-item\">";
            echo "<p>";
            echo "<label class=\"flt_left\">".($i+1)."</label>";
            echo "<select name=\"list_item$i\" value=\"\">";
            echo "<option>".$row["list_item$i"]."</option>";

            if($list_title == "Best Phones" || $list_title == "Best Budget Phones" || $list_title == "Best Mid-Range Phones"){
                $sql2 = "SELECT phone_model FROM `phones`";
            }else if($list_title == "Best Tablets" || $list_title == "Best Budget Tablets" || $list_title == "Best Mid-Range Tablets"){
                $sql2 = "SELECT tablet_model FROM `tablets`";
            }else if($list_title == "Best Laptops" || $list_title == "Best Budget Laptops" || $list_title == "Best Mid-Range Laptops"){
                $sql2 = "SELECT laptop_model FROM `laptops`";
            }else{
                // do nothing
            }
            $result2 = mysqli_query($conn,$sql2);

            while($row2 = mysqli_fetch_assoc($result2)){
                foreach($row2 as $key2 => $value2){
                    if($key2 == "phone_model" || $key2 == "tablet_model" || $key2 == "laptop_model"){
                        echo "<option>".$value2."</option>";
                    }
                }
            }
            echo "</select>";
            echo "</p>";
            echo "<p>";
            echo "<label class=\"flt_left\">Item Description</label>";
            echo "<textarea name=\"list_item".$i."_description\">".$row["list_item$i"."_description"]."</textarea>";
            echo "</p>";
            echo "</div>";
        }
    }
}

function save_best_list(){
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "UPDATE `best_list` SET "."list_item0 = '".$_POST['list_item0']."', "."list_item1 = '".$_POST['list_item1']."', "."list_item2 = '".$_POST['list_item2']."', "."list_item3 = '".$_POST['list_item3']."', "."list_item4 = '".$_POST['list_item4']."', "."list_item5 = '".$_POST['list_item5']."', "."list_item6 = '".$_POST['list_item6']."', "."list_item7 = '".$_POST['list_item7']."', "."list_item8 = '".$_POST['list_item8']."', "."list_item9 = '".$_POST['list_item9']."', updated_date = '".date("Y-m-d")."', list_item0_description = '".$_POST['list_item0_description']."', "."list_item1_description = '".$_POST['list_item1_description']."', "."list_item2_description = '".$_POST['list_item2_description']."', "."list_item3_description = '".$_POST['list_item3_description']."', "."list_item4_description = '".$_POST['list_item4_description']."', "."list_item5_description = '".$_POST['list_item5_description']."', "."list_item6_description = '".$_POST['list_item6_description']."', "."list_item7_description = '".$_POST['list_item7_description']."', "."list_item8_description = '".$_POST['list_item8_description']."', "."list_item9_description = '".$_POST['list_item9_description']."' WHERE list_title = '".$_POST["list-title"]."'";
    if(mysqli_query($conn,$sql)){
        echo "<p class=\"msg_box\">".$_POST["list-title"]." updated successfully.</p>";
    }else{
        echo "<p class=\"msg_box_failed\">Update failed</p>";
    }
}

function get_list($list_title){
    // config
    if(!isset($con)){
        $con = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    if($list_title == "Best Phones" || $list_title == "Best Budget Phones" || $list_title == "Best Mid-Range Phones"){
        $context = "phone";
    }else if($list_title == "Best Tablets" || $list_title == "Best Budget Tablets" || $list_title == "Best Mid-Range Tablets"){
        $context = "tablet";
    }else if($list_title == "Best Laptops" || $list_title == "Best Budget Laptops" || $list_title == "Best Mid-Range Laptops"){
        $context = "laptop";
    }else{
        // do nothing
    }
    $sql = "SELECT * FROM `best_list` WHERE list_title = '$list_title'";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($result)){
        echo "<ol class=\"best-list\">";
        for($i = 0; $i <= 9;$i++){
            echo "<li>";
            $sql2 = "SELECT ".$context."_image_filename,file_name FROM `".$context."s` WHERE ".$context."_model = '".$row["list_item$i"]."'";
            $result2 = mysqli_query($con,$sql2);
            while($row2 = mysqli_fetch_assoc($result2)){
                    echo "<div class=\"best-list-sec1\">";
                    echo "<a class=\"best-list-image\" href=\"http://www.kathmanduelectronics.com/".$context."s/".$row2["file_name"].".php\"><img src=\"http://www.kathmanduelectronics.com/images/".$row2["$context"."_image_filename"]."\" alt=\"".$row["list_item$i"]."\"></img></a>";
                    echo "</div>";
                    // not related to this while but below section uses the values for links using filename.
                    echo "<div class=\"best-list-sec2\">";
                    echo "<a class=\"best-list-title\" href=\"http://www.kathmanduelectronics.com/".$context."s/".$row2["file_name"].".php\">".$row["list_item$i"]."</a>";
                    echo "<span class=\"best-list-description\">".$row["list_item$i"."_description"]."</span>";
                    echo "</div>";
                    echo "</li>";
            }
        }
        echo "</ol>";
    }
}

function extract_articles($context){
    switch($context){
        case "published":
            $sql = "SELECT * FROM articles_published";
            break;
        case "drafted":
            $sql = "SELECT * FROM articles_drafted";
            break;
    }
    if(!isset($conn2)){
        $conn2 = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $result = mysqli_query($conn2,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if($key == "article_heading"){
                echo "<div class=\"article\">";
                echo "<div class=\"article_sec1\">";
                echo "<a href=\"http://www.kathmanduelectronics.com/articles/".$row["filename"]."\"><img class=\"article_sec1_img\" src=\"http://www.kathmanduelectronics.com/images/".$row["article_image"]."\" alt=\"".$row["article_heading"]."\" /></a>";
                echo "</div>";
                echo "<div class=\"article_sec2\">";
                echo "<span class=\"article_category\">".$row["article_category"]."</span>";
                echo "<span class=\"article_publication_date\">".$row["article_date"]."</span>";
                echo "<h1 class=\"article_heading\"><a href=\"http://www.kathmanduelectronics.com/articles/".$row["filename"]."\">".$row["article_heading"]."</a></h1>";
                echo "<span class=\"article_description\">".$row["article_description"]."</span>";
                echo "</div>";
                echo "</div>";
            }
        }
    }
}

function get_drafts(){
    if(!isset($conn2)){
        $conn2 = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }

    $sql = "SELECT * FROM articles_drafted";
    $result = mysqli_query($conn2,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if($key == "article_heading"){
                echo "<div class=\"draft_article\">";
                echo "<p class=\"draft_article_heading\">".$row["article_heading"]."</a>";
                echo "<a href=\"http://www.kathmanduelectronics.com/admin/submit-article.php?draft=".$row["filename"]."&&action=edit\">Edit</a>";
                echo "<a href=\"http://www.kathmanduelectronics.com/admin/manage-website.php?draft=".$row["filename"]."&&action=delete\">Delete</a>";
                echo "</div>";
            }
        }
    }
}

function delete_draft(){
    if(!isset($conn2)){
        $conn2 = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "DELETE FROM articles_drafted WHERE filename = '".$_GET["draft"]."'";
    if(mysqli_query($conn2,$sql)){
        echo "<p class=\"msg_box\">Draft deleted successfully.</p>";
    }else{
        echo "<p class=\"msg_box_failed\">Failed to delete draft.</p>";
    }
}

function delete_published(){
    if(!isset($conn2)){
        $conn2 = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "DELETE FROM articles_published WHERE filename = '".$_GET["published"]."'";
    if(mysqli_query($conn2,$sql)){
        echo "<p class=\"msg_box\">Article deleted successfully.</p>";
    }else{
        echo "<p class=\"msg_box_failed\">Failed to delete article.</p>";
    }
}

function get_published_articles(){
    if(!isset($conn2)){
        $conn2 = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }

    $sql = "SELECT * FROM articles_published";
    $result = mysqli_query($conn2,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if($key == "article_heading"){
                echo "<div class=\"published_article\">";
                echo "<p class=\"published_article_heading\">".$row["article_heading"]."</a>";
                echo "<a href=\"http://www.kathmanduelectronics.com/admin/submit-article.php?published=".$row["filename"]."&&action=edit\">Edit</a>";
                echo "<a href=\"http://www.kathmanduelectronics.com/admin/manage-website.php?published=".$row["filename"]."&&action=delete\">Delete</a>";
                echo "</div>";
            }
        }
    }
}

function delete_published_article(){
    if(!isset($conn2)){
        $conn2 = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "DELETE FROM articles_published WHERE filename = '".$_GET["published"]."'";
    if(mysqli_query($conn2,$sql)){
        echo "<p class=\"msg_box\">Article deleted successfully.</p>";
    }else{
        echo "<p class=\"msg_box_failed\">Failed to delete article.</p>";
    }
}

function facebook_comments_api(){
    echo "<div id=\"fb-root\"></div>";
echo "<script>(function("."d, s, id)"." {";
        echo "var js, fjs = d.getElementsByTagName(s)[0];";
  echo "if (d.getElementById(id)) return;";
  echo "js = d.createElement(s); js.id = id;";
  echo "js.src = \"//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.9\";";
  echo "fjs.parentNode.insertBefore(js, fjs);";
echo "}(document, 'script', 'facebook-jssdk'));</script>";
}

function facebook_commenets_section(){
/*<?php if(basename(dirname($_SERVER['PHP_SELF'])) == "articles" || get_requested_page_file_name() == "index"): ?>*/
}

?>