!DOCTYPE html>
<html>
<body>

<form action="anal.php" method="post" enctype="multipart/form-data">

    <input type="file" name="fileToUpload" id="fileToUpload">
    Select Enhancement Method
<select name="formlist">
  <option value="">Select...</option>
  <option value="NaiveBayes">NaiveBayes</option>
  <option value="RFE">RFE</option>
  <option value="PCA">PCA</option>
  <option value="KNN">KNN</option>
</select>
    <input type="submit" value="Upload Image" name="submit">
</form>
<?php
if(isset($_POST['submited'])) {
        exec("powerlaw.py");
?>
<br><table><tr><td><img src="uploads/test.png"></td><td><img src="uploads/result.png"></td></tr></table>
<?php
}
if(isset($_POST['submitedthresh'])) {
	
        exec("thresh.py");
?>
<br><table><tr><td><img src="uploads/test.png"></td><td><img src="uploads/result.png"></td></tr></table>
<?php
}
if(isset($_POST['submitedlog'])) {
        exec("log.py");
?>
<br><table><tr><td><img src="uploads/test.png"></td><td><img src="uploads/result.png"></td></tr></table>
<?php
}
if(isset($_POST['submit'])) {
        onFunc();
	if(!isset($_POST['formlist']))
	{

  	$errorMessage .= "<li>You forgot to select !</li>";
	}
	if(isset($_POST['formlist']))
	{
	$method=$_POST['formlist'];
	echo "method: ".$method;
	switch($method)

    {

      case "NaiveBayes": exec("avg.py"); break;

      case "RFE": exec("hist.py"); break;

      case "PCA": header("Location: log.php");//exec("log.py"); 
		  break;
      case "KNN": header("Location: thresh.php");//exec("log.py"); 
		  break;
      

      default: echo("Error!"); exit(); break;

    
	}

	}
?>
<br><table><tr><td><img src="uploads/test.png"></td><td><img src="uploads/result.png"></td></tr></table>
<?php
    }
    

    function onFunc(){

$target_dir = "uploads/";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . basename("test.png");
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    
      	   echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


}
function prompt($prompt_msg){
        echo("<script type='text/javascript'> var answer = prompt('".$prompt_msg."'); </script>");

        $answer = "<script type='text/javascript'> document.write(answer); </script>";
        return($answer);
    }


?>
</body>
</html>