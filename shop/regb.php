<?php
include 'Komunikacija.php';

$mail = $_POST['user'];
$pass = md5($_POST['pass']);


$query ="SELECT * FROM `registrirani` where `Mail`='".$mail."'" ;
echo $query;
$result =db_select($query);

if($result){
		header("Location:reg.php?poruka=Ovakav nadimak je zauzet");
		echo "postoji";
}else{
$duzina = strlen($_POST['pass']);
$duzina1 = strlen($_POST['user']);
if($duzina < 6 or $duzina1<5){

header("Location:reg.php?poruka=Zapis prekratak");
echo "kratko";
}else{
	if(empty($_POST['ime'])){
		$ime = "ime";
	}else{
		$ime = $_POST['ime'];
	}
	if(empty($_POST['prezime'])){
		$prez = "prez";
	}else{
		$prez = $_POST['prezime'];
	}
$BASEDIR = "upload/";
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
//	echo $data;
	
	$query = "INSERT INTO `registrirani` (`ID_REG`, `Mail`, `Pass`, `ID_Ovlasti`,`ime`,`prezime`,`Slika`) VALUES (NULL, '".$mail."','".$pass."' ,'2','".$ime."','".$prez."','".$data."')";
	
	$result =db_query($query);
	
}else{
	$query = "INSERT INTO `registrirani` (`ID_REG`, `Mail`, `Pass`,`ID_Ovlasti`, `ime`,`prezime`) VALUES (NULL, '".$mail."','".$pass."' , '2','".$ime."','".$prez."')";
	
	$result =db_query($query);
}

	echo "hahah";
	//echo $query;
	if($result){
		header("Location:login.php");
	} else {
		echo("INSERT komanda nije uspjela. Kontaktirajte Web administratora!");
	}

	
}
}

?>