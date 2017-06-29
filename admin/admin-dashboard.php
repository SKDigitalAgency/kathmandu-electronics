<?php ob_start();
    session_start();
    include_once("../functions.php");
    if(!check_login()){
        header("Location: http://www.kathmanduelectronics.com/admin");
        ob_end_flush();
        exit();
    }
    $_SESSION["selected_page"] = "admin-dashboard";
?>
<?php include_once ("meta-admin.php"); ?>
<body>
    <div class="container">
        <?php include_once ("header-admin.php"); ?>
        <?php include_once ("aside-admin.php"); ?>
        <?php include_once ("footer-admin.php"); ?>
    </div>
</body>
</html>
