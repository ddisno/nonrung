<?php include "../library/config.php";?>
<?php

// Create connection
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$fileName = $_FILES['fileName']['name'];
$tmp = $_FILES['fileName']['tmp_name'];

if(!empty($_FILES['fileName']['tmp_name'])){
    
      $namefile = $_FILES['fileName']['name'];
      $sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
      $name = "FR-".(Date("dmy").rand('1000','9999').$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
      $target = "../../uploads/froala/".$name;
      $newname = $name;

      if(file_exists($target)){
        $oldname = pathinfo($name, PATHINFO_FILENAME);
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $newname = $oldname;
        do{
          $r = rand(1000,9999);
          $newname = $oldname."-".$r.".$ext";
          $target = "../../uploads/froala/".$newname;
        }while (file_exists($target)); 
      }

      $url = "../../uploads/froala/".$newname;

  copy($tmp, iconv('UTF-8','windows-874',$url));

    $link = array(
         "link"=>$url
      );

   $path = '1';//getcwd().DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR ;
   $sql = "INSERT INTO froala_uploads (name_uploads, link_uploads, img_path)
    VALUES ('$newname', '$url','$path')";

if ($conn->query($sql) === TRUE) {

} else {

}

$conn->close();

    echo json_encode($link);
}

?>
