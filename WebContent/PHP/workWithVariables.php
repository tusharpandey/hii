<?php
$bookName = "English";
$postedBy = "Ravi";
$phoneNo = "9654309293";
$bookPrice = 100;
$description = "Hi this is a Grammar book";
$message;

$logs = new ShowLogs();

// Fetch Variables from URl
if (isset($bookName) && isset($bookName) && isset($bookName)) {
	if (!empty($bookName) && !empty($bookName) && !empty($bookName)) {
		$logs -> mergeVariable("Fields are filled properly");
		$message = "success";

	} else {
		$message = "Error in Response : Fields are not filled Properly";
	}
} else {
	$message = "Error in Response : Problem in Variable Creation";
	$logs -> mergeVariable("Problem in Field Submussion");
}

// Work with DataBase .
if ($message == "success") {

	$con = mysqli_connect('localhost', 'root', '', 'shb_db');

	if (mysqli_connect_errno()) {
		$logs -> mergeVariable("Failed to connect to MySQL: " . mysqli_connect_error());
	} else {
		$logs -> mergeVariable("connected");
	}

	$query = "Select * from shb";

	$result = mysqli_query($con, $query) or die('Error querying database.');

   $marks = array( 
		"mohammad" => array
		(
		"physics" => 35,	    
		"maths" => 30,	    
		"chemistry" => 39	    
		),
		"qadir" => array
                (
                "physics" => 30,
                "maths" => 32,
                "chemistry" => 29
                ),
                "zara" => array
                (
                "physics" => 31,
                "maths" => 22,
                "chemistry" => 39
                )
	     );
	     

	echo json_encode($marks).'<br />';;

	$mutiArray = array();     

		$i = 0 ;
	while ($row = mysqli_fetch_array($result)) {
		$mutiArray[$i] = "books" ;
		
		$book_id = $row['book_ID'];

		$valueArray = array
                (
                "book_id" => $book_id,
                );

		$mutiArray[$i] = $valueArray ;

		// echo "Book id : ".$book_id.'<br />';
		
		$i ++ ;
	}

	echo json_encode($mutiArray).'<br />';;

}

class ShowLogs {
	function mergeVariable($echo_message) {
		echo $echo_message . '</br>';
	}

}
?>