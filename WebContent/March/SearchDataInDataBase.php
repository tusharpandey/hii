<?php
	$searchKey_ = $_GET["searchKey"];
	$limit_ = $_GET["limit"];
	$endLimit = $limit_  ;
	require 'BaseClass.php';
	require 'Constants.php';
	$msg = new Messages();
	$res = new Results();
	$status_dbconnection ;
	$status_networkconnection ;
	$con = mysqli_connect('localhost', 'tharr8ql_tushar', 'Tharra@123', 'tharr8ql_sharebook');
	if (mysqli_connect_errno()){
  		$msg -> statusOfQuery = UNABLE_TO_CONNECT_TO_DB ;
		$status = false ;
	}else{
  		$msg -> statusOfQuery = CONNECTED_TO_DB ;
		$status = true ;
	}
	if ( $status ){
		$query_to_execute = "" ;
		$isSearchingPerformed = true ;
		$result = false ;
		if ( !empty($searchKey_) ){
			$query_to_execute = "Select * from  ShareBook WHERE book_title LIKE '%{$searchKey_}%' limit 10 ";
		 	$result = mysqli_query($con, $query_to_execute) or die('Error querying database.');
		}else{
			$query_to_execute = "Select * from  ShareBook limit $limit_ , 10";
		 	$result = mysqli_query($con, $query_to_execute) or die('Error querying database.');
		}
	 	if ( $result ){
			$status = true ;
	 		$msg -> statusOfQuery = QUERY_EXECUTED_SUCCESSFULLY ;
			$i = -1 ;
			while ($row = mysqli_fetch_array($result)) {
				$i++;
				$book_title_ = $row["book_title"];
				$book_subtitle_ = $row["book_subtitle"];
				$book_imagelarge_ = "http://www.tharra.org/images/".$row["book_imagelarge"];
				$book_imagesmall_ = "http://www.tharra.org/images/".$row["book_imagesmall"];
				$book_coststatus_ = $row["book_coststatus"];
				$book_uploadercontactnumber_ = $row["book_uploadercontactnumber"];
				$book_uploadername_ = $row["book_uploadername"];
				$book_locationlat_ = $row["book_locationlat"];
				$book_locationlong_ = $row["book_locationlong"];
				$android_device_id_ = $row["android_device_id"];
				$book_uploaderemail_ = $row["book_uploaderemail"];
				$book_uploadtime_ = $row["book_uploadtime"];
				$book_uploaderaddress_ = $row["book_uploaderaddress"];
				
				$res -> listArray[$i] = array("book_title" => $book_title_, "book_subtitle" => $book_subtitle_, 
												"book_imagelarge" => $book_imagelarge_, "book_imagesmall" => $book_imagesmall_, 
												"book_coststatus" => $book_coststatus_, "book_uploadercontactnumber" => $book_uploadercontactnumber_, 
												"book_uploadername" => $book_uploadername_, "book_locationlat" => $book_locationlat_, 
												"book_locationlong" => $book_locationlong_, "android_device_id" => $android_device_id_sssss,
												"book_uploaderemail" => $book_uploaderemail_, "book_uploadtime" => $book_uploadtime_,
												"book_uploaderaddress" => $book_uploaderaddress_
												);
			}
	 	}else{
	 		$msg -> statusOfQuery = QUERY_EXECUTED_UNSUCCESSFULLY ;
			$status = false ;
	 	}	
		if ( $i == -1 ){
			$res -> pageCache = -1 ;
			$msg -> statusOfQuery = NO_MORE_PRODUCTS_FOUND ;
		}else{
			$res -> pageCache = $endLimit + $i + 1 ;
		}
		mysqli_close($con);
	}
	if ( $status ){
		$res -> response = array ("status" => $status, "message" => $msg -> statusOfQuery ) ;
		echo json_encode($res) ;
	}else{
		$res -> response = array ("status" => $status, "message" => $msg -> statusOfQuery ) ;
		echo json_encode($res -> response) ;
	}
?>