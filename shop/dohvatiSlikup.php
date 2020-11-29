<?php
include 'Komunikacija.php';
$id = $_GET['id'];

if($id) {
	if ($conn = mysqli_connect('localhost', 'root', 'vertrigo', 'baza')) {
	
			$sql = "SELECT * FROM registrirani where ID_REG  = {$id}";
	
	
		

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
		header("Content-type: jpeg");
		echo $imageData['Slika'];
	}

}

?>