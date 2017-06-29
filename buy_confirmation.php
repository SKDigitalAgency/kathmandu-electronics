<?php
session_start();
include_once("functions.php");
$_SESSION["selected_page_user"] = "buy_confirmation";
?>
<?php include_once("meta.php"); ?>
<body>
<?php include_once("header.php"); ?>
<main>
    <div class="container">
        <?php

        if(!isset($conn2)){
            $conn2 = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
        }

        $sql2 = "SELECT * FROM `phones` WHERE file_name = '".$_GET["name"]."'";
        $result2 = mysqli_query($conn2,$sql2);
        while($row2 = mysqli_fetch_assoc($result2)){
            foreach($row2 as $key2 => $value2){
                if($key2 == "phone_model"){
                    echo "<h2>".$row2['phone_model']."</h2>";
                    $model = "'".$row2['phone_model']."'";
                    $price = "'".$row2['phone_price']."'";
                    echo "<img style=\"width:20%;\" src=\"http://www.kathmanduelectronics.com/images/".$row2["phone_image_filename"]."\" alt=\"".$row2["phone_image_filename"]."\" />";
                }
            }
        }


        ?>
        <?php

        if(isset($_POST["submit_customer_data"])){

            $sql3 = "INSERT INTO sales(product_type,product_model,product_price,customer_name,customer_contact,customer_email,customer_address) VALUES('".$_GET['product']."',".$model.",".$price.",'".$_POST["customer_name"]."','".$_POST["customer_contact"]."','".$_POST["customer_email"]."','".$_POST["customer_address"]."')";
            if(mysqli_query($conn2,$sql3)){
                echo "Buy successful";
            }else{
                echo $sql;
            }
        }

        ?>
        <form action="" method="POST">
            <p>
                <label style="font:Bold 1em 'Arial'">Name</label>
                <input style="padding:5px;border:1px solid rgb(240,240,240);font:1em 'Arial',sans-serif;letter-spacing:1px;" type="text" name="customer_name" />
            </p>
            <p>
                <label style="font:Bold 1em 'Arial'">Contact</label>
                <input style="padding:5px;border:1px solid rgb(240,240,240);font:1em 'Arial',sans-serif;letter-spacing:1px;" type="text" name="customer_contact" />
            </p>
            <p>
                <label style="font:Bold 1em 'Arial'">Email</label>
                <input style="padding:5px;border:1px solid rgb(240,240,240);font:1em 'Arial',sans-serif;letter-spacing:1px;" type="text" name="customer_email" />
            </p>
            <p>
                <label style="font:Bold 1em 'Arial'">Address</label>
                <input style="padding:5px;border:1px solid rgb(240,240,240);font:1em 'Arial',sans-serif;letter-spacing:1px;" type="text" name="customer_address" />
            </p>
            <P>
                <input class="submit_btn" type="submit" name="submit_customer_data" value="Buy" />
            </P>
        </form>
    </div>
</main>
<?php include_once("aside.php"); ?>
<?php include_once("footer.php"); ?>
</body>
</html>
