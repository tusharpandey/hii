<?php 
	require 'BaseClass.php';
	require 'Constants.php';
	$msg = new Messages();
	$res = new Results();

	if(move_uploaded_file($_FILES["file"]["tmp_name"],  "../public_html/images/" . $_FILES['file']['name'])){
		$msg -> statusOfQuery = IMAGE_UPLOADED_SUCCESSFULLY ;
		$status = true ;		
	} 
	else {
		$msg -> statusOfQuery = IMAGE_UPLOADED_UNSUCCESSFULLY ;
		$status = false ;
	}
	$res -> response = array ("status" => $status, "message" => $msg -> statusOfQuery ) ;
	echo json_encode($res->response) ;
?>