<?php
	$book_title_ = $_POST["book_title"];
	$book_subtitle_ = $_POST["book_subtitle"];
	$book_imagelarge_ = $_POST["book_imagelarge"];
	$book_imagesmall_ = $_POST["book_imagesmall"];
	$book_coststatus_ = $_POST["book_coststatus"];
	$book_uploadercontactnumber_ = $_POST["book_uploadercontactnumber"];
	$book_uploadername_ = $_POST["book_uploadername"];
	$book_locationlat_ = $_POST["book_locationlat"];
	$book_locationlong_ = $_POST["book_locationlong"];
	$android_device_id_ = $_POST["android_device_id"];
	$book_uploaderemail_ = $_POST["book_uploaderemail"];
	$book_uploadtime_ = $_POST["book_uploadtime"];
	$book_uploaderaddress_ = $_POST["book_uploaderaddress"];
	
	require 'BaseClass.php';
	require 'Constants.php';
	$msg = new Messages();
	$res = new Results();
	$status_dbconnection ;
	$status_networkconnection ;
	
	if (!empty($book_title_) 
	&& !empty($book_subtitle_) && !empty($book_imagelarge_) && !empty($book_coststatus_) 
		&& !empty($book_uploadercontactnumber_) && !empty($book_uploadername_) && !empty($book_locationlat_) 
		&& !empty($book_locationlong_)) {
	
		$msg -> statusOfQuery = INPUTS_ARE_VALID ;
		$status = true ;
	
		$con = mysqli_connect('localhost', 'tharr8ql_tushar', 'Tharra@123', 'tharr8ql_sharebook');
		if (mysqli_connect_errno()){
	  		$msg -> statusOfQuery = UNABLE_TO_CONNECT_TO_DB ;
			$status = false ;
		}else{
	  		$msg -> statusOfQuery = CONNECTED_TO_DB ;
			$status = true ;
		}
		if ( $status ){
			
		$insert_query = "INSERT INTO  ShareBook 
										(  book_title ,  book_subtitle ,  book_imagelarge ,  book_imagesmall ,  book_coststatus , book_uploadercontactnumber ,  book_uploadername ,  book_locationlat ,  book_locationlong ,  android_device_id , book_uploaderemail ,  book_uploadtime ,  book_uploaderaddress ) 
						VALUES 
										(  		'$book_title_',  		 '$book_subtitle_',			  '$book_imagelarge_',				  '$book_imagesmall_',
														  '$book_coststatus_',			  		'$book_uploadercontactnumber_',					  '$book_uploadername_',					 '$book_locationlat_',			  
														  '$book_locationlong_',					  '$android_device_id_',					  '$book_uploaderemail_',			  '$book_uploadtime_',				  
														  '$book_uploaderaddress_'           )"	;
		 							
		 	$result = mysqli_query($con, $insert_query) ;
		 	if ( $result ){
		 		$msg -> statusOfQuery = INSERTION_PERFROMED_SUCCESSFULLY ;
				$status = true ;
		 	}else{
		 		$msg -> statusOfQuery = INSERTION_PERFROMED_UNSUCCESSFULLY ;
				$status = false ;
		 	}	
		}
		mysqli_close($con);
	}
	else{
	  		$msg -> statusOfQuery = INPUTS_ARE_NOT_VALID ;
			$status = false ;
	}
	$res -> response = array ("status" => $status, "message" => $msg -> statusOfQuery ) ;
	echo json_encode($res->response) ;
?>
