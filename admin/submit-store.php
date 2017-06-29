<?php ob_start();
session_start();
include_once("../functions.php");
if(!check_login()){
    header("Location: http://www.kathmanduelectronics.com/admin");
    ob_end_flush();
    exit();
}
$_SESSION["selected_page"] = "submit-store";
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
                    $sql = "SELECT * FROM stores WHERE store_name = '".$_GET["store"]."'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        foreach($row as $key => $value) {
                            $_SESSION[$key] = $value;
                        }
                    }

                    ?>
                    <form action="submit-store.php?store_name=<?php echo $_GET["store_name"]; ?>&&action=edit" method="POST" enctype="multipart/form-data">
                        <?php if(isset($_POST["submit"])){submit_store("update");} ?>
                        <h1>Edit store details for <?php echo $_SESSION["store_name"]; ?></h1>
                        <p><input type="submit" name="submit" value="submit"/></p>
                        <div class="form-section">
                            <p>
                                <label class="flt_left" for="field-store-name">Store Name</label>
                                <input type="text" name="store_name" value="<?php echo $_SESSION["store_name"]; ?>"/>
                            </p>
                            <p>
                                <label class="flt_left" for="field-store-location">Store Location</label>
                                <input type="text" name="store_location" value="<?php echo $_SESSION["store_location"]; ?>"/>
                            </p>
                            <p>
                                <label class="flt_left" for="field-store-contact">Store Contact</label>
                                <input type="text" name="store_contact" value="<?php echo $_SESSION["store_contact"]; ?>"/>
                            </p>
                            <p>
                                <label class="flt_left" for="field-store-email">Store Email</label>
                                <input type="text" name="store_email" value="<?php echo $_SESSION["store_email"]; ?>"/>
                            </p>
                            <p>
                                <label class="flt_left" for="field-store-website">Store Website</label>
                                <input type="text" name="store_website" value="<?php echo $_SESSION["store_website"]; ?>"/>
                            </p>
                        </div>
                    </form>



                <?php else: ?>


                    <form action="submit-store.php" method="POST" enctype="multipart/form-data">
                        <?php if(isset($_POST["submit"])){submit_store("insert");} ?>
                        <h1>Enter store details</h1>
                        <p><input type="submit" name="submit" value="submit"/></p>
                        <div class="form-section">
                            <p>
                                <label class="flt_left" for="field-store-name">Store Name</label>
                                <input type="text" name="store_name" value=""/>
                            </p>
                            <p>
                                <label class="flt_left" for="field-store-location">Store Location</label>
                                <input type="text" name="store_location" value=""/>
                            </p>
                            <p>
                                <label class="flt_left" for="field-store-contact">Store Contact</label>
                                <input type="text" name="store_contact" value=""/>
                            </p>
                            <p>
                                <label class="flt_left" for="field-store-email">Store Email</label>
                                <input type="text" name="store_email" value=""/>
                            </p>
                            <p>
                                <label class="flt_left" for="field-store-website">Store Website</label>
                                <input type="text" name="store_website" value=""/>
                            </p>
                        </div>
                    </form>
                <?php endif ?>
            </div>
        </main>
        <?php include_once ("aside-admin.php"); ?>
        <?php include_once ("footer-admin.php"); ?>
    </div>
    </body>
</html>