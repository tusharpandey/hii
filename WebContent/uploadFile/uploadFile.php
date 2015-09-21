<?php
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ($_FILES["file"]["type"] == "image/png") {
	if ($_FILES["file"]["error"] > 0) {
		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	} else {

		if (file_exists("/images/" . $_FILES["file"]["name"])) {
			echo $_FILES["file"]["name"] . " already exists. ";
			move_uploaded_file($_FILES["file"]["tmp_name"], "/images/" . $_FILES["file"]["name"]);
			echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
		} 
		else {
			move_uploaded_file($_FILES["file"]["tmp_name"], "/images/" . $_FILES["file"]["name"]);
			echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
		}
	}
} else {
	echo "Invalid file";
}
?>