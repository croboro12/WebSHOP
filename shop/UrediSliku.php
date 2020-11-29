<?php
session_start();
include 'Komunikacija.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Proizvodi</title>
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
        <li class="active"><a href="proizvodiu.php">Proizvodi</a></li>
        <?php
		if($_SESSION['ovlasti']==2){
			print('<li><a href="Kupnje.php">Moje Kupnje</a></li>');
		}else{
			if($_SESSION['ovlasti'] == 1){
				print('<li><a href="kupci.php">Kupci</a></li>');
			}
		}
		
		?>
        <li><a href="#">Stores</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
	  <li> 
        <form class="navbar-form" role="search" action="PretragaUl.php" >
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="q">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        </form>
   </li>
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user'] ?></a></li>
		<li><a href="logout.php">LogOut</a></li>
       <?php
		if($_SESSION['ovlasti']==2){
			print(' <li><a href="zelje.php"><span class="glyphicon glyphicon-shopping-cart"></span>Moje Zelje</a></li>');
		}else{
			if($_SESSION['ovlasti'] == 1){
				print(' <li><a href="Kosarice.php"><span class="glyphicon glyphicon-shopping-cart"></span>Kosarice</a></li>');
			}
		}
		
		?>
      </ul>
    </div>
  </div>
</nav>

<?php
if(isset($_GET['id'])){
	$query = "SELECT * FROM `proizvod` where ID_Proizvod=".$_GET['id'];	
	$result = db_select($query);
	if(isset($_GET['pretraga'])){
		$href="PretragaUl.php?brojStranice=".$_GET['brojStranice']."&q=".$_GET['pretraga']."";
	}else{
		$href="proizvodiu.php?brojStranice=".$_GET['brojStranice']."";
	}
	if(($result[0]['Kolicina'])>0){
		$dostupno = "Dostupno za kupnju";
		$dost = 1;
	}else{
		$dostupno = "NEDOSTUPNO(nedovoljno robe u skladistu)";
		$dost = 0;
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
			
				<a id="gumbicPovratka" href="'.$href.'" class="btn btn-default">Vrati se natrag</a>');
		if($_SESSION['ovlasti'] ==1){
			print('<a id="gumbicPovratka" href="IzbrisiZapis.php?id='.$_GET['id'].'" class="btn btn-default">Izbrisi Zapis</a>');
			print('<a id="gumbicPovratka" href="UrediZapis.php?id='.$_GET['id'].'" class="btn btn-default">Uredi Zapis</a>');
		}
		if($dost == 1){
			if(isset($_GET['pretraga'])){
				print('<a id="gumbicPovratka" href="Kupnja.php?id='.$_GET["id"].'&brojStranice='.$_GET["brojStranice"].'&pretraga='.$_GET['pretraga'].'" class="btn btn-default">Kupi</a>');
			}else{
			print('<a id="gumbicPovratka" href="Kupnja.php?id='.$_GET["id"].'&brojStranice='.$_GET["brojStranice"].'" class="btn btn-default">Kupi</a>');
			}
			
		}else{
			if($_SESSION['ovlasti']==2){
			$kupac = "SELECT ID_REG FROM registrirani where Mail='".$_SESSION['user']."'";
			$idkupca = db_select($kupac);
			
			$query = "SELECT count(*) as br FROM `listazelja` where id_kupca='".$idkupca[0]['ID_REG']."' and id_proizvod='".$_GET['id']."'";	
			$result = db_select($query);
			
			if($result[0]['br']>0){
					print('<a id="gumbicPovratka" class="btn btn-default">Ovo je na vasoj listi zelja</a>');
			}else{
					print('<a id="gumbicPovratka" href="dodajulistuzelja.php?imekupca='.$_SESSION['user'].'&idproiz='.$_GET['id'].'" class="btn btn-default">Dodaj na listu želja</a>');
			}
			}
		}
		
		print('	</div>');
	
		
		print('</div>');
}
?>


<footer class="container-fluid text-center">
  <p>Nas Web Shop</p>  
	<p><span style="color:red;">@</span>RiTeh</p>
</footer>
</body>
</html>
