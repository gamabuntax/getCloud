<?php
$file = base64_decode($_POST['pdf']);
header('Content-type: application/pdf');
header('Content-Transfer-Encoding: binary');
echo $file;
?>
