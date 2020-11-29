<?php
session_start();
include 'Komunikacija.php';
$email = db_quote($_POST['user']);
$pass = db_quote(md5($_POST['pass']));
echo $email;
echo "<br/>";

echo $pass;
$rows = db_select("SELECT * FROM `registrirani` where(`Mail`= ".$email." and `Pass`= ".$pass.")");

if(!$rows)
{
	$_SESSION['poruka'] = "<p><span style='color:red'>Uneseni podaci nisu valjani!</span></p>";
	header( "Location: http://localhost:8080/shop/login.php" );
}else{
	
	$_SESSION['user'] = $_POST['user'];
	$_SESSION['ovlasti'] = $rows[0]['ID_Ovlasti'];
	header( "Location: http://localhost:8080/shop/index1.php" );
}
?>