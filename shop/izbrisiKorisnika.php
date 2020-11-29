<?php
include 'Komunikacija.php';
if(isset($_GET['id'])){

	$query ="DELETE FROM `registrirani` where ID_REG=".$_GET['id']."";
	$result = db_query($query);
	header("Location:kupci.php");
}
?>