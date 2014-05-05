<?php
$file = base64_decode($_POST['file']);
header('Content-type: application/pdf');
header('Content-Transfer-Encoding: binary');
echo $file;
?>
