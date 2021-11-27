<?php  include "froala_connectDB.php";?>
<?php

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

  $ImgName = $_POST['name'];

  $id = $_POST['id'];


   // $path = getcwd().DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR;
   $path = '../../uploads/froala/';
   $fullPath = $path.$ImgName;
   chmod($fullPath, 0777);
   if(file_exists($fullPath)){
     unlink($fullPath);
     echo 'delete';
   }
   



// sql to delete a record

$sql = "DELETE FROM froala_uploads WHERE id_uploads='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();


?>
