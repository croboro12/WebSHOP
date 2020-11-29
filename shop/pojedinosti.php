<?php
include 'Komunikacija.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Pojedinosti</title>
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
	#gumbicPovratka{
		margin-left:0%;
	}
  </style>
  
</head>
<body>

<div class="jumbotron">
  <div class="container text-center">
		<img src="banner-shop.gif" style="width:100%;" class="img-responsive" alt="Cinque Terre">
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
    
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li ><a href="index.php">Početna</a></li>
        <li class="active"><a href="proizvodi.php">Proizvodi</a></li>
        <li><a href="#">O nama</a></li>
        <li><a href="#">Stores</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right"> <li> 
        <form class="navbar-form" role="search" action="Pretraga.php" >
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="q">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        </form>
   </li>
       <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
         <li><a href="reg.php"><span class="glyphicon glyphicon-user"></span>Registriraj se</a></li>
      </ul>
    </div>
  </div>
</nav>
<?php
if(isset($_GET['id_slike'])){
	$query = "SELECT * FROM `proizvod` where ID_Proizvod=".$_GET['id_slike'];	
	$result = db_select($query);
	if(isset($_GET['pretraga'])){
		$href="Pretraga.php?brojStranice=".$_GET['brojStranice']."&q=".$_GET['pretraga']."";
	}else{
		$href="proizvodi.php?brojStranice=".$_GET['brojStranice']."";
	}
	if(($result[0]['Kolicina'])>0){
		$dostupno = "Dostupno za kupnju";
	}else{
		$dostupno = "NEDOSTUPNO(nedovoljno robe u skladistu)";
	}
	print('<div class="container-fluid" id="konetenjer">');
		print('<div class="col-xs-6 col-sm-3" style="height:350px; width:300px;">
				<img src="dohvatiSliku.php?id='.$result[0]["ID_Proizvod"].'" class="img-responsive" style="width:100%" alt="Image" id="slika"><br>
				<label class="control-label" style="margin-left:40%;">'.$result[0]["Naziv"].'</label>
				</div>');
		print('<div class="col-xs-6 col-sm-3" style="height:350px; width:400px; ;">
				<label class="control-label" style="margin-left:0%;"><b>Naziv Proizvoda</b>   :                        <small>'.$result[0]['Naziv'].'</small> </label></br></br>
				<label class="control-label" style="margin-left:0%;"><b>Cijena Proizvoda</b>   :                        <small>'.$result[0]['Cijena'].' kn</small> </label></br></br>
				<label class="control-label" style="margin-left:0%;"><b>Kolicina Proizvoda</b>   :                        <small>'.$result[0]['Kolicina'].'  ----  '.$dostupno.'</small></label></br></br>
			
				<a id="gumbicPovratka" href="'.$href.'" class="btn btn-default">Vrati se natrag</a>
					<label class="control-label" style="margin-left:0%;">DA BI OBAVILI KUPNJU MORATE BITI REGISTRIRANI KORISNIK OVE STRANICE!</label></br></br>
				</div>');
	
		
		print('</div>');
}

?>
<footer class="container-fluid text-center">
  <p>Nas Web Shop</p>  
	<p><span style="color:red;">@</span>RiTeh</p>
</footer>

</body>
</html>
