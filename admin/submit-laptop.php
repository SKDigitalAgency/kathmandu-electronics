<?php ob_start();
session_start();
include_once("../functions.php");
if(!check_login()){
    header("Location: http://www.kathmanduelectronics.com/admin");
    ob_end_flush();
    exit();
}
$_SESSION["selected_page"] = "submit-laptop";
?>
<?php include_once ("meta-admin.php"); ?>
    <body>
    <div class="container">
        <?php include_once ("header-admin.php"); ?>
        <main>
            <div class="container">
                <?php if (isset($_GET["action"]) && $_GET["action"] == "edit"): ?>

                    <?php

                    if(!isset($conn)){
                        if(mysqli_connect("localhost","kathman4","Codec_form1243","kathman4_ke")){
                            $conn = mysqli_connect("localhost","kathman4","Codec_form1243","kathman4_ke");
                        }else{
                            $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
                        }
                    }
                    $sql = "SELECT * FROM laptops WHERE file_name = '".$_GET["laptop"]."'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        foreach($row as $key => $value) {
                            if ($key == "laptop_network" || $key == "laptop_alert_types" || $key == "laptop_sensors" || $key == "laptop_messaging" || $key == "laptop_other_features" || $key == "laptop_colors") {
                                $value = unserialize($value);
                                foreach($value as $k => $v){
                                    $_SESSION[$key][$k] = $v;
                                }
                            }else{
                                $_SESSION[$key] = $value;
                            }
                        }
                    }

                    ?>
                    <form class="submit_laptop_form" action="submit-laptop.php?page=<?php echo $_SESSION["laptop_model"]; ?>&&action=edit" method="POST" enctype="multipart/form-data">
                        <?php if(isset($_POST["submit"])){submit_laptop("update");} ?>
                        <h1>Edit laptop details</h1>
                        <p><input type="submit" name="submit" value="submit"/></p>
                        <div class="form-section">
                            <h2>General</h2>
                            <p>
                                <label class="flt_left" for="field-image">Image</label>
                                <input id="field_image" type="file" name="laptop_image" value=""/>
                                <img src="../images/<?php echo $_SESSION["laptop_image_filename"]; ?>" alt="<?php echo $_SESSION["laptop_model"]; ?>" />
                                <?php echo $_SESSION["laptop_image_filename"]; ?>
                            </p>
                            <p>
                                <label class="flt_left" for="selectfield-brand">Brand</label>
                                <input id="selectfield-brand" type="text" name="brand" value="<?php echo $_SESSION["laptop_brand"]; ?>" />
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-type">Laptop Type</label>
                                <input id="textfield-type" type="text" name="type" value="<?php echo $_SESSION["laptop_type"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-model">Model</label>
                                <input id="textfield-model" type="text" name="model" value="<?php echo $_SESSION["laptop_model"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-launch">Launch<wbr />/Announced Date</label>
                                <input id="textfield-launch" type="date" name="launch_date" value="<?php echo $_SESSION["laptop_launch_date"]; ?>"/>
                            </p>

                        </div>
                        <div class="form-section">
                            <h2>Body</h2>
                            <p>
                                <label class="flt_left" for="textfield-height">Length</label>
                                <input id="textfield-height" type="text" name="length" value="<?php echo $_SESSION["laptop_length"]; ?>"/> mm
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-width">Width</label>
                                <input id="textfield-width" type="text" name="width" value="<?php echo $_SESSION["laptop_width"]; ?>"/> mm
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-thickness">Thickness</label>
                                <input id="textfield-thickness" type="text" name="thickness" value="<?php echo $_SESSION["laptop_thickness"]; ?>"/> mm
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-weight">Weight</label>
                                <input id="textfield-weight" type="text" name="weight" value="<?php echo $_SESSION["laptop_weight"]; ?>"/> kg
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Display</h2>

                            <p>
                                <label class="flt_left" for="textfield-display-size">Size</label>
                                <input id="textfield-display-size" type="text" name="display_size" value="<?php echo $_SESSION["laptop_display_size"]; ?>"/> inches
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-display-pixel-density">Pixel Density</label>
                                <input id="textfield-display-pixel-density" type="text" name="display_pixel_density" value="<?php echo $_SESSION["laptop_display_pixel_density"]; ?>"/> inches
                            </p>

                            <p>
                                <label class="flt_left">Resolution</label>
                                <input id="textfield-display-resolution_high" type="text" name="display_resolution_high" value="<?php echo $_SESSION["laptop_display_resolution_high"]; ?>"/> x
                                <input id="textfield-display-resolution_low" type="text" name="display_resolution_low" value="<?php echo $_SESSION["laptop_display_resolution_low"]; ?>"/> pixels
                            </p>

                            <p>
                                <label class="flt_left">Aspect Ratio</label>
                                <input id="textfield-display-aspect_ratio_high" type="text" name="display_aspect_ratio_high" value="<?php echo $_SESSION["laptop_display_aspect_ratio_high"]; ?>"/> :
                                <input id="textfield-display-aspect_ratio_low" type="text" name="display_aspect_ratio_low" value="<?php echo $_SESSION["laptop_display_aspect_ratio_low"]; ?>"/> pixels
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Operating System</h2>
                            <p>
                                <label class="flt_left">OS</label>
                                <input <?php if($_SESSION["laptop_os"] == "windows"){echo "checked";} ?> id="radiofield-os-windows" type="radio" name="os" value="windows"/>
                                <label for="radiofield-os-windows">Windows</label>
                                <input <?php if($_SESSION["laptop_os"] == "mac"){echo "checked";} ?> id="radiofield-os-mac" type="radio" name="os" value="mac"/>
                                <label for="radiofield-os-mac">Mac</label>
                                <input <?php if($_SESSION["laptop_os"] == "linux"){echo "checked";} ?> id="radiofield-os-linux" type="radio" name="os" value="linux"/>
                                <label for="radiofield-os-linux">Linux</label>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-os-version">OS Version</label>
                                <input id="textfield-os-version" type="text" name="os_version" value="<?php echo $_SESSION["laptop_os_version"]; ?>"/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Processor</h2>
                            <p>
                                <label class="flt_left" for="textfield-processor-type">Type</label>
                                <input id="textfield-processor-type" type="text" name="processor_type" value="<?php echo $_SESSION["laptop_processor_type"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-processor-speed">Processor Speed</label>
                                <input id="textfield-processor-speed" type="text" name="processor_speed" value="<?php echo $_SESSION["laptop_processor_speed"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="selectfield-cores-count">No. of Cores</label>
                                <select id="selectfield-cores-count" name="processor_cores_count" value="">
                                    <option <?php if($_SESSION["laptop_processor_cores_count"] == "1"){echo "selected";} ?>>1</option>
                                    <option <?php if($_SESSION["laptop_processor_cores_count"] == "2"){echo "selected";} ?>>2</option>
                                    <option <?php if($_SESSION["laptop_processor_cores_count"] == "4"){echo "selected";} ?>>4</option>
                                    <option <?php if($_SESSION["laptop_processor_cores_count"] == "6"){echo "selected";} ?>>6</option>
                                    <option <?php if($_SESSION["laptop_processor_cores_count"] == "8"){echo "selected";} ?>>8</option>
                                </select>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-processor-cache">Cache Memory</label>
                                <input id="textfield-processor-cache" type="text" name="processor_cache" value="<?php echo $_SESSION["laptop_processor_cache"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-graphics">Graphics</label>
                                <input id="textfield-graphics" type="text" name="graphics" value="<?php echo $_SESSION["laptop_graphics"]; ?>"/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Storage</h2>

                            <p>
                                <label class="flt_left" for="textfield-storage-size">Storage Size</label>
                                <input id="textfield-storage-size" type="text" name="storage_size" value="<?php echo $_SESSION["laptop_storage_size"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-storage-technology">Storage Technology</label>
                                <input id="textfield-storage-technology" type="text" name="storage_technology" value="<?php echo $_SESSION["laptop_storage_technology"]; ?>"/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>RAM</h2>
                            <p>
                                <label class="flt_left" for="textfield-ram-size">Size</label>
                                <input class="textfield-ram-size" type="text" name="ram_size" value="<?php echo $_SESSION["laptop_ram_size"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-ram-type">Type</label>
                                <input class="textfield-ram-type" type="text" name="ram_type" value="<?php echo $_SESSION["laptop_ram_type"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-ram-speed">Speed</label>
                                <input class="textfield-ram-speed" type="text" name="ram_speed" value="<?php echo $_SESSION["laptop_ram_speed"]; ?>"/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Battery</h2>
                            <p>
                                <label class="flt_left" for="textfield-battery-cell-value">Battery Cell Count</label>
                                <input class="textfield-battery-cell-count" type="text" name="battery_cell_count" value="<?php echo $_SESSION["laptop_battery_cell_count"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-battery-power">Battery Power Value</label>
                                <input id="textfield-battery-power" type="text" name="battery_power" value="<?php echo $_SESSION["laptop_battery_power"]; ?>"/>
                            </p>
                            <p>
                                <label class="flt_left" for="selectfield-battery-type">Type</label>
                                <select id="selectfield-battery-type" name="battery_type" value="">
                                    <option <?php if($_SESSION["laptop_battery_type"] == "Li-Ion"){echo "selected";} ?>>Li-Ion</option>
                                    <option <?php if($_SESSION["laptop_battery_type"] == "Li-Polymer"){echo "selected";} ?>>Li-Polymer</option>
                                </select>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-battery-life">Battery Life</label>
                                <input id="textfield-battery-life" type="text" name="battery_life" value="<?php echo $_SESSION["laptop_battery_life"]; ?>"/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Other Features</h2>
                            <p>
                                <?php $arr_len = count($_SESSION["laptop_connectivity_and_ports"]); ?>
                                <label class="flt_left" for="textfield-connectivity-and-ports">Connectivity and Ports</label>
                                <span class="input_fields_connectivity_and_ports_wrap">
                <input type="text" name="connectivity_and_ports[]" value="<?php echo $_SESSION["laptop_connectivity_and_ports"]["0"]; ?>">
                <input type="button" id="add_field_connectivity_and_ports" value="+"/>
                                    <?php for($i = 1;$i < $arr_len;$i ++){ ?>
                                        <span style="display:block;">
                        <input type="text" name="connectivity_and_ports[]" value="<?php echo $_SESSION["laptop_connectivity_and_ports"]["$i"]; ?>"/>
                        <input type="button" class="remove_field" value="Remove"/>
                    </span>
                                    <?php } ?>
            </span>
                            </p>

                            <p>
                                <?php $arr_len = count($_SESSION["laptop_other_features"]); ?>
                                <label class="flt_left" for="textfield-other-features">Other Features</label>
                                <span class="input_fields_other_features_wrap">
                <input type="text" name="other_features[]" value="<?php echo $_SESSION["laptop_other_features"]["0"]; ?>">
                <input type="button" id="add_field_other_features" value="+"/>
                                    <?php for($i = 1;$i < $arr_len;$i ++){ ?>
                                        <span style="display:block;">
                        <input type="text" name="other_features[]" value="<?php echo $_SESSION["laptop_other_features"]["$i"]; ?>"/>
                        <input type="button" class="remove_field" value="Remove"/>
                    </span>
                                    <?php } ?>
            </span>
                            </p>
                            <p>
                                <?php $arr_len = count($_SESSION["laptop_colors"]); ?>
                                <label class="flt_left" for="textfield-colors">Colors</label>
                                <span class="input_fields_colors_wrap">
                <input type="text" name="colors[]" value="<?php echo $_SESSION["laptop_colors"]["0"]; ?>">
                <input type="button" id="add_field_colors" value="+"/>
                                    <?php for($i = 1;$i < $arr_len;$i ++){ ?>
                                        <span style="display:block;">
                        <input type="text" name="colors[]" value="<?php echo $_SESSION["laptop_colors"]["$i"]; ?>"/>
                        <input type="button" class="remove_field" value="Remove"/>
                    </span>
                                    <?php } ?>
            </span>
                            </p>
                        </div>
                        <?php

                        $sql = "SELECT laptop_id FROM `laptops` WHERE file_name = '".$_GET["laptop"]."'";
                        $result = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($result)){
                            foreach($row as $key => $value){
                                $laptop_id = $value;
                            }
                        }
                        $sql = "SELECT * FROM `availability_laptops` WHERE laptop_id = ".$laptop_id;
                        $result = mysqli_query($conn,$sql);
                        $i = 0;
                        echo "<h2>Availability</h2>";
                        echo "<input type=\"button\" class=\"add_availability\" value=\"+\"/>";
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class=\"form-section\">";
                            echo "<p>";
                            echo "<label class=\"flt_left\" for=\"selectfield-availability-store-name\">Store Name</label>";
                            echo "<select class=\"availability_input\" id=\"selectfield-availability-store-name\" name=\"availability[$i][]\" selected=\"" . $row["store_name"] . "\">";
                            get_store_names($row["store_name"]);
                            echo "</select>";
                            echo "</p>";

                            echo "<p>";
                            echo "<label class=\"flt_left\" for=\"selectfield-availability-location\">Location</label>";
                            echo "<select class=\"availability_input\" id=\"selectfield-availability-location\" name=\"availability[$i][]\" selected=\"" . $row["store_location"] . "\" > ";
                            get_store_locations($row["store_location"]);
                            echo "</select>";
                            echo "</p>";

                            echo "<p>";
                            echo "<label class=\"flt_left\">Price</label>";
                            echo "<input class=\"availability_input\" type=\"text\" name=\"availability[$i][]\" value=\"".$row["price"]."\"/>";
                            echo "</p>";

                            echo "<p>";
                            echo "<label class=\"flt_left\" for=\"textfield-availability-note\">Addition Information</label>";
                            echo "<textarea class=\"availability_input\" id=\"textfield-availability-note\" type=\"text\" name=\"availability[$i][]\">".$row["note"]."</textarea>";
                            echo "</p>";

                            echo "<input type=\"button\" class=\"remove_availability_form_section\" value=\"Remove\" />";
                            echo "</div>";
                            $i++;
                        }

                        ?>
                    </form>
                <?php else: ?>
                    <form class="submit_laptop_form" action="submit-laptop.php" method="POST" enctype="multipart/form-data">
                        <?php if(isset($_POST["submit"])){submit_laptop("insert");} ?>
                        <h1>Enter laptop details</h1>
                        <p><input type="submit" name="submit" value="submit"/></p>
                        <div class="form-section">
                            <h2>General</h2>
                            <p>
                                <label class="flt_left" for="field-image">Image</label>
                                <input id="field_image" type="file" name="laptop_image" value=""/>
                            </p>
                            <p>
                                <label class="flt_left" for="selectfield-brand">Brand</label>
                                <input id="selectfield-brand" type="text" name="brand" value="" />
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-type">Laptop Type</label>
                                <input id="textfield-type" type="text" name="type" value=""/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-model">Model</label>
                                <input id="textfield-model" type="text" name="model" value=""/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-launch">Launch<wbr />/Announced Date</label>
                                <input id="textfield-launch" type="date" name="launch_date" value=""/>
                            </p>

                        </div>
                        <div class="form-section">
                            <h2>Body</h2>
                            <p>
                                <label class="flt_left" for="textfield-height">Length</label>
                                <input id="textfield-height" type="text" name="length" value=""/> mm
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-width">Width</label>
                                <input id="textfield-width" type="text" name="width" value=""/> mm
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-thickness">Thickness</label>
                                <input id="textfield-thickness" type="text" name="thickness" value=""/> mm
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-weight">Weight</label>
                                <input id="textfield-weight" type="text" name="weight" value=""/> kg
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Display</h2>

                            <p>
                                <label class="flt_left" for="textfield-display-size">Size</label>
                                <input id="textfield-display-size" type="text" name="display_size" value=""/> inches
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-display-pixel-density">Pixel Density</label>
                                <input id="textfield-display-pixel-density" type="text" name="display_pixel_density" value=""/> inches
                            </p>

                            <p>
                                <label class="flt_left">Resolution</label>
                                <input id="textfield-display-resolution_high" type="text" name="display_resolution_high" value=""/> x
                                <input id="textfield-display-resolution_low" type="text" name="display_resolution_low" value=""/> pixels
                            </p>

                            <p>
                                <label class="flt_left">Aspect Ratio</label>
                                <input id="textfield-display-aspect_ratio_high" type="text" name="display_aspect_ratio_high" value=""/> :
                                <input id="textfield-display-aspect_ratio_low" type="text" name="display_aspect_ratio_low" value=""/> pixels
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Operating System</h2>
                            <p>
                                <label class="flt_left">OS</label>
                                <input id="radiofield-os-windows" type="radio" name="os" value="windows"/>
                                <label for="radiofield-os-windows">Windows</label>
                                <input id="radiofield-os-mac" type="radio" name="os" value="mac"/>
                                <label for="radiofield-os-mac">Mac</label>
                                <input id="radiofield-os-linux" type="radio" name="os" value="linux"/>
                                <label for="radiofield-os-linux">Linux</label>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-os-version">OS Version</label>
                                <input id="textfield-os-version" type="text" name="os_version" value=""/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Processor</h2>
                            <p>
                                <label class="flt_left" for="textfield-processor-type">Type</label>
                                <input id="textfield-processor-type" type="text" name="processor_type" value=""/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-processor-speed">Processor Speed</label>
                                <input id="textfield-processor-speed" type="text" name="processor_speed" value=""/>
                            </p>

                            <p>
                                <label class="flt_left" for="selectfield-cores-count">No. of Cores</label>
                                <select id="selectfield-cores-count" name="processor_cores_count" value="">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>6</option>
                                    <option>8</option>
                                </select>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-processor-cache">Cache Memory</label>
                                <input id="textfield-processor-cache" type="text" name="processor_cache" value=""/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-graphics">Graphics</label>
                                <input id="textfield-graphics" type="text" name="graphics" value=""/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Storage</h2>

                            <p>
                                <label class="flt_left" for="textfield-storage-size">Storage Size</label>
                                <input id="textfield-storage-size" type="text" name="storage_size" value=""/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-storage-technology">Storage Technology</label>
                                <input id="textfield-storage-technology" type="text" name="storage_technology" value=""/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>RAM</h2>
                            <p>
                                <label class="flt_left" for="textfield-ram-size">Size</label>
                                <input class="textfield-ram-size" type="text" name="ram_size" value=""/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-ram-type">Type</label>
                                <input class="textfield-ram-type" type="text" name="ram_type" value=""/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-ram-speed">Speed</label>
                                <input class="textfield-ram-speed" type="text" name="ram_speed" value=""/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Battery</h2>
                            <p>
                                <label class="flt_left" for="textfield-battery-cell-value">Battery Cell Count</label>
                                <input class="textfield-battery-cell-count" type="text" name="battery_cell_count" value=""/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-battery-power">Battery Power Value</label>
                                <input id="textfield-battery-power" type="text" name="battery_power" value=""/>
                            </p>
                            <p>
                                <label class="flt_left" for="selectfield-battery-type">Type</label>
                                <select id="selectfield-battery-type" name="battery_type" value="">
                                    <option>Li-Ion</option>
                                    <option>Li-Polymer</option>
                                </select>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-battery-life">Battery Life</label>
                                <input id="textfield-battery-life" type="text" name="battery_life" value=""/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Additional Features</h2>
                            <p>
                                <label class="flt_left" for="textfield-connectivity-and-ports">Connectivity and Ports</label>
                                <span class="input_fields_connectivity_and_ports_wrap">
                <input type="text" name="connectivity_and_ports[]" value="">
                <input type="button" id="add_field_connectivity_and_ports" value="+"/>
            </span>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-other-features">Other Features</label>
                                <span class="input_fields_other_features_wrap">
                <input type="text" name="other_features[]" value="">
                <input type="button" id="add_field_other_features" value="+"/>
            </span>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-colors">Colors</label>
                                <span class="input_fields_colors_wrap">
                <input type="text" name="colors[]" value="">
                <input type="button" id="add_field_colors" value="+"/>
            </span>
                            </p>
                        </div>
                        <h2>Availability</h2>
                        <p>
                            <input type="button" class="add_availability" value="+"/>
                        </p>
                        <div class="form-section">
                            <p>
                                <label class="flt_left" for="selectfield-availability-store-name">Store Name</label>
                                <select class="availability_input" id="selectfield-availability-store-name" name="availability[0][]">
                                    <option></option>
                                    <?php get_store_names(""); ?>
                                </select>
                            </p>
                            <p>
                                <label class="flt_left" for="selectfield-availability-location">Location</label>
                                <select class="availability_input" id="selectfield-availability-location" name="availability[0][]">
                                    <option></option>
                                    <?php get_store_locations(""); ?>
                                </select>
                            </p>
                            <p>
                                <label class="flt_left">Price</label>
                                <input class="availability_input" type="text" name="availability[0][]" value=""/>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-availability-note">Addition Information</label>
                                <textarea class="availability_input" id="textfield-availability-note" type="text" name="availability[0][]"></textarea>
                            </p>
                            <input type="button" class="remove_availability_form_section" value="Remove" />
                        </div>
                    </form>
                <?php endif ?>
            </div>
        </main>
        <?php include_once ("aside-admin.php"); ?>
        <?php include_once ("footer-admin.php"); ?>
    </div>
    <script>
        $(document).ready(function() {
            $('.remove_field').bind('click', function ()
            {
                $(this).parent("span").remove();
            });
            $("#add_field_connectivity_and_ports").click(function(){
                $(".input_fields_connectivity_and_ports_wrap").append('<span style="display:block;"><input type="text" name="connectivity_and_ports[]"/><input type="button" class="remove_field" value="Remove"/></span>');
                $('.remove_field').bind('click', function ()
                {
                    $(this).parent("span").remove();
                });
            });
            $("#add_field_other_features").click(function(){
                $(".input_fields_other_features_wrap").append('<span style="display:block;"><input type="text" name="other_features[]"/><input type="button" class="remove_field" value="Remove"/></span>');
                $('.remove_field').bind('click', function ()
                {
                    $(this).parent("span").remove();
                });
            });
            $("#add_field_colors").click(function(){
                $(".input_fields_colors_wrap").append('<span style="display:block;"><input type="text" name="colors[]"/><input type="button" class="remove_field" value="Remove"/></span>');
                $('.remove_field').bind('click', function ()
                {
                    $(this).parent("span").remove();
                });
            });
        });
    </script>
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

                        $(".submit_laptop_form").append($new_form_section);
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
            $('.remove_availability_form_section').click(function ()
            {
                $(this).parent(".form-section").remove();
            });
        })();
    </script>
    </body>
</html>