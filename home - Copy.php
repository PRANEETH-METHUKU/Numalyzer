<!DOCTYPE html>
<html>
<head>
<style>
            table {
                border-collapse: collapse;
                border: 2px black solid;
                font: 12px sans-serif;
            }

            td {
                border: 1px black solid;
                padding: 5px;
            }
#loading {
    background: url('spinner.gif') no-repeat center center;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 9999999;
}
        </style>

</head>
<body>
<div id="loading"></div>
<script>
function hideLoader() {
    $('#loading').hide();
}

$(window).ready(hideLoader);

// Strongly recommended: Hide loader after 20 seconds, even if the page hasn't finished loading
setTimeout(hideLoader, 20 * 1000);
</script>
<form action="home - Copy.php" method="post" enctype="multipart/form-data">

    <input type="file" name="fileToUpload" id="fileToUpload">
   
    <input type="submit" value="Upload File" name="submit">
<input type="submit" value="Predict" name="submit1"><br>
</form>
<?php
if(isset($_POST['submit'])) {
        onFunc();
exec("atrib.py");
exec("corr.py");
echo "<br>Data Info<table>\n\n";
$f = fopen("datainfo.csv", "r");
while (($line = fgetcsv($f)) !== false) {
        echo "<tr>";
        foreach ($line as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>\n";
}
fclose($f);
echo "\n</table><br><br>";

echo "Unique Info<table>\n\n";
$f = fopen("uniqinfo.csv", "r");
while (($line = fgetcsv($f)) !== false) {
        echo "<tr>";
        foreach ($line as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>\n";
}
fclose($f);
echo "\n</table><br><br>";

echo "Null Info<table>\n\n";
$f = fopen("nullinfo.csv", "r");
while (($line = fgetcsv($f)) !== false) {
        echo "<tr>";
        foreach ($line as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>\n";
}
fclose($f);
echo "\n</table><br><br>";

echo "Correlation Table<table>\n\n";
$f = fopen("corr.csv", "r");
while (($line = fgetcsv($f)) !== false) {
        echo "<tr>";
        foreach ($line as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>\n";
}
fclose($f);
echo "\n</table>";  
//header("Location: FileUpload.php");
}
///////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['submit1'])) {
      

header("Location: bigdata.php");
}
///////////////////////////////////////////////////////////////////////////////////////
function onFunc(){

$target_dir = "uploads/";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . basename("train.csv");
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
</body>
</html>






