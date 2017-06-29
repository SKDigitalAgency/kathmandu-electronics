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
    <div class="about_us">
        <h2>About Us</h2>

        <p>Present context of electronics market in Nepal is such that there is no standard or stability in product information particularly in pricing and availability which leads to lack of trust among customers. We are here to fill that short coming by working with as much electronics stores as possible to bring reliable and up to date information as possible. Kathmandu Electronics is an online catalog of electronics products like phones, tablets, laptops and accessories where you can find information related to specification and features, price and availability, services and maintenance.</p>

        <h2>Nationwide services</h2>
    <p>We are based in Kathmandu but we are not limited by location. We are partnering with as much stores and retailers as possible around the country.</p>

        <h2>Delivery</h2>
    <p> We also provide delivery services for electronics products in the country.</p>

        <h2>Service and maintenance</h2>
    <p> Apart from information and guidance and delivery we also provide product repair and maintenance service.</p>

    <p>        Kathmandu Electronics is all about filling the shortcomings of current electronics retail industry in Nepal. Therefore, we primarily focus on providing reliable and up to date information on products and personalized guidance to every customer. Second, we fill the gap where current electronics retail industry has failed and that is provide reliable delivery service across the country and provide after sales services like repair and maintenance.</p>

    </div>
    <?php endif ?>
    </div>
</main>
<?php include_once("aside.php"); ?>
<?php include_once("footer.php"); ?>
</body>
</html>
