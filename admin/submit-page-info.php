<?php ob_start();
session_start();
include_once("../functions.php");
if(!check_login()){
    header("Location: http://www.kathmanduelectronics.com/admin");
    ob_end_flush();
    exit();
}
$_SESSION["selected_page"] = "";
?>
<?php include_once ("meta-admin.php"); ?>
<body>
<div class="container">
    <?php include_once ("header-admin.php"); ?>
    <main>
        <div class="container">
            <?php if (isset($_GET["action"]) && $_GET["action"] == "edit"): ?>

                <form action="submit-page-info.php?page=<?php echo $_SESSION["page_title"]; ?>&&action=edit" method="POST" enctype="multipart/form-data">
                    <?php if(isset($_POST["submit"])){submit_page_info("update");} ?>
                    <h1>Edit page details for <?php echo $_SESSION["page_name"]; ?></h1>
                    <p><input type="submit" name="submit" value="submit"/></p>
                    <div class="form-section">
                        <h2>General Information</h2>
                        <p>
                            <label class="flt_left" for="title">Title</label>
                            <input type="text" name="page_title" value="<?php echo $_SESSION["page_title"]; ?>"/>
                        </p>

                        <p>
                            <label class="flt_left" for="page-description">Description</label>
                            <textarea id="page_description" name="page_description" value=""><?php echo $_SESSION["page_description"]; ?></textarea>
                        </p>

                        <p>
                        <p>
                            <label class="flt_left">Keywords</label>
                            <span class="input_fields_page_keywords_wrap">
                <input type="text" name="page_keywords" value="<?php echo $_SESSION["page_keywords"]; ?>">
            </span>
                        </p>

                        <p>
                            <label class="flt_left" for="page-canonical">Canonical</label>
                            <input type="text" id="page-canonical" name="page_canonical" value="<?php echo $_SESSION["page_canonical"]; ?>"/>
                        </p>
                    </div>
                    <div class="form-section">
                        <h2>Facebook Information</h2>
                        <p>
                            <label class="flt_left" for="page-fb-title">Title</label>
                            <input type="text" id="page-fb-title" name="fb_meta_title" value="<?php echo $_SESSION["fb_meta_title"]; ?>"/>
                        </p>

                        <p>
                            <label class="flt_left" for="fb_type">Type</label>
                            <select id="fb_type" name="fb_meta_type" value="<?php echo $_SESSION["fb_meta_type"]; ?>">
                                <option>Article</option>
                                <option>Product</option>
                            </select>
                        </p>

                        <p>
                            <label class="flt_left" for="fb-url">URL</label>
                            <input type="text" id="fb-url" name="fb_meta_url" value="<?php echo $_SESSION["fb_meta_url"]; ?>"/>
                        </p>

                        <p>
                            <label class="flt_left" for="fb_meta_image">Image</label>
                            <input type="file" name="fb_meta_image" value="<?php echo $_SESSION["fb_meta_image"]; ?>"/>
                            <img src="../images/<?php echo $_SESSION["fb_meta_image"]; ?>" alt="<?php echo $_SESSION["page_title"]; ?>" />
                            <?php echo $_SESSION["fb_meta_image"]; ?>
                        </p>

                        <p>
                            <label class="flt_left" for="fb-description">Description</label>
                            <textarea id="fb-description" name="fb_meta_description" value=""><?php echo $_SESSION["fb_meta_description"]; ?></textarea>
                        </p>

                        <p>
                            <label class="flt_left" for="fb-sitename">Sitename</label>
                            <input type="text" id="fb-sitename" name="fb_meta_sitename" value="<?php echo $_SESSION["fb_meta_site_name"]; ?>"/>
                        </p>

                        <p>
                            <label class="flt_left" for="fb-admins">Admins</label>
                            <input type="text" id="fb-admins" name="fb_meta_admins" value="<?php echo $_SESSION["fb_meta_admins"]; ?>"/>
                        </p>

                        <p>
                            <label class="flt_left" for="fb-app_id">App ID</label>
                            <input type="text" id="fb-app-id" name="fb_meta_app_id" value="<?php echo $_SESSION["fb_meta_app_id"]; ?>"/>
                        </p>
                    </div>
                    <div class="form-section">
                        <h2>Twitter Information</h2>
                        <p>
                            <label class="flt_left" for="twitter-card">Card</label>
                            <select id="twitter-card" name="twitter_meta_card" value="<?php echo $_SESSION["twitter_meta_card"]; ?>">
                                <option>summary_large_image</option>
                            </select>
                        </p>

                        <p>
                            <label class="flt_left" for="twitter-site">Site</label>
                            <input type="text" id="twitter-site" name="twitter_meta_site" value="<?php echo $_SESSION["twitter_meta_site"]; ?>"/>
                        </p>

                        <p>
                            <label class="flt_left" for="twitter-title">Title</label>
                            <input type="text" id="twitter-title" name="twitter_meta_title" value="<?php echo $_SESSION["twitter_meta_title"]; ?>"/>
                        </p>

                        <p>
                            <label class="flt_left" for="twitter-description">Description</label>
                            <textarea id="twitter-description" name="twitter_meta_description" value=""><?php echo $_SESSION["twitter_meta_description"]; ?></textarea>
                        </p>

                        <p>
                            <label class="flt_left" for="twitter-creator">Creator</label>
                            <input type="text" id="twitter-creator" name="twitter_meta_creator" value="<?php echo $_SESSION["twitter_meta_creator"]; ?>"/>
                        </p>

                        <p>
                            <label class="flt_left" for="twitter-image">Image</label>
                            <input type="file" id="twitter-image" name="twitter_meta_image" value="<?php echo $_SESSION["twitter_meta_image"]; ?>"/>
                            <img src="../images/<?php echo $_SESSION["twitter_meta_image"]; ?>" alt="<?php echo $_SESSION["page_title"]; ?>" />
                            <?php echo $_SESSION["twitter_meta_image"]; ?>
                        </p>
                    </div>
                </form>


            <?php else: ?>

                <form action="submit-page-info.php" method="POST" enctype="multipart/form-data">
                    <?php if(isset($_POST["submit"])){submit_page_info("insert");} ?>
                    <h1>Enter page details for <?php echo $_SESSION["new_page"]; ?></h1>
                    <p><input type="submit" name="submit" value="submit"/></p>
                    <div class="form-section">
                        <h2>General Information</h2>
                        <p>
                            <label class="flt_left" for="title">Title</label>
                            <input type="text" name="page_title" value=""/>
                        </p>

                        <p>
                            <label class="flt_left" for="page-description">Description</label>
                            <textarea id="page_description" name="page_description" value=""></textarea>
                        </p>

                        <p>
                        <p>
                            <label class="flt_left">Keywords</label>
                            <span class="input_fields_page_keywords_wrap">
                <input type="text" name="page_keywords" value="">
            </span>
                        </p>

                        <p>
                            <label class="flt_left" for="page-canonical">Canonical</label>
                            <input type="text" id="page-canonical" name="page_canonical" value=""/>
                        </p>
                    </div>
                    <div class="form-section">
                        <h2>Facebook Information</h2>
                        <p>
                            <label class="flt_left" for="page-fb-title">Title</label>
                            <input type="text" id="page-fb-title" name="fb_meta_title" value=""/>
                        </p>

                        <p>
                            <label class="flt_left" for="fb_type">Type</label>
                            <select id="fb_type" name="fb_meta_type" value="">
                                <option>Article</option>
                                <option>Product</option>
                            </select>
                        </p>

                        <p>
                            <label class="flt_left" for="fb-url">URL</label>
                            <input type="text" id="fb-url" name="fb_meta_url" value=""/>
                        </p>

                        <p>
                            <label class="flt_left" for="fb_meta_image">Image</label>
                            <input type="file" name="fb_meta_image" value=""/>
                        </p>

                        <p>
                            <label class="flt_left" for="fb-description">Description</label>
                            <textarea id="fb-description" name="fb_meta_description" value=""></textarea>
                        </p>

                        <p>
                            <label class="flt_left" for="fb-sitename">Sitename</label>
                            <input type="text" id="fb-sitename" name="fb_meta_sitename" value=""/>
                        </p>

                        <p>
                            <label class="flt_left" for="fb-admins">Admins</label>
                            <input type="text" id="fb-admins" name="fb_meta_admins" value=""/>
                        </p>

                        <p>
                            <label class="flt_left" for="fb-app_id">App ID</label>
                            <input type="text" id="fb-app-id" name="fb_meta_app_id" value=""/>
                        </p>
                    </div>
                    <div class="form-section">
                        <h2>Twitter Information</h2>
                        <p>
                            <label class="flt_left" for="twitter-card">Card</label>
                            <select id="twitter-card" name="twitter_meta_card" value="">
                                <option>summary_large_image</option>
                            </select>
                        </p>

                        <p>
                            <label class="flt_left" for="twitter-site">Site</label>
                            <input type="text" id="twitter-site" name="twitter_meta_site" value=""/>
                        </p>

                        <p>
                            <label class="flt_left" for="twitter-title">Title</label>
                            <input type="text" id="twitter-title" name="twitter_meta_title" value=""/>
                        </p>

                        <p>
                            <label class="flt_left" for="twitter-description">Description</label>
                            <textarea id="twitter-description" name="twitter_meta_description" value=""></textarea>
                        </p>

                        <p>
                            <label class="flt_left" for="twitter-creator">Creator</label>
                            <input type="text" id="twitter-creator" name="twitter_meta_creator" value=""/>
                        </p>

                        <p>
                            <label class="flt_left" for="twitter-image">Image</label>
                            <input type="file" id="twitter-image" name="twitter_meta_image" value=""/>
                        </p>
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
