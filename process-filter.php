<?php ob_start();

    $context = $_POST["filter_product"];
    switch($context){
        case "Phones":
            $context = "phones";
            break;
        case "Tablets":
            $context = "tablets";
            break;
        case "Laptops":
            $context = "laptops";
            break;
        default:
            // do nothing
    }
    $sql = "SELECT * FROM `".$context."` WHERE";
    if($context == "phones"){
        // -----------------brand ----------------------------
        if(isset($_POST["brand"])){
            $brand_tail = implode("', '",$_POST["brand"]);
            $brand_tail = "(phone_brand in ('".$brand_tail."'))";
        }else{
            $brand_tail = "";
        }
// -----------------price ----------------------------
        if(isset($_POST["price"])){
            $price_tail = array();
            for($i = 0;$i < count($_POST["price"]);$i++){
                switch($_POST["price"][$i]){
                    case "0 - 10000":
                        $price_high[] = 10000;
                        $price_low[] = 0;
                        break;
                    case "10000 - 20000":
                        $price_high[] = 20000;
                        $price_low[] = 10000;
                        break;
                    case "20000 - 30000":
                        $price_high[] = 30000;
                        $price_low[] = 20000;
                        break;
                    case "30000 - 50000":
                        $price_high[] = 50000;
                        $price_low[] = 30000;
                        break;
                    case "50000 - above":
                        $price_low[] = 50000;
                        $price_high[] = 99999999999;
                        break;
                }
                $price_tail[] .= "(phone_price >= $price_low[$i] AND phone_price <= $price_high[$i])";
            }
        }else{
            $price_tail = "";
        }

// -----------------sim count----------------------------
        if(isset($_POST["sim_count"])){
            $sim_count_tail = implode(", ",$_POST["sim_count"]);
            $sim_count_tail = "(phone_sim_count in (".$sim_count_tail."))";
        }else{
            $sim_count_tail = "";
        }
// -----------------display size----------------------------
        if(isset($_POST["display_size"])){
            $display_size_tail = array();
            for($i = 0;$i < count($_POST["display_size"]);$i++){
                switch($_POST["display_size"][$i]){
                    case "3 inch - below":
                        $display_size_high[] = 3.5;
                        $display_size_low[] = 0;
                        break;
                    case "3 - 3.5 inch":
                        $display_size_high[] = 3.5;
                        $display_size_low[] = 3;
                        break;
                    case "3.5 - 4 inch":
                        $display_size_high[] = 4;
                        $display_size_low[] = 3.5;
                        break;
                    case "4 - 4.5 inch":
                        $display_size_high[] = 4.5;
                        $display_size_low[] = 4;
                        break;
                    case "4.5 - 5 inch":
                        $display_size_low[] = 4.5;
                        $display_size_high[] = 5;
                        break;
                    case "5 - 5.5 inch":
                        $display_size_low[] = 5;
                        $display_size_high[] = 5.5;
                        break;
                    case "5.5 inch - above":
                        $display_size_low[] = 5.5;
                        $display_size_high[] = 999999;
                        break;
                }
                $display_size_tail[] .= "(phone_display_size >= $display_size_low[$i] AND phone_display_size <= $display_size_high[$i])";
            }
        }else{
            $display_size_tail = "";
        }
// -----------------display resolution----------------------------

// -----------------os----------------------------
        if(isset($_POST["os"])){
            $os_tail = implode("', '",$_POST["os"]);
            $os_tail = "(phone_os in ('".$os_tail."'))";
        }else{
            $os_tail = "";
        }
// -----------------clock speed----------------------------
        if(isset($_POST["clock_speed"])){
            $clock_speed_tail = array();
            for($i = 0;$i < count($_POST["clock_speed"]);$i++){
                switch($_POST["clock_speed"][$i]){
                    case "1 - 1.5 GHz":
                        $clock_speed_high[] = 1.5;
                        $clock_speed_low[] = 1;
                        break;
                    case "1.5 - 2 GHz":
                        $clock_speed_high[] = 2;
                        $clock_speed_low[] = 1.5;
                        break;
                    case "2 - 2.5 GHz":
                        $clock_speed_high[] = 2.5;
                        $clock_speed_low[] = 2;
                        break;
                    case "2.5 GHz - above":
                        $clock_speed_high[] = 999999;
                        $clock_speed_low[] = 2.5;
                        break;
                }
                $clock_speed_tail[] .= "(phone_cpu_clock_freq >= $clock_speed_low[$i] AND phone_cpu_clock_freq <= $clock_speed_high[$i])";
            }
        }else{
            $clock_speed_tail = "";
        }
// -----------------cores count----------------------------
        if(isset($_POST["cores_count"])){
            $cores_count_tail = implode(", ",$_POST["cores_count"]);
            $cores_count_tail = "(phone_cpu_core_count in (".$cores_count_tail."))";
        }else{
            $cores_count_tail = "";
        }
// -----------------ram----------------------------
        if(isset($_POST["ram"])){
            $ram_tail = array();
            for($i = 0;$i < count($_POST["ram"]);$i++){
                switch($_POST["ram"][$i]){
                    case "0 - 1 GB":
                        $ram_high[] = 1;
                        $ram_low[] = 0;
                        break;
                    case "1 - 2 GB":
                        $ram_high[] = 2;
                        $ram_low[] = 1;
                        break;
                    case "2 - 4 GB":
                        $ram_high[] = 4;
                        $ram_low[] = 2;
                        break;
                    case "4 GB - above":
                        $ram_high[] = 999999;
                        $ram_low[] = 4;
                        break;
                }
                $ram_tail[] .= "(phone_ram >= $ram_low[$i] AND phone_ram <= $ram_high[$i])";
            }
        }else{
            $ram_tail = "";
        }
// ------------------------internal memory--------------------------
        if(isset($_POST["internal_memory"])){
            $internal_memory_tail = array();
            for($i = 0;$i < count($_POST["internal_memory"]);$i++){
                switch($_POST["internal_memory"][$i]){
                    case "1 - 4 GB":
                        $internal_memory_high[] = 4;
                        $internal_memory_low[] = 1;
                        break;
                    case "4 - 8 GB":
                        $internal_memory_high[] = 8;
                        $internal_memory_low[] = 4;
                        break;
                    case "8 - 16 GB":
                        $internal_memory_high[] = 16;
                        $internal_memory_low[] = 8;
                        break;
                    case "16 - 32 GB":
                        $internal_memory_high[] = 32;
                        $internal_memory_low[] = 16;
                        break;
                    case "32 - 64 GB":
                        $internal_memory_high[] = 64;
                        $internal_memory_low[] = 32;
                        break;
                    case "64 - 128 GB":
                        $internal_memory_high[] = 128;
                        $internal_memory_low[] = 64;
                        break;
                    case "128 GB - above":
                        $internal_memory_high[] = 999999;
                        $internal_memory_low[] = 128;
                        break;
                }
                $internal_memory_tail[] .= "(phone_internal_memory_size >= $internal_memory_low[$i] AND phone_internal_memory_size <= $internal_memory_high[$i])";
            }
        }else{
            $internal_memory_tail = "";
        }
// ------------------------external memory--------------------------
        if(isset($_POST["external_memory"])){
            $external_memory_tail = array();
            for($i = 0;$i < count($_POST["external_memory"]);$i++){
                switch($_POST["external_memory"][$i]){
                    case "1 - 4 GB":
                        $external_memory_high[] = 4;
                        $external_memory_low[] = 1;
                        break;
                    case "4 - 8 GB":
                        $external_memory_high[] = 8;
                        $external_memory_low[] = 4;
                        break;
                    case "8 - 16 GB":
                        $external_memory_high[] = 16;
                        $external_memory_low[] = 8;
                        break;
                    case "16 - 32 GB":
                        $external_memory_high[] = 32;
                        $external_memory_low[] = 16;
                        break;
                    case "32 - 64 GB":
                        $external_memory_high[] = 64;
                        $external_memory_low[] = 32;
                        break;
                    case "64 - 128 GB":
                        $external_memory_high[] = 128;
                        $external_memory_low[] = 64;
                        break;
                    case "128 GB - above":
                        $external_memory_high[] = 999999;
                        $external_memory_low[] = 128;
                        break;
                }
                $external_memory_tail[] .= "(phone_external_memory_size >= $external_memory_low[$i] AND phone_external_memory_size <= $external_memory_high[$i])";
            }
        }else{
            $external_memory_tail = "";
        }
// ------------------------primary camera--------------------------
        if(isset($_POST["primary_camera"])){
            $primary_camera_tail = array();
            for($i = 0;$i < count($_POST["primary_camera"]);$i++){
                switch($_POST["primary_camera"][$i]){
                    case "2 MP - below":
                        $primary_camera_high[] = 2;
                        $primary_camera_low[] = 0;
                        break;
                    case "2 - 2.9 MP":
                        $primary_camera_high[] = 2.9;
                        $primary_camera_low[] = 2;
                        break;
                    case "3 - 4.9 MP":
                        $primary_camera_high[] = 4.9;
                        $primary_camera_low[] = 3;
                        break;
                    case "5 - 7.9 MP":
                        $primary_camera_high[] = 7.9;
                        $primary_camera_low[] = 5;
                        break;
                    case "8 MP - above":
                        $primary_camera_high[] = 99999;
                        $primary_camera_low[] = 8;
                        break;
                }
                $primary_camera_tail[] .= "(phone_primary_camera_pixel_size >= $primary_camera_low[$i] AND phone_primary_camera_pixel_size <= $primary_camera_high[$i])";
            }
        }else{
            $primary_camera_tail = "";
        }
// ------------------------secondary camera--------------------------
        if(isset($_POST["secondary_camera"])){
            $secondary_camera_tail = array();
            for($i = 0;$i < count($_POST["secondary_camera"]);$i++){
                switch($_POST["secondary_camera"][$i]){
                    case "2 MP - below":
                        $secondary_camera_high[] = 2;
                        $secondary_camera_low[] = 0;
                        break;
                    case "2 - 2.9 MP":
                        $secondary_camera_high[] = 2.9;
                        $secondary_camera_low[] = 2;
                        break;
                    case "3 - 4.9 MP":
                        $secondary_camera_high[] = 4.9;
                        $secondary_camera_low[] = 3;
                        break;
                    case "5 - 7.9 MP":
                        $secondary_camera_high[] = 7.9;
                        $secondary_camera_low[] = 5;
                        break;
                    case "8 MP - above":
                        $secondary_camera_high[] = 99999;
                        $secondary_camera_low[] = 8;
                        break;
                }
                $secondary_camera_tail[] .= "(phone_secondary_camera_pixel_size >= $secondary_camera_low[$i] AND phone_secondary_camera_pixel_size <= $secondary_camera_high[$i])";
            }
        }else{
            $secondary_camera_tail = "";
        }
// ------------------------battery size--------------------------
        if(isset($_POST["battery_size"])){
            $battery_size_tail = array();
            for($i = 0;$i < count($_POST["battery_size"]);$i++){
                switch($_POST["battery_size"][$i]){
                    case "1000 mAh - below":
                        $battery_size_high[] = 1000;
                        $battery_size_low[] = 0;
                        break;
                    case "1000 - 1999 mAh":
                        $battery_size_high[] = 1999;
                        $battery_size_low[] = 1000;
                        break;
                    case "2000 - 2999 mAh":
                        $battery_size_high[] = 2999;
                        $battery_size_low[] = 2000;
                        break;
                    case "3000 - 3999 mAh":
                        $battery_size_high[] = 3999;
                        $battery_size_low[] = 3000;
                        break;
                    case "4000 mAh - above":
                        $battery_size_high[] = 9999999;
                        $battery_size_low[] = 4000;
                        break;
                }
                $battery_size_tail[] .= "(phone_battery_size >= $battery_size_low[$i] AND phone_battery_size <= $battery_size_high[$i])";
            }
        }else{
            $battery_size_tail = "";
        }
    }
    else if($context == "tablets"){
        // -----------------brand ----------------------------
        if(isset($_POST["brand"])){
            $brand_tail = implode("', '",$_POST["brand"]);
            $brand_tail = "(tablet_brand in ('".$brand_tail."'))";
        }else{
            $brand_tail = "";
        }
// -----------------price ----------------------------
        if(isset($_POST["price"])){
            $price_tail = array();
            for($i = 0;$i < count($_POST["price"]);$i++){
                switch($_POST["price"][$i]){
                    case "0 - 10000":
                        $price_high[] = 10000;
                        $price_low[] = 0;
                        break;
                    case "10000 - 20000":
                        $price_high[] = 20000;
                        $price_low[] = 10000;
                        break;
                    case "20000 - 30000":
                        $price_high[] = 30000;
                        $price_low[] = 20000;
                        break;
                    case "30000 - 50000":
                        $price_high[] = 50000;
                        $price_low[] = 30000;
                        break;
                    case "50000 - above":
                        $price_low[] = 50000;
                        $price_high[] = 99999999999;
                        break;
                }
                $price_tail[] .= "(tablet_price >= $price_low[$i] AND tablet_price <= $price_high[$i])";
            }
        }else{
            $price_tail = "";
        }

// -----------------sim count----------------------------
        if(isset($_POST["sim_count"])){
            $sim_count_tail = implode(", ",$_POST["sim_count"]);
            $sim_count_tail = "(tablet_sim_count in (".$sim_count_tail."))";
        }else{
            $sim_count_tail = "";
        }
// -----------------display size----------------------------
        if(isset($_POST["display_size"])){
            $display_size_tail = array();
            for($i = 0;$i < count($_POST["display_size"]);$i++){
                switch($_POST["display_size"][$i]){
                    case "7 inch - below":
                        $display_size_high[] = 7;
                        $display_size_low[] = 0;
                        break;
                    case "7 - 8 inch":
                        $display_size_high[] = 8;
                        $display_size_low[] = 7;
                        break;
                    case "8 - 9 inch":
                        $display_size_high[] = 9;
                        $display_size_low[] = 8;
                        break;
                    case "9 - 10 inch":
                        $display_size_high[] = 10;
                        $display_size_low[] = 9;
                        break;
                    case "10 inch - above":
                        $display_size_low[] = 10;
                        $display_size_high[] = 999999;
                        break;
                }
                $display_size_tail[] .= "(tablet_display_size >= $display_size_low[$i] AND tablet_display_size <= $display_size_high[$i])";
            }
        }else{
            $display_size_tail = "";
        }
// -----------------display resolution----------------------------

// -----------------os----------------------------
        if(isset($_POST["os"])){
            $os_tail = implode("', '",$_POST["os"]);
            $os_tail = "(tablet_os in ('".$os_tail."'))";
        }else{
            $os_tail = "";
        }
// -----------------clock speed----------------------------
        if(isset($_POST["clock_speed"])){
            $clock_speed_tail = array();
            for($i = 0;$i < count($_POST["clock_speed"]);$i++){
                switch($_POST["clock_speed"][$i]){
                    case "1 - 1.5 GHz":
                        $clock_speed_high[] = 1.5;
                        $clock_speed_low[] = 1;
                        break;
                    case "1.5 - 2 GHz":
                        $clock_speed_high[] = 2;
                        $clock_speed_low[] = 1.5;
                        break;
                    case "2 - 2.5 GHz":
                        $clock_speed_high[] = 2.5;
                        $clock_speed_low[] = 2;
                        break;
                    case "2.5 GHz - above":
                        $clock_speed_high[] = 999999;
                        $clock_speed_low[] = 2.5;
                        break;
                }
                $clock_speed_tail[] .= "(tablet_cpu_clock_freq >= $clock_speed_low[$i] AND tablet_cpu_clock_freq <= $clock_speed_high[$i])";
            }
        }else{
            $clock_speed_tail = "";
        }
// -----------------cores count----------------------------
        if(isset($_POST["cores_count"])){
            $cores_count_tail = implode(", ",$_POST["cores_count"]);
            $cores_count_tail = "(tablet_cpu_core_count in (".$cores_count_tail."))";
        }else{
            $cores_count_tail = "";
        }
// -----------------ram----------------------------
        if(isset($_POST["ram"])){
            $ram_tail = array();
            for($i = 0;$i < count($_POST["ram"]);$i++){
                switch($_POST["ram"][$i]){
                    case "0 - 1 GB":
                        $ram_high[] = 1;
                        $ram_low[] = 0;
                        break;
                    case "1 - 2 GB":
                        $ram_high[] = 2;
                        $ram_low[] = 1;
                        break;
                    case "2 - 4 GB":
                        $ram_high[] = 4;
                        $ram_low[] = 2;
                        break;
                    case "4 GB - above":
                        $ram_high[] = 999999;
                        $ram_low[] = 4;
                        break;
                }
                $ram_tail[] .= "(tablet_ram >= $ram_low[$i] AND tablet_ram <= $ram_high[$i])";
            }
        }else{
            $ram_tail = "";
        }
// ------------------------internal memory--------------------------
        if(isset($_POST["internal_memory"])){
            $internal_memory_tail = array();
            for($i = 0;$i < count($_POST["internal_memory"]);$i++){
                switch($_POST["internal_memory"][$i]){
                    case "1 - 4 GB":
                        $internal_memory_high[] = 4;
                        $internal_memory_low[] = 1;
                        break;
                    case "4 - 8 GB":
                        $internal_memory_high[] = 8;
                        $internal_memory_low[] = 4;
                        break;
                    case "8 - 16 GB":
                        $internal_memory_high[] = 16;
                        $internal_memory_low[] = 8;
                        break;
                    case "16 - 32 GB":
                        $internal_memory_high[] = 32;
                        $internal_memory_low[] = 16;
                        break;
                    case "32 - 64 GB":
                        $internal_memory_high[] = 64;
                        $internal_memory_low[] = 32;
                        break;
                    case "64 - 128 GB":
                        $internal_memory_high[] = 128;
                        $internal_memory_low[] = 64;
                        break;
                    case "128 GB - above":
                        $internal_memory_high[] = 999999;
                        $internal_memory_low[] = 128;
                        break;
                }
                $internal_memory_tail[] .= "(tablet_internal_memory_size >= $internal_memory_low[$i] AND tablet_internal_memory_size <= $internal_memory_high[$i])";
            }
        }else{
            $internal_memory_tail = "";
        }
// ------------------------external memory--------------------------
        if(isset($_POST["external_memory"])){
            $external_memory_tail = array();
            for($i = 0;$i < count($_POST["external_memory"]);$i++){
                switch($_POST["external_memory"][$i]){
                    case "1 - 4 GB":
                        $external_memory_high[] = 4;
                        $external_memory_low[] = 1;
                        break;
                    case "4 - 8 GB":
                        $external_memory_high[] = 8;
                        $external_memory_low[] = 4;
                        break;
                    case "8 - 16 GB":
                        $external_memory_high[] = 16;
                        $external_memory_low[] = 8;
                        break;
                    case "16 - 32 GB":
                        $external_memory_high[] = 32;
                        $external_memory_low[] = 16;
                        break;
                    case "32 - 64 GB":
                        $external_memory_high[] = 64;
                        $external_memory_low[] = 32;
                        break;
                    case "64 - 128 GB":
                        $external_memory_high[] = 128;
                        $external_memory_low[] = 64;
                        break;
                    case "128 GB - above":
                        $external_memory_high[] = 999999;
                        $external_memory_low[] = 128;
                        break;
                }
                $external_memory_tail[] .= "(tablet_external_memory_size >= $external_memory_low[$i] AND tablet_external_memory_size <= $external_memory_high[$i])";
            }
        }else{
            $external_memory_tail = "";
        }
// ------------------------primary camera--------------------------
        if(isset($_POST["primary_camera"])){
            $primary_camera_tail = array();
            for($i = 0;$i < count($_POST["primary_camera"]);$i++){
                switch($_POST["primary_camera"][$i]){
                    case "2 MP - below":
                        $primary_camera_high[] = 2;
                        $primary_camera_low[] = 0;
                        break;
                    case "2 - 2.9 MP":
                        $primary_camera_high[] = 2.9;
                        $primary_camera_low[] = 2;
                        break;
                    case "3 - 4.9 MP":
                        $primary_camera_high[] = 4.9;
                        $primary_camera_low[] = 3;
                        break;
                    case "5 - 7.9 MP":
                        $primary_camera_high[] = 7.9;
                        $primary_camera_low[] = 5;
                        break;
                    case "8 MP - above":
                        $primary_camera_high[] = 99999;
                        $primary_camera_low[] = 8;
                        break;
                }
                $primary_camera_tail[] .= "(tablet_primary_camera_pixel_size >= $primary_camera_low[$i] AND tablet_primary_camera_pixel_size <= $primary_camera_high[$i])";
            }
        }else{
            $primary_camera_tail = "";
        }
// ------------------------secondary camera--------------------------
        if(isset($_POST["secondary_camera"])){
            $secondary_camera_tail = array();
            for($i = 0;$i < count($_POST["secondary_camera"]);$i++){
                switch($_POST["secondary_camera"][$i]){
                    case "2 MP - below":
                        $secondary_camera_high[] = 2;
                        $secondary_camera_low[] = 0;
                        break;
                    case "2 - 2.9 MP":
                        $secondary_camera_high[] = 2.9;
                        $secondary_camera_low[] = 2;
                        break;
                    case "3 - 4.9 MP":
                        $secondary_camera_high[] = 4.9;
                        $secondary_camera_low[] = 3;
                        break;
                    case "5 - 7.9 MP":
                        $secondary_camera_high[] = 7.9;
                        $secondary_camera_low[] = 5;
                        break;
                    case "8 MP - above":
                        $secondary_camera_high[] = 99999;
                        $secondary_camera_low[] = 8;
                        break;
                }
                $secondary_camera_tail[] .= "(tablet_secondary_camera_pixel_size >= $secondary_camera_low[$i] AND tablet_secondary_camera_pixel_size <= $secondary_camera_high[$i])";
            }
        }else{
            $secondary_camera_tail = "";
        }
// ------------------------battery size--------------------------
        if(isset($_POST["battery_size"])){
            $battery_size_tail = array();
            for($i = 0;$i < count($_POST["battery_size"]);$i++){
                switch($_POST["battery_size"][$i]){
                    case "4000 mAh - below":
                        $battery_size_high[] = 4000;
                        $battery_size_low[] = 0;
                        break;
                    case "4000 - 6000 mAh":
                        $battery_size_high[] = 6000;
                        $battery_size_low[] = 4000;
                        break;
                    case "6000 - 8000 mAh":
                        $battery_size_high[] = 8000;
                        $battery_size_low[] = 6000;
                        break;
                    case "8000 mAh - above":
                        $battery_size_high[] = 9999999;
                        $battery_size_low[] = 8000;
                        break;
                }
                $battery_size_tail[] .= "(tablet_battery_size >= $battery_size_low[$i] AND tablet_battery_size <= $battery_size_high[$i])";
            }
        }else{
            $battery_size_tail = "";
        }
    }
    else if($context == "laptops"){
        // -----------------brand ----------------------------
        if(isset($_POST["brand"])){
            $brand_tail = implode("', '",$_POST["brand"]);
            $brand_tail = "(laptop_brand in ('".$brand_tail."'))";
        }
        else{
            $brand_tail = "";
        }
// -----------------type -----------------------------
        if(isset($_POST["type"])){
            $type_tail = implode("', '",$_POST["type"]);
            $type_tail = "(laptop_type in ('".$type_tail."'))";
        }
        else{
            $type_tail = "";
        }
// -----------------price ----------------------------
        if(isset($_POST["price"])){
            $price_tail = array();
            for($i = 0;$i < count($_POST["price"]);$i++){
                switch($_POST["price"][$i]){
                    case "0 - 30000":
                        $price_high[] = 30000;
                        $price_low[] = 0;
                        break;
                    case "30000 - 50000":
                        $price_high[] = 50000;
                        $price_low[] = 30000;
                        break;
                    case "50000 - 100000":
                        $price_high[] = 100000;
                        $price_low[] = 50000;
                        break;
                    case "100000 - 150000":
                        $price_high[] = 150000;
                        $price_low[] = 100000;
                        break;
                    case "150000 - above":
                        $price_low[] = 150000;
                        $price_high[] = 99999999999;
                        break;
                }
                $price_tail[] .= "(laptop_price >= $price_low[$i] AND laptop_price <= $price_high[$i])";
            }
        }
        else{
            $price_tail = "";
        }
// -----------------processor type ----------------------------
        if(isset($_POST["processor_type"])){
            $processor_type_tail = implode("', '",$_POST["processor_type"]);
            $processor_type_tail = "(laptop_processor_type in ('".$processor_type_tail."'))";
        }
        else{
            $processor_type_tail = "";
        }
// -----------------display size ------------------------
        if(isset($_POST["display_size"])){
            $display_size_tail = array();
            for($i = 0;$i < count($_POST["display_size"]);$i++){
                switch($_POST["display_size"][$i]){
                    case "12 inch - below":
                        $display_size_high[] = 12;
                        $display_size_low[] = 0;
                        break;
                    case "12 - 12.9 inch":
                        $display_size_high[] = 12.9;
                        $display_size_low[] = 12;
                        break;
                    case "13 - 13.9 inch":
                        $display_size_high[] = 13.9;
                        $display_size_low[] = 13;
                        break;
                    case "14 - 14.9 inch":
                        $display_size_high[] = 14.9;
                        $display_size_low[] = 14;
                        break;
                    case "15 - 15.9 inch":
                        $display_size_high[] = 15.9;
                        $display_size_low[] = 15;
                        break;
                    case "16 - 16.9 inch":
                        $display_size_high[] = 16.9;
                        $display_size_low[] = 16;
                        break;
                    case "17 - 17.9 inch":
                        $display_size_high[] = 17.9;
                        $display_size_low[] = 17;
                        break;
                    case "18 inch - above":
                        $display_size_low[] = 18;
                        $display_size_high[] = 999999;
                        break;
                }
                $display_size_tail[] .= "(laptop_display_size >= $display_size_low[$i] AND laptop_display_size <= $display_size_high[$i])";
            }
        }
        else{
            $display_size_tail = "";
        }
// -----------------ram -----------------------------
        if(isset($_POST["ram"])){
            $ram_tail = array();
            for($i = 0;$i < count($_POST["ram"]);$i++){
                switch($_POST["ram"][$i]){
                    case "0 - 2 GB":
                        $ram_high[] = 2;
                        $ram_low[] = 0;
                        break;
                    case "2 - 4 GB":
                        $ram_high[] = 4;
                        $ram_low[] = 2;
                        break;
                    case "4 - 8 GB":
                        $ram_high[] = 8;
                        $ram_low[] = 4;
                        break;
                    case "8 - 16 GB":
                        $ram_high[] = 16;
                        $ram_low[] = 8;
                        break;
                    case "16 GB - above":
                        $ram_high[] = 999999;
                        $ram_low[] = 16;
                        break;
                }
                $ram_tail[] .= "(laptop_ram_size >= $ram_low[$i] AND laptop_ram_size <= $ram_high[$i])";
            }
        }
        else{
            $ram_tail = "";
        }
// -----------------storage -----------------------------
        if(isset($_POST["storage"])){
            $storage_tail = array();
            for($i = 0;$i < count($_POST["storage"]);$i++){
                switch($_POST["storage"][$i]){
                    case "0 - 1 GB":
                        $storage_high[] = 1;
                        $storage_low[] = 0;
                        break;
                    case "1 - 2 GB":
                        $storage_high[] = 2;
                        $storage_low[] = 1;
                        break;
                    case "2 - 4 GB":
                        $storage_high[] = 4;
                        $storage_low[] = 2;
                        break;
                    case "4 GB - above":
                        $storage_high[] = 999999;
                        $storage_low[] = 4;
                        break;
                }
                $storage_tail[] .= "(laptop_storage_size >= $storage_low[$i] AND laptop_storage_size <= $storage_high[$i])";
            }
        }
        else{
            $storage_tail = "";
        }
    }
    else{
        // do nothing
    }



if($context == "phones" || $context == "tablets"){
    if($brand_tail != ""){$sql .= " ".$brand_tail;}
    if($price_tail != ""){
        $n = count($price_tail);
        if($sql == "SELECT * FROM `".$context."` WHERE"){
            for($i = 1;$i < $n;$i++){
                $price_tail[0] .= " OR ".$price_tail[$i];
            }
            $price_tail_final = "(".$price_tail[0].")";
            $sql .= $price_tail_final;
        }else{
            $sql .= " AND ";
            for($i = 1;$i < $n;$i++){
                $price_tail[0] .= " OR ".$price_tail[$i];
            }
            $price_tail_final = "(".$price_tail[0].")";
            $sql .= $price_tail_final;
        }
    }

    if($sim_count_tail != ""){
        if($sql == "SELECT * FROM `".$context."` WHERE"){
            $sql .= " ".$sim_count_tail;
        }else{
            $sql .= " AND ".$sim_count_tail;
        }
    }
    if($display_size_tail != ""){
        $n = count($display_size_tail);
        if($sql == "SELECT * FROM `".$context."` WHERE"){
            for($i = 1;$i < $n;$i++){
                $display_size_tail[0] .= " OR ".$display_size_tail[$i];
            }
            $display_size_tail_final = "(".$display_size_tail[0].")";
            $sql .= $display_size_tail_final;
        }else{
            $sql .= " AND ";
            for($i = 1;$i < $n;$i++){
                $display_size_tail[0] .= " OR ".$display_size_tail[$i];
            }
            $display_size_tail_final = "(".$display_size_tail[0].")";
            $sql .= $display_size_tail_final;
        }
    }

    if($os_tail != ""){if($sql == "SELECT * FROM `".$context."` WHERE"){$sql .= " ".$os_tail;}else{$sql .= " AND ".$os_tail;}}

    if($clock_speed_tail != ""){
        $n = count($clock_speed_tail);
        if($sql == "SELECT * FROM `".$context."` WHERE"){
            for($i = 1;$i < $n;$i++){
                $clock_speed_tail[0] .= " OR ".$clock_speed_tail[$i];
            }
            $clock_speed_tail_final = "(".$clock_speed_tail[0].")";
            $sql .= $clock_speed_tail_final;
        }else{
            $sql .= " AND ";
            for($i = 1;$i < $n;$i++){
                $clock_speed_tail[0] .= " OR ".$clock_speed_tail[$i];
            }
            $clock_speed_tail_final = "(".$clock_speed_tail[0].")";
            $sql .= $clock_speed_tail_final;
        }
    }
    if($cores_count_tail != ""){if($sql == "SELECT * FROM `".$context."` WHERE"){$sql .= " ".$cores_count_tail;}else{$sql .= " AND ".$cores_count_tail;}}


    if($ram_tail != ""){
        $n = count($ram_tail);
        if($sql == "SELECT * FROM `".$context."` WHERE"){
            for($i = 1;$i < $n;$i++){
                $ram_tail[0] .= " OR ".$ram_tail[$i];
            }
            $ram_tail_final = "(".$ram_tail[0].")";
            $sql .= $ram_tail_final;
        }else{
            $sql .= " AND ";
            for($i = 1;$i < $n;$i++){
                $ram_tail[0] .= " OR ".$ram_tail[$i];
            }
            $ram_tail_final = "(".$ram_tail[0].")";
            $sql .= $ram_tail_final;
        }
    }
    if($internal_memory_tail != ""){
        $n = count($internal_memory_tail);
        if($sql == "SELECT * FROM `".$context."` WHERE"){
            for($i = 1;$i < $n;$i++){
                $internal_memory_tail[0] .= " OR ".$internal_memory_tail[$i];
            }
            $internal_memory_tail_final = "(".$internal_memory_tail[0].")";
            $sql .= $internal_memory_tail_final;
        }else{
            $sql .= " AND ";
            for($i = 1;$i < $n;$i++){
                $internal_memory_tail[0] .= " OR ".$internal_memory_tail[$i];
            }
            $internal_memory_tail_final = "(".$internal_memory_tail[0].")";
            $sql .= $internal_memory_tail_final;
        }
    }

    if($external_memory_tail != ""){
        $n = count($external_memory_tail);
        if($sql == "SELECT * FROM `".$context."` WHERE"){
            for($i = 1;$i < $n;$i++){
                $external_memory_tail[0] .= " OR ".$external_memory_tail[$i];
            }
            $external_memory_tail_final = "(".$external_memory_tail[0].")";
            $sql .= $external_memory_tail_final;
        }else{
            $sql .= " AND ";
            for($i = 1;$i < $n;$i++){
                $external_memory_tail[0] .= " OR ".$external_memory_tail[$i];
            }
            $external_memory_tail_final = "(".$external_memory_tail[0].")";
            $sql .= $external_memory_tail_final;
        }
    }

    if($primary_camera_tail != ""){
        $n = count($primary_camera_tail);
        if($sql == "SELECT * FROM `".$context."` WHERE"){
            for($i = 1;$i < $n;$i++){
                $primary_camera_tail[0] .= " OR ".$primary_camera_tail[$i];
            }
            $primary_camera_tail_final = "(".$primary_camera_tail[0].")";
            $sql .= $primary_camera_tail_final;
        }else{
            $sql .= " AND ";
            for($i = 1;$i < $n;$i++){
                $primary_camera_tail[0] .= " OR ".$primary_camera_tail[$i];
            }
            $primary_camera_tail_final = "(".$primary_camera_tail[0].")";
            $sql .= $primary_camera_tail_final;
        }
    }
    if($secondary_camera_tail != ""){
        $n = count($secondary_camera_tail);
        if($sql == "SELECT * FROM `".$context."` WHERE"){
            for($i = 1;$i < $n;$i++){
                $secondary_camera_tail[0] .= " OR ".$secondary_camera_tail[$i];
            }
            $secondary_camera_tail_final = "(".$secondary_camera_tail[0].")";
            $sql .= $secondary_camera_tail_final;
        }else{
            $sql .= " AND ";
            for($i = 1;$i < $n;$i++){
                $secondary_camera_tail[0] .= " OR ".$secondary_camera_tail[$i];
            }
            $secondary_camera_tail_final = "(".$secondary_camera_tail[0].")";
            $sql .= $secondary_camera_tail_final;
        }
    }
    if($battery_size_tail != ""){
        $n = count($battery_size_tail);
        if($sql == "SELECT * FROM `".$context."` WHERE"){
            for($i = 1;$i < $n;$i++){
                $battery_size_tail[0] .= " OR ".$battery_size_tail[$i];
            }
            $battery_size_tail_final = "(".$battery_size_tail[0].")";
            $sql .= $battery_size_tail_final;
        }else{
            $sql .= " AND ";
            for($i = 1;$i < $n;$i++){
                $battery_size_tail[0] .= " OR ".$battery_size_tail[$i];
            }
            $battery_size_tail_final = "(".$battery_size_tail[0].")";
            $sql .= $battery_size_tail_final;
        }
    }
}
else if($context == "laptops"){
    if($brand_tail != ""){$sql .= " ".$brand_tail;}
    if($type_tail != ""){if($sql == "SELECT * FROM `".$context."` WHERE"){$sql .= " ".$type_tail;}else{$sql .= " AND ".$type_tail;}}
    if($price_tail != ""){
        $n = count($price_tail);
        if($sql == "SELECT * FROM `".$context."` WHERE"){
            for($i = 1;$i < $n;$i++){
                $price_tail[0] .= " OR ".$price_tail[$i];
            }
            $price_tail_final = "(".$price_tail[0].")";
            $sql .= $price_tail_final;
        }else{
            $sql .= " AND ";
            for($i = 1;$i < $n;$i++){
                $price_tail[0] .= " OR ".$price_tail[$i];
            }
            $price_tail_final = "(".$price_tail[0].")";
            $sql .= $price_tail_final;
        }
    }
    if($processor_type_tail != ""){if($sql == "SELECT * FROM `".$context."` WHERE"){$sql .= " ".$processor_type_tail;}else{$sql .= " AND ".$processor_type_tail;}}
    if($display_size_tail != ""){
        $n = count($display_size_tail);
        if($sql == "SELECT * FROM `".$context."` WHERE"){
            for($i = 1;$i < $n;$i++){
                $display_size_tail[0] .= " OR ".$display_size_tail[$i];
            }
            $display_size_tail_final = "(".$display_size_tail[0].")";
            $sql .= $display_size_tail_final;
        }else{
            $sql .= " AND ";
            for($i = 1;$i < $n;$i++){
                $display_size_tail[0] .= " OR ".$display_size_tail[$i];
            }
            $display_size_tail_final = "(".$display_size_tail[0].")";
            $sql .= $display_size_tail_final;
        }
    }
    if($ram_tail != ""){
        $n = count($ram_tail);
        if($sql == "SELECT * FROM `".$context."` WHERE"){
            for($i = 1;$i < $n;$i++){
                $ram_tail[0] .= " OR ".$ram_tail[$i];
            }
            $ram_tail_final = "(".$ram_tail[0].")";
            $sql .= $ram_tail_final;
        }else{
            $sql .= " AND ";
            for($i = 1;$i < $n;$i++){
                $ram_tail[0] .= " OR ".$ram_tail[$i];
            }
            $ram_tail_final = "(".$ram_tail[0].")";
            $sql .= $ram_tail_final;
        }
    }
    if($storage_tail != ""){
        $n = count($storage_tail);
        if($sql == "SELECT * FROM `".$context."` WHERE"){
            for($i = 1;$i < $n;$i++){
                $storage_tail[0] .= " OR ".$storage_tail[$i];
            }
            $storage_tail_final = "(".$storage_tail[0].")";
            $sql .= $storage_tail_final;
        }else{
            $sql .= " AND ";
            for($i = 1;$i < $n;$i++){
                $storage_tail[0] .= " OR ".$storage_tail[$i];
            }
            $storage_tail_final = "(".$storage_tail[0].")";
            $sql .= $storage_tail_final;
        }
    }
}



        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");

        $xml          = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
        $result = mysqli_query($conn,$sql);

        $xml .= "<result>";
        while($row = mysqli_fetch_assoc($result)){
            $xml .= "<row>";
            switch($context){
                case "phones":
                    foreach($row as $key => $value) {
                        if ($key == "phone_brand" || $key == "phone_model" || $key == "phone_price" || $key == "phone_sim_count" || $key == "phone_display_size" || $key == "phone_display_resolution_high" || $key == "phone_display_resolution_low" || $key == "phone_os" || $key == "phone_cpu_clock_freq" || $key == "phone_cpu_core_count" || $key == "phone_ram" || $key == "phone_internal_memory_size" || $key == "phone_external_memory_size" || $key == "phone_primary_camera_pixel_size" || $key == "phone_secondary_camera_pixel_size" || $key == "phone_battery_size" || $key == "phone_image_filename" || $key == "file_name") {
                            $xml .= "<$key>$value</$key>";
                        }
                    }
                    break;
                case "tablets":
                    foreach($row as $key => $value){
                        if($key == "tablet_brand" || $key == "tablet_model" || $key == "tablet_price" || $key == "tablet_sim_count" || $key == "tablet_display_size" || $key == "tablet_display_resolution_high" || $key == "tablet_display_resolution_low" || $key == "tablet_os" || $key == "tablet_cpu_clock_freq" || $key == "tablet_cpu_core_count" || $key == "tablet_ram" || $key == "tablet_internal_memory_size" || $key == "tablet_external_memory_size" || $key == "tablet_primary_camera_pixel_size" || $key == "tablet_secondary_camera_pixel_size" || $key == "tablet_battery_size" || $key == "tablet_image_filename" || $key == "file_name"){
                            $xml .= "<$key>$value</$key>";
                        }
                    }
                    break;
                case "laptops":
                    foreach($row as $key => $value){
                        if($key == "laptop_brand" || $key == "laptop_model" || $key == "laptop_type" || $key == "laptop_price" || $key == "laptop_processor_type" || $key == "laptop_display_size" || $key == "laptop_ram_size" || $key == "laptop_storage_size" || $key == "laptop_os" || $key == "laptop_image_filename" || $key == "file_name"){
                            $xml .= "<$key>$value</$key>";
                        }
                    }
                    break;
                default:
                    // do nothing
            }
            $xml.="</row>";
        }
        $xml .= "</result>";
        unset($_POST);

        header ("Content-Type:text/xml");
        ob_end_flush();
        echo $xml;
?>