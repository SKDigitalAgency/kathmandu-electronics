<form action="create-filename.php" method="GET">
    <input type="text" name="str1" />
    <input type="submit" name="submit" value="Create filename" />
</form>
<?php

include_once("functions.php");
if(isset($_GET["submit"])){
    $str2 = create_filename($_GET["str1"]);
    echo $str2;
}

?>