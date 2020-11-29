<?php
include 'Komunikacija.php';
if(isset($_GET['id'])){
	$query = "DELETE FROM `proizvod` where ID_Proizvod='".$_GET['id']."'";
	$result = db_query($query);
	if($result){
		header("Location: proizvodiu.php");
	}
}
?>