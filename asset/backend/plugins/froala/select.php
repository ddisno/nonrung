<?php include "froala_connectDB.php";?>
<?php

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM froala_uploads";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   $out = array();
    while($row = $result->fetch_assoc()) {
     $Imgdata = array(
           'url'=>$row['link_uploads'],
           'name'=>$row['name_uploads'],
           'id'=>$row['id_uploads'],
     	);
          array_push($out, $Imgdata);
    }
    echo json_encode($out);

} else {
    echo "0 results";
}
$conn->close();
?>
