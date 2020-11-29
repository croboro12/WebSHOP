<?php
session_start();
include 'Komunikacija.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kupci</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
       /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
    #konetenjer{
	   margin-left:1%;
   }
   #slika {
    position: relative;
    float: left;
    width:  400px;
    height: 300px;
    background-position: 50% 50%;
    background-repeat:   no-repeat;
    background-size:     cover;
}
  
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
  
</head>
<body>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Online Store</h1>      
    <p>Mission, Vission & Values</p>
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li ><a href="index1.php">Početna</a></li>
        <li ><a href="proizvodiu.php">Proizvodi</a></li>
        <li class="active"><a href="#">Kupci</a></li>
        <li><a href="#">Stores</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
	 <!-- <li> 
        <form class="navbar-form" role="search" action="PretragaUl.php" >
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="q">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        </form>
   </li>-->
	<li><a href="formaKorisnika.php">Dodaj Korisnika</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user'] ?></a></li>
		<li><a href="logout.php">LogOut</a></li>
        <li><a href="Kosarice.php"><span class="glyphicon glyphicon-shopping-cart"></span>Kosarice</a></li>
      </ul>
    </div>
  </div>
</nav>



<?php
function ispis(){
	$query ="
	SELECT a.ID_REG as id, a.Mail as mejl, COUNT(b.ID_Kupca) as br FROM registrirani a 
	JOIN kupnja b on b.ID_Kupca = a.ID_REG
	WHERE a.ID_Ovlasti='2'
	GROUP BY b.ID_Kupca";
	$result = db_select($query);
	if($result){
	//print('<div class="col-xs-6 col-sm-3" id="podaci" style="height:350px; width:500px;">');

	foreach($result as $dio){
		print('<b>ID_Kupca =</b> '.$dio['id'].'<b> Mail = </b>'.$dio['mejl'].'<b> Broj kupnji:</b>'.$dio['br'].'</br>');
	}
	//print('	</div>');
	}else{
		echo "Ovi korisnici nisu kupovali :(";
	}
}
function manipulacija(){
	$query ="
	SELECT * from registrirani where ID_Ovlasti='2'";
	$result = db_select($query);
	if($result){
		
	//print('<div class="col-xs-6 col-sm-3" id="podaci" style="height:350px; width:500px;">');
	foreach($result as $dio){
		
		print('<b>ID_Kupca =</b> '.$dio['ID_REG'].' <b><a href="Profil.php?id='.$dio['ID_REG'].'">Mail = </b>'.$dio['Mail'].'</a>');
		print('<a href="izbrisiKorisnika.php?id='.$dio['ID_REG'].'" style="margin-left:0%;" class="btn btn-default">Izbrisi Korisnika</a>');
		print('<a href="urediKorisnika.php?id='.$dio['ID_REG'].'" class="btn btn-default">Uredi Korisnika</a></br>');

	}
	//print('	</div>');
}else{ 
		//echo "ovaj zapis mora da je obrisan iz baze! :(";
	}
}
$query ="SELECT COUNT(*) as br FROM `registrirani` where `ID_Ovlasti` = '2'";
$result = db_select($query);
$registrirani = $result[0]['br'];

$query ="SELECT COUNT(*) as br FROM `kupnja`";
$result = db_select($query);
$brojkupnji = $result[0]['br'];

$query ="SELECT a.Mail as ime FROM registrirani a 
		JOIN kupnja b on b.ID_Kupca = a.ID_REG
		GROUP BY b.ID_Kupca HAVING COUNT(b.ID_Kupca) =( SELECT MAX(br) FROM(
		SELECT COUNT(*) as  br FROM kupnja
			GROUP BY ID_Kupca
              ) a)";
$result = db_select($query);
if($result){
$najboljikupac = $result[0]['ime'];
}
print('<div class="container-fluid" id="konetenjer"><div class="col-xs-6 col-sm-3" style="height:350px; width:300px;">');
		print('<label class="control-label" style="margin-left:0%;">Trenutni broj registriranih kupaca je: '.$registrirani.'  </label></br></br>');
		print('<label class="control-label" style="margin-left:0%;">Ukupan broj kupnji: '.$brojkupnji.'  </label></br></br>');
		if(isset($najboljikupac)){
					print('<label class="control-label" style="margin-left:0%;">Najbolji Kupac: '.$najboljikupac.'  </label></br></br>');

		}
		print('<form method="POST" action=#><input type="submit" value="Prodaja-podaci" name="Prodaja-podaci" class="btn btn-default"></a></form>');
		print('<form method="POST" action=#><input type="submit" value="Manipulacija" name="Manipulacija" class="btn btn-default"></a></form>');
		
		
	print('	</div>');

	
		
print('<div class="col-xs-6 col-sm-3" id="podaci" style="height:350px; width:400px;">');
if(isset($_POST['Prodaja-podaci'])){
	ispis();
}
if(isset($_POST['Manipulacija'])){
	manipulacija();
	}
print('	</div>');

print('	</div>');
?>


<footer class="container-fluid text-center">
  <p>Nas Web Shop</p>  
	<p><span style="color:red;">@</span>RiTeh</p>
</footer>
</body>
</html>
