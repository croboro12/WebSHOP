<?php
include 'Komunikacija.php';
session_start();
$query = "SELECT COUNT(*) as br FROM `proizvod` where `Naziv` LIKE '%".$_GET['q']."%'";
$result=db_select($query);
$TrazenihProizvoda = $result[0]['br'];




if(isset($_GET['brojStranice'])){
	$brojstr =(int)$_GET['brojStranice'];
}else{
	$brojstr= 1;
}
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
    width:  100px;
    height: 100px;
    background-position: 50% 50%;
    background-repeat:   no-repeat;
    background-size:     cover;
}
   <?php
$j = 0;
for($j = 0; $j< $TrazenihProizvoda; $j++){
	print('.middle'.$j.' {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%)
}

.panel-body'.$j.':hover .image-responsive'.$j.' {
  opacity: 0.3;
}

.panel-body'.$j.':hover .middle'.$j.' {
  opacity: 1;
}
.image-responsive'.$j.'{
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}');
}
?>
.text {
  background-color: #3266ba ;
  color: white;
  font-size: 16px;
  padding: 16px 32px;
}
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
	.pagination {
		
	margin-left:40%;
    display: inline-block;
}

.pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
}

.pagination a.active {
    background-color: #4CAF50;
    color: white;
    border-radius: 5px;
}

.pagination a:hover:not(.active) {
    background-color: #ddd;
    border-radius: 5px;
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
      <ul class="nav navbar-nav navbar-right"> <li> 
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

if($brojstr > 1){
	$gornjagranica=8*$brojstr;
	$i = $gornjagranica - 8;
	if($TrazenihProizvoda<8*$brojstr){
		$gornjagranica=$TrazenihProizvoda-1;
	}else{
		$gornjagranica=8*$brojstr-1;
	}
}else{
	$i = 0;
	if($TrazenihProizvoda>8){
		$gornjagranica=7;
	}else{
		$gornjagranica=$TrazenihProizvoda-1;
	}
}
$pocetak = $i;
/*echo $pocetak;
echo "Hahhaah";
echo $i;
echo "Hahhaah";
echo $gornjagranica;*/
$query = "SELECT ID_Proizvod,Naziv,Cijena FROM `proizvod` where `Naziv` LIKE '%".$_GET['q']."%'";	
$result = db_select($query);
print('<div class="container-fluid" id="konetenjer">');
for($pocetak; $pocetak <= $gornjagranica ; $pocetak++){
	if($pocetak == $i or $pocetak == ceil((($gornjagranica/2)))) {
		print(' <div class="row">');

	}
	print('<div class="col-xs-6 col-sm-3"  margin-left:10px;"> <div class="panel panel-primary "><div class="panel-heading"><label class="control-label" style="margin-left:40%;">'.$result[$pocetak]["Naziv"].'</label></a></div><div class="panel-body'.$pocetak.'
			<a href="pojedinosti.php?id_slike='.$result[$pocetak]["ID_Proizvod"].'&brojStranice='.$brojstr.'"><img src="dohvatiSliku.php?id='.$result[$pocetak]["ID_Proizvod"].'" class="img-responsive'.$pocetak.'"  " style="height:200px; width:300px;
			
			" alt="Image" id="slika">
<br><div class="middle'.$pocetak.' ">
');
			if($_SESSION['ovlasti']==1){
				print('<a  href="UrediSliku.php?id='.$result[$pocetak]["ID_Proizvod"].'&brojStranice='.$brojstr.'" class="text">Kupi</a>');
				print('<a  href="UrediSliku.php?id='.$result[$pocetak]["ID_Proizvod"].'&brojStranice='.$brojstr.'" class="text">Uredi</a>');
			}else{
				print('<a  href="UrediSliku.php?id='.$result[$pocetak]["ID_Proizvod"].'&brojStranice='.$brojstr.'" class="text">Kupi</a>');
			}

			print('

			</div>
			</div><div class="panel-footer">Cijena: <i>'.$result[$pocetak]['Cijena'].' kn/kom</i></div></div> </div>');

	if($pocetak == $i+3 or $pocetak == $i+7){
		print(' <div class="clearfix visible-xs"></div>');
	}

	
	if($pocetak == 3 or $pocetak == $gornjagranica){
	print('</div>');

	}
		
}
print('</div>');
	if($TrazenihProizvoda>8){
		$brojstranica = ceil($TrazenihProizvoda/8);
	}else{
		$brojstranica = 1;
	}
	print('<div class="pagination">
			<a href="#">&laquo;</a>');

	for($i = 1; $i <= $brojstranica; $i++){
		if($brojstr == $i){
			print('<a href="#" class=active>'.$i.'</a>');
		}else{
			print('<a href="?q='.$_GET['q'].'&brojStranice='.$i.'">'.$i.'</a>');
		}
	}
	print('<a href="#">&raquo;</a>
			</div>');
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
