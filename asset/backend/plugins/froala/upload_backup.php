<?php include "froala_connectDB.php";?>
<?php

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$fileName = $_FILES['fileName']['name'];
$tmp = $_FILES['fileName']['tmp_name'];

if(!empty($_FILES['fileName']['tmp_name'])){
    $url = "uploads/".$fileName;
	copy($tmp, $url);

    $link = array(
         "link"=>$url
    	);

   $path = '1';//getcwd().DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR ;
   $sql = "INSERT INTO froala_uploads (name_uploads, link_uploads, img_path)
    VALUES ('$fileName', '$url','$path')";

if ($conn->query($sql) === TRUE) {

} else {

}

$conn->close();

    echo json_encode($link);
}

?>
