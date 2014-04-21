<?php
    $pic = $_POST['picture'];
    $cap = $_POST['caption'];
    $name = $_POST['name'];
    echo "<b>Photo name: </b>".$name."<br>";
    echo "<b>Caption: </b>".$cap."<br><hr>";
    echo "<img src='data:image;base64,".$pic."'alt=''/>";
?>
