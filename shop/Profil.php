<?php
session_start();
include 'Komunikacija.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profil</title>
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
	$query = "SELECT * FROM `registrirani` where ID_REG=".$_GET['id'];	
	$result = db_select($query);
	print('<div class="container-fluid" id="konetenjer">');
		print('<div class="col-xs-6 col-sm-3" style="height:350px; width:300px;">');
	if($result){
		
		if($result[0]['Slika']){
			print('	<img src="dohvatiSlikup.php?id='.$result[0]["ID_REG"].'" class="img-responsive" style="width:100%" alt="Image" id="slika"><br>
				
				</div>');
		}else{
			print('	<img src="profilna.png" class="img-responsive" style="width:100%" alt="Image" id="slika"><br>
				</div>');
		}
		print('<div class="col-xs-6 col-sm-3" style="height:350px; width:400px; ;">
				<label class="control-label" style="margin-left:0%;"><b>Username</b>   :                        <small>'.$result[0]['Mail'].'</small> </label></br></br>
				<label class="control-label" style="margin-left:0%;"><b>Ime</b>   :                        <small>'.$result[0]['ime'].'</small> </label></br></br>
				<label class="control-label" style="margin-left:0%;"><b>Prezime</b>   :                        <small>'.$result[0]['prezime'].' </small></label></br></br>
				
				<a id="gumbicPovratka" href="proizvodiu.php" class="btn btn-default">Vrati se natrag</a>');
				if($_SESSION['ovlasti']==1){
					print('<a href="izbrisiKorisnika.php?id='.$_GET['id'].'" style="margin-left:0%;" class="btn btn-default">Izbrisi Korisnika</a>');
				}
				
				print('
				<a href="urediKorisnika.php?id='.$_GET['id'].'" class="btn btn-default">Uredi</a></br>');
	
		
		
	}else{
		print('<a id="gumbicPovratka" href="index1.php" class="btn btn-default">Pocetna</a>');
	}
	
	print('	</div>');
	
		
		print('</div>');

?>


<footer class="container-fluid text-center">
  <p>Nas Web Shop</p>  
	<p><span style="color:red;">@</span>RiTeh</p>
</footer>

</body>
</html>
