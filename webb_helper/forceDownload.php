<?php
	$s_target = "./uploads/setMobility.py";

	header("Content-Description: File Transfer"); 
	header("Content-Type: application/octet-stream"); 
	header("Content-Disposition: attachment; filename=\"". basename($s_target) ."\""); 

	readfile ($s_target);

?>