<!DOCTYPE html>
<html>
<body>

<form action="./uploadDatasmithFile.php" method="post" enctype="multipart/form-data">
    Select an .udatasmith file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <input type="submit" value="Upload" name="submit">
</form>


<?php


$ElementCategories = array();

$xmlData = file_get_contents("./uploads/datasmith.udatasmith");
$xmlData =preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $xmlData);


$xml = simplexml_load_string($xmlData);
if ($xml === false) {
    echo "Failed loading XML: ";
    foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
} else {
    //print_r($xml->MetaData[0]);
    //echo "<br><br>";
    //var_dump($xml->MetaData);

    foreach($xml->MetaData as $metaData) {
    	foreach($metaData as $KeyValueProperty){
    		if ($KeyValueProperty["name"] != "Element_Category"){
    			continue;
    		}
    		array_push($ElementCategories,$KeyValueProperty["val"]);

    	}
    }
}

$ElementCategories = array_unique($ElementCategories);

// Force sorting
$s_ElementCategories = implode("*",$ElementCategories);
$ElementCategories = explode("*",$s_ElementCategories);
// Force sorting

sort($ElementCategories);

//var_dump($ElementCategories);

echo '<form action="/action_page.php">';
$i = 1;
foreach($ElementCategories as $category){
	echo '<input type="checkbox" id="category' . $i . '" name="category' . $i . '" value="'. $category . '">';
	echo '<label for="category'.$i.'">'.$category.'</label><br>';
	$i++;
}
echo '<input type="submit" value="Submit">';
echo '</form>';


?>


</body>
</html>