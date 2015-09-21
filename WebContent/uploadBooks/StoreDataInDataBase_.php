<?php

$bookName_ = $_POST["bookName"];
$bookPostedBy_ = $_POST["bookPostedBy"];
$phoneNumber_ = $_POST["phoneNumber"];
$book_price_ = $_POST["book_price"];
$description_ = $_POST["description"];
$tableName_ = $_POST["tableName"];


require 'BaseClass.php';
$msg = new Messages();

if (!empty($bookName_) && !empty($bookPostedBy_) && !empty($phoneNumber_)) {
	$varFileName = $bookName_ ."_". $bookPostedBy_."_".$phoneNumber_."_img.png";

	echo("fileName : " . $_FILES['file']['tmp_name']);
	echo("</br>.fileName : " . $_FILES['file']['name']);
	echo("</br>.fileName : " . $_FILES['file']['type']);
	
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);

	move_uploaded_file($_FILES["file"]["tmp_name"], "../images/" . $varFileName);

	$con = mysqli_connect('mysql.freehostingnoads.net', 'u579942986_tush', 'Tharra@123', 'u579942986_tush');

	$insert_query = "INSERT INTO $tableName_(bookName, bookPostedBy, phoneNumber, book_price, description, imageUrl) 
	 					VALUES ('$bookName_','$bookPostedBy_','$phoneNumber_','$book_price_','$description_','$varFileName')";

	$messageRelatedTo_ActionPerformed;
	$statusOfQuery;

	// http://127.0.0.1/PHP/WebContent/PHP/StoreDataInDataBase.php?bookName=hello&bookPostedBy=hello&phoneNumber=9654309293&book_price=100&description=jello&imageUrl=hello

	$result = mysqli_query($con, $insert_query) or die('Error querying database.');

	if ($result == FALSE) {
		$msg -> messageRelatedTo_ActionPerformed = "Error in Insertion";
		$msg -> statusOfQuery = "failure";
	} else {
		$msg -> messageRelatedTo_ActionPerformed = "Data Inserted Successfully";
		$msg -> statusOfQuery = "Success";
	}

	mysqli_close($con);
} else {
	$msg -> messageRelatedTo_ActionPerformed = "Parameter
	s are not entered";
	$msg -> statusOfQuery = "failure";
}

echo json_encode($msg) . '<br />';
?>