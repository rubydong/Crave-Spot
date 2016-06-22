<?php
if (file_exists("groups/" . $_GET['id'] . ".response")) {
    $fp = fopen("groups/" . $_GET['id'] . ".response", "r");
    $arr = explode("|",fread($fp, filesize("groups/" . $_GET['id'] . ".response")));
    
    if ($_GET['sec'] == "name"){
        echo $arr[0];
    } else {
        echo $arr[1];
    }
    fclose($fp);
} else {
        echo "NONE";
    }
?>
