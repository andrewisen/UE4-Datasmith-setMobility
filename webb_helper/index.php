<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<!-- Custom CSS -->
	<link href="./css/custom.css" rel="stylesheet">

	<title>Datasmith Helper</title>
</head>
<body class="bg-light">
<?
if(!empty($_GET)){
	$status = $_GET['status'];
	if ($status=="fileUploaded"){
		$uploadMessage  = "File uploaded successfully! Please continue with next the section.";
	} else {
		$uploadMessage  = "Upload failed!";
	}
} else{
	$uploadMessage  = "no file uploaded";
}
?>

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

?>

<main role="main" class="container">

	<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
		<img class="mr-3" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-outline.svg" alt="" width="48" height="48">
			<div class="lh-100">
				<h6 class="mb-0 text-white lh-100">Datasmith helper</h6>
			<small>Since 2011</small>
			</div>
		</div>

	<div class="my-3 p-3 bg-white rounded box-shadow">
		<h6 class="border-bottom border-gray pb-2 mb-0">1. Upload Datasmith file</h6>
		<div class="media text-muted pt-3">
			<form class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray" action="./uploadDatasmithFile.php" method="post" enctype="multipart/form-data">
				<p><strong class="d-block text-gray-dark">Select an .udatasmith file to upload:</strong></p>
				<p><input type="file" name="fileToUpload" id="fileToUpload"></p>
				<p><input type="submit" value="Upload File" name="submit"> <? echo $uploadMessage ?></p> 
			</form>
		</div>
	
		<small class="d-block text-right mt-3">
			<a href="#">Help</a>
		</small>
	</div>

	<div class="my-3 p-3 bg-white rounded box-shadow">
		<h6 class="border-bottom border-gray pb-2 mb-0">2. Select Revit Categories</h6>
		<div class="media text-muted pt-3">

<?

	echo '<form class="media-body pb-3 mb-0 lh-125 border-bottom border-gray" action="/action_page.php">';
	echo '<p class="small"><strong class="d-block text-gray-dark">Select categories</strong></p>';
	echo '<div class="form-check">';

	$i = 1;
	foreach($ElementCategories as $category){
		echo '<input class="form-check-input" type="checkbox" id="category' . $i . '" name="category" value="'. $category . '" onClick="getSelectedCategories(this)">';
		echo '<label class="form-check-label" for="category'.$i.'">'.$category.'</label><br>';
		$i++;
	}

	echo '<small class="d-block mt-3"><a href="javascript:toggle(this);">Select All</a></small>';
	//echo '<input type="submit" value="Submit">';
	//echo '<input class="form-check-input" type="checkbox" onClick="toggle(this)" /><p class="small">Select All</p><br/>';
	echo '</div>';
	echo '</form>';
	//echo '<p id="demo"></p>';

?>


		</div>
	
		<small class="d-block text-right mt-3">
			<a href="#">Help</a>
		</small>
	</div>


<div class="my-3 p-3 bg-white rounded box-shadow">
		<h6 class="border-bottom border-gray pb-2 mb-0">3. Export config file</h6>
		<div class="media text-muted pt-3">
			<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
			<p><strong class="d-block text-gray-dark">Copy the following null</strong></p>

			<input type="text" readonly class="form-control" id="demo" placeholder="(Please upload a file)">

			<br>
			<button type="button" class="btn btn-primary" onclick="copyConfigText()">Copy text</button>
			</div>


			

		</div>

	
		<small class="d-block text-right mt-3">
			<a href="#">Help</a>
		</small>
	</div>

</main>

<footer class="footer pt-4 my-md-5 pt-md-5 border-top">
      <div class="container">
        <span class="text-muted">Created by <a href="https://andrewisen.se/" target="_blank">André Wisén</a> - <a href="https://github.com/andrewisen/UE4-Datasmith-setMobility" target="_blank">GitHub Repo</a></span>
      </div>
</footer>

<script>
	function toggle(source) {
		// Credit: Can Berk Guder
		// https://stackoverflow.com/a/386303
		checkboxes = document.getElementsByName('category');
		for(var i=0, n = checkboxes.length;i<n; i++){
			checkboxes[i].checked = true;
		}
		getSelectedCategories();
	}

	function getSelectedCategories(source) {

		string = "";
		checkboxes = document.getElementsByName('category');
		for(var i=0, n=checkboxes.length;i<n;i++) {
			if (checkboxes[i].checked == true){
				string += checkboxes[i].value + ",";
			}

		}
		console.log(string);
		document.getElementById("demo").value = string;
	}


	function copyConfigText() {
		var copyText = document.getElementById("demo");
		copyText.select();
		copyText.setSelectionRange(0, 99999)
		document.execCommand("copy");
	}





</script>
<!-- Bootstrap CDN -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>