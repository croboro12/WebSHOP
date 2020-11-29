<?php
include 'Komunikacija.php';
$kupac = "SELECT ID_REG FROM registrirani where Mail='".$_GET['imekupca']."'";
$idkupca = db_select($kupac);

$query = "INSERT INTO listazelja VALUES(NULL,'".$idkupca[0]['ID_REG']."','".$_GET['idproiz']."')";
$result = db_query($query);
if($result){
	header("Location:proizvodiu.php");
}
?>