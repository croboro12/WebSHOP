<?php
include 'Komunikacija.php';
session_start();
$kolicina = $_POST['odabirvr']+1;
$nacinplacanja = $_POST['odabirpl']+1;
$idproizvoda = $_POST['idslike'];
echo $kolicina;
echo $nacinplacanja;
echo $idproizvoda;
$query= "SELECT ID_REG FROM `registrirani` where `Mail`='" . $_SESSION['user']."'";
$result = db_select($query);
$idkupca = $result[0]['ID_REG'];


$query = "SELECT Cijena,Kolicina FROM `proizvod` where ID_Proizvod='".$idproizvoda."'";
$result=db_select($query);
$ukupnoproizvoda = $result[0]['Kolicina'];
$preostalo = $ukupnoproizvoda - $kolicina;
echo "</br> ".$preostalo."</br>";
$ukupno = $kolicina * ($result[0]['Cijena']);
$datum = date("Y-m-d");
$query = "INSERT INTO `kupnja` (`ID_Kupnje`,`Datum`,`ID_Kupca`,`ID_Placa`,`ID_Proizvod`,`Kolicina`,`Ukupno`) VALUES (NULL,'".$datum."','".$idkupca."','".$nacinplacanja."','".$idproizvoda."','".$kolicina."','".$ukupno."')";
$result = db_query($query);
	if($result){
		
		$query = "UPDATE `proizvod` SET `Kolicina` = '".$preostalo."' WHERE `ID_Proizvod` = ".$idproizvoda.";";
		
		$result = db_query($query);

		
		header("Location:proizvodiu.php");
	} else {
		echo("INSERT komanda nije uspjela. Kontaktirajte Web administratora!");
	}
?>