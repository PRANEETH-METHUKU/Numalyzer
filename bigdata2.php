<?php
//remove <script></script> and add php start and close tag
//comment these two lines when code started working fine
error_reporting(E_ALL);
ini_set('display_errors',1);

$filename = 'atr.txt';
$eachlines = file($filename, FILE_IGNORE_NEW_LINES);

?>
<body>
    <div id="page-wrap">
<form method = 'post'> 
        <h1>Select your target attributes</h1>
        <select id="value" name = 'subject[]' multiple>
            <option selected value="base">Please Select</option>
           <?php foreach($eachlines as $lines){ //add php code here
                echo "<option value='".$lines."'>$lines</option>";
		
		
            }?>
        </select>
<input type = 'submit' name = 'submit' value = Submit> 
</form>
    </div>
</body>
<?php 
      
    // Check if form is submitted successfully 
    if(isset($_POST["submit"]))  
    { 
        // Check if any option is selected 
        if(isset($_POST["subject"]))  
        { 
$data="";
            // Retrieving each selected option 
            foreach ($_POST['subject'] as $subject)  {
                //print "You selected $subject<br/>";
		$data=$data."".$subject.","; 
}
$myfile = fopen("output.txt", "w") or die("Unable to open file!");
fwrite($myfile, $data);
fclose($myfile);
//exec("powerlaw.py");
//print "$data";	
header("Location: testhome.php");	
        } 
    else
        echo "Select an option first !!"; 
    } 
?> 