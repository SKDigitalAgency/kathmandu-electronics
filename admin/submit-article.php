<?php ob_start();
session_start();
include_once("../functions.php");
if(!check_login()){
    header("Location: http://www.kathmanduelectronics.com/admin");
    ob_end_flush();
    exit();
}
$_SESSION["selected_page"] = "submit-article";
?>
<?php include_once ("meta-admin.php"); ?>
<body>
<div class="container">
    <?php include_once ("header-admin.php"); ?>
    <main>
        <div class="container">
            <?php if(!isset($_GET["draft"]) && !isset($_GET["published"])): ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <?php

                    if(!isset($conn2)){
                        $conn2 = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
                    }
                    if(isset($_POST["submit"])){
                        switch($_POST["submit"]){
                            case "Draft":
                                $article_image = $_FILES["article_image"]["name"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_FILES["article_image"]["name"])."'";
                                $article_category = $_POST["article_category"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_POST["article_category"])."'";
                                $article_heading = $_POST["article_heading"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_POST["article_heading"])."'";
                                $article_description = $_POST["article_description"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_POST["article_description"])."'";
                                $article_date = "'".date("y-m-d")."'";
                                $filename = "'".create_filename($_POST["article_heading"])."'";
                                $article_content = $_POST["article_content"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_POST["article_content"])."'";
                                $sql = "INSERT INTO articles_drafted(`article_image`,`article_category`,`article_heading`,`article_description`,`article_date`,`filename`,`article_content`) VALUES($article_image,$article_category,$article_heading,$article_description,$article_date,$filename,$article_content)";
                                if(mysqli_query($conn2,$sql)){
                                    upload_file("article_image","image");
                                    echo "<p class=\"msg_box\">Article drafted successfully.</p>";
                                }else{
                                    echo "<p class=\"msg_box_failed\">Failed to draft article.</p>";
                                }
                                break;
                            case "Publish":
                                $article_image = $_FILES["article_image"]["name"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_FILES["article_image"]["name"])."'";
                                $article_category = $_POST["article_category"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_POST["article_category"])."'";
                                $article_heading = $_POST["article_heading"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_POST["article_heading"])."'";
                                $article_description = $_POST["article_description"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_POST["article_description"])."'";
                                $article_date = "'".date("y-m-d")."'";
                                $filename = "'".create_filename($_POST["article_heading"])."'";
                                $article_content = $_POST["article_content"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_POST["article_content"])."'";
                                $sql = "INSERT INTO articles_published(`article_image`,`article_category`,`article_heading`,`article_description`,`article_date`,`filename`,`article_content`) VALUES($article_image,$article_category,$article_heading,$article_description,$article_date,$filename,$article_content)";
                                if(mysqli_query($conn2,$sql)){
                                    upload_file("article_image","image");
                                    $new_page = create_filename($_POST["article_heading"]);
                                    $_SESSION["new_page"] = $new_page;
                                    create_new_page($new_page,"articles");
                                    echo "<p class=\"msg_box\">Article published successfully. Now add article page information.<a href=\"submit-page-info.php\">Go to submit page info</a></p>";
                                }else{
                                    echo "<p class=\"msg_box_failed\">Failed to publish article.</p>";
                                }
                                break;
                        }
                    }

                    ?>
                    <h2>New Article</h2>
                    <p>
                        <label class="flt-left">Main Image</label>
                        <input type="file" name="article_image" />
                    </p>
                    <p>
                        <label class="flt-left">Category</label>
                        <input type="text" name="article_category" />
                    </p>
                    <p>
                        <label class="flt-left">Heading</label>
                        <input class="article_heading" type="text" name="article_heading" />
                    </p>
                    <p>
                        <label class="flt-left">Description</label>
                        <input class="article_description" type="text" name="article_description" />
                    </p>
                    <p>
                        <textarea name="article_content"></textarea>
                        <script>
                            CKEDITOR.replace( 'article_content' );
                        </script>
                    </p>
                    <p>
                        <input type="submit" name="submit" value="Draft" />
                        <input type="submit" name="submit" value="Publish" />
                    </p>
                </form>
            <?php else: ?>
                <?php

                if(!isset($conn2)){
                    $conn2 = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
                }

                if(isset($_GET["draft"])){
                    $context = "draft";
                }else if(isset($_GET["published"])){
                    $context = "published";
                }else{
                    // do nothing
                }
                switch($context){
                    case "draft":
                        $sql = "SELECT * FROM articles_drafted WHERE filename = '".$_GET["draft"]."'";
                        break;
                    case "published":
                        $sql = "SELECT * FROM articles_published WHERE filename = '".$_GET["published"]."'";
                        break;
                }

                $result = mysqli_query($conn2,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    foreach($row as $key => $value){
                        if($key == "article_heading"){
                            $temp["article_image"] = $row["article_image"];
                            $temp["article_category"] = $row["article_category"];
                            $temp["article_heading"] = $row["article_heading"];
                            $temp["article_description"] = $row["article_description"];
                            $temp["article_content"] = $row["article_content"];
                        }
                    }
                }

                if(isset($_POST["submit"]) && $_POST["submit"] == "Save"){
                    switch($context){
                        case "draft":
                            $article_image = $_FILES["article_image"]["name"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_FILES["article_image"]["name"])."'";
                            $article_category = $_POST["article_category"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_POST["article_category"])."'";
                            $article_heading = $_POST["article_heading"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_POST["article_heading"])."'";
                            $article_description = $_POST["article_description"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_POST["article_description"])."'";
                            $article_date = "'".date("y-m-d")."'";
                            $filename = "'".create_filename($_POST["article_heading"])."'";
                            $article_content = $_POST["article_content"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_POST["article_content"])."'";
                            $sql = "UPDATE articles_drafted SET article_image = $article_image,article_category = $article_category,article_heading = $article_heading,article_description = $article_description,article_date = $article_date,article_content = $article_content WHERE filename = '".$_GET["draft"]."'";
                            if(mysqli_query($conn2,$sql)){
                                upload_file("article_image","image");
                                echo "<p class=\"msg_box\">Draft updated successfully.</p>";
                            }else{
                                echo "<p class=\"msg_box_failed\">Failed to update draft.</p>";
                            }
                            break;
                        case "published":
                            $article_image = $_FILES["article_image"]["name"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_FILES["article_image"]["name"])."'";
                            $article_category = $_POST["article_category"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_POST["article_category"])."'";
                            $article_heading = $_POST["article_heading"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_POST["article_heading"])."'";
                            $article_description = $_POST["article_description"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_POST["article_description"])."'";
                            $article_date = "'".date("y-m-d")."'";
                            $filename = "'".create_filename($_POST["article_heading"])."'";
                            $article_content = $_POST["article_content"] == NULL?"NULL":"'".mysqli_real_escape_string($conn2,$_POST["article_content"])."'";
                            $sql = "UPDATE articles_published SET article_category = $article_category,article_heading = $article_heading,article_description = $article_description,article_date = $article_date,article_content = $article_content WHERE filename = '".$_GET["published"]."'";
                            if(mysqli_query($conn2,$sql)){
                                if($article_image !== "NULL"){
                                    upload_file("article_image","image");
                                    mysqli_query($conn2,"UPDATE articles_published SET article_image = $article_image WHERE filename = '".$_GET["published"]."'");
                                }
                                $new_page = create_filename($_POST["article_heading"]);
                                $_SESSION["new_page"] = $new_page;
                                create_new_page($new_page,"articles");
                                echo "<p class=\"msg_box\">Article updated successfully.</p>";
                            }else{
                                echo "<p class=\"msg_box_failed\">Failed to update article.</p>";
                            }
                            break;
                    }
                }
                if(isset($_POST["submit"]) && isset($_GET["draft"]) && $_POST["submit"] == "Publish"){
                    $sql = "INSERT INTO articles_published SELECT * FROM articles_drafted WHERE filename = '".$_GET["draft"]."'";
                    mysqli_query($conn2,$sql);
                    $sql = "DELETE FROM articles_drafted WHERE filename = '".$_GET["draft"]."'";
                    if(mysqli_query($conn2,$sql)){
                        upload_file("article_image","image");
                        $new_page = $_GET["draft"];
                        $_SESSION["new_page"] = $new_page;
                        create_new_page($new_page,"articles");
                        echo "<p class=\"msg_box\">Article published successfully. Now add article page information.<a href=\"submit-page-info.php\">Go to submit page info</a></p>";
                    }else{
                        echo "<p class=\"msg_box_failed\">Failed to publish article.</p>";
                    }
                }
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <h2>Edit article</h2>
                <p>
                    <label class="flt-left">Main Image</label>
                    <input type="file" name="article_image" />
                    <img src="http://www.kathmanduelectronics.com/images/<?php echo $temp["article_image"] ?>" alt="<?php echo $temp["article_heading"] ?>"
                </p>
                <p>
                    <label class="flt-left">Category</label>
                    <input type="text" name="article_category" value="<?php echo $temp["article_category"] ?>"/>
                </p>
                <p>
                    <label class="flt-left">Heading</label>
                    <input class="article_heading" type="text" name="article_heading"  value="<?php echo $temp["article_heading"] ?>"/>
                </p>
                <p>
                    <label class="flt-left">Description</label>
                    <input class="article_description" type="text" name="article_description"  value="<?php echo $temp["article_description"] ?>"/>
                </p>
                <p>
                    <textarea name="article_content"><?php echo $temp["article_content"] ?></textarea>
                    <script>
                        CKEDITOR.replace( 'article_content' );
                    </script>
                </p>
                <p>
                    <input type="submit" name="submit" value="Save" />
                    <?php
                        if(isset($_GET["draft"])) {
                            echo "<input type = \"submit\" name = \"submit\" value = \"Publish\" />";
                        }
                        ?>
                </p>
                </form>
            <?php endif ?>
        </div>
    </main>
    <?php include_once ("footer-admin.php"); ?>
</div>
</body>
</html>
