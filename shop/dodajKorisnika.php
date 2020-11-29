<?php
include 'Komunikacija.php';

$mail = $_POST['Mail'];
$pass = md5($_POST['Password']);

$query ="SELECT * FROM `registrirani` where `Mail`='".$mail."'" ;
echo $query;
$result =db_select($query);

if($result){
		header("Location:formaKorisnika.php?poruka=Ovakav zapis vec postoji!");
}else{
$duzina = strlen($_POST['Password']);
$duzina1 = strlen($_POST['Mail']);
if($duzina < 6 or $duzina1<5){

	header("Location:formaKorisnika.php?poruka=Unosi prekratki!");
}else{

$odabir = $_POST['odabirvr'];
if(move_uploaded_file($_FILES['slika']['tmp_name'], $BASEDIR.$_FILES['slika']['name'])){
	$BASEDIR = "upload/";
	if (!file_exists($BASEDIR)) mkdir($BASEDIR, 755);
	
	$_FILES['slika']['name'] = explode(' ', $_FILES['slika']['name']);
	$_FILES['slika']['name'] = implode('_', $_FILES['slika']['name']);
	
	if (!file_exists($BASEDIR.$_FILES['slika']['name'])) {
		move_uploaded_file($_FILES['slika']['tmp_name'], $BASEDIR.$_FILES['slika']['name']);
	}
	
	$filename= $BASEDIR.$_FILES['slika']['name'];
	
	$data = addslashes(fread(fopen($filename, "r"), filesize($filename)));
	//$data = addslashes(file_get_contents($BASEDIR.$_FILES['slika']['name']), getimageSize($BASEDIR.$_FILES['slika']['name'])); //SQL Injection defence!

	
	//print_r($data);
	//echo $data;
	
	$query = "INSERT INTO `registrirani` (`ID_REG`, `Mail`, `Pass`, `ID_Ovlasti`,`ime`,`prezime`,`Slika`) VALUES (NULL, '".$mail."', '".$pass."', '".$odabir."','".$_POST['Ime']."','".$_POST['Prezime']."','".$data."')";
	
	$result =db_query($query);
	
	if($result){
		header("Location:index1.php");
	} else {
		echo("INSERT komanda nije uspjela. Kontaktirajte Web administratora!");
	}

	
}
}
}
?>