<?php
session_start();
include_once("functions.php");
$_SESSION["selected_page_user"] = "filter";
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

        <form class="filter-form" action="" method="POST">
            <h1 class="section-header">Find the right product.</h1>
            <p class="select-product">
                <select id="filter-product" name="filter_product" value="">
                    <option>Phones</option>
                    <option>Tablets</option>
                    <option>Laptops</option>
                </select>
            </p>
            <div class="filter-sub-section" id="phones">
                <p>
                    <label class="lbl-brand">Brand</label>
                <div class="filter-form-values-brand">
                    <?php convert_phone_brand_to_input(); ?>
                </div>
                </p>
                <p>
                    <label class="lbl-price">Price</label>
                <div class="filter-form-values-price">
                    <label><input id="phone_price_0_10000" class="filter-field" type="checkbox" name="price[]" value="0 - 10000"/><span></span>0 - 10000</label>
                    <label><input id="phone_price_10000_20000" class="filter-field" type="checkbox" name="price[]" value="10000 - 20000"/><span></span>10000 - 20000</label>
                    <label><input id="phone_price_20000_30000" class="filter-field" type="checkbox" name="price[]" value="20000 - 30000"/><span></span>20000 - 30000</label>
                    <label><input id="phone_price_30000_50000" class="filter-field" type="checkbox" name="price[]" value="30000 - 50000"/><span></span>30000 - 50000</label>
                    <label><input id="phone_price_50000_above" class="filter-field" type="checkbox" name="price[]" value="50000 - above"/><span></span>50000 - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-sim-count">No. of SIM</label>
                <div class="filter-form-values-sim-count">
                    <label><input id="phone_sim_count_1" class="filter-field" type="checkbox" name="sim_count[]" value="1"/><span></span>Single SIM</label>
                    <label><input id="phone_sim_count_2" class="filter-field" type="checkbox" name="sim_count[]" value="2"/><span></span>Dual SIM</label>
                    <label><input id="phone_sim_count_3" class="filter-field" type="checkbox" name="sim_count[]" value="3"/><span></span>Triple SIM</label>
                    <label><input id="phone_sim_count_4" class="filter-field" type="checkbox" name="sim_count[]" value="4"/><span></span>Quad SIM</label>
                </div>
                </p>
                <p>
                    <label class="lbl-display-size">Display Size</label>
                <div class="filter-form-values-display-size">
                    <label><input id="phone_display_size_3_below" class="filter-field" type="checkbox" name="display_size[]" value="3 inch - below"/><span></span>3 inch - below</label>
                    <label><input id="phone_display_size_3_to_3_5" class="filter-field" type="checkbox" name="display_size[]" value="3 - 3.5 inch"/><span></span>3 - 3.5 inch</label>
                    <label><input id="phone_display_size_3_5_to_4" class="filter-field" type="checkbox" name="display_size[]" value="3.5 - 4 inch"/><span></span>3.5 - 4 inch</label>
                    <label><input id="phone_display_size_4_to_4_5" class="filter-field" type="checkbox" name="display_size[]" value="4 - 4.5 inch"/><span></span>4 - 4.5 inch</label>
                    <label><input id="phone_display_size_4_5_to_5" class="filter-field" type="checkbox" name="display_size[]" value="4.5 - 5 inch"/><span></span>4.5 - 5 inch</label>
                    <label><input id="phone_display_size_5_to_5_5" class="filter-field" type="checkbox" name="display_size[]" value="5 - 5.5 inch"/><span></span>5 - 5.5 inch</label>
                    <label><input id="phone_display_size_5_5_above" class="filter-field" type="checkbox" name="display_size[]" value="5.5 inch - above"/><span></span>5.5 inch - above</label>
                </div>
                </p>
                <!-- <p>
                     <label class="lbl-display-resolution">Display Resolution</label>
                     <div class="filter-form-values-display-resolution">
                     <label><input id="phone_display_resolution_wvga" class="filter-field" type="checkbox" name="display_resolution[]" value="WVGA"/><span></span>WVGA (Normal)</label>
                     <label><input id="phone_display_resolution_hd" class="filter-field" type="checkbox" name="display_resolution[]" value="HD"/><span></span>HD</label>
                     <label><input id="phone_display_resolution_fhd" class="filter-field" type="checkbox" name="display_resolution[]" value="Full HD"/><span></span>Full HD</label>
                     <label><input id="phone_display_resolution_qhd" class="filter-field" type="checkbox" name="display_resolution[]" value="Quad HD"/><span></span>Quad HD</label>
                     <label><input id="phone_display_resolution_4k" class="filter-field" type="checkbox" name="display_resolution[]" value="4K"/><span></span>4K</label>
                     </div>
                 </p>-->
                <p>
                    <label class="lbl-os">OS</label>
                <div class="filter-form-values-os">
                    <label><input id="phone_os_android" class="filter-field" type="checkbox" name="os[]" value="Android"/><span></span>Android</label>
                    <label><input id="phone_os_ios" class="filter-field" type="checkbox" name="os[]" value="iOS"/><span></span>iOS</label>
                    <label><input id="phone_os_windows" class="filter-field" type="checkbox" name="os[]" value="Windows"/><span></span>Windows</label>
                </div>
                </p>
                <p>
                    <label class="lbl-clock-speed">CPU Clock Speed</label>
                <div class="filter-form-values-clock-speed">
                    <label><input id="phone_clock_speed_1_to_1_5" class="filter-field" type="checkbox" name="clock_speed[]" value="1 - 1.5 GHz"/><span></span>1 - 1.5 GHz</label>
                    <label><input id="phone_clock_speed_1_5_to_2" class="filter-field" type="checkbox" name="clock_speed[]" value="1.5 - 2 GHz"/><span></span>1.5 - 2 GHz</label>
                    <label><input id="phone_clock_speed_2_to_2_5" class="filter-field" type="checkbox" name="clock_speed[]" value="2 - 2.5 GHz"/><span></span>2 - 2.5 GHz</label>
                    <label><input id="phone_clock_speed_2_5_above" class="filter-field" type="checkbox" name="clock_speed[]" value="2.5 GHz - above"/><span></span>2.5 GHz - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-cores-count">CPU No. of Cores</label>
                <div class="filter-form-values-cores-count">
                    <label><input id="phone_core_count_1" class="filter-field" type="checkbox" name="cores_count[]" value="1"/><span></span>Single-core</label>
                    <label><input id="phone_core_count_2" class="filter-field" type="checkbox" name="cores_count[]" value="2"/><span></span>Dual-core</label>
                    <label><input id="phone_core_count_4" class="filter-field" type="checkbox" name="cores_count[]" value="4"/><span></span>Quad-core</label>
                    <label><input id="phone_core_count_6" class="filter-field" type="checkbox" name="cores_count[]" value="6"/><span></span>Hexa-core</label>
                    <label><input id="phone_core_count_8" class="filter-field" type="checkbox" name="cores_count[]" value="8"/><span></span>Octa-core</label>
                </div>
                </p>
                <p>
                    <label class="lbl-ram">RAM</label>
                <div class="filter-form-values-ram">
                    <label><input id="phone_ram_0_to_1" class="filter-field" type="checkbox" name="ram[]" value="0 - 1 GB"/><span></span>0 - 1 GB</label>
                    <label><input id="phone_ram_1_to_2" class="filter-field" type="checkbox" name="ram[]" value="1 - 2 GB"/><span></span>1 - 2 GB</label>
                    <label><input id="phone_ram_2_to_4" class="filter-field" type="checkbox" name="ram[]" value="2 - 4 GB"/><span></span>2 - 4 GB</label>
                    <label><input id="phone_ram_4_above" class="filter-field" type="checkbox" name="ram[]" value="4 GB - above"/><span></span>4 GB - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-internal-memory">Internal Memory</label>
                <div class="filter-form-values-internal-memory">
                    <label><input id="phone_internal_memory_1_to_4" class="filter-field" type="checkbox" name="internal_memory[]" value="1 - 4 GB"/><span></span>1 - 4 GB</label>
                    <label><input id="phone_internal_memory_4_to_8" class="filter-field" type="checkbox" name="internal_memory[]" value="4 - 8 GB"/><span></span>4 - 8 GB</label>
                    <label><input id="phone_internal_memory_8_to_16" class="filter-field" type="checkbox" name="internal_memory[]" value="8 - 16 GB"/><span></span>8 - 16 GB</label>
                    <label><input id="phone_internal_memory_16_to_32" class="filter-field" type="checkbox" name="internal_memory[]" value="16 - 32 GB"/><span></span>16 - 32 GB</label>
                    <label><input id="phone_internal_memory_32_to_64" class="filter-field" type="checkbox" name="internal_memory[]" value="32 - 64 GB"/><span></span>32 - 64 GB</label>
                    <label><input id="phone_internal_memory_64_to_128" class="filter-field" type="checkbox" name="internal_memory[]" value="64 - 128 GB"/><span></span>64 - 128 GB</label>
                    <label><input id="phone_internal_memory_128_above" class="filter-field" type="checkbox" name="internal_memory[]" value="128 GB - above"/><span></span>128 GB - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-external-memory">External Memory</label>
                <div class="filter-form-values-external-memory">
                    <label><input id="phone_external_memory_1_to_4" class="filter-field" type="checkbox" name="external_memory[]" value="1 - 4 GB"/><span></span>1 - 4 GB</label>
                    <label><input id="phone_external_memory_4_to_8" class="filter-field" type="checkbox" name="external_memory[]" value="4 - 8 GB"/><span></span>4 - 8 GB</label>
                    <label><input id="phone_external_memory_8_to_16" class="filter-field" type="checkbox" name="external_memory[]" value="8 - 16 GB"/><span></span>8 - 16 GB</label>
                    <label><input id="phone_external_memory_16_to_32" class="filter-field" type="checkbox" name="external_memory[]" value="16 - 32 GB"/><span></span>16 - 32 GB</label>
                    <label><input id="phone_external_memory_32_to_64" class="filter-field" type="checkbox" name="external_memory[]" value="32 - 64 GB"/><span></span>32 - 64 GB</label>
                    <label><input id="phone_external_memory_64_to_128" class="filter-field" type="checkbox" name="external_memory[]" value="64 - 128 GB"/><span></span>64 - 128 GB</label>
                    <label><input id="phone_external_memory_128_above" class="filter-field" type="checkbox" name="external_memory[]" value="128 GB - above"/><span></span>128 GB - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-primary-camera">Primary Camera</label>
                <div class="filter-form-values-primary-camera">
                    <label><input id="phone_primary_camera_2_below" class="filter-field" type="checkbox" name="primary_camera[]" value="2 MP - below"/><span></span>2 MP - below</label>
                    <label><input id="phone_primary_camera_2_to_2_9" class="filter-field" type="checkbox" name="primary_camera[]" value="2 - 2.9 MP"/><span></span>2 - 2.9 MP</label>
                    <label><input id="phone_primary_camera_3_to_4_9" class="filter-field" type="checkbox" name="primary_camera[]" value="3 - 4.9 MP"/><span></span>3 - 4.9 MP</label>
                    <label><input id="phone_primary_camera_5_to_7_9" class="filter-field" type="checkbox" name="primary_camera[]" value="5 - 7.9 MP"/><span></span>5 - 7.9 MP</label>
                    <label><input id="phone_primary_camera_8_above" class="filter-field" type="checkbox" name="primary_camera[]" value="8 MP - above"/><span></span>8 MP - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-secondary-camera">Secondary Camera</label>
                <div class="filter-form-values-secondary-camera">
                    <label><input id="phone_secondary_camera_2_below" class="filter-field" type="checkbox" name="secondary_camera[]" value="2 MP - below"/><span></span>2 MP - below</label>
                    <label><input id="phone_secondary_camera_2_to_2_9" class="filter-field" type="checkbox" name="secondary_camera[]" value="2 - 2.9 MP"/><span></span>2 - 2.9 MP</label>
                    <label><input id="phone_secondary_camera_3_to_4_9" class="filter-field" type="checkbox" name="secondary_camera[]" value="3 - 4.9 MP"/><span></span>3 - 4.9 MP</label>
                    <label><input id="phone_secondary_camera_5_to_7_9" class="filter-field" type="checkbox" name="secondary_camera[]" value="5 - 7.9 MP"/><span></span>5 - 7.9 MP</label>
                    <label><input id="phone_secondary_camera_8_above" class="filter-field" type="checkbox" name="secondary_camera[]" value="8 MP - above"/><span></span>8 MP - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-battery-size">Battery Size</label>
                <div class="filter-form-values-battery-size">
                    <label><input id="phone_battery_size_1000_below" class="filter-field" type="checkbox" name="battery_size[]" value="1000 mAh - below"/><span></span>1000 mAh - below</label>
                    <label><input id="phone_battery_size_1000_to_1999" class="filter-field" type="checkbox" name="battery_size[]" value="1000 - 1999 mAh"/><span></span>1000 - 1999 mAh</label>
                    <label><input id="phone_battery_size_2000_to_2999" class="filter-field" type="checkbox" name="battery_size[]" value="2000 - 2999 mAh"/><span></span>2000 - 2999 mAh</label>
                    <label><input id="phone_battery_size_3000_to_3999" class="filter-field" type="checkbox" name="battery_size[]" value="3000 - 3999 mAh"/><span></span>3000 - 3999 mAh</label>
                    <label><input id="phone_battery_size_4000_above" class="filter-field" type="checkbox" name="battery_size[]" value="4000 mAh - above"/><span></span>4000 mAh - above</label>
                </div>
                </p>
            </div>
            <div class="filter-sub-section" id="tablets">

                <p>
                    <label class="lbl-brand">Brand</label>
                <div class="filter-form-values-brand">
                    <?php convert_tablet_brand_to_input(); ?>
                </div>
                </p>
                <p>
                    <label class="lbl-price">Price</label>
                <div class="filter-form-values-price">
                    <label><input id="tablet_price_0_10000" class="filter-field" type="checkbox" name="price[]" value="0 - 10000"/><span></span>0 - 10000</label>
                    <label><input id="tablet_price_10000_20000" class="filter-field" type="checkbox" name="price[]" value="10000 - 20000"/><span></span>10000 - 20000</label>
                    <label><input id="tablet_price_20000_30000" class="filter-field" type="checkbox" name="price[]" value="20000 - 30000"/><span></span>20000 - 30000</label>
                    <label><input id="tablet_price_30000_50000" class="filter-field" type="checkbox" name="price[]" value="30000 - 50000"/><span></span>30000 - 50000</label>
                    <label><input id="tablet_price_50000_above" class="filter-field" type="checkbox" name="price[]" value="50000 - above"/><span></span>50000 - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-sim-count">No. of SIM</label>
                <div class="filter-form-values-sim-count">
                    <label><input id="tablet_sim_count_1" class="filter-field" type="checkbox" name="sim_count[]" value="1"/><span></span>Single SIM</label>
                    <label><input id="tablet_sim_count_2" class="filter-field" type="checkbox" name="sim_count[]" value="2"/><span></span>Dual SIM</label>
                    <label><input id="tablet_sim_count_3" class="filter-field" type="checkbox" name="sim_count[]" value="3"/><span></span>Triple SIM</label>
                    <label><input id="tablet_sim_count_4" class="filter-field" type="checkbox" name="sim_count[]" value="4"/><span></span>Quad SIM</label>
                </div>
                </p>
                <p>
                    <label class="lbl-display-size">Display Size</label>
                <div class="filter-form-values-display-size">
                    <label><input id="tablet_display_size_7_below" class="filter-field" type="checkbox" name="display_size[]" value="7 inch - below"/><span></span>7 inch - below</label>
                    <label><input id="tablet_display_size_7_to_8" class="filter-field" type="checkbox" name="display_size[]" value="7 - 8 inch"/><span></span>7 - 8 inch</label>
                    <label><input id="tablet_display_size_8_to_9" class="filter-field" type="checkbox" name="display_size[]" value="8 - 9 inch"/><span></span>8 - 9 inch</label>
                    <label><input id="tablet_display_size_9_to_10" class="filter-field" type="checkbox" name="display_size[]" value="9 - 10 inch"/><span></span>9 - 10 inch</label>
                    <label><input id="tablet_display_size_10_above" class="filter-field" type="checkbox" name="display_size[]" value="10 inch - above"/><span></span>10 inch - above</label>
                </div>
                </p>
                <!-- <p>
                     <label class="lbl-display-resolution">Display Resolution</label>
                     <div class="filter-form-values-display-resolution">
                     <label><input id="tablet_display_resolution_wvga" class="filter-field" type="checkbox" name="display_resolution[]" value="WVGA"/><span></span>WVGA (Normal)</label>
                     <label><input id="tablet_display_resolution_hd" class="filter-field" type="checkbox" name="display_resolution[]" value="HD"/><span></span>HD</label>
                     <label><input id="tablet_display_resolution_fhd" class="filter-field" type="checkbox" name="display_resolution[]" value="Full HD"/><span></span>Full HD</label>
                     <label><input id="tablet_display_resolution_qhd" class="filter-field" type="checkbox" name="display_resolution[]" value="Quad HD"/><span></span>Quad HD</label>
                     <label><input id="tablet_display_resolution_4k" class="filter-field" type="checkbox" name="display_resolution[]" value="4K"/><span></span>4K</label>
                     </div>
                 </p>-->
                <p>
                    <label class="lbl-os">OS</label>
                <div class="filter-form-values-os">
                    <label><input id="tablet_os_android" class="filter-field" type="checkbox" name="os[]" value="Android"/><span></span>Android</label>
                    <label><input id="tablet_os_ios" class="filter-field" type="checkbox" name="os[]" value="iOS"/><span></span>iOS</label>
                    <label><input id="tablet_os_windows" class="filter-field" type="checkbox" name="os[]" value="Windows"/><span></span>Windows</label>
                </div>
                </p>
                <p>
                    <label class="lbl-clock-speed">CPU Clock Speed</label>
                <div class="filter-form-values-clock-speed">
                    <label><input id="tablet_clock_speed_1_to_1_5" class="filter-field" type="checkbox" name="clock_speed[]" value="1 - 1.5 GHz"/><span></span>1 - 1.5 GHz</label>
                    <label><input id="tablet_clock_speed_1_5_to_2" class="filter-field" type="checkbox" name="clock_speed[]" value="1.5 - 2 GHz"/><span></span>1.5 - 2 GHz</label>
                    <label><input id="tablet_clock_speed_2_to_2_5" class="filter-field" type="checkbox" name="clock_speed[]" value="2 - 2.5 GHz"/><span></span>2 - 2.5 GHz</label>
                    <label><input id="tablet_clock_speed_2_5_above" class="filter-field" type="checkbox" name="clock_speed[]" value="2.5 GHz - above"/><span></span>2.5 GHz - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-cores-count">CPU No. of Cores</label>
                <div class="filter-form-values-cores-count">
                    <label><input id="tablet_core_count_1" class="filter-field" type="checkbox" name="cores_count[]" value="1"/><span></span>Single-core</label>
                    <label><input id="tablet_core_count_2" class="filter-field" type="checkbox" name="cores_count[]" value="2"/><span></span>Dual-core</label>
                    <label><input id="tablet_core_count_4" class="filter-field" type="checkbox" name="cores_count[]" value="4"/><span></span>Quad-core</label>
                    <label><input id="tablet_core_count_6" class="filter-field" type="checkbox" name="cores_count[]" value="6"/><span></span>Hexa-core</label>
                    <label><input id="tablet_core_count_8" class="filter-field" type="checkbox" name="cores_count[]" value="8"/><span></span>Octa-core</label>
                </div>
                </p>
                <p>
                    <label class="lbl-ram">RAM</label>
                <div class="filter-form-values-ram">
                    <label><input id="tablet_ram_0_to_1" class="filter-field" type="checkbox" name="ram[]" value="0 - 1 GB"/><span></span>0 - 1 GB</label>
                    <label><input id="tablet_ram_1_to_2" class="filter-field" type="checkbox" name="ram[]" value="1 - 2 GB"/><span></span>1 - 2 GB</label>
                    <label><input id="tablet_ram_2_to_4" class="filter-field" type="checkbox" name="ram[]" value="2 - 4 GB"/><span></span>2 - 4 GB</label>
                    <label><input id="tablet_ram_4_above" class="filter-field" type="checkbox" name="ram[]" value="4 GB - above"/><span></span>4 GB - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-internal-memory">Internal Memory</label>
                <div class="filter-form-values-internal-memory">
                    <label><input id="tablet_internal_memory_1_to_4" class="filter-field" type="checkbox" name="internal_memory[]" value="1 - 4 GB"/><span></span>1 - 4 GB</label>
                    <label><input id="tablet_internal_memory_4_to_8" class="filter-field" type="checkbox" name="internal_memory[]" value="4 - 8 GB"/><span></span>4 - 8 GB</label>
                    <label><input id="tablet_internal_memory_8_to_16" class="filter-field" type="checkbox" name="internal_memory[]" value="8 - 16 GB"/><span></span>8 - 16 GB</label>
                    <label><input id="tablet_internal_memory_16_to_32" class="filter-field" type="checkbox" name="internal_memory[]" value="16 - 32 GB"/><span></span>16 - 32 GB</label>
                    <label><input id="tablet_internal_memory_32_to_64" class="filter-field" type="checkbox" name="internal_memory[]" value="32 - 64 GB"/><span></span>32 - 64 GB</label>
                    <label><input id="tablet_internal_memory_64_to_128" class="filter-field" type="checkbox" name="internal_memory[]" value="64 - 128 GB"/><span></span>64 - 128 GB</label>
                    <label><input id="tablet_internal_memory_128_above" class="filter-field" type="checkbox" name="internal_memory[]" value="128 GB - above"/><span></span>128 GB - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-external-memory">External Memory</label>
                <div class="filter-form-values-external-memory">
                    <label><input id="tablet_external_memory_1_to_4" class="filter-field" type="checkbox" name="external_memory[]" value="1 - 4 GB"/><span></span>1 - 4 GB</label>
                    <label><input id="tablet_external_memory_4_to_8" class="filter-field" type="checkbox" name="external_memory[]" value="4 - 8 GB"/><span></span>4 - 8 GB</label>
                    <label><input id="tablet_external_memory_8_to_16" class="filter-field" type="checkbox" name="external_memory[]" value="8 - 16 GB"/><span></span>8 - 16 GB</label>
                    <label><input id="tablet_external_memory_16_to_32" class="filter-field" type="checkbox" name="external_memory[]" value="16 - 32 GB"/><span></span>16 - 32 GB</label>
                    <label><input id="tablet_external_memory_32_to_64" class="filter-field" type="checkbox" name="external_memory[]" value="32 - 64 GB"/><span></span>32 - 64 GB</label>
                    <label><input id="tablet_external_memory_64_to_128" class="filter-field" type="checkbox" name="external_memory[]" value="64 - 128 GB"/><span></span>64 - 128 GB</label>
                    <label><input id="tablet_external_memory_128_above" class="filter-field" type="checkbox" name="external_memory[]" value="128 GB - above"/><span></span>128 GB - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-primary-camera">Primary Camera</label>
                <div class="filter-form-values-primary-camera">
                    <label><input id="tablet_primary_camera_2_below" class="filter-field" type="checkbox" name="primary_camera[]" value="2 MP - below"/><span></span>2 MP - below</label>
                    <label><input id="tablet_primary_camera_2_to_2_9" class="filter-field" type="checkbox" name="primary_camera[]" value="2 - 2.9 MP"/><span></span>2 - 2.9 MP</label>
                    <label><input id="tablet_primary_camera_3_to_4_9" class="filter-field" type="checkbox" name="primary_camera[]" value="3 - 4.9 MP"/><span></span>3 - 4.9 MP</label>
                    <label><input id="tablet_primary_camera_5_to_7_9" class="filter-field" type="checkbox" name="primary_camera[]" value="5 - 7.9 MP"/><span></span>5 - 7.9 MP</label>
                    <label><input id="tablet_primary_camera_8_above" class="filter-field" type="checkbox" name="primary_camera[]" value="8 MP - above"/><span></span>8 MP - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-secondary-camera">Secondary Camera</label>
                <div class="filter-form-values-secondary-camera">
                    <label><input id="tablet_secondary_camera_2_below" class="filter-field" type="checkbox" name="secondary_camera[]" value="2 MP - below"/><span></span>2 MP - below</label>
                    <label><input id="tablet_secondary_camera_2_to_2_9" class="filter-field" type="checkbox" name="secondary_camera[]" value="2 - 2.9 MP"/><span></span>2 - 2.9 MP</label>
                    <label><input id="tablet_secondary_camera_3_to_4_9" class="filter-field" type="checkbox" name="secondary_camera[]" value="3 - 4.9 MP"/><span></span>3 - 4.9 MP</label>
                    <label><input id="tablet_secondary_camera_5_to_7_9" class="filter-field" type="checkbox" name="secondary_camera[]" value="5 - 7.9 MP"/><span></span>5 - 7.9 MP</label>
                    <label><input id="tablet_secondary_camera_8_above" class="filter-field" type="checkbox" name="secondary_camera[]" value="8 MP - above"/><span></span>8 MP - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-battery-size">Battery Size</label>
                <div class="filter-form-values-battery-size">
                    <label><input id="tablet_battery_size_4000_below" class="filter-field" type="checkbox" name="battery_size[]" value="4000 mAh - below"/><span></span>4000 mAh - below</label>
                    <label><input id="tablet_battery_size_4000_to_6000" class="filter-field" type="checkbox" name="battery_size[]" value="4000 - 6000 mAh"/><span></span>4000 - 6000 mAh</label>
                    <label><input id="tablet_battery_size_6000_to_8000" class="filter-field" type="checkbox" name="battery_size[]" value="6000 - 8000 mAh"/><span></span>6000 - 8000 mAh</label>
                    <label><input id="tablet_battery_size_8000_above" class="filter-field" type="checkbox" name="battery_size[]" value="8000 mAh - above"/><span></span>8000 mAh - above</label>
                </div>
                </p>

            </div>
            <div class="filter-sub-section" id="laptops">
                <p>
                    <label class="lbl-brand">Brand</label>
                <div class="filter-form-values-brand">
                    <?php convert_laptop_brand_to_input(); ?>
                </div>
                </p>
                <p>
                    <label class="lbl-type">Type</label>
                <div class="filter-form-values-type">
                    <?php convert_laptop_type_to_input(); ?>
                </div>
                </p>
                <p>
                    <label class="lbl-price">Price</label>
                <div class="filter-form-values-price">
                    <label><input id="laptop_price_0_30000" class="filter-field" type="checkbox" name="price[]" value="0 - 30000"/><span></span>0 - 30000</label>
                    <label><input id="laptop_price_30000_50000" class="filter-field" type="checkbox" name="price[]" value="30000 - 50000"/><span></span>30000 - 50000</label>
                    <label><input id="laptop_price_50000_100000" class="filter-field" type="checkbox" name="price[]" value="50000 - 100000"/><span></span>50000 - 100000</label>
                    <label><input id="laptop_price_100000_150000" class="filter-field" type="checkbox" name="price[]" value="100000 - 150000"/><span></span>100000 - 150000</label>
                    <label><input id="laptop_price_150000_above" class="filter-field" type="checkbox" name="price[]" value="150000 - above"/><span></span>150000 - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-processor">Processor</label>
                <div class="filter-form-values-processor">
                    <?php convert_laptop_processor_to_input(); ?>
                </div>
                </p>
                <p>
                    <label class="lbl-display-size">Display Size</label>
                <div class="filter-form-values-display-size">
                    <label><input id="laptop_display_size_12_below" class="filter-field" type="checkbox" name="display_size[]" value="12 inch - below"/><span></span>Below 12 inch</label>
                    <label><input id="laptop_display_size_12_to_12_9" class="filter-field" type="checkbox" name="display_size[]" value="12 - 12.9 inch"/><span></span>12 - 12.9 inch</label>
                    <label><input id="laptop_display_size_13_to_13_9" class="filter-field" type="checkbox" name="display_size[]" value="13 - 13.9 inch"/><span></span>13 - 13.9 inch</label>
                    <label><input id="laptop_display_size_14_to_14_9" class="filter-field" type="checkbox" name="display_size[]" value="14 - 14.9 inch"/><span></span>14 - 14.9 inch</label>
                    <label><input id="laptop_display_size_15_to_15_9" class="filter-field" type="checkbox" name="display_size[]" value="15 - 15.9 inch"/><span></span>15 - 15.9 inch</label>
                    <label><input id="laptop_display_size_16_to_16_9" class="filter-field" type="checkbox" name="display_size[]" value="16 - 16.9 inch"/><span></span>16 - 16.9 inch</label>
                    <label><input id="laptop_display_size_127_to_17_9" class="filter-field" type="checkbox" name="display_size[]" value="17 - 17.9 inch"/><span></span>17 - 17.9 inch</label>
                    <label><input id="laptop_display_size_18_above" class="filter-field" type="checkbox" name="display_size[]" value="18 inch - above"/><span></span>18 inch - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-ram">RAM</label>
                <div class="filter-form-values-ram">
                    <label><input id="laptop_ram_0_to_2" class="filter-field" type="checkbox" name="ram[]" value="0 - 2 GB"/><span></span>0 - 2 GB</label>
                    <label><input id="laptop_ram_2_to_4" class="filter-field" type="checkbox" name="ram[]" value="2 - 4 GB"/><span></span>2 - 4 GB</label>
                    <label><input id="laptop_ram_4_to_8" class="filter-field" type="checkbox" name="ram[]" value="4 - 8 GB"/><span></span>4 - 8 GB</label>
                    <label><input id="laptop_ram_18_to_16" class="filter-field" type="checkbox" name="ram[]" value="8 - 16 GB"/><span></span>8 - 16 GB</label>
                    <label><input id="laptop_ram_16_above" class="filter-field" type="checkbox" name="ram[]" value="16 GB - above"/><span></span>16 GB - above</label>
                </div>
                </p>
                <p>
                    <label class="lbl-os">OS</label>
                <div class="filter-form-values-os">
                    <?php convert_laptop_os_to_input(); ?>
                </div>
                </p>
                <!--<p>
                    <label class="lbl-graphics">Graphics</label>
                    <div class="filter-form-values-graphics">
                    <label><input id="laptop_graphics_0_to_1" class="filter-field" type="checkbox" name="graphics[]" value="0 - 1 GB"/><span></span>0 - 1 GB</label>
                    <label><input id="laptop_graphics_1_to_2" class="filter-field" type="checkbox" name="graphics[]" value="1 - 2 GB"/><span></span>1 - 2 GB</label>
                    <label><input id="laptop_graphics_2_to_4" class="filter-field" type="checkbox" name="graphics[]" value="2 - 4 GB"/><span></span>2 - 4 GB</label>
                    </div>
                </p>-->
                <p>
                    <label class="lbl-storage">Storage</label>
                <div class="filter-form-values-storage">
                    <label><input id="laptop_storage_0_to_256" class="filter-field" type="checkbox" name="storage[]" value="0 - 256 GB"/><span></span>0 - 256 GB</label>
                    <label><input id="laptop_storage_256_to_512" class="filter-field" type="checkbox" name="storage[]" value="256 - 512 GB"/><span></span>256 - 512 GB</label>
                    <label><input id="laptop_storage_512_to_1024" class="filter-field" type="checkbox" name="storage[]" value="512 - 1024 GB"/><span></span>512 GB - 1 TB</label>
                    <label><input id="laptop_storage_1024_and_above" class="filter-field" type="checkbox" name="storage[]" value="1024 GB - above"/><span></span>1TB - above</label>
                </div>
                </p>
            </div>
        </form>
        <div class="filter-result-section">
            <?php

            $sql = "SELECT `phone_id`,`phone_image_filename`,`phone_model`,`phone_price`,`phone_internal_memory_size`,`phone_external_memory_size`,`phone_ram`,`phone_display_size`,`phone_display_resolution_high`,`phone_display_resolution_low`,`phone_primary_camera_pixel_size`,`phone_secondary_camera_pixel_size`,`phone_battery_size`,`phone_cpu_chipset`,`file_name` FROM phones ORDER BY phone_launch DESC LIMIT 10";
            show_all_product("phones",$sql);

            ?>
        </div>

    <?php endif ?>
    </div>
</main>
<?php include_once("aside.php"); ?>
    </div></div>
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

<script>
    (function(){
        $("input.filter-field").click(function(){
            var context = $("#filter-product").val();

            switch(context){
                case "Phones":
                    var cb = $("div#phones input.filter-field");
                    break;
                case "Tablets":
                    var cb = $("div#tablets input.filter-field");
                    break;
                case "Laptops":
                    var cb = $("div#laptops input.filter-field");
                    break;
                default:
                    // do nothing
            }

            var handle = $(this).attr("name");
            var data = new FormData();

            var cb_checked_count = 0;
            for(var i = 0;i < cb.length;i++){
                if(cb[i].checked){
                    cb_checked_count++;
                }
            }
            if(cb_checked_count >= 1){
                for(var i = 0;i < cb.length;i++){
                    if(cb[i].checked){
                        var key = cb[i].getAttribute("name");
                        var value = cb[i].getAttribute("value");
                        data.append(key, value);
                    }
                }

                data.append("filter_product",context);

                var xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function(){
                    if((xhr.readyState == 4) && (xhr.status == 200 || xhr.status == 304)){
                        var xml = xhr.responseXML, $xml = $( xml );
                        $(".filter-result-section").empty();
                        if(context == "Phones"){
                            $xml.find("row").each(function(idx, v) {
                                var imgVal = $(v).find("phone_image_filename").text();
                                var titleVal = $(v).find("phone_model").text();
                                var priceVal = $(v).find("phone_price").text();
                                var linkVal = $(v).find("file_name").text();
                                var $img = $("<img class=\"product-image\" src=\"images/"+imgVal+"\" alt=\""+titleVal+"\" />");
                                var $aImg = $("<a href=\"http://www.kathmanduelectronics.com/phones/"+linkVal+".php\"></a>");
                                $aImg.append($img);
                                var $product_sec1 = $("<div class=\"product-sec1\"></div>");
                                $product_sec1.append($aImg);

                                var $aTitle = $("<a class=\"product-title\" href=\"http://www.kathmanduelectronics.com/phones/"+linkVal+".php\"></a>");
                                $aTitle.text(titleVal);
                                var $pTitle = $("<p class=\"product-title\"></p>");
                                $pTitle.append($aTitle);

                                if(priceVal != ""){
                                    var $pPrice = $("<p class=\"product-price\"></p>");
                                    $pPrice.text("Starting at NRs. "+priceVal);
                                }

                                var $product_sec2 = $("<div class=\"product-sec2\"></div>");
                                $product_sec2.append($pTitle);
                                if(priceVal != ""){
                                    $product_sec2.append($pPrice);
                                }
                                var $product = $("<div class=\"product\"></div>");
                                $product.append($product_sec1);
                                $product.append($product_sec2);
                                $(".filter-result-section").append($product);
                                if($(window).width <= 480){
                                    $product.css("width","100%");
                                }else if($(window).width >= 1024){
                                    $product.css("width","30%");
                                }
                            });
                            var brand = [];
                            $xml.find("row").each(function(idx, v) {
                                brand[idx] = [];
                                $(v).find("phone_brand").each(function( i , vi) {
                                    brand[idx].push( $(vi).text() );
                                });
                            });

                            var model = [];
                            $xml.find("row").each(function(idx, v) {
                                model[idx] = [];
                                $(v).find("phone_model").each(function( i , vi) {
                                    model[idx].push( $(vi).text() );
                                });
                            });

                            var price = [];
                            $xml.find("row").each(function(idx, v) {
                                price[idx] = [];
                                $(v).find("phone_price").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        price[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var sim_count = [];
                            $xml.find("row").each(function(idx, v) {
                                sim_count[idx] = [];
                                $(v).find("phone_sim_count").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        sim_count[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var display_size = [];
                            $xml.find("row").each(function(idx, v) {
                                display_size[idx] = [];
                                $(v).find("phone_display_size").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        display_size[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var display_resolution_high = [];
                            $xml.find("row").each(function(idx, v) {
                                display_resolution_high[idx] = [];
                                $(v).find("phone_display_resolution_high").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        display_resolution_high[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var display_resolution_low = [];
                            $xml.find("row").each(function(idx, v) {
                                display_resolution_low[idx] = [];
                                $(v).find("phone_display_resolution_low").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        display_resolution_low[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var os = [];
                            $xml.find("row").each(function(idx, v) {
                                os[idx] = [];
                                $(v).find("phone_os").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        os[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var clock_speed = [];
                            $xml.find("row").each(function(idx, v) {
                                clock_speed[idx] = [];
                                $(v).find("phone_cpu_clock_freq").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        clock_speed[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var core_count = [];
                            $xml.find("row").each(function(idx, v) {
                                core_count[idx] = [];
                                $(v).find("phone_cpu_core_count").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        core_count[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var ram = [];
                            $xml.find("row").each(function(idx, v) {
                                ram[idx] = [];
                                $(v).find("phone_ram").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        ram[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var internal_memory = [];
                            $xml.find("row").each(function(idx, v) {
                                internal_memory[idx] = [];
                                $(v).find("phone_internal_memory_size").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        internal_memory[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var external_memory = [];
                            $xml.find("row").each(function(idx, v) {
                                external_memory[idx] = [];
                                $(v).find("phone_external_memory_size").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        external_memory[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var primary_camera = [];
                            $xml.find("row").each(function(idx, v) {
                                primary_camera[idx] = [];
                                $(v).find("phone_primary_camera_pixel_size").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        primary_camera[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var secondary_camera = [];
                            $xml.find("row").each(function(idx, v) {
                                secondary_camera[idx] = [];
                                $(v).find("phone_secondary_camera_pixel_size").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        secondary_camera[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var battery_size = [];
                            $xml.find("row").each(function(idx, v) {
                                battery_size[idx] = [];
                                $(v).find("phone_battery_size").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        battery_size[idx].push( $(vi).text() );
                                    }
                                });
                            });


                            if(handle != "brand[]"){
                                $("#phone_brand_Apple").attr("disabled","disabled");
                                $("#phone_brand_Asus").attr("disabled","disabled");
                                for(var i = 0;i < brand.length;i++){
                                    if(brand[i] == "Apple"){
                                        $("#phone_brand_Apple").removeAttr("disabled");
                                    }else if(brand[i] == "Asus"){
                                        $("#phone_brand_Asus").removeAttr("disabled");
                                    }
                                }
                            }
                            if(handle != "price[]"){
                                $("#phone_price_0_10000").attr("disabled","disabled");
                                $("#phone_price_10000_20000").attr("disabled","disabled");
                                $("#phone_price_20000_30000").attr("disabled","disabled");
                                $("#phone_price_30000_50000").attr("disabled","disabled");
                                $("#phone_price_50000_above").attr("disabled","disabled");
                                for(var i = 0;i < price.length;i++){
                                    if(price[i] >0 && price[i] <= 10000){
                                        $("#phone_price_0_10000").removeAttr("disabled");
                                    }else if(price[i] >10000 && price[i] <= 20000){
                                        $("#phone_price_10000_20000").removeAttr("disabled");
                                    }else if(price[i] >20000 && price[i] <= 30000){
                                        $("#phone_price_20000_30000").removeAttr("disabled");
                                    }else if(price[i] >30000 && price[i] <= 50000){
                                        $("#phone_price_30000_50000").removeAttr("disabled");
                                    }else if(price[i] >50000){
                                        $("#phone_price_50000_above").removeAttr("disabled");
                                    }
                                }
                            }
                            if(handle != "sim_count[]"){
                                $("#phone_sim_count_1").attr("disabled","disabled");
                                $("#phone_sim_count_2").attr("disabled","disabled");
                                $("#phone_sim_count_3").attr("disabled","disabled");
                                $("#phone_sim_count_4").attr("disabled","disabled");
                                for(var i = 0;i < sim_count.length;i++){
                                    if(sim_count[i] == 1){
                                        $("#phone_sim_count_1").removeAttr("disabled");
                                    }else if(sim_count[i] == 2){
                                        $("#phone_sim_count_2").removeAttr("disabled");
                                    }else if(sim_count[i] == 3){
                                        $("#phone_sim_count_3").removeAttr("disabled");
                                    }else if(sim_count[i] == 4){
                                        $("#phone_sim_count_4").removeAttr("disabled");
                                    }
                                }
                            }
                            if(handle != "display_size[]"){
                                $("#phone_display_size_3_below").attr("disabled","disabled");
                                $("#phone_display_size_3_to_3_5").attr("disabled","disabled");
                                $("#phone_display_size_3_5_to_4").attr("disabled","disabled");
                                $("#phone_display_size_4_to_4_5").attr("disabled","disabled");
                                $("#phone_display_size_4_5_to_5").attr("disabled","disabled");
                                $("#phone_display_size_5_to_5_5").attr("disabled","disabled");
                                $("#phone_display_size_5_5_above").attr("disabled","disabled");
                                for(var i = 0;i < display_size.length;i++){
                                    if(display_size[i] <= 3){
                                        $("#phone_display_size_3_below").removeAttr("disabled");
                                    }else if(display_size[i] > 3 && display_size[i] <= 3.5){
                                        $("#phone_display_size_3_to_3_5").removeAttr("disabled");
                                    }else if(display_size[i] > 3.5 && display_size[i] <= 4){
                                        $("#phone_display_size_3_5_to_4").removeAttr("disabled");
                                    }else if(display_size[i] > 4 && display_size[i] <= 4.5){
                                        $("#phone_display_size_4_to_4_5").removeAttr("disabled");
                                    }else if(display_size[i] > 4.5 && display_size[i] <= 5){
                                        $("#phone_display_size_4_5_to_5").removeAttr("disabled");
                                    }else if(display_size[i] > 5 && display_size[i] <= 5.5){
                                        $("#phone_display_size_5_to_5_5").removeAttr("disabled");
                                    }else if(display_size[i] > 5.5){
                                        $("#phone_display_size_5_5_above").removeAttr("disabled");
                                    }
                                }
                            }
                            if(handle != "os[]"){
                                $("#phone_os_android").attr("disabled","disabled");
                                $("#phone_os_ios").attr("disabled","disabled");
                                $("#phone_os_windows").attr("disabled","disabled");
                                for(var i = 0;i < display_size.length;i++){
                                    if(os[i] == "android"){
                                        $("#phone_os_android").removeAttr("disabled");
                                    }else if(os[i] == "ios"){
                                        $("#phone_os_ios").removeAttr("disabled");
                                    }else if(os[i] == "windows"){
                                        $("#phone_os_windows").removeAttr("disabled");
                                    }
                                }
                            }
                            if(handle != "clock_speed[]"){
                                $("#phone_clock_speed_1_to_1_5").attr("disabled","disabled");
                                $("#phone_clock_speed_1_5_to_2").attr("disabled","disabled");
                                $("#phone_clock_speed_2_to_2_5").attr("disabled","disabled");
                                $("#phone_clock_speed_2_5_above").attr("disabled","disabled");
                                for(var i = 0;i < clock_speed.length;i++){
                                    if(clock_speed <= 1.5){
                                        $("#phone_clock_speed_1_to_1_5").removeAttr("disabled");
                                    }else if(clock_speed[i] > 1.5 && clock_speed[i] <= 2){
                                        $("#phone_clock_speed_1_5_to_2").removeAttr("disabled");
                                    }else if(clock_speed[i] > 2 && clock_speed[i] <= 2.5){
                                        $("#phone_clock_speed_2_to_2_5").removeAttr("disabled");
                                    }else if(clock_speed[i] > 2.5){
                                        $("#phone_clock_speed_2_5_above").removeAttr("disabled");
                                    }
                                }
                            }
                            if(handle != "cores_count[]"){
                                $("#phone_core_count_1").attr("disabled","disabled");
                                $("#phone_core_count_2").attr("disabled","disabled");
                                $("#phone_core_count_4").attr("disabled","disabled");
                                $("#phone_core_count_6").attr("disabled","disabled");
                                $("#phone_core_count_8").attr("disabled","disabled");
                                for(var i = 0;i < core_count.length;i++){
                                    if(core_count[i] == 1){
                                        $("#phone_core_count_1").removeAttr("disabled");
                                    }else if(core_count[i] == 2){
                                        $("#phone_core_count_2").removeAttr("disabled");
                                    }else if(core_count[i] == 4){
                                        $("#phone_core_count_4").removeAttr("disabled");
                                    }else if(core_count[i] == 6){
                                        $("#phone_core_count_6").removeAttr("disabled");
                                    }else if(core_count[i] == 8){
                                        $("#phone_core_count_8").removeAttr("disabled");
                                    }
                                }
                            }
                            if(handle != "ram[]"){
                                $("#phone_ram_0_to_1").attr("disabled","disabled");
                                $("#phone_ram_1_to_2").attr("disabled","disabled");
                                $("#phone_ram_2_to_4").attr("disabled","disabled");
                                $("#phone_ram_4_above").attr("disabled","disabled");
                                for(var i = 0;i < ram.length;i++){
                                    if(ram[i] <= 1){
                                        $("#phone_ram_0_to_1").removeAttr("disabled");
                                    }else if(ram[i] >1 && ram[i] <= 2){
                                        $("#phone_ram_1_to_2").removeAttr("disabled");
                                    }else if(ram[i] >2 && ram[i] <= 4){
                                        $("#phone_ram_2_to_4").removeAttr("disabled");
                                    } else if(ram[i] >4){
                                        $("#phone_ram_4_above").removeAttr("disabled");
                                    }
                                }
                            }
                            if(handle != "internal_memory[]"){
                                $("#phone_internal_memory_1_to_4").attr("disabled","disabled");
                                $("#phone_internal_memory_4_to_8").attr("disabled","disabled");
                                $("#phone_internal_memory_8_to_16").attr("disabled","disabled");
                                $("#phone_internal_memory_16_to_32").attr("disabled","disabled");
                                $("#phone_internal_memory_32_to_64").attr("disabled","disabled");
                                $("#phone_internal_memory_64_to_128").attr("disabled","disabled");
                                $("#phone_internal_memory_128_above").attr("disabled","disabled");
                                for(var i = 0;i < internal_memory.length;i++){
                                    if(internal_memory[i] <= 4){
                                        $("#phone_internal_memory_1_to_4").removeAttr("disabled");
                                    }else if(internal_memory[i] > 4 && internal_memory[i] <= 8){
                                        $("#phone_internal_memory_4_to_8").removeAttr("disabled");
                                    }else if(internal_memory[i] > 8 && internal_memory[i] <= 16){
                                        $("#phone_internal_memory_8_to_16").removeAttr("disabled");
                                    }else if(internal_memory[i] > 16 && internal_memory[i] <= 32){
                                        $("#phone_internal_memory_16_to_32").removeAttr("disabled");
                                    }else if(internal_memory[i] > 32 && internal_memory[i] <= 64){
                                        $("#phone_internal_memory_32_to_64").removeAttr("disabled");
                                    }else if(internal_memory[i] > 64 && internal_memory[i] <= 128){
                                        $("#phone_internal_memory_64_to_128").removeAttr("disabled");
                                    }else if(internal_memory[i] > 128){
                                        $("#phone_internal_memory_128_above").removeAttr("disabled");
                                    }
                                }
                            }
                            if(handle != "external_memory[]"){
                                $("#phone_external_memory_1_to_4").attr("disabled","disabled");
                                $("#phone_external_memory_4_to_8").attr("disabled","disabled");
                                $("#phone_external_memory_8_to_16").attr("disabled","disabled");
                                $("#phone_external_memory_16_to_32").attr("disabled","disabled");
                                $("#phone_external_memory_32_to_64").attr("disabled","disabled");
                                $("#phone_external_memory_64_to_128").attr("disabled","disabled");
                                $("#phone_external_memory_128_above").attr("disabled","disabled");
                                for(var i = 0;i < external_memory.length;i++){
                                    if(external_memory[i] >= 1 && external_memory[i] <= 4){
                                        $("#phone_external_memory_1_to_4").removeAttr("disabled");
                                    }else if(external_memory[i] > 4 && external_memory[i] <= 8){
                                        $("#phone_external_memory_4_to_8").removeAttr("disabled");
                                    }else if(external_memory[i] > 8 && external_memory[i] <= 16){
                                        $("#phone_external_memory_8_to_16").removeAttr("disabled");
                                    }else if(external_memory[i] > 16 && external_memory[i] <= 32){
                                        $("#phone_external_memory_16_to_32").removeAttr("disabled");
                                    }else if(external_memory[i] > 32 && external_memory[i] <= 64){
                                        $("#phone_external_memory_32_to_64").removeAttr("disabled");
                                    }else if(external_memory[i] > 64 && external_memory[i] <= 128){
                                        $("#phone_external_memory_64_to_128").removeAttr("disabled");
                                    }else if(external_memory[i] > 128){
                                        $("#phone_external_memory_128_above").removeAttr("disabled");
                                    }
                                }
                            }
                            if(handle != "primary_camera[]"){
                                $("#phone_primary_camera_2_below").attr("disabled","disabled");
                                $("#phone_primary_camera_2_to_2_9").attr("disabled","disabled");
                                $("#phone_primary_camera_3_to_4_9").attr("disabled","disabled");
                                $("#phone_primary_camera_5_to_7_9").attr("disabled","disabled");
                                $("#phone_primary_camera_8_above").attr("disabled","disabled");
                                for(var i = 0;i < primary_camera.length;i++){
                                    if(primary_camera[i] <= 2){
                                        $("#phone_primary_camera_2_below").removeAttr("disabled");
                                    }else if(primary_camera[i] > 2 && primary_camera[i] <= 2.9){
                                        $("#phone_primary_camera_2_to_2_9").removeAttr("disabled");
                                    }else if(primary_camera[i] > 3 && primary_camera[i] <= 4.9){
                                        $("#phone_primary_camera_3_to_4_9").removeAttr("disabled");
                                    }else if(primary_camera[i] > 5 && primary_camera[i] <= 7.9){
                                        $("#phone_primary_camera_5_to_7_9").removeAttr("disabled");
                                    }else if(primary_camera[i] > 8){
                                        $("#phone_primary_camera_8_above").removeAttr("disabled");
                                    }
                                }
                            }
                            if(handle != "secondary_camera[]"){
                                $("#phone_secondary_camera_2_below").attr("disabled","disabled");
                                $("#phone_secondary_camera_2_to_2_9").attr("disabled","disabled");
                                $("#phone_secondary_camera_3_to_4_9").attr("disabled","disabled");
                                $("#phone_secondary_camera_5_to_7_9").attr("disabled","disabled");
                                $("#phone_secondary_camera_8_above").attr("disabled","disabled");
                                for(var i = 0;i < secondary_camera.length;i++){
                                    if(secondary_camera[i] <= 2){
                                        $("#phone_secondary_camera_2_below").removeAttr("disabled");
                                    }else if(secondary_camera[i] > 2 && secondary_camera[i] <= 2.9){
                                        $("#phone_secondary_camera_2_to_2_9").removeAttr("disabled");
                                    }else if(secondary_camera[i] > 3 && secondary_camera[i] <= 4.9){
                                        $("#phone_secondary_camera_3_to_4_9").removeAttr("disabled");
                                    }else if(secondary_camera[i] > 5 && secondary_camera[i] <= 7.9){
                                        $("#phone_secondary_camera_5_to_7_9").removeAttr("disabled");
                                    }else if(secondary_camera[i] > 8){
                                        $("#phone_secondary_camera_8_above").removeAttr("disabled");
                                    }
                                }
                            }
                            if(handle != "battery_size"){
                                $("#phone_battery_size_1000_below").attr("disabled","disabled");
                                $("#phone_battery_size_1000_to_1999").attr("disabled","disabled");
                                $("#phone_battery_size_2000_to_2999").attr("disabled","disabled");
                                $("#phone_battery_size_3000_to_3999").attr("disabled","disabled");
                                $("#phone_battery_size_4000_above").attr("disabled","disabled");
                                for(var i = 0;i < battery_size.length;i++){
                                    if(battery_size[i] <= 1000){
                                        $("#phone_battery_size_1000_below").removeAttr("disabled");
                                    }else if(battery_size[i] > 1000 && battery_size[i] <= 1999){
                                        $("#phone_battery_size_1000_to_1999").removeAttr("disabled");
                                    }else if(battery_size[i] >= 2000 && battery_size[i] <= 2999){
                                        $("#phone_battery_size_2000_to_2999").removeAttr("disabled");
                                    }else if(battery_size[i] >= 3000 && battery_size[i] <= 3999){
                                        $("#phone_battery_size_3000_to_3999").removeAttr("disabled");
                                    }else if(battery_size[i] >= 4000){
                                        $("#phone_battery_size_4000_above").removeAttr("disabled");
                                    }
                                }
                            }
                        }
                        else if(context == "Tablets"){

                            $xml.find("row").each(function(idx, v) {
                                var imgVal = $(v).find("tablet_image_filename").text();
                                var titleVal = $(v).find("tablet_model").text();
                                var priceVal = $(v).find("tablet_price").text();
                                var linkVal = $(v).find("file_name").text();
                                var $img = $("<img class=\"product-image\" src=\"images/"+imgVal+"\" alt=\""+titleVal+"\" />");
                                var $aImg = $("<a href=\"http://www.kathmanduelectronics.com/tablets/"+linkVal+".php\"></a>");
                                $aImg.append($img);
                                var $product_sec1 = $("<div class=\"product-sec1\"></div>");
                                $product_sec1.append($aImg);

                                var $aTitle = $("<a class=\"product-title\" href=\"http://www.kathmanduelectronics.com/tablets/"+linkVal+".php\"></a>");
                                $aTitle.text(titleVal);
                                var $pTitle = $("<p class=\"product-title\"></p>");
                                $pTitle.append($aTitle);

                                if(priceVal != ""){
                                    var $pPrice = $("<p class=\"product-price\"></p>");
                                    $pPrice.text("Starting at NRs. "+priceVal);
                                }

                                var $product_sec2 = $("<div class=\"product-sec2\"></div>");
                                $product_sec2.append($pTitle);
                                if(priceVal != ""){
                                    $product_sec2.append($pPrice);
                                }
                                var $product = $("<div class=\"product\"></div>");
                                $product.append($product_sec1);
                                $product.append($product_sec2);
                                $(".filter-result-section").append($product);
                                if($(window).width <= 480){
                                    $product.css("width","100%");
                                }else if($(window).width >= 1024){
                                    $product.css("width","30%");
                                }
                            });
                            var brand = [];
                            $xml.find("row").each(function(idx, v) {
                                brand[idx] = [];
                                $(v).find("tablet_brand").each(function( i , vi) {
                                    brand[idx].push( $(vi).text() );
                                });
                            });

                            var model = [];
                            $xml.find("row").each(function(idx, v) {
                                model[idx] = [];
                                $(v).find("tablet_model").each(function( i , vi) {
                                    model[idx].push( $(vi).text() );
                                });
                            });

                            var price = [];
                            $xml.find("row").each(function(idx, v) {
                                price[idx] = [];
                                $(v).find("tablet_price").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        price[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var sim_count = [];
                            $xml.find("row").each(function(idx, v) {
                                sim_count[idx] = [];
                                $(v).find("tablet_sim_count").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        sim_count[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var display_size = [];
                            $xml.find("row").each(function(idx, v) {
                                display_size[idx] = [];
                                $(v).find("tablet_display_size").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        display_size[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var display_resolution_high = [];
                            $xml.find("row").each(function(idx, v) {
                                display_resolution_high[idx] = [];
                                $(v).find("tablet_display_resolution_high").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        display_resolution_high[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var display_resolution_low = [];
                            $xml.find("row").each(function(idx, v) {
                                display_resolution_low[idx] = [];
                                $(v).find("tablet_display_resolution_low").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        display_resolution_low[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var os = [];
                            $xml.find("row").each(function(idx, v) {
                                os[idx] = [];
                                $(v).find("tablet_os").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        os[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var clock_speed = [];
                            $xml.find("row").each(function(idx, v) {
                                clock_speed[idx] = [];
                                $(v).find("tablet_cpu_clock_freq").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        clock_speed[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var core_count = [];
                            $xml.find("row").each(function(idx, v) {
                                core_count[idx] = [];
                                $(v).find("tablet_cpu_core_count").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        core_count[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var ram = [];
                            $xml.find("row").each(function(idx, v) {
                                ram[idx] = [];
                                $(v).find("tablet_ram").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        ram[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var internal_memory = [];
                            $xml.find("row").each(function(idx, v) {
                                internal_memory[idx] = [];
                                $(v).find("tablet_internal_memory_size").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        internal_memory[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var external_memory = [];
                            $xml.find("row").each(function(idx, v) {
                                external_memory[idx] = [];
                                $(v).find("tablet_external_memory_size").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        external_memory[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var primary_camera = [];
                            $xml.find("row").each(function(idx, v) {
                                primary_camera[idx] = [];
                                $(v).find("tablet_primary_camera_pixel_size").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        primary_camera[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var secondary_camera = [];
                            $xml.find("row").each(function(idx, v) {
                                secondary_camera[idx] = [];
                                $(v).find("tablet_secondary_camera_pixel_size").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        secondary_camera[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            var battery_size = [];
                            $xml.find("row").each(function(idx, v) {
                                battery_size[idx] = [];
                                $(v).find("tablet_battery_size").each(function( i , vi) {
                                    if($(vi).text() != ""){
                                        battery_size[idx].push( $(vi).text() );
                                    }
                                });
                            });

                            if(handle != "brand[]"){
                                $("#tablet_brand_Apple").attr("disabled","disabled");
                                $("#tablet_brand_Asus").attr("disabled","disabled");
                                for(var i = 0;i < brand.length;i++){
                                    if(brand[i] == "Apple"){
                                        $("#tablet_brand_Apple").removeAttr("disabled");
                                    }else if(brand[i] == "Asus"){
                                        $("#tablet_brand_Asus").removeAttr("disabled");
                                    }else{
// do nothing
                                    }
                                }
                            }
                            if(handle != "price[]"){
                                $("#tablet_price_0_10000").attr("disabled","disabled");
                                $("#tablet_price_10000_20000").attr("disabled","disabled");
                                $("#tablet_price_20000_30000").attr("disabled","disabled");
                                $("#tablet_price_30000_50000").attr("disabled","disabled");
                                $("#tablet_price_50000_above").attr("disabled","disabled");
                                for(var i = 0;i < price.length;i++){
                                    if(price[i] >0 && price[i] <= 10000){
                                        $("#tablet_price_0_10000").removeAttr("disabled");
                                    }else if(price[i] >10000 && price[i] <= 20000){
                                        $("#tablet_price_10000_20000").removeAttr("disabled");
                                    }else if(price[i] >20000 && price[i] <= 30000){
                                        $("#tablet_price_20000_30000").removeAttr("disabled");
                                    }else if(price[i] >30000 && price[i] <= 50000){
                                        $("#tablet_price_30000_50000").removeAttr("disabled");
                                    }else if(price[i] >50000){
                                        $("#tablet_price_50000_above").removeAttr("disabled");
                                    }else{
// do nothing
                                    }
                                }
                            }
                            if(handle != "sim_count[]"){
                                $("#tablet_sim_count_1").attr("disabled","disabled");
                                $("#tablet_sim_count_2").attr("disabled","disabled");
                                $("#tablet_sim_count_3").attr("disabled","disabled");
                                $("#tablet_sim_count_4").attr("disabled","disabled");
                                for(var i = 0;i < sim_count.length;i++){
                                    if(sim_count[i] == 1){
                                        $("#tablet_sim_count_1").removeAttr("disabled");
                                    }else if(sim_count[i] == 2){
                                        $("#tablet_sim_count_2").removeAttr("disabled");
                                    }else if(sim_count[i] == 3){
                                        $("#tablet_sim_count_3").removeAttr("disabled");
                                    }else if(sim_count[i] == 4){
                                        $("#tablet_sim_count_4").removeAttr("disabled");
                                    }else{
// do nothing
                                    }
                                }
                            }
                            if(handle != "display_size[]"){
                                $("#tablet_display_size_7_below").attr("disabled","disabled");
                                $("#tablet_display_size_7_to_8").attr("disabled","disabled");
                                $("#tablet_display_size_8_to_9").attr("disabled","disabled");
                                $("#tablet_display_size_9_to_10").attr("disabled","disabled");
                                $("#tablet_display_size_10_above").attr("disabled","disabled");
                                for(var i = 0;i < display_size.length;i++){
                                    if(display_size[i] <= 7){
                                        $("#tablet_display_size_7_below").removeAttr("disabled");
                                    }else if(display_size[i] > 7 && display_size[i] <= 8){
                                        $("#tablet_display_size_7_to_8").removeAttr("disabled");
                                    }else if(display_size[i] > 8 && display_size[i] <= 9){
                                        $("#tablet_display_size_8_to_9").removeAttr("disabled");
                                    }else if(display_size[i] > 9 && display_size[i] <= 10){
                                        $("#tablet_display_size_9_to_10").removeAttr("disabled");
                                    }else if(display_size[i] > 10){
                                        $("#tablet_display_size_10_above").removeAttr("disabled");
                                    }
                                }
                            }
                            if(handle != "os[]"){
                                $("#tablet_os_android").attr("disabled","disabled");
                                $("#tablet_os_ios").attr("disabled","disabled");
                                $("#tablet_os_windows").attr("disabled","disabled");
                                for(var i = 0;i < display_size.length;i++){
                                    if(os[i] == "android"){
                                        $("#tablet_os_android").removeAttr("disabled");
                                    }else if(os[i] == "ios"){
                                        $("#tablet_os_ios").removeAttr("disabled");
                                    }else if(os[i] == "windows"){
                                        $("#tablet_os_windows").removeAttr("disabled");
                                    }else{
// do nothing
                                    }
                                }
                            }
                            if(handle != "clock_speed[]"){
                                $("#tablet_clock_speed_1_to_1_5").attr("disabled","disabled");
                                $("#tablet_clock_speed_1_5_to_2").attr("disabled","disabled");
                                $("#tablet_clock_speed_2_to_2_5").attr("disabled","disabled");
                                $("#tablet_clock_speed_2_5_above").attr("disabled","disabled");
                                for(var i = 0;i < clock_speed.length;i++){
                                    if(clock_speed <= 1.5){
                                        $("#tablet_clock_speed_1_to_1_5").removeAttr("disabled");
                                    }else if(clock_speed[i] > 1.5 && clock_speed[i] <= 2){
                                        $("#tablet_clock_speed_1_5_to_2").removeAttr("disabled");
                                    }else if(clock_speed[i] > 2 && clock_speed[i] <= 2.5){
                                        $("#tablet_clock_speed_2_to_2_5").removeAttr("disabled");
                                    }else if(clock_speed[i] > 2.5){
                                        $("#tablet_clock_speed_2_5_above").removeAttr("disabled");
                                    }
                                }
                            }
                            if(handle != "cores_count[]"){
                                $("#tablet_core_count_1").attr("disabled","disabled");
                                $("#tablet_core_count_2").attr("disabled","disabled");
                                $("#tablet_core_count_4").attr("disabled","disabled");
                                $("#tablet_core_count_6").attr("disabled","disabled");
                                $("#tablet_core_count_8").attr("disabled","disabled");
                                for(var i = 0;i < core_count.length;i++){
                                    if(core_count[i] == 1){
                                        $("#tablet_core_count_1").removeAttr("disabled");
                                    }else if(core_count[i] == 2){
                                        $("#tablet_core_count_2").removeAttr("disabled");
                                    }else if(core_count[i] == 4){
                                        $("#tablet_core_count_4").removeAttr("disabled");
                                    }else if(core_count[i] == 6){
                                        $("#tablet_core_count_6").removeAttr("disabled");
                                    }else if(core_count[i] == 8){
                                        $("#tablet_core_count_8").removeAttr("disabled");
                                    }else{
// do nothing
                                    }
                                }
                            }
                            if(handle != "ram[]"){
                                $("#tablet_ram_0_to_1").attr("disabled","disabled");
                                $("#tablet_ram_1_to_2").attr("disabled","disabled");
                                $("#tablet_ram_2_to_4").attr("disabled","disabled");
                                $("#tablet_ram_4_above").attr("disabled","disabled");
                                for(var i = 0;i < ram.length;i++){
                                    if(ram[i] <= 1){
                                        $("#tablet_ram_0_to_1").removeAttr("disabled");
                                    }else if(ram[i] >1 && ram[i] <= 2){
                                        $("#tablet_ram_1_to_2").removeAttr("disabled");
                                    }else if(ram[i] >2 && ram[i] <= 4){
                                        $("#tablet_ram_2_to_4").removeAttr("disabled");
                                    } else if(ram[i] >4){
                                        $("#tablet_ram_4_above").removeAttr("disabled");
                                    }
                                }
                            }
                            if(handle != "internal_memory[]"){
                                $("#tablet_internal_memory_1_to_4").attr("disabled","disabled");
                                $("#tablet_internal_memory_4_to_8").attr("disabled","disabled");
                                $("#tablet_internal_memory_8_to_16").attr("disabled","disabled");
                                $("#tablet_internal_memory_16_to_32").attr("disabled","disabled");
                                $("#tablet_internal_memory_32_to_64").attr("disabled","disabled");
                                $("#tablet_internal_memory_64_to_128").attr("disabled","disabled");
                                $("#tablet_internal_memory_128_above").attr("disabled","disabled");
                                for(var i = 0;i < internal_memory.length;i++){
                                    if(internal_memory[i] <= 4){
                                        $("#tablet_internal_memory_1_to_4").removeAttr("disabled");
                                    }else if(internal_memory[i] > 4 && internal_memory[i] <= 8){
                                        $("#tablet_internal_memory_4_to_8").removeAttr("disabled");
                                    }else if(internal_memory[i] > 8 && internal_memory[i] <= 16){
                                        $("#tablet_internal_memory_8_to_16").removeAttr("disabled");
                                    }else if(internal_memory[i] > 16 && internal_memory[i] <= 32){
                                        $("#tablet_internal_memory_16_to_32").removeAttr("disabled");
                                    }else if(internal_memory[i] > 32 && internal_memory[i] <= 64){
                                        $("#tablet_internal_memory_32_to_64").removeAttr("disabled");
                                    }else if(internal_memory[i] > 64 && internal_memory[i] <= 128){
                                        $("#tablet_internal_memory_64_to_128").removeAttr("disabled");
                                    }else if(internal_memory[i] > 128){
                                        $("#tablet_internal_memory_128_above").removeAttr("disabled");
                                    }else{
// do nothing
                                    }
                                }
                            }
                            if(handle != "external_memory[]"){
                                $("#tablet_external_memory_1_to_4").attr("disabled","disabled");
                                $("#tablet_external_memory_4_to_8").attr("disabled","disabled");
                                $("#tablet_external_memory_8_to_16").attr("disabled","disabled");
                                $("#tablet_external_memory_16_to_32").attr("disabled","disabled");
                                $("#tablet_external_memory_32_to_64").attr("disabled","disabled");
                                $("#tablet_external_memory_64_to_128").attr("disabled","disabled");
                                $("#tablet_external_memory_128_above").attr("disabled","disabled");
                                for(var i = 0;i < external_memory.length;i++){
                                    if(external_memory[i] >= 1 && external_memory[i] <= 4){
                                        $("#tablet_external_memory_1_to_4").removeAttr("disabled");
                                    }else if(external_memory[i] > 4 && external_memory[i] <= 8){
                                        $("#tablet_external_memory_4_to_8").removeAttr("disabled");
                                    }else if(external_memory[i] > 8 && external_memory[i] <= 16){
                                        $("#tablet_external_memory_8_to_16").removeAttr("disabled");
                                    }else if(external_memory[i] > 16 && external_memory[i] <= 32){
                                        $("#tablet_external_memory_16_to_32").removeAttr("disabled");
                                    }else if(external_memory[i] > 32 && external_memory[i] <= 64){
                                        $("#tablet_external_memory_32_to_64").removeAttr("disabled");
                                    }else if(external_memory[i] > 64 && external_memory[i] <= 128){
                                        $("#tablet_external_memory_64_to_128").removeAttr("disabled");
                                    }else if(external_memory[i] > 128){
                                        $("#tablet_external_memory_128_above").removeAttr("disabled");
                                    }else{
// do nothing
                                    }
                                }
                            }
                            if(handle != "primary_camera[]"){
                                $("#tablet_primary_camera_2_below").attr("disabled","disabled");
                                $("#tablet_primary_camera_2_to_2_9").attr("disabled","disabled");
                                $("#tablet_primary_camera_3_to_4_9").attr("disabled","disabled");
                                $("#tablet_primary_camera_5_to_7_9").attr("disabled","disabled");
                                $("#tablet_primary_camera_8_above").attr("disabled","disabled");
                                for(var i = 0;i < primary_camera.length;i++){
                                    if(primary_camera[i] <= 2){
                                        $("#tablet_primary_camera_2_below").removeAttr("disabled");
                                    }else if(primary_camera[i] > 2 && primary_camera[i] <= 2.9){
                                        $("#tablet_primary_camera_2_to_2_9").removeAttr("disabled");
                                    }else if(primary_camera[i] > 3 && primary_camera[i] <= 4.9){
                                        $("#tablet_primary_camera_3_to_4_9").removeAttr("disabled");
                                    }else if(primary_camera[i] > 5 && primary_camera[i] <= 7.9){
                                        $("#tablet_primary_camera_5_to_7_9").removeAttr("disabled");
                                    }else if(primary_camera[i] > 8){
                                        $("#tablet_primary_camera_8_above").removeAttr("disabled");
                                    }
                                }
                            }
                            if(handle != "secondary_camera[]"){
                                $("#tablet_secondary_camera_2_below").attr("disabled","disabled");
                                $("#tablet_secondary_camera_2_to_2_9").attr("disabled","disabled");
                                $("#tablet_secondary_camera_3_to_4_9").attr("disabled","disabled");
                                $("#tablet_secondary_camera_5_to_7_9").attr("disabled","disabled");
                                $("#tablet_secondary_camera_8_above").attr("disabled","disabled");
                                for(var i = 0;i < secondary_camera.length;i++){
                                    if(secondary_camera[i] <= 2){
                                        $("#tablet_secondary_camera_2_below").removeAttr("disabled");
                                    }else if(secondary_camera[i] > 2 && secondary_camera[i] <= 2.9){
                                        $("#tablet_secondary_camera_2_to_2_9").removeAttr("disabled");
                                    }else if(secondary_camera[i] > 3 && secondary_camera[i] <= 4.9){
                                        $("#tablet_secondary_camera_3_to_4_9").removeAttr("disabled");
                                    }else if(secondary_camera[i] > 5 && secondary_camera[i] <= 7.9){
                                        $("#tablet_secondary_camera_5_to_7_9").removeAttr("disabled");
                                    }else if(secondary_camera[i] > 8){
                                        $("#tablet_secondary_camera_8_above").removeAttr("disabled");
                                    }else{
// do nothing
                                    }
                                }
                            }
                            if(handle != "battery_size"){
                                $("#tablet_battery_size_4000_below").attr("disabled","disabled");
                                $("#tablet_battery_size_4000_to_6000").attr("disabled","disabled");
                                $("#tablet_battery_size_6000_to_8000").attr("disabled","disabled");
                                $("#tablet_battery_size_8000_above").attr("disabled","disabled");
                                for(var i = 0;i < battery_size.length;i++){
                                    if(battery_size[i] <= 4000){
                                        $("#tablet_battery_size_4000_below").removeAttr("disabled");
                                    }else if(battery_size[i] > 4000 && battery_size[i] <= 6000){
                                        $("#tablet_battery_size_4000_to_6000").removeAttr("disabled");
                                    }else if(battery_size[i] >= 6000 && battery_size[i] <= 8000){
                                        $("#tablet_battery_size_6000_to_8000").removeAttr("disabled");
                                    }else if(battery_size[i] >= 8000){
                                        $("#tablet_battery_size_8000_above").removeAttr("disabled");
                                    }
                                }
                            }

                        }
                        else if(context == "Laptops"){
                            $xml.find("row").each(function(idx, v) {
                                var imgVal = $(v).find("laptop_image_filename").text();
                                var titleVal = $(v).find("laptop_model").text();
                                var priceVal = $(v).find("laptop_price").text();
                                var linkVal = $(v).find("file_name").text();
                                var $img = $("<img class=\"product-image\" src=\"images/"+imgVal+"\" alt=\""+titleVal+"\" />");
                                var $aImg = $("<a href=\"http://www.kathmanduelectronics.com/laptops/"+linkVal+".php\"></a>");
                                $aImg.append($img);
                                var $product_sec1 = $("<div class=\"product-sec1\"></div>");
                                $product_sec1.append($aImg);

                                var $aTitle = $("<a class=\"product-title\" href=\"http://www.kathmanduelectronics.com/laptops/"+linkVal+".php\"></a>");
                                $aTitle.text(titleVal);
                                var $pTitle = $("<p class=\"product-title\"></p>");
                                $pTitle.append($aTitle);

                                if(priceVal != ""){
                                    var $pPrice = $("<p class=\"product-price\"></p>");
                                    $pPrice.text("Starting at NRs. "+priceVal);
                                }

                                var $product_sec2 = $("<div class=\"product-sec2\"></div>");
                                $product_sec2.append($pTitle);
                                if(priceVal != ""){
                                    $product_sec2.append($pPrice);
                                }
                                var $product = $("<div class=\"product\"></div>");
                                $product.append($product_sec1);
                                $product.append($product_sec2);
                                $(".filter-result-section").append($product);
                                if($(window).width <= 480){
                                    $product.css("width","100%");
                                }else if($(window).width >= 1024){
                                    $product.css("width","30%");
                                }
                            });

                            var brand = [];
                            $xml.find("row").each(function(idx, v) {
                                brand[idx] = [];
                                $(v).find("laptop_brand").each(function( i , vi) {
                                    brand[idx].push( $(vi).text() );
                                });
                            });

                            var type = [];
                            $xml.find("row").each(function(idx, v) {
                                type[idx] = [];
                                $(v).find("laptop_type").each(function( i , vi) {
                                    type[idx].push( $(vi).text() );
                                });
                            });

                            var price = [];
                            $xml.find("row").each(function(idx, v) {
                                price[idx] = [];
                                $(v).find("laptop_price").each(function( i , vi) {
                                    price[idx].push( $(vi).text() );
                                });
                            });

                            var processor_type = [];
                            $xml.find("row").each(function(idx, v) {
                                processor_type[idx] = [];
                                $(v).find("laptop_processor_type").each(function( i , vi) {
                                    processor_type[idx].push( $(vi).text() );
                                });
                            });

                            var display_size = [];
                            $xml.find("row").each(function(idx, v) {
                                display_size[idx] = [];
                                $(v).find("laptop_display_size").each(function( i , vi) {
                                    display_size[idx].push( $(vi).text() );
                                });
                            });

                            os = [];
                            $xml.find("row").each(function(idx, v) {
                                os[idx] = [];
                                $(v).find("laptop_os").each(function( i , vi) {
                                    os[idx].push( $(vi).text() );
                                });
                            });

                            var ram = [];
                            $xml.find("row").each(function(idx, v) {
                                ram[idx] = [];
                                $(v).find("laptop_ram_size").each(function( i , vi) {
                                    ram[idx].push( $(vi).text() );
                                });
                            });

                            var storage = [];
                            $xml.find("row").each(function(idx, v) {
                                storage[idx] = [];
                                $(v).find("laptop_storage_size").each(function( i , vi) {
                                    storage[idx].push( $(vi).text() );
                                });
                            });

                            if(handle != "brand[]"){
                                $("#laptop_brand_Apple").attr("disabled","disabled");
                                $("#laptop_brand_Dell").attr("disabled","disabled");
                                for(var i = 0;i < brand.length;i++){
                                    if(brand[i] == "Apple"){
                                        $("#laptop_brand_Apple").removeAttr("disabled");
                                    }else if(brand[i] == "Dell"){
                                        $("#laptop_brand_Dell").removeAttr("disabled");
                                    }
                                }
                            }

                            if(handle != "type[]"){
                                $("#laptop_type_Ultrabook").attr("disabled","disabled");
                                $("#laptop_type_Gaming").attr("disabled","disabled");
                                $("#laptop_type_Notebook").attr("disabled","disabled");
                                for(var i = 0;i < type.length;i++){
                                    if(type[i] == "Ultrabook"){
                                        $("#laptop_type_Ultrabook").removeAttr("disabled");
                                    }else if(type[i] == "Gaming"){
                                        $("#laptop_type_Gaming").removeAttr("disabled");
                                    }else if(type[i] == "Notebook"){
                                        $("#laptop_type_Notebook").removeAttr("disabled");
                                    }else{
// do nothing
                                    }
                                }
                            }
                            if(handle != "price[]"){
                                $("#laptop_price_0_30000").attr("disabled","disabled");
                                $("#laptop_price_30000_50000").attr("disabled","disabled");
                                $("#laptop_price_50000_100000").attr("disabled","disabled");
                                $("#laptop_price_100000_150000").attr("disabled","disabled");
                                $("#laptop_price_150000_above").attr("disabled","disabled");
                                for(var i = 0;i < price.length;i++){
                                    if(price[i] > 0 && price[i] <= 30000){
                                        $("#laptop_price_0_30000").removeAttr("disabled");
                                    }else if(price[i] > 30000 && price[i] <= 50000){
                                        $("#laptop_price_30000_50000").removeAttr("disabled");
                                    }else if(price[i] > 50000 && price[i] <= 100000){
                                        $("#laptop_price_50000_100000").removeAttr("disabled");
                                    }else if(price[i] > 100000 && price[i] <= 150000){
                                        $("#laptop_price_100000_150000").removeAttr("disabled");
                                    }else if(price[i] > 150000){
                                        $("#laptop_price_150000_above").removeAttr("disabled");
                                    }else{
// do nothing
                                    }
                                }
                            }
                            if(handle != "processor_type[]") {
                                $("laptop_processor_type_i3").attr("disabled","disabled");
                                $("laptop_processor_type_i5").attr("disabled","disabled");
                                $("laptop_processor_type_i7").attr("disabled","disabled");
                                for(var i = 0;i < processor_type.length;i++){
                                    if(processor_type[i] == "i3"){
                                        $("laptop_processor_type_i3").removeAttr("disabled");
                                    }else if(processor_type[i] == "i5"){
                                        $("laptop_processor_type_i5").removeAttr("disabled");
                                    }else if(processor_type[i] == "i7"){
                                        $("laptop_processor_type_i7").removeAttr("disabled");
                                    }else{
                                        // do nothing
                                    }
                                }
                            }
                            if(handle != "display_size[]"){
                                $("#laptop_display_size_12_below").attr("disabled","disabled");
                                $("#laptop_display_size_12_to_12_9").attr("disabled","disabled");
                                $("#laptop_display_size_13_to_13_9").attr("disabled","disabled");
                                $("#laptop_display_size_14_to_14_9").attr("disabled","disabled");
                                $("#laptop_display_size_15_to_15_9").attr("disabled","disabled");
                                $("#laptop_display_size_16_to_16_9").attr("disabled","disabled");
                                $("#laptop_display_size_17_to_17_9").attr("disabled","disabled");
                                $("#laptop_display_size_18_above").attr("disabled","disabled");
                                for(var i = 0;i < display_size.length;i++){
                                    if(display_size[i] >0 && display_size[i] <= 12){
                                        $("#laptop_display_size_12_below").removeAttr("disabled");
                                    }else if(display_size[i] > 12 && display_size[i] <= 12.9){
                                        $("#laptop_display_size_12_to_12_9").removeAttr("disabled");
                                    }else if(display_size[i] > 13 && display_size[i] <= 13.9){
                                        $("#laptop_display_size_13_to_13_9").removeAttr("disabled");
                                    }else if(display_size[i] > 14 && display_size[i] <= 14.9){
                                        $("#laptop_display_size_14_to_14_9").removeAttr("disabled");
                                    }else if(display_size[i] > 15 && display_size[i] <= 15.9){
                                        $("#laptop_display_size_15_to_15_9").removeAttr("disabled");
                                    }else if(display_size[i] > 16 && display_size[i] <= 16.9){
                                        $("#laptop_display_size_16_to_16_9").removeAttr("disabled");
                                    }else if(display_size[i] > 17 && display_size[i] <= 17.9){
                                        $("#laptop_display_size_17_to_17_9").removeAttr("disabled");
                                    }else if(display_size[i] > 18){
                                        $("#laptop_display_size_18_above").removeAttr("disabled");
                                    }else{
// do nothing
                                    }
                                }
                            }

                            if(handle != "ram[]"){
                                $("#laptop_ram_0_to_2").attr("disabled","disabled");
                                $("#laptop_ram_2_to_4").attr("disabled","disabled");
                                $("#laptop_ram_4_to_8").attr("disabled","disabled");
                                $("#laptop_ram_8_to_16").attr("disabled","disabled");
                                $("#laptop_ram_16_above").attr("disabled","disabled");
                                for(var i = 0;i < ram.length;i++){
                                    if(ram[i] > 0 && ram[i] <= 2){
                                        $("#laptop_ram_0_to_2").removeAttr("disabled");
                                    }else if(ram[i] > 2 && ram[i] <= 4){
                                        $("#laptop_ram_2_to_4").removeAttr("disabled");
                                    }else if(ram[i] > 4 && ram[i] <= 8){
                                        $("#laptop_ram_4_to_8").removeAttr("disabled");
                                    }else if(ram[i] > 8 && ram[i] <= 16){
                                        $("#laptop_ram_8_to_16").removeAttr("disabled");
                                    } else if(ram[i] > 16){
                                        $("#laptop_ram_16_above").removeAttr("disabled");
                                    }else{
// do nothing
                                    }
                                }
                            }

                            if(handle != "os[]"){
                                $("#laptop_os_mac").attr("disabled","disabled");
                                $("#laptop_os_windows").attr("disabled","disabled");
                                $("#laptop_os_linux").attr("disabled","disabled");
                                for(var i = 0;i < os.length;i++){
                                    if(os[i] == "mac"){
                                        $("#laptop_os_mac").removeAttr("disabled");
                                    }else if(os[i] == "windows"){
                                        $("#laptop_os_windows").removeAttr("disabled");
                                    }else if(os[i] == "linux"){
                                        $("#laptop_os_linux").removeAttr("disabled");
                                    }else{
                                        // do nothing
                                    }
                                }
                            }

                            if(handle != "storage[]"){
                                $("#laptop_storage_0_to_256").attr("disabled","disabled");
                                $("#laptop_storage_256_to_512").attr("disabled","disabled");
                                $("#laptop_storage_512_to_1024").attr("disabled","disabled");
                                $("#laptop_storage_1024_and_above").attr("disabled","disabled");
                                for(var i = 0;i < storage.length;i++){
                                    if(storage[i] > 0 && storage[i] <= 256){
                                        $("#laptop_storage_0_to_256").removeAttr("disabled");
                                    }else if(storage[i] > 256 && storage[i] <= 512){
                                        $("#laptop_storage_256_to_512").removeAttr("disabled");
                                    }else if(storage[i] > 512 && storage[i] <= 1024){
                                        $("#laptop_storage_512_to_1024").removeAttr("disabled");
                                    }else if(storage[i] > 1024){
                                        $("#laptop_storage_1024_and_above").removeAttr("disabled");
                                    }else{
                                        // do nothing
                                    }
                                }
                            }
                        }else{
                            // do nothing
                        }

                        $( "label:has(input[type=checkbox])" ).css("color","rgb(0,0,0)");
                        $( "label:has(input[disabled])" ).css("color","rgb(200,200,200)");
                    }
                };
                xhr.open("POST", "process-filter.php", true);
                xhr.send(data);
            }else{
                cb.removeAttr("disabled");
                $( "label:has(input[type=checkbox])" ).css("color","rgb(0,0,0)");
            }
        });
    })();
</script>