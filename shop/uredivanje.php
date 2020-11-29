<?php
	include 'Komunikacija.php';
	function cijena(){
		$cij = (is_numeric($_POST['Cijena']) ? (int)$_POST['Cijena'] : 0);
		if($cij ==0){
			echo "Uneseni podaci nisu valjani, Cijena i Kolicina su int!!";
			return;}
		else{
			$query = "UPDATE `proizvod` SET `Cijena` = '".$cij."' WHERE `proizvod`.`ID_Proizvod` = ".$_POST['id']."";
			$result=db_query($query);
			if($result){
				return;
			}else{
				echo "nevalja";
			}
		}
	}
	function naziv(){
		$naziv = $_POST['Naziv'];
		$duz = strlen($naziv);
		if($duz < 5){
			return;
		}else{
			$query = "UPDATE `proizvod` SET `Naziv` = '".$naziv."' WHERE `proizvod`.`ID_Proizvod` = ".$_POST['id']."";
			$result=db_query($query);
			return;
		}
	}
	function kolicina(){
		$kol = (is_numeric($_POST['Kolicina']) ? (int)$_POST['Kolicina'] : 0);
		if($kol==0){
			echo "Uneseni podaci nisu valjani, Cijena i Kolicina su int!!";
			return;}
		else{
			$query = "UPDATE `proizvod` SET `Kolicina` = '".$kol."' WHERE `proizvod`.`ID_Proizvod` = ".$_POST['id']."";
			$result=db_query($query);
			if($result){
				return;
			}else{
				echo "nevalja";
			}
		}
	}
	function vrsta(){
		$query = "UPDATE `proizvod` SET `ID_Vrste`=".$_POST['odabirvr']." where `ID_Proizvod`=".$_POST['id']."";
		$result=db_query($query);
	}
	$ID_v = (is_numeric($_POST['odabirvr']) ? (int)$_POST['odabirvr'] : 0);
	if(!empty($_POST['Cijena'])){
		cijena();
	}
	
	if(!empty($_POST['Kolicina'])){
		kolicina();
		
	}
		
	
	if(!empty($_POST['Naziv'])){
		naziv();
	}
	$query = "SELECT ID_Vrste FROM `proizvod` where `ID_Proizvod`=".$_POST['id']."";
	$result1=db_select($query);
	
	$idvr = $result1[0]['ID_Vrste'];
	if($idvr != $_POST['odabirvr']){
		vrsta();
	}
	$BASEDIR = "upload/";
if(move_uploaded_file($_FILES['slika']['tmp_name'], $BASEDIR.$_FILES['slika']['name'])){

	if (!file_exists($BASEDIR)) mkdir($BASEDIR, 755);
	
	$_FILES['slika']['name'] = explode(' ', $_FILES['slika']['name']);
	$_FILES['slika']['name'] = implode('_', $_FILES['slika']['name']);
	
	if (!file_exists($BASEDIR.$_FILES['slika']['name'])) {
		move_uploaded_file($_FILES['slika']['tmp_name'], $BASEDIR.$_FILES['slika']['name']);
	}
	
	$filename= $BASEDIR.$_FILES['slika']['name'];
	
	$data = addslashes(fread(fopen($filename, "r"), filesize($filename)));
	//$data = addslashes(file_get_contents($BASEDIR.$_FILES['slika']['name']), getimageSize($BASEDIR.$_FILES['slika']['name'])); //SQL Injection defence!
	$query = "UPDATE `proizvod` set `Slika`='".$data."' WHERE `proizvod`.`ID_Proizvod` = ".$_POST['id']."";
	$result =db_query($query);
	if($result){
		
	} else {
		echo("INSERT komanda nije uspjela. Kontaktirajte Web administratora!");
	
	}
}
	
	header("Location:UrediZapis.php?id=".$_POST['id']."");
	
	

?>