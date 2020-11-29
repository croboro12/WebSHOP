<?php
session_start();
include 'Komunikacija.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
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
        <li ><a href="index1.php">Home</a></li>
        <li class="active"><a href="proizvodiu.php">Proizvodi</a></li>
        <li><a href="#">Deals</a></li>
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
        <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php
if(isset($_GET['id'])){
	$query = "SELECT * FROM `proizvod` where ID_Proizvod=".$_GET['id'];	
	$result = db_select($query);
	if(isset($_GET['pretraga'])){
		$href="UrediSliku.php?id=".$_GET['id']."&brojStranice=".$_GET['brojStranice']."&pretraga=".$_GET['pretraga']."";
	}else{
		$href="UrediSliku.php?id=".$_GET['id']."&brojStranice=".$_GET['brojStranice']."";
	}	print('<div class="container-fluid" id="konetenjer">');
		print('<div class="col-xs-6 col-sm-3" style="height:350px; width:300px;">
				<img src="dohvatiSliku.php?id='.$result[0]["ID_Proizvod"].'" class="img-responsive" style="width:100%" alt="Image" id="slika"><br>
				<label class="control-label" style="margin-left:40%;">'.$result[0]["Naziv"].'</label>
				</div>');
		print('<div class="col-xs-6 col-sm-3" style="height:350px; width:400px; ;">
				<label class="control-label" style="margin-left:0%;"><b>Naziv Proizvoda</b>   :                        <small>'.$result[0]['Naziv'].'</small> </label></br></br>
				<label class="control-label" style="margin-left:0%;"><b>Cijena Proizvoda</b>   :                        <small>'.$result[0]['Cijena'].' kn</small> </label></br></br>
				<label class="control-label" style="margin-left:0%;"><b>Kolicina Proizvoda</b>   :                        <small>'.$result[0]['Kolicina'].'</small></label></br></br>
			
');
		print('
				<form method="POST" action="Kupovanje.php" >
				<label class="control-label" style="margin-left:0%;"><b>Zeljena Kolicina</b> :   </label>');
				print('<select name="odabirvr">');
		for($i = 0; $i < $result[0]['Kolicina'] ; $i++){
			print('<option value="'.$i.'">'.($i+1).'</option>');
		}	
	
			print('	</select>');
		$query = "SELECT * FROM `placanje`";	
		$result = db_select($query);
		print('<label class="control-label" style="margin-left:0%;"><b>Nacin Placanja</b> :   </label>');
		
		$query = "SELECT COUNT(*) as br FROM `placanje`";	
		$result1 = db_select($query);
		
		print('<select name="odabirpl">');
		
		for($i = 0; $i < $result1[0]['br'] ; $i++){
			print('<option value="'.$i.'">'.$result[$i]['Naziv_placanja'].'</option>');
		}
			print('	</select>');
			
			print('
				<input type="hidden" name="idslike" value='.$_GET['id'].' />
				 <button type="submit" class="btn btn-primary">Kupi</button>
			</form>');
		
		print('</br></br>	<a id="gumbicPovratka" href="'.$href.'" class="btn btn-default">Vrati se natrag</a>');
		print('	</div>');
		
		print('</div>');
}
?>


<footer class="container-fluid text-center">
  <p>Online Store Copyright</p>  
  <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer>

</body>
</html>
