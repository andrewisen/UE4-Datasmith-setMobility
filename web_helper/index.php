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
		<link rel="icon" type="image/png" href="./img/favicon.png">
		<link rel="icon" type="image/x-icon" href="./img/favicon.ico">
	</head>

	<body class="bg-light" onload="forceReload()">

	<?php
		function getDatasmithData($fileName){


			$ElementCategories = array();
			$file = "./uploads/" . $fileName . ".udatasmith";


			if (file_exists($file)) {
				echo "The file $file  exists";
			} else {
				echo "The file $file  does not exist";
				echo "<script type='text/javascript'>" . "document.getElementById('listCategories').innerHTML = '". "nooo file" . "'" . "</script>" ;
				return 0;

			}


			$xmlData = file_get_contents($file);
			unlink($file);

			$xmlData = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $xmlData);


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
			return $ElementCategories;
		}

	?>

	<main role="main" class="container">
		<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
			<img class="mr-3" src="./img/icon.svg" alt="" width="48" height="48">
				<div class="lh-100">
					<h6 class="mb-0 text-white lh-100">Datasmith Helper</h6>
				<small>Python script that sets the mobility based on Revit Category</small>
				</div>
			</div>

		<div id="div-about" class="my-3 p-3 bg-white rounded box-shadow">
			<h6 class="border-bottom border-gray pb-2 mb-0">About</h6>
			<div class="media text-muted pt-3">
				<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
					Given an Autodesk Revit model. Assume one wants to create a game/application where users can try different layouts. I.e. move the furnitures around and find the best placement.  
				</p>
			</div>
		
			<small class="d-block text-right mt-3">
				<a href="#" data-toggle="modal" data-target="#helpModalAbout">More Info</a>
			</small>
		</div>

		<div id="div-01" class="my-3 p-3 bg-white rounded box-shadow">
			<h6 class="border-bottom border-gray pb-2 mb-0">1. Upload Datasmith file</h6>
			<div class="media text-muted pt-3">
				<form class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray" action="./uploadDatasmithFile.php" method="post" enctype="multipart/form-data">
					<p><strong class="d-block text-gray-dark">Choose an .udatasmith file to upload.</strong></p>
					<p><input type="file" name="fileToUpload" id="fileToUpload"></p>
					<p><input type="submit" value="Upload File" name="submit"> <text id="uploadMessage"></text></p> 
				</form>
			</div>
		
			<small class="d-block text-right mt-3">
				<a href="#" data-toggle="modal" data-target="#helpModal01">Help</a>
			</small>
		</div>

		<div id="div-02" class="my-3 p-3 bg-white rounded box-shadow">
			<h6 class="border-bottom border-gray pb-2 mb-0">2. Select Revit Categories</h6>
			<div id="listCategories" class="media text-muted pt-3">

			</div>
		
			<small class="d-block text-right mt-3">
				<a href="#" data-toggle="modal" data-target="#helpModal02">Help</a>
			</small>
		</div>


	<div id="div-03" class="my-3 p-3 bg-white rounded box-shadow">
			<h6 class="border-bottom border-gray pb-2 mb-0">3. Export config file</h6>
			<div class="media text-muted pt-3">
				<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
				<p><strong class="d-block text-gray-dark">Copy the following null</strong></p>

				<input type="text" readonly class="form-control" id="demo" placeholder="(Please select a category)">

				<br>

				<button type="submit" type="button" class="btn btn-primary" id="downloadPythonButton">Download Pyhton Script</button>
				<button type="button" class="btn btn-secondary" onclick="copyConfigText()">Copy text</button>
				</div>
			</div>
			<small class="d-block text-right mt-3">
				<a href="#" data-toggle="modal" data-target="#helpModal03">Help</a>
			</small>
		</div>
	</main>

	<footer class="footer pt-4 my-md-5 pt-md-5 border-top">
	      <div class="container">
	        <span class="text-muted">Created by <a href="https://andrewisen.se/" target="_blank">André Wisén</a> - <a href="https://github.com/andrewisen/UE4-Datasmith-setMobility" target="_blank">GitHub Repo</a></span>
	      </div>
	</footer>

	<!-- Modal About -->
	<div class="modal fade" id="helpModalAbout" tabindex="-1" role="dialog" aria-labelledby="helpModalAbout" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">About Datasmith Helper</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
				<p>Epic Games's Unreal Datasmith (<code>.udatasmith</code>) is a file standard that is used to import 3D scenes into Unreal Engine projects.</p>
				<p>See: <a href="https://docs.unrealengine.com/en-US/Engine/Content/Importing/Datasmith/SoftwareInteropGuides/Revit/InstallingExporterPlugin/index.html" target="_blank">Installing the Datasmith Exporter Plugin for Revit</a></p>
				<p>See: <a href="https://docs.unrealengine.com/en-US/Engine/Content/Importing/Datasmith/SoftwareInteropGuides/Revit/ExportingDatasmithContentfromRevit/index.html" target="_blank">Exporting Datasmith Content from Revit</a></p>

				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-primary"  data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal 01 -->
	<div class="modal fade" id="helpModal01" tabindex="-1" role="dialog" aria-labelledby="helpModal01" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">1. Upload Datasmith file</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
				<p>Epic Games's Unreal Datasmith (<code>.udatasmith</code>) is a file standard that is used to import 3D scenes into Unreal Engine projects.</p>
				<p>See: <a href="https://docs.unrealengine.com/en-US/Engine/Content/Importing/Datasmith/SoftwareInteropGuides/Revit/InstallingExporterPlugin/index.html" target="_blank">Installing the Datasmith Exporter Plugin for Revit</a></p>
				<p>See: <a href="https://docs.unrealengine.com/en-US/Engine/Content/Importing/Datasmith/SoftwareInteropGuides/Revit/ExportingDatasmithContentfromRevit/index.html" target="_blank">Exporting Datasmith Content from Revit</a></p>

				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-primary"  data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal 02 -->
	<div class="modal fade" id="helpModal02" tabindex="-1" role="dialog" aria-labelledby="helpModal02" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">2. Select Revit Categories</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
				<p>Use the checkbox to select one or mulltiple <code>Revit categories</code> that you wish to use to use the Python script with.</p>
				<p>Please note that the categories are derived from the file you've uploaded. A list of all the categories can be found <a href="https://forum.dynamobim.com/t/list-of-all-revit-categories/1732" target="_blank">here</a>.</p>
				
				<div class="alert alert-primary" role="alert">
					<p><b>Category:</b> A Category controls the organization, visibility, graphical representations, and scheduling options of Families within the Project.</p>
					<p><b>Family:</b> A Family is a grouping of 2D and/or 3D information that serves to represent a discrete building or documentation element in the Project. It defines parametric, graphical, and documentation requirements.</p>
					<p><b>Type:</b> A Type is a specific representation in a Family defined by distinct parametric, Type graphical, and documentation characteristics which makes it unique from other Types in the Family.</p>
					<p><b>Instance:</b> An Instance is an individual representation of a Type in the Project defined by unique parametric, graphical, and documentation characteristics which makes it unique from other Instances in the Project</p>
				</div>
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-primary"  data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap CDN -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="   crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<script>
		function forceReload(){
			if (!window.location.href.split("?")[1]){return;}
			// do stuff
		}

		function toggleDIV(divID) {
			
			var x = document.getElementById(divID);
			if (x.style.display === "none") {
				x.style.display = "block";
			} else {
				x.style.display = "none";
			}
		}

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

			var string = "";
			string += "["
			checkboxes = document.getElementsByName('category');
			for(var i=0, n=checkboxes.length;i<n;i++) {
				if (checkboxes[i].checked == true){

					string += checkboxes[i].value + ", ";
				}

			}
			string = string.substring(0, string.length - 2);
			if (string.length>0){
				string += "]";	
			}
			console.log(string);
			document.getElementById("demo").value =  string;
		}
		$(document).ready(function(){

			$('#downloadPythonButton').click(function(){
				var url = $("#demo").val();
				url = '"' + url + '"';
				
				// Credit: Victor
				// https://stackoverflow.com/a/15758129
				$.ajax({
					type: "POST",
					url: 'getPythonScript.php',
					dataType: 'json',
					data: {functionname: 'add', arguments: [url]},

					success: function (obj, textstatus) {
					      if( !('error' in obj) ) {
					          yourVariable = obj.result;
					          alert('A');
					      }
					      else {
					          console.log(obj.error);
					          alert('B');
					      }
					}
				});
				
				window.open("./forceDownload.php", "_blank",);

			});
		});

		function copyConfigText() {
			var copyText = document.getElementById("demo");
			copyText.select();
			copyText.setSelectionRange(0, 99999)
			document.execCommand("copy");
		}

	</script>

	<?
		// Main php function 
		if(!empty($_GET)){
			$status = $_GET['status'];
			if ($status=="fileUploaded"){
				$uploadMessage  = "File uploaded successfully!";
				$ElementCategories = getDatasmithData();
				echoDatamsithData($ElementCategories);
			} else {
				$uploadMessage  = "Upload failed!";
				echo '<script type="text/javascript">' . 'toggleDIV("div-02");' . '</script>' ;
				echo '<script type="text/javascript">' . 'toggleDIV("div-03");' . '</script>' ;
			}
			echo "<script type='text/javascript'>" . "document.getElementById('uploadMessage').innerHTML = '". $uploadMessage . "'" . "</script>" ;
		} else {
			$uploadMessage  = "no file uploaded";
			echo '<script type="text/javascript">' . 'toggleDIV("div-03");' . '</script>' ;
			echo '<script type="text/javascript">' . 'toggleDIV("div-02");' . '</script>' ;

			echo "<script type='text/javascript'>" . "document.getElementById('uploadMessage').innerHTML = '". $uploadMessage . "'" . "</script>" ;

		}

		function main(){

		}

		function echoDatamsithData($ElementCategories){
			$div = "";
			$div .= 
			$div .=  '<form class="media-body pb-3 mb-0 lh-125 border-bottom border-gray" action="/action_page.php">';
			$div .=  '<p class="small"><strong class="d-block text-gray-dark">Select the Revit categories that you wish to use.</strong></p>';
			$div .=  '<div class="form-check">';

			$i = 1;
			foreach($ElementCategories as $category){
				$div .=  '<input class="form-check-input" type="checkbox" id="category' . $i . '" name="category" value="'. $category . '" onClick="getSelectedCategories(this)">';
				$div .=  '<label class="form-check-label" for="category'.$i.'">'.$category.'</label><br>';
				$i++;
			}

			$div .=  '<small class="d-block mt-3"><a href="javascript:toggle(this);">Select All</a></small>';
			//echo '<input type="submit" value="Submit">';
			//echo '<input class="form-check-input" type="checkbox" onClick="toggle(this)" /><p class="small">Select All</p><br/>';
			$div .=  '</div>';
			$div .=  '</form>';
			//echo '<p id="demo"></p>';
			echo "<script type='text/javascript'>" . "document.getElementById('listCategories').innerHTML = '". $div. "'" . "</script>" ;
		}
	?>
	</body>
</html>