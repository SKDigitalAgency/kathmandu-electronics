<?php include_once("../functions.php"); ?>
<?php if(isset($_GET["search"]) && isset($_GET["keywords"]) && $_GET["keywords"] != NULL): ?>

    <?php search($_GET["keywords"]); ?>

<?php else: ?>
    <?php

    $filename = get_requested_page_file_name();

    if(!isset($conn2)){
        $conn2 = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT * FROM articles_published WHERE filename = '$filename'";
    $result = mysqli_query($conn2,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if($key == "article_heading"){
                echo "<article>";
                    echo "<span class=\"article_category\">".$row["article_category"]."</span><span class=\"article_publication_date\">".$row["article_date"]."</span>";
                    echo "<header class=\"article_heading\">".$row["article_heading"]."</header>";
                    echo "<p class=\"article_description\">".$row["article_description"]."</p>";
                    echo "<img src=\"http://www.kathmanduelectronics.com/images/".$row["article_image"]."\" alt=\"".$row["article_heading"]."\" class=\"article_hero_image\" />";
                    echo $row["article_content"];
                echo "</article>";
            }
        }
    }

    ?>

<?php endif ?>