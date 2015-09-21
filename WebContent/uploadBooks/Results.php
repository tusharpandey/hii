<?php

require 'BaseClass.php';
$res = new Results();

if (isset($_GET["limit"])) {
	$limit = $_GET["limit"];
	$tableName_ = $_GET["tableName"];
	$endLimit = $limit + 10;

	$con = mysqli_connect('mysql.freehostingnoads.net', 'u579942986_tush', 'Tharra@123', 'u579942986_tush');

	$select_query = "select * from  $tableName_ limit $limit , 10 ";

	echo $select_query."</br>" ;

	$result = mysqli_query($con, $select_query) or die('Error querying database.');
	if ($result == FALSE) {

		$res -> messageRelatedTo_ActionPerformed = "Error in Query submisson";
		$res -> statusOfQuery = "failure";

		$res -> pageCache = 0;
	} else {

		$res -> messageRelatedTo_ActionPerformed = "Data Inserted Successfully";
		$res -> statusOfQuery = "Success";

		$i = 0;

		while ($row = mysqli_fetch_array($result)) {

			$book_id = $row['book_ID'];
			$bookName = $row['bookName'];
			$bookPostedBy = $row['bookPostedBy'];
			$phoneNumber = $row['phoneNumber'];
			$book_price = $row['book_price'];
			$description = $row['description'];
			$imageUrl = $row['imageUrl'];

			$res -> listArray[$i] = array("book_ID" => $book_id, "bookName" => $bookName, "bookPostedBy" => $bookPostedBy, "phoneNumber" => $phoneNumber, "book_price" => $book_price, "description" => $description, "imageUrl" => $imageUrl);

			$i++;
		}

		$res -> pageCache = $endLimit;
	}
} else {
	$res -> messageRelatedTo_ActionPerformed = "Error in Query submisson";
	$res -> statusOfQuery = "failure";

	$res -> pageCache = 0;

}
echo json_encode($res) . '<br />';
?>

