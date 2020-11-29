<?php
	/**
	 * Display image form database
	 *
	 * Retrive an image from mysql database if image id is provided.
	 *
	 * @example to display a image with image id 1, place <img src="image.php?id=1" > in your html file.
	 *
	 * @author Md. Rayhan Chowdhury
	 * @copyright www.raynux.com
	 * @license LGPL
	 */

	// verify request id.


	$imageId = $_GET['id'];

	//connect to mysql database
	if ($conn = mysqli_connect('localhost', 'root', 'vertrigo', 'baza')) {
		
		$sql = "SELECT type, content FROM images where id = {$imageId}";

		if ($rs = mysqli_query($conn, $sql)) {
			$imageData = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			mysqli_free_result($rs);
		} else {
			echo "Error: Could not get data from mysql database. Please try again.";
		}
		//close mysqli connection
		mysqli_close($conn);

	} else {
		echo "Error: Could not connect to mysql database. Please try again.";
	}	

	if (!empty($imageData)) {
		// show the image.
		header("Content-type: {$imageData['type']}");
		echo $imageData['content'];
	}
?>