<?php
	include 'Komunikacija.php';
	
	$ID_v = (is_numeric($_POST['odabirvr']) ? (int)$_POST['odabirvr'] : 0);
	$cij = (is_numeric($_POST['Cijena']) ? (int)$_POST['Cijena'] : 0);
	$kol = (is_numeric($_POST['Kolicina']) ? (int)$_POST['Kolicina'] : 0);
	$naziv = $_POST['Naziv'];

	
	if($ID_v == 0 or $cij ==0 or $kol==0){
		echo "Uneseni podaci nisu valjani, Cijena i Kolicina su int!!";
	print('</br><a id="gumbicPovratka" href="formaNovog.php" class="btn btn-default">Vrati se natrag</a>');}
	else{
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
	
	$query = "INSERT INTO `proizvod` (`ID_Proizvod`,`Naziv`,`ID_Vrste`,`Kolicina`,`Cijena`,`Slika`) VALUES(NULL,'".$naziv."','" . $ID_v ."','" . $kol ."','" . $cij .	"','".$data."')";
	
	$result =db_query($query);
	
	if($result){
		header("Location:index1.php");
	} else {
		echo("INSERT komanda nije uspjela. Kontaktirajte Web administratora!");
	}
	}else{
		header("Location:formaNovog.php");
	}
	}

?>