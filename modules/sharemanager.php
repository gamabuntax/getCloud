<?php
    if(isset($_POST['share'])){
        if($_POST['fileStatus'] == 0){
            $status = 1;
        }
        else{
            $status = 0;
        }

        require('../includes/mysql_connect.inc.php');
        $user = $_SESSION['userName'];
        $id = $_POST['fileID'];
        $query = "UPDATE FILE SET Status ='$status' WHERE FileID='$id'";
        mysqli_query($link, $query)or die("Error:".mysqli_error($link));
        mysqli_close($link);  
        header("Location: ../myfiles.php");
    }
?>
