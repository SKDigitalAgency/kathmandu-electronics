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

                <?php if (isset($_GET["action"]) && $_GET["action"] == "edit"): ?>
                    <?php

                    if(!isset($conn)){
                        if(mysqli_connect("localhost","kathman4","Codec_form1243","kathman4_ke")){
                            $conn = mysqli_connect("localhost","kathman4","Codec_form1243","kathman4_ke");
                        }else{
                            $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
                        }
                    }
                    $sql = "SELECT * FROM phones WHERE file_name = '".$_GET["phone"]."'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        foreach($row as $key => $value) {
                            if ($key == "phone_network" || $key == "phone_alert_types" || $key == "phone_sensors" || $key == "phone_messaging" || $key == "phone_other_features" || $key == "phone_colors") {
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
                    <form class="submit_phone_form" action="submit-phone.php?phone=<?php echo $_GET["phone"]; ?>&&action=edit" method="POST" enctype="multipart/form-data">
                        <?php if(isset($_POST["submit"])){submit_phone("update");} ?>
                        <h1>Edit phone details for <?php echo $_SESSION["phone_model"]; ?></h1>
                        <p><input type="submit" name="submit" value="submit"/></p>
                        <div class="form-section">
                            <h2>General</h2>
                            <p>
                                <label class="flt_left" for="field-image">Image</label>
                                <input type="file" name="phone_image" value=""/>
                                <img src="../images/<?php echo $_SESSION["phone_image_filename"]; ?>" alt="<?php echo $_SESSION["phone_model"]; ?>" />
                                <?php echo $_SESSION["phone_image_filename"]; ?>
                            </p>
                            <p>
                                <label class="flt_left" for="selectfield-brand">Brand</label>
                                <input id="selectfield-brand" type="text" name="brand" value="<?php echo $_SESSION["phone_brand"]; ?>" />
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-model">Model</label>
                                <input id="textfield-model" type="text" name="model" value="<?php echo $_SESSION["phone_model"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left">Network</label>
                                <input <?php foreach($_SESSION["phone_network"] as $key => $value){if($value == "LTE"){echo "checked = \"TRUE\" ";}} ?>id="checkboxfield-network-lte" type="checkbox" name="network[]" value="LTE"/>
                                <label id="flt_left" for="checkboxfield-network-lte">LTE</label>
                                <input <?php foreach($_SESSION["phone_network"] as $key => $value){if($value == "HSDPA"){echo "checked = \"TRUE\" ";}} ?> id="checkboxfield-network-hsdpa" type="checkbox" name="network[]" value="HSDPA"/>
                                <label id="flt_left" for="checkboxfield-network-hsdpa">HSDPA</label>
                                <input <?php foreach($_SESSION["phone_network"] as $key => $value){if($value == "UMTS"){echo "checked = \"TRUE\" ";}} ?> id="checkboxfield-network-umts" type="checkbox" name="network[]" value="UMTS"/>
                                <label id="flt_left" for="checkboxfield-network-umts">UMTS</label>
                                <input <?php foreach($_SESSION["phone_network"] as $key => $value){if($value == "GSM"){echo "checked = \"TRUE\" ";}} ?> id="checkboxfield-network-gsm" type="checkbox" name="network[]" value="GSM"/>
                                <label id="flt_left" for="checkboxfield-network-gsm">GSM</label>
                                <input <?php foreach($_SESSION["phone_network"] as $key => $value){if($value == "CDMA"){echo "checked = \"TRUE\" ";}} ?> id="checkboxfield-network-cdma" type="checkbox" name="network[]" value="CDMA"/>
                                <label id="flt_left" for="checkboxfield-network-cdma">CDMA</label>
                                <input <?php foreach($_SESSION["phone_network"] as $key => $value){if($value == "HSPA"){echo "checked = \"TRUE\" ";}} ?> id="checkboxfield-network-hspa" type="checkbox" name="network[]" value="HSPA"/>
                                <label id="flt_left" for="checkboxfield-network-hspa">HSPA</label>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-launch">Launch<wbr />/Announced Date</label>
                                <input id="textfield-launch" type="date" name="launch_date" value="<?php echo $_SESSION["phone_launch"]; ?>"/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Body</h2>
                            <p>
                                <label class="flt_left" for="textfield-height">Height</label>
                                <input id="textfield-height" type="text" name="height" value="<?php echo $_SESSION["phone_height"]; ?>"/> mm
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-width">Width</label>
                                <input id="textfield-width" type="text" name="width" value="<?php echo $_SESSION["phone_width"]; ?>"/> mm
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-thickness">Thickness</label>
                                <input id="textfield-thickness" type="text" name="thickness" value="<?php echo $_SESSION["phone_thickness"]; ?>"/> mm
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-weight">Weight</label>
                                <input id="textfield-weight" type="text" name="weight" value="<?php echo $_SESSION["phone_weight"]; ?>"/> g
                            </p>
                        </div>

                        <div class="form-section">
                            <h2>SIM</h2>
                            <p>
                                <label class="flt_left" for="selectfield-sim-size">SIM Size</label>
                                <select id="selectfield-sim-size" name="sim_size" value="">
                                    <option <?php if($_SESSION["phone_sim_size"] == "Mini"){echo "selected";} ?>>Mini</option>
                                    <option <?php if($_SESSION["phone_sim_size"] == "Micro"){echo "selected";} ?>>Micro</option>
                                    <option <?php if($_SESSION["phone_sim_size"] == "Nano"){echo "selected";} ?>>Nano</option>
                                </select>
                            </p>

                            <p>
                                <label class="flt_left" for="selectfield-sim-count">SIM Count</label>
                                <select id="selectfield-sim-count" name="sim_count" value="<?php echo $_SESSION["phone_sim_count"]; ?>">
                                    <option <?php if($_SESSION["phone_sim_count"] == "1"){echo "selected";} ?>>1</option>
                                    <option <?php if($_SESSION["phone_sim_count"] == "2"){echo "selected";} ?>>2</option>
                                    <option <?php if($_SESSION["phone_sim_count"] == "3"){echo "selected";} ?>>3</option>
                                    <option <?php if($_SESSION["phone_sim_count"] == "4"){echo "selected";} ?>>4</option>
                                </select>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Operating System</h2>
                            <p>
                                <label class="flt_left">OS</label>
                                <input  <?php if($_SESSION["phone_os"] == "android"){echo "checked";} ?> id="radiofield-os-android" type="radio" name="os" value="android"/>
                                <label for="radiofield-os-android">Android</label>
                                <input <?php if($_SESSION["phone_os"] == "ios"){echo "checked";} ?> id="radiofield-os-ios" type="radio" name="os" value="ios"/>
                                <label for="radiofield-os-ios">iOS</label>
                                <input <?php if($_SESSION["phone_os"] == "windows"){echo "checked";} ?> id="radiofield-os-windows" type="radio" name="os" value="windows"/>
                                <label for="radiofield-os-windows">Windows</label>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-os-version">OS Version</label>
                                <input id="textfield-os-version" type="text" name="os_version" value="<?php echo $_SESSION["phone_os_version"]; ?>"/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Display</h2>
                            <p>
                                <label class="flt_left" for="textfield-display-type">Type</label>
                                <input id="textfield-display-type" type="text" name="display_type" value="<?php echo $_SESSION["phone_display_type"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-display-size">Size</label>
                                <input id="textfield-display-size" type="text" name="display_size" value="<?php echo $_SESSION["phone_display_size"]; ?>"/> inches
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-display-screen-to-body-ratio">Screen-to-body Ratio</label>
                                <input id="textfield-display-screen-to-body-ratio" type="text" name="display_screen_to_body_ratio" value="<?php echo $_SESSION["phone_screen_to_body_ratio"]; ?>"/> %
                            </p>

                            <p>
                                <label class="flt_left">Resolution</label>
                                <input id="textfield-display-resolution_high" type="text" name="display_resolution_high" value="<?php echo $_SESSION["phone_display_resolution_high"]; ?>"/> x
                                <input id="textfield-display-resolution_low" type="text" name="display_resolution_low" value="<?php echo $_SESSION["phone_display_resolution_low"]; ?>"/> pixels
                            </p>
                            <p>
                                <label class="flt_left">Touch</label>
                                <input <?php if($_SESSION["phone_multi_touch_display"] == "1"){echo "checked";} ?> id="radiofield-display-touch-yes" type="radio" name="display_touch" value="1"/>
                                <label for="radiofield-display-touch-yes">Yes</label>
                                <input <?php if($_SESSION["phone_multi_touch_display"] == "0"){echo "checked";} ?> id="radiofield-display-touch-no" type="radio" name="display_touch" value="0"/>
                                <label for="radiofield-display-touch-no">No</label>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-display-protection">Protection</label>
                                <input id="textfield-display-protection" type="text" name="display_protection" value="<?php echo $_SESSION["phone_display_protection"]; ?>"/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>CPU</h2>
                            <p>
                                <label class="flt_left" for="textfield-cpu-chipset">CPU Chipset</label>
                                <input id="textfield-cpu-chipset" type="text" name="chipset" value="<?php echo $_SESSION["phone_cpu_chipset"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="selectfield-cores-count">Cores Count</label>
                                <select id="selectfield-cores-count" name="cpu_cores_count" value="<?php echo $_SESSION["phone_cpu_cores_count"]; ?>">
                                    <option <?php if($_SESSION["phone_cpu_core_count"] == "1"){echo "selected";} ?>>1</option>
                                    <option <?php if($_SESSION["phone_cpu_core_count"] == "2"){echo "selected";} ?>>2</option>
                                    <option <?php if($_SESSION["phone_cpu_core_count"] == "3"){echo "selected";} ?>>3</option>
                                    <option <?php if($_SESSION["phone_cpu_core_count"] == "4"){echo "selected";} ?>>4</option>
                                    <option <?php if($_SESSION["phone_cpu_core_count"] == "5"){echo "selected";} ?>>6</option>
                                    <option <?php if($_SESSION["phone_cpu_core_count"] == "6"){echo "selected";} ?>>8</option>
                                </select>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-cpu-clock-freq">Clock Frequency</label>
                                <input id="textfield-cpu-clock-freq" type="text" name="cpu_clock_freq" value="<?php echo $_SESSION["phone_cpu_clock_freq"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-cpu-model">CPU Model</label>
                                <input id="textfield-cpu-model" type="text" name="cpu_model" value="<?php echo $_SESSION["phone_cpu_model"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-gpu">GPU</label>
                                <input id="textfield-gpu" type="text" name="gpu" value="<?php echo $_SESSION["phone_gpu"]; ?>"/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Memory</h2>
                            <p>
                                <label class="flt_left">External Memory</label>
                                <input <?php if($_SESSION["phone_external_memory"] == "1"){echo "checked";} ?> id="radiofield-external-memory-yes" type="radio" name="external_memory" value="1"/>
                                <label for="radiofield-external-memory-yes">Yes</label>
                                <input <?php if($_SESSION["phone_external_memory"] == "0"){echo "checked";} ?> id="radiofield-external-memory-no" type="radio" name="external_memory" value="0"/>
                                <label for="radiofield-external-memory-no">No</label>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-external-memory-size">External Memory Size</label>
                                <input id="textfield-external-memory-size" type="text" name="external_memory_size" value="<?php echo $_SESSION["phone_external_memory_size"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-internal-memory-size">Internal Memory Size</label>
                                <input id="textfield-internal-memory-size" type="text" name="internal_memory_size" value="<?php echo $_SESSION["phone_internal_memory_size"]; ?>"/>
                            </p>
                            <script>
                                $(document).ready(function() {
                                    $('.remove_field').bind('click', function () {
                                        $(this).parent("span").remove();
                                    });
                                });

                                $(document).ready(function() {
                                    $("#add_field_alert_types").click(function(){
                                        $(".input_fields_alert_types_wrap").append('<span style="display:block;"><input type="text" name="alert_types[]"/><input type="button" class="remove_field" value="Remove"/></span>');
                                        $('.remove_field').bind('click', function (){
                                            $(this).parent("span").remove();
                                        });
                                    });
                                    $("#add_field_sensors").click(function(){
                                        $(".input_fields_sensors_wrap").append('<span style="display:block;"><input type="text" name="sensors[]"/><input type="button" class="remove_field" value="Remove"/></span>');
                                        $('.remove_field').bind('click', function ()
                                        {
                                            $(this).parent("span").remove();
                                        });
                                    });
                                    $("#add_field_messaging").click(function(){
                                        $(".input_fields_messaging_wrap").append('<span style="display:block;"><input type="text" name="messaging[]"/><input type="button" class="remove_field" value="Remove"/></span>');
                                        $('.remove_field').bind('click', function ()
                                        {
                                            $(this).parent("span").remove();
                                        });
                                    });$("#add_field_other_features").click(function(){
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
                            <p>
                                <label class="flt_left" for="textfield-ram">RAM</label>
                                <input type="text" name="ram" value="<?php echo $_SESSION["phone_ram"]; ?>">
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Camera</h2>
                            <p>
                                <label class="flt_left" for="textfield-primary-camera-size">Primary Camera Size</label>
                                <input id="textfield-primary-camera-size" type="text" name="primary_camera_size" value="<?php echo $_SESSION["phone_primary_camera_pixel_size"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-primary-camera-description">Primary Camera Description</label>
                                <input id="textfield-primary-camera-description" type="text" name="primary_camera_description" value="<?php echo $_SESSION["phone_primary_camera_description"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-secondary-camera-size">Secondary Camera Size</label>
                                <input id="textfield-secondary-camera-size" type="text" name="secondary_camera_size" value="<?php echo $_SESSION["phone_secondary_camera_pixel_size"]; ?>"/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-secondary-camera-description">Secondary Camera Description</label>
                                <input id="textfield-secondary-camera-description" type="text" name="secondary_camera_description" value="<?php echo $_SESSION["phone_secondary_camera_description"]; ?>"/>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-video">Video</label>
                                <input id="textfield-video" type="text" name="video" value="<?php echo $_SESSION["phone_video"]; ?>"/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Sound</h2>
                            <p>
                                <?php $arr_len = count($_SESSION["phone_alert_types"]); ?>
                                <label class="flt_left" for="textfield-alerttypes">Alert Types</label>
                                <span class="input_fields_alert_types_wrap">
                <input type="text" name="alert_types[]" value="<?php echo $_SESSION["phone_alert_types"]["0"]; ?>">
                <input type="button" id="add_field_alert_types" value="+"/>
                                    <?php for($i = 1;$i < $arr_len;$i ++){ ?>
                                        <span style="display:block;">
                        <input type="text" name="alert_types[]" value="<?php echo $_SESSION["phone_alert_types"]["$i"]; ?>"/>
                        <input type="button" class="remove_field" value="Remove"/>
                    </span>
                                    <?php } ?>
            </span>
                            </p>

                            <p>
                                <label class="flt_left">Loudspeaker</label>
                                <input <?php if($_SESSION["phone_loudspeaker"] == "1"){echo "checked";} ?> id="radiofield-loudspeaker-yes" type="radio" name="loudspeaker" value="1"/>
                                <label for="radiofield-loudspeaker-yes">Yes</label>
                                <input <?php if($_SESSION["phone_loudspeaker"] == "0"){echo "checked";} ?> id="radiofield-loudspeaker-no" type="radio" name="loudspeaker" value="0"/>
                                <label for="radiofield-loudspeaker-no">No</label>
                            </p>

                            <p>
                                <label class="flt_left">3.5 mm Jack</label>
                                <input <?php if($_SESSION["phone_3_5mm_jack"] == "1"){echo "checked";} ?> id="radiofield-3-5mm-jack-yes" type="radio" name="3_5mm_jack" value="1"/>
                                <label for="radiofield-3-5mm-jack-yes">Yes</label>
                                <input <?php if($_SESSION["phone_3_5mm_jack"] == "0"){echo "checked";} ?> id="radiofield-3-5mm-jack-no" type="radio" name="3_5mm_jack" value="0"/>
                                <label for="radiofield-3-5mm-jack-no">No</label>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Connectivity</h2>
                            <p>
                                <label class="flt_left" for="textfield-wlan">WLAN</label>
                                <input id="textfield-wlan" type="text" name="wlan" value="<?php echo $_SESSION["phone_wlan"]; ?>"/>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-bluetooth">Bluetooth</label>
                                <input id="textfield-bluetooth" type="text" name="bluetooth" value="<?php echo $_SESSION["phone_bluetooth"]; ?>"/>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-gps">GPS</label>
                                <input id="textfield-gps" type="text" name="gps" value="<?php echo $_SESSION["phone_gps"]; ?>"/>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-usb">USB</label>
                                <input id="textfield-usb" type="text" name="usb" value="<?php echo $_SESSION["phone_usb"]; ?>"/>
                            </p>
                            <p>
                                <label class="flt_left">Radio</label>
                                <input <?php if($_SESSION["phone_radio"] == "1"){echo "checked";} ?> id="radiofield-radio-yes" type="radio" name="radio" value="1"/>
                                <label for="radiofield-radio-yes">Yes</label>
                                <input <?php if($_SESSION["phone_radio"] == "0"){echo "checked";} ?> id="radiofield-radio-no" type="radio" name="radio" value="0"/>
                                <label for="radiofield-radio-no">No</label>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Other Features</h2>
                            <p>
                                <?php $arr_len = count($_SESSION["phone_sensors"]); ?>
                                <label class="flt_left" for="textfield-sensors">Sensors</label>
                                <span class="input_fields_sensors_wrap">
                <input type="text" name="sensors[]" value="<?php echo $_SESSION["phone_sensors"]["0"]; ?>">
                <input type="button" id="add_field_sensors" value="+"/>
                                    <?php for($i = 1;$i < $arr_len;$i ++){ ?>
                                        <span style="display:block;">
                        <input type="text" name="sensors[]" value="<?php echo $_SESSION["phone_sensors"]["$i"]; ?>"/>
                        <input type="button" class="remove_field" value="Remove"/>
                    </span>
                                    <?php } ?>
            </span>
                            </p>
                            <p>
                                <?php $arr_len = count($_SESSION["phone_messaging"]); ?>
                                <label class="flt_left" for="textfield-messaging">Messaging</label>
                                <span class="input_fields_messaging_wrap">
                <input type="text" name="messaging[]" value="<?php echo $_SESSION["phone_messaging"]["0"]; ?>">
                <input type="button" id="add_field_messaging" value="+"/>
                                    <?php for($i = 1;$i < $arr_len;$i ++){ ?>
                                        <span style="display:block;">
                        <input type="text" name="messaging[]" value="<?php echo $_SESSION["phone_messaging"]["$i"]; ?>"/>
                        <input type="button" class="remove_field" value="Remove"/>
                    </span>
                                    <?php } ?>
            </span>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-browser">Browser</label>
                                <input id="textfield-browser" type="text" name="browser" value="<?php echo $_SESSION["phone_browser"]; ?>"/>
                            </p>
                            <p>
                                <label class="flt_left">Java</label>
                                <input <?php if($_SESSION["phone_java"] == "1"){echo "checked";} ?> id="radiofield-java-yes" type="radio" name="java" value="1"/>
                                <label for="radiofield-java-yes">Yes</label>
                                <input <?php if($_SESSION["phone_java"] == "0"){echo "checked";} ?> id="radiofield-java-no" type="radio" name="java" value="0"/>
                                <label for="radiofield-java-no">No</label>
                            </p>
                            <p>
                                <?php $arr_len = count($_SESSION["phone_other_features"]); ?>
                                <label class="flt_left" for="textfield-other-features">Other Features</label>
                                <span class="input_fields_other_features_wrap">
                <input type="text" name="other_features[]" value="<?php echo $_SESSION["phone_other_features"]["0"]; ?>">
                <input type="button" id="add_field_other_features" value="+"/>
                                    <?php for($i = 1;$i < $arr_len;$i ++){ ?>
                                        <span style="display:block;">
                        <input type="text" name="other_features[]" value="<?php echo $_SESSION["phone_other_features"]["$i"]; ?>"/>
                        <input type="button" class="remove_field" value="Remove"/>
                    </span>
                                    <?php } ?>
            </span>
                            </p>
                            <p>
                                <?php $arr_len = count($_SESSION["phone_colors"]); ?>
                                <label class="flt_left" for="textfield-colors">Colors</label>
                                <span class="input_fields_colors_wrap">
                <input type="text" name="colors[]" value="<?php echo $_SESSION["phone_colors"]["0"]; ?>">
                <input type="button" id="add_field_colors" value="+"/>
                                    <?php for($i = 1;$i < $arr_len;$i ++){ ?>
                                        <span style="display:block;">
                        <input type="text" name="colors[]" value="<?php echo $_SESSION["phone_colors"]["$i"]; ?>"/>
                        <input type="button" class="remove_field" value="Remove"/>
                    </span>
                                    <?php } ?>
            </span>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Battery</h2>
                            <p>
                                <label class="flt_left" for="textfield-battery-size">Battery Size</label>
                                <input id="textfield-battery-size" type="text" name="battery_size" value="<?php echo $_SESSION["phone_battery_size"]; ?>"/>
                            </p>
                            <p>
                                <label class="flt_left">Removable</label>
                                <input <?php if($_SESSION["phone_battery_removable"] == "1"){echo "checked";} ?> id="radiofield-battery-removable-yes" type="radio" name="battery_removable" value="1"/>
                                <label for="radiofield-battery-removable-yes">Yes</label>
                                <input <?php if($_SESSION["phone_battery_removable"] == "0"){echo "checked";} ?> id="radiofield-battery-removable-no" type="radio" name="battery_removable" value="0"/>
                                <label for="radiofield-battery-removable-no">No</label>
                            </p>
                            <p>
                                <label class="flt_left" for="selectfield-battery-type">Type</label>
                                <select id="selectfield-battery-type" name="battery_type" value="">
                                    <option <?php if($_SESSION["phone_battery_type"] == "Li-Ion"){echo "selected";} ?>>Li-Ion</option>
                                    <option <?php if($_SESSION["phone_battery_type"] == "Li-Polymer"){echo "selected";} ?>>Li-Polymer</option>
                                </select>
                            </p>
                        </div>
                        <?php

                        $sql = "SELECT phone_id FROM `phones` WHERE file_name = '".$_GET["phone"]."'";
                        $result = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($result)){
                            foreach($row as $key => $value){
                                $phone_id = $value;
                            }
                        }
                        $sql = "SELECT * FROM `availability_phones` WHERE phone_id = ".$phone_id;
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


                    <form class="submit_phone_form" action="submit-phone.php" method="POST" enctype="multipart/form-data">
                        <?php if(isset($_POST["submit"])){submit_phone("insert");} ?>
                        <h1>Enter phone details</h1>
                        <p><input type="submit" name="submit" value="submit"/></p>
                        <div class="form-section">
                            <h2>General</h2>
                            <p>
                                <label class="flt_left" for="field-image">Image</label>
                                <input type="file" name="phone_image" value=""/>
                            </p>
                            <p>
                                <label class="flt_left" for="selectfield-brand">Brand</label>
                                <input id="selectfield-brand" type="text" name="brand" value="" />
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-model">Model</label>
                                <input id="textfield-model" type="text" name="model" value=""/>
                            </p>


                            <p>
                                <label class="flt_left">Network</label>
                                <input id="checkboxfield-network-lte" type="checkbox" name="network[]" value="LTE"/>
                                <label id="flt_left" for="checkboxfield-network-lte">LTE</label>
                                <input id="checkboxfield-network-hsdpa" type="checkbox" name="network[]" value="HSDPA"/>
                                <label id="flt_left" for="checkboxfield-network-hsdpa">HSDPA</label>
                                <input id="checkboxfield-network-umts" type="checkbox" name="network[]" value="UMTS"/>
                                <label id="flt_left" for="checkboxfield-network-umts">UMTS</label>
                                <input id="checkboxfield-network-gsm" type="checkbox" name="network[]" value="GSM"/>
                                <label id="flt_left" for="checkboxfield-network-gsm">GSM</label>
                                <input id="checkboxfield-network-cdma" type="checkbox" name="network[]" value="CDMA"/>
                                <label id="flt_left" for="checkboxfield-network-cdma">CDMA</label>
                                <input id="checkboxfield-network-hspa" type="checkbox" name="network[]" value="HSPA"/>
                                <label id="flt_left" for="checkboxfield-network-hspa">HSPA</label>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-launch">Launch<wbr />/Announced Date</label>
                                <input id="textfield-launch" type="date" name="launch_date" value=""/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Body</h2>
                            <p>
                                <label class="flt_left" for="textfield-height">Height</label>
                                <input id="textfield-height" type="text" name="height" value=""/> mm
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
                                <input id="textfield-weight" type="text" name="weight" value=""/> g
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>SIM</h2>
                            <p>
                                <label class="flt_left" for="selectfield-sim-size">SIM Size</label>
                                <select id="selectfield-sim-size" name="sim_size" value="">
                                    <option>Mini</option>
                                    <option>Micro</option>
                                    <option>Nano</option>
                                </select>
                            </p>

                            <p>
                                <label class="flt_left" for="selectfield-sim-count">SIM Count</label>
                                <select id="selectfield-sim-count" name="sim_count" value="">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Operating System</h2>
                            <p>
                                <label class="flt_left">OS</label>
                                <input id="radiofield-os-android" type="radio" name="os" value="android"/>
                                <label for="radiofield-os-android">Android</label>
                                <input id="radiofield-os-ios" type="radio" name="os" value="ios"/>
                                <label for="radiofield-os-ios">iOS</label>
                                <input id="radiofield-os-windows" type="radio" name="os" value="windows"/>
                                <label for="radiofield-os-windows">Windows</label>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-os-version">OS Version</label>
                                <input id="textfield-os-version" type="text" name="os_version" value=""/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Display</h2>
                            <p>
                                <label class="flt_left" for="textfield-display-type">Type</label>
                                <input id="textfield-display-type" type="text" name="display_type" value=""/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-display-size">Size</label>
                                <input id="textfield-display-size" type="text" name="display_size" value=""/> inches
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-display-screen-to-body-ratio">Screen-to-body Ratio</label>
                                <input id="textfield-display-screen-to-body-ratio" type="text" name="display_screen_to_body_ratio" value=""/> %
                            </p>

                            <p>
                                <label class="flt_left">Resolution</label>
                                <input id="textfield-display-resolution_high" type="text" name="display_resolution_high" value=""/> x
                                <input id="textfield-display-resolution_low" type="text" name="display_resolution_low" value=""/> pixels
                            </p>
                            <p>
                                <label class="flt_left">Touch</label>
                                <input id="radiofield-display-touch-yes" type="radio" name="display_touch" value="1"/>
                                <label for="radiofield-display-touch-yes">Yes</label>
                                <input id="radiofield-display-touch-no" type="radio" name="display_touch" value="0"/>
                                <label for="radiofield-display-touch-no">No</label>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-display-protection">Protection</label>
                                <input id="textfield-display-protection" type="text" name="display_protection" value=""/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>CPU</h2>
                            <p>
                                <label class="flt_left" for="textfield-cpu-chipset">CPU Chipset</label>
                                <input id="textfield-cpu-chipset" type="text" name="chipset" value=""/>
                            </p>

                            <p>
                                <label class="flt_left" for="selectfield-cores-count">Cores Count</label>
                                <select id="selectfield-cores-count" name="cpu_cores_count">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>6</option>
                                    <option>8</option>
                                </select>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-cpu-clock-freq">Clock Frequency</label>
                                <input id="textfield-cpu-clock-freq" type="text" name="cpu_clock_freq" value=""/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-cpu-model">CPU Model</label>
                                <input id="textfield-cpu-model" type="text" name="cpu_model" value=""/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-gpu">GPU</label>
                                <input id="textfield-gpu" type="text" name="gpu" value=""/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Memory</h2>
                            <p>
                                <label class="flt_left">External Memory</label>
                                <input id="radiofield-external-memory-yes" type="radio" name="external_memory" value="1"/>
                                <label for="radiofield-external-memory-yes">Yes</label>
                                <input id="radiofield-external-memory-no" type="radio" name="external_memory" value="0"/>
                                <label for="radiofield-external-memory-no">No</label>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-external-memory-size">External Memory Size</label>
                                <input id="textfield-external-memory-size" type="text" name="external_memory_size" value=""/>
                            </p>

                            <p>
                                <label class="flt_left">Internal Memory Size</label>
                                <input type="text" name="internal_memory_size" value="">
                                <span></span>
                            </p>
                            <script>
                                $(document).ready(function() {
                                    $("#add_field_alert_types").click(function(){
                                        $(".input_fields_alert_types_wrap").append('<span style="display:block;"><input type="text" name="alert_types[]"/><input type="button" class="remove_field" value="Remove"/></span>');
                                        $('.remove_field').bind('click', function ()
                                        {
                                            $(this).parent("span").remove();
                                        });
                                    });
                                    $("#add_field_sensors").click(function(){
                                        $(".input_fields_sensors_wrap").append('<span style="display:block;"><input type="text" name="sensors[]"/><input type="button" class="remove_field" value="Remove"/></span>');
                                        $('.remove_field').bind('click', function ()
                                        {
                                            $(this).parent("span").remove();
                                        });
                                    });
                                    $("#add_field_messaging").click(function(){
                                        $(".input_fields_messaging_wrap").append('<span style="display:block;"><input type="text" name="messaging[]"/><input type="button" class="remove_field" value="Remove"/></span>');
                                        $('.remove_field').bind('click', function ()
                                        {
                                            $(this).parent("span").remove();
                                        });
                                    });$("#add_field_other_features").click(function(){
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
                            <p>
                                <label class="flt_left" for="textfield-ram">RAM</label>
                                <input class="textfield-ram" type="text" name="ram" value=""/>
                                <span></span>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Camera</h2>
                            <p>
                                <label class="flt_left" for="textfield-primary-camera-size">Primary Camera Size</label>
                                <input id="textfield-primary-camera-size" type="text" name="primary_camera_size" value=""/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-primary-camera-description">Primary Camera Description</label>
                                <input id="textfield-primary-camera-description" type="text" name="primary_camera_description" value=""/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-secondary-camera-size">Secondary Camera Size</label>
                                <input id="textfield-secondary-camera-size" type="text" name="secondary_camera_size" value=""/>
                            </p>

                            <p>
                                <label class="flt_left" for="textfield-secondary-camera-description">Secondary Camera Description</label>
                                <input id="textfield-secondary-camera-description" type="text" name="secondary_camera_description" value=""/>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-video">Video</label>
                                <input id="textfield-video" type="text" name="video" value=""/>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Sound</h2>
                            <p>
                                <label class="flt_left" for="textfield-alerttypes">Alert Types</label>
                                <span class="input_fields_alert_types_wrap">
                <input type="text" name="alert_types[]" value="">
                <input type="button" id="add_field_alert_types" value="+"/>
            </span>
                            </p>

                            <p>
                                <label class="flt_left">Loudspeaker</label>
                                <input id="radiofield-loudspeaker-yes" type="radio" name="loudspeaker" value="1"/>
                                <label for="radiofield-loudspeaker-yes">Yes</label>
                                <input id="radiofield-loudspeaker-no" type="radio" name="loudspeaker" value="0"/>
                                <label for="radiofield-loudspeaker-no">No</label>
                            </p>

                            <p>
                                <label class="flt_left">3.5 mm Jack</label>
                                <input id="radiofield-3-5mm-jack-yes" type="radio" name="3_5mm_jack" value="1"/>
                                <label for="radiofield-3-5mm-jack-yes">Yes</label>
                                <input id="radiofield-3-5mm-jack-no" type="radio" name="3_5mm_jack" value="0"/>
                                <label for="radiofield-3-5mm-jack-no">No</label>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Connectivity</h2>
                            <p>
                                <label class="flt_left" for="textfield-wlan">WLAN</label>
                                <input id="textfield-wlan" type="text" name="wlan" value=""/>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-bluetooth">Bluetooth</label>
                                <input id="textfield-bluetooth" type="text" name="bluetooth" value=""/>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-gps">GPS</label>
                                <input id="textfield-gps" type="text" name="gps" value=""/>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-usb">USB</label>
                                <input id="textfield-usb" type="text" name="usb" value=""/>
                            </p>
                            <p>
                                <label class="flt_left">Radio</label>
                                <input id="radiofield-radio-yes" type="radio" name="radio" value="1"/>
                                <label for="radiofield-radio-yes">Yes</label>
                                <input id="radiofield-radio-no" type="radio" name="radio" value="0"/>
                                <label for="radiofield-radio-no">No</label>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Other Features</h2>
                            <p>
                                <label class="flt_left" for="textfield-sensors">Sensors</label>
                                <span class="input_fields_sensors_wrap">
                <input type="text" name="sensors[]" value="">
                <input type="button" id="add_field_sensors" value="+"/>
            </span>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-messaging">Messaging</label>
                                <span class="input_fields_messaging_wrap">
                <input type="text" name="messaging[]" value="">
                <input type="button" id="add_field_messaging" value="+"/>
            </span>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-browser">Browser</label>
                                <input id="textfield-browser" type="text" name="browser" value=""/>
                            </p>
                            <p>
                                <label class="flt_left">Java</label>
                                <input id="radiofield-java-yes" type="radio" name="java" value="1"/>
                                <label for="radiofield-java-yes">Yes</label>
                                <input id="radiofield-java-no" type="radio" name="java" value="0"/>
                                <label for="radiofield-java-no">No</label>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-other-features">Other Features</label>
                                <span class="input_fields_other_features_wrap">
                <input type="text" name="other_features[]" value="">
                <input type="button" id="add_field_other_features" value="+"/>
            </span>
                            </p>
                            <p>
                                <label class="flt_left" for="textfield-colors">colors</label>
                                <span class="input_fields_colors_wrap">
                <input type="text" name="colors[]" value="">
                <input type="button" id="add_field_colors" value="+"/>
            </span>
                            </p>
                        </div>
                        <div class="form-section">
                            <h2>Battery</h2>
                            <p>
                                <label class="flt_left" for="textfield-battery-size">Battery Size</label>
                                <input id="textfield-battery-size" type="text" name="battery_size" value=""/>
                            </p>
                            <p>
                                <label class="flt_left">Removable</label>
                                <input id="radiofield-battery-removable-yes" type="radio" name="battery_removable" value="1"/>
                                <label for="radiofield-battery-removable-yes">Yes</label>
                                <input id="radiofield-battery-removable-no" type="radio" name="battery_removable" value="0"/>
                                <label for="radiofield-battery-removable-no">No</label>
                            </p>
                            <p>
                                <label class="flt_left" for="selectfield-battery-type">Type</label>
                                <select id="selectfield-battery-type" name="battery_type">
                                    <option>Li-Ion</option>
                                    <option>Li-Polymer</option>
                                </select>
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