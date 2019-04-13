<!DOCTYPE html>
<html>
<head>
<?php
if(isset($_POST['submit'])) {
        onFunc();

header("Location: BigData.php");
}
function onFunc(){

$target_dir = "uploads/";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . basename("test.csv");
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    
      	   echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}
?>
</head>
<body>

<form action="FileUpload.php" method="post" enctype="multipart/form-data">

    <input type="file" name="fileToUpload" id="fileToUpload">
   
    <input type="submit" value="Upload File" name="submit">
</form>
</body>
</html>






