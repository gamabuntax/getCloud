<?php 
    $page_title = 'getCloud';
    require('../includes/header.inc.php');

    if (isset($_SESSION['userName'])) {
        $userName = $_SESSION['userName'];
    }
    else {
        header("Location:register.php");
    }

    require('../includes/sideregion.inc.php');
?>

<?php

    function isValidFile(){
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES['file']['tmp_name']);
        switch ($mime) {
            case 'image/jpeg':
                return true;
            case 'image/jpg':
                return true;
            case 'application/pdf':
                return true;
        }
        return false;
    }

    function upload($file){
        require('../includes/mysql_connect.inc.php');
        $escapedfile = mysqli_real_escape_string($link, $file);
        $name = $_POST['name'];
        $caption = $_POST['caption'];
        $user = $_SESSION['userName'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $type = finfo_file($finfo, $_FILES['file']['tmp_name']);
        $status = 0;

        $query = "INSERT INTO FILE(Filename, Caption, Data, type, Status, Owner) 
                        VALUES('$name', '$caption', '$escapedfile', '$type', '$status', '$user')"; 
        $result = mysqli_query( $link, $query);
        if ($result){
           makethumbnail($link, $file, $type);  
        }
        mysqli_close($link);
        return $result;
    }

    function makethumbnail($link, $file, $type){ 
        /*
        //add the desired extension to the thumbnail
        $thumb = mysqli_insert_id().".jpg";
        $thumbDirectory = "../thumbnails";
 
        //execute imageMagick's 'convert', setting the color space to RGB and size to 200px wide
        exec("convert \"{$file}[0]\" -colorspace RGB -geometry 200 $thumbDirectory $thumb");
        */

         $size = 0.40; 

         // Setting the resize parameters
         list($width, $height) = getimagesize($file); 
         $modwidth = $width * $size; 
         $modheight = $height * $size; 

         // Creating the Canvas 
         $tmp_img = imagecreatetruecolor($modwidth, $modheight); 

         $source = imagecreatefromjpeg($file); 

         echo "resizing...";
         // Resizing our image to fit the canvas 
         $image = imagecopyresized($thumb, $source, 0, 0, 0, 0, $modwidth, $modheight, $width, $height); 
         imagejpeg($tmp_img, "../thumbnails");

    }
?>

<?php //MAIN

    if ($_FILES["file"]["error"] != 0){
        $_SESSION['uploadStatus'] = "<b style='color:red;' align='center'>Error:".$_FILES["file"]["error"]."<b>";
        header('Location: ../myfiles.php');
    }
    elseif (isValidFile()){
        $file = file_get_contents($_FILES['file']['tmp_name']);
        if (upload($file)){ 
            $_SESSION['uploadStatus'] = "<b style='color:green;'>File uploaded!</b>";
            header('Location: ../myfiles.php');
        }else{
            $_SESSION['uploadStatus'] = "<b style='color:red;'>Something wrong. File not uploaded.</b>";
            header('Location: ../myfiles.php');
        } 
    }
    else {
        $_SESSION['uploadStatus'] = "<b style='color:red;' align='center'>
        Sorry, we currently only support pdf, jpg, and jpeg files.<b>";
        header('Location: ../myfiles.php');
    }
?>

<?php
require('../includes/footer.inc.php');
?>