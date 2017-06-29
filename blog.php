<?php
session_start();
include_once("functions.php");
$_SESSION["selected_page_user"] = "blog";
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

        <?php extract_articles("published"); ?>

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
