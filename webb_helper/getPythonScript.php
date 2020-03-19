<?php
	// Credit: Victor
	// https://stackoverflow.com/a/15758129
	header('Content-Type: application/json');
		$aResult = array();

	if( !isset($_POST['functionname']) ) {
		$aResult['error'] = 'No function name!';
	}

	if( !isset($_POST['arguments']) ) {
		$aResult['error'] = 'No function arguments!';
	}

	if( !isset($aResult['error']) ) {

		switch($_POST['functionname']) {
			case 'add':
				
				if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
					$aResult['error'] = 'Error in arguments!';
				}
				break;

			default:
				$aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
				break;
		}

	}

	$file = 'https://raw.githubusercontent.com/andrewisen/UE4-Datasmith-setMobility/master/UE4_Script/setMobility.py';
	$s_target = "./uploads/setMobility.py";

	$s_find = 'metadataValues = ["Furniture"]';
	$s_replace = 'metadataValues = ' . $_POST['arguments'][0];
	
	file_put_contents($s_target,str_replace($s_find,$s_replace,file_get_contents($file)));
	
?>