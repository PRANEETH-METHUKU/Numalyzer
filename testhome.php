<?php
if(isset($_POST['submit'])) {
        onFunc();
	

//header("Location: BigData.php");
}
if(isset($_POST['submited'])) {
if(!isset($_POST['formlist']))
	{

  	echo "<li>You forgot to select !</li>";
	}
	if(isset($_POST['formlist']))
	{       
 		onFuncs();
	}


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

function onFuncs(){
$method=$_POST['formlist'];
//echo "method: ".$method;
$myfile = fopen("model.txt", "w") or die("Unable to open file!");
fwrite($myfile, $method);
fclose($myfile);
exec("gnbbigdata.py");

$myfiles = fopen("model.txt", "r") or die("Unable to open file!");
$url=fgets($myfiles);
fclose($myfiles);
//echo($url);


$filepath = $url;
    
    // Process download
    if(file_exists($filepath)) {
        //header('Content-Description: File Transfer');
  	//header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        //header('Expires: 0');
        //header('Cache-Control: must-revalidate');
        //header('Pragma: public');
        //header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        exit;
    }

}
?>


<!DOCTYPE html>
<html>
<head>

</head>
<body>

<form action="testhome.php" method="post" enctype="multipart/form-data">

    <input type="file" name="fileToUpload" id="fileToUpload">
   
    <input type="submit" value="Upload File" name="submit"><br>
</form>
<form action="testhome.php" method="post" enctype="multipart/form-data">
    <br>Select Model
<select name="formlist">
  <option value="">Select...</option>
  <option value="0">Gaussian NaiveBayes</option>
  <option value="1">Multinomial NaiveBayes</option>
  <option value="2">Bernoulli NaiveBayes</option>
  <option value="3">KNeighborsClassifier</option>
  <option value="4">RandomForestClassifier</option>
  <option value="5">DecisionTreeClassifier</option>
  <option value="6">SVM.SVC</option>
  <option value="7">KMeans</option>
</select>
    <input type="submit" value="Analyze and Download" name="submited"><br><br>
<?php
exec("allmodel.py");
$filename = "rfe.txt";
$file = fopen($filename, "r");

while(! feof($file))
  {
  echo fgets($file). "<br />";
  }

fclose($file);
?>
</body>
</html>






