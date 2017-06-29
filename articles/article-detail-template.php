<?php
session_start();
include_once("../functions.php");
?>

<?php include_once("../meta.php"); ?>
<body>
<?php include_once("../header.php"); ?>
<div class="main-body">
    <div class="container">
<main>
    <div class="container">
        <?php include_once("article_body.php");  ?>
        <?php /*facebook_comments_section();*/ ?>
    </div>
</main>
<?php include_once("../aside.php"); ?>
    </div></div>
<?php include_once("../footer.php"); ?>
<script type="text/javascript">
    var infolinks_pid = 3015466;
    var infolinks_wsid = 0;
</script>
<script type="text/javascript" src="//resources.infolinks.com/js/infolinks_main.js"></script>

</body>
</html>
