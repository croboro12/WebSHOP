<?php
	include 'Komunikacija.php';
	function ime(){
		$cij = $_POST['Ime'];
			$query = "UPDATE `registrirani` SET `ime` = '".$cij."' WHERE `registrirani`.`ID_REG` = ".$_POST['id']."";
			$result=db_query($query);
			if($result){
				return;
			}else{
				echo "nevalja";
			}
		
	}
	function prezime(){
		$naziv = $_POST['Prezime'];
		print_r($naziv );
		$duz = strlen($naziv);
		if($duz < 5){
			return;
		}else{
			$query = "UPDATE `registrirani` SET `prezime` = '".$naziv."' WHERE `registrirani`.`ID_REG` =' ".$_POST['id']."'";
			$result=db_query($query);
			return;
		}
	}
	function mejl(){
		$naziv = $_POST['Mail'];
		$duz = strlen($naziv);
		$query = "SELECT Mail FROM `registrirani` where `Mail`=".$naziv."";
		$result1=db_select($query);
		if($result1) return;
		if($duz < 5){
			return;
		}else{
			$query = "UPDATE `registrirani` SET `Mail` = '".$naziv."' WHERE `registrirani`.`ID_REG` = ".$_POST['id']."";
			$result=db_query($query);
			return;
		}
	}
	function pass(){
		$naziv = $_POST['Pass'];
		$duz = strlen($naziv);
		if($duz < 5){
			return;
		}else{
			$naziv = md5($_POST['Pass']);
			$query = "UPDATE `registrirani` SET `Pass` = '".$naziv."' WHERE `registrirani`.`ID_REG` = ".$_POST['id']."";
			$result=db_query($query);
			return;
		}
	}


	if(!empty($_POST['Prezime'])){
		prezime();
	}
	
	if(!empty($_POST['Ime'])){
		ime();
		
	}
		
	
	if(!empty($_POST['Mail'])){
		mejl();
	}
	if(!empty($_POST['Pass'])){
		pass();
	}
	$BASEDIR = "upload/";
if(move_uploaded_file($_FILES['slika']['tmp_name'], $BASEDIR.$_FILES['slika']['name'])){

	
	$_FILES['slika']['name'] = explode(' ', $_FILES['slika']['name']);
	$_FILES['slika']['name'] = implode('_', $_FILES['slika']['name']);
	
	if (!file_exists($BASEDIR.$_FILES['slika']['name'])) {
		move_uploaded_file($_FILES['slika']['tmp_name'], $BASEDIR.$_FILES['slika']['name']);
	}
	
	$filename= $BASEDIR.$_FILES['slika']['name'];
	
	$data = addslashes(fread(fopen($filename, "r"), filesize($filename)));
	//$data = addslashes(file_get_contents($BASEDIR.$_FILES['slika']['name']), getimageSize($BASEDIR.$_FILES['slika']['name'])); //SQL Injection defence!
	$query = "UPDATE `registrirani` set `Slika`='".$data."' WHERE `registrirani`.`ID_REG` = '".$_POST['id']."'";
	$result =db_query($query);
	if($result){
		
	} else {
		echo("INSERT komanda nije uspjela. Kontaktirajte Web administratora!");
	
	}
}
if($_SESSION['ovlasti']==2){
	header("Location:index1.php");
}
header("Location:urediKorisnika.php?id=".$_POST['id']."");
	
	

?>