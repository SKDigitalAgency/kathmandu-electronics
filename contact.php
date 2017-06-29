<?php
session_start();
include_once("functions.php");
?>

<?php include_once("meta.php"); ?>
<body>
<?php include_once("header.php"); ?>
<main>
    <div class="container">
    <?php if(isset($_GET["search"]) && isset($_GET["keywords"]) && $_GET["keywords"] != NULL): ?>

        <?php search($_GET["keywords"]); ?>

    <?php else: ?>
    <div class="contact_info">
        <h2>Contact Us</h2>

        <p>Kathmandu Electronics is all about providing reliable and up to date information, fast and safe product delivery and expert after sales services to customers. If you have any query regarding our services and products you can contact our Customers Care branch anytime from anywhere.</p>

        <h2>Customer care</h2>

        <h2>Kathmandu</h2>
        <p>+977-9817483561</p>

        <h2>You can also connect with us via e-mail.</h2>
        <p>mail@kathmanduelectronics.com</p>
        <p>kathmanduelectronics@gmail.com</p>

        <h2>OR</h2>

        <h2>You can follow us on social media:</h2>
        <ul>
            <li><a href="http://www.facebook.com/kathmanduelectronics">Facebook</a></li>
            <li><a href="http://www.twitter.com/ktmelectronics">Twitter</a></li>
        </ul>

    </div>

    <?php endif ?>
    </div>
</main>
<?php include_once("aside.php"); ?>
<?php include_once("footer.php"); ?>
</body>
</html>