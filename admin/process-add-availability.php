<?php

if(!isset($conn)){
    $conn = mysqli_connect("localhost","kathman4_ke","Codec_form1243","kathman4_ke");
}
$sql = "SELECT * FROM stores";
$result = mysqli_query($conn,$sql);

$xml          = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
$xml .= "<result>";
while($row = mysqli_fetch_assoc($result)){
    $xml .= "<row>";
    foreach($row as $key => $value){
        $xml .= "<$key>$value</$key>";
    }
    $xml.="</row>";
}
$xml .= "</result>";

unset($_POST);
header ("Content-Type:text/xml");
ob_end_flush();
echo $xml;

?>