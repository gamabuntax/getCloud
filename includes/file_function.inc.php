<?php

//handle the uploading file
function upload($file){
    require('./includes/mysql_connect.inc.php');
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
    mysqli_close($link);
    return $result;
}

function displayFile(){
    require('./includes/mysql_connect.inc.php');
    $userName = $_SESSION['userName'];
    $query = "SELECT * FROM FILE WHERE Owner='$userName'";
    $result = mysqli_query($link, $query);

    while($row = mysqli_fetch_array($result)){
        $cap = $row['Caption'];
        $name = $row['Filename'];
        $file = base64_encode($row['Data']);
        $type = $row['Type'];
        $fileID = $row['FileID'];
        $status1 = $row['Status'];
        if($row['Status'] == 0) { 
            $status = 'Private';
        }
        else {
            $status = 'Public';
        }   

        echo "<tr width='100%'>";

        if ($type == "application/pdf") {
            echo "<td width='10%'><img src='./thumbnails/pdfthumb.png' height='50' alt=''/></td>";
        }
        else {
            echo '<td width="10%"><img src="data:image;base64,'.$file.'" height="50" width="">';
        }
        echo "<td width='10%'>".$status . "</td>
            <td width='20%'>".$name . "</td>
            <td width='40%'>".$cap . "</td>
            <td width='40%'><form class='form-inline' action='myPDFs.php' method='post'>
            <select class='form-control' name='sharing'>
            <option value='private'>Private</option>
            <option value='public'>Public</option>
            </select>
            <input type='hidden' name='file_id' value='".$fileID."'/>
            <input type='hidden' name='status' value='".$status1."'/>
            <button type='submit' name ='submit' class='btn btn-default'>Submit</button>
            </form></td>
          </tr>";       
   } 
    mysqli_close($link);   
}

?>