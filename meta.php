<?php

    $meta = get_general_meta_data();

?>
<!DOCTYPE html>

<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <?php if(basename(dirname($_SERVER['PHP_SELF'])) == "articles" || get_requested_page_file_name() == "index"): ?>

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-3446499865954498",
            enable_page_level_ads: true
        });
    </script>
    <?php endif; ?>

<!--Metadata-->
	<meta charset="utf-8" />
    <link rel="shortcut icon" href="http://www.kathmanduelectronics.com/images/favicon.png" />
	<meta  name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
	<title><?php echo $meta[1]; ?></title>
	<meta name="description" content="<?php echo $meta[2]; ?>" />
	<meta name="keywords" content="<?php echo $meta[3]; ?>" />
	<link rel="canonical" href="<?php echo "http://".$meta[4].".php"; ?>" />
<!--Facebook metadata-->
	<meta property="og:title" content="<?php echo $meta[5]; ?>" />
	<meta property="og:type" content="<?php echo $meta[6]; ?>" />
	<meta property="og:url" content="<?php echo $meta[7]; ?>" />
	<meta property="og:image" content="http://www.kathmanduelectronics.com/images/<?php echo $meta[8]; ?>" />
	<meta property="og:description" content="<?php echo $meta[9]; ?>" />
	<meta property="og:site_name" content="<?php echo $meta[10]; ?>" />
	<meta property="fb:admins" content="<?php echo $meta[11]; ?>" />
	<meta property="fb:app_id" content="<?php echo $meta[12]; ?>" />
<!--Twitter metadata-->
	<meta name="twitter:card" content="<?php echo $meta[13]; ?>" />
	<meta name="twitter:site" content="<?php echo $meta[14]; ?>" />
	<meta name="twitter:title" content="<?php echo $meta[15]; ?>" />
	<meta name="twitter:description" content="<?php echo $meta[16]; ?>" />
	<meta name="twitter:creator" content="<?php echo $meta[17]; ?>" />
	<meta name="twitter:image:src" content="http://www.kathmanduelectronics.com/images/<?php echo $meta[18]; ?>" />
<!-- css links -->
<?php
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"http://www.kathmanduelectronics.com/css/common.css\"/>";
    if(!isset($conn)){
        $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
    }
    $sql = "SELECT * FROM themes WHERE is_used = '1'";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $key => $value){
            if($key !== "is_used" && $key !== "theme_name"){
                if($value != NULL){
                    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"http://www.kathmanduelectronics.com/css/".$value.".css\"/>";
                }
            }
        }
    }
    mysqli_close($conn);
?>

<!-- javascript -->
    <script type="text/javascript" src="http://www.kathmanduelectronics.com/js/jquery.js"></script>
    <script type="text/javascript" src="http://www.kathmanduelectronics.com/js/events.js"></script>
<!-- external files -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:900|Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">

</head>