<!DOCTYPE html>
<html lang="en">
<head>
  <title>WebShop</title>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
   
   
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
	.text {
  background-color: #3266ba ;
  color: white;
  font-size: 16px;
  padding: 16px 32px;
}
.middle0 {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%)
}

.panel-body0:hover .image-responsive0 {
  opacity: 0.3;
}

.panel-body0:hover .middle0 {
  opacity: 1;
}
.image-responsive0{
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}



.middle1 {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%)
}

.panel-body1:hover .image-responsive1 {
  opacity: 0.3;
}

.panel-body1:hover .middle1 {
  opacity: 1;
}
.image-responsive1{
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}



.middle2 {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%)
}

.panel-body2:hover .image-responsive2 {
  opacity: 0.3;
}

.panel-body2:hover .middle2 {
  opacity: 1;
}
.image-responsive2{
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}



.middle3 {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%)
}

.panel-body3:hover .image-responsive3 {
  opacity: 0.3;
}

.panel-body3:hover .middle3 {
  opacity: 1;
}
.image-responsive3{
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}




.middle4 {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%)
}

.panel-body4:hover .image-responsive4 {
  opacity: 0.3;
}

.panel-body4:hover .middle4 {
  opacity: 1;
}
.image-responsive4{
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}



.middle5 {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%)
}

.panel-body5:hover .image-responsive5{
  opacity: 0.3;
}

.panel-body5:hover .middle5 {
  opacity: 1;
}
.image-responsive5{
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle6 {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%)
}

.panel-body6:hover .image-responsive6{
  opacity: 0.3;
}

.panel-body6:hover .middle6{
  opacity: 1;
}
.image-responsive6{
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}
  </style>
  
</head>
<body>

<div class="jumbotron ">
 <div class="w3-content w3-section" style="max-width:500px; height:250px;">

  <img class="mySlides w3-animate-fading" src="_mg_1639__rotator2.jpg" style="width:500px">
  <img class="mySlides w3-animate-fading" src="images(2).jpg" style="width:500px">
  <img class="mySlides w3-animate-fading" src="images(3).jpg" style="width:500px">
  
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 9000);    
}
</script>

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
        <li class="active"><a href="#">Pocetna</a></li>
        <li><a href="proizvodi.php">Proizvodi</a></li>
        <li><a href="#">O nama</a></li>
        <li><a href="#">Stores</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Ulogiraj se</a></li>
        <li><a href="reg.php"><span class="glyphicon glyphicon-user"></span>Registriraj se</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">    
  <div class="row">
  <?php
  include 'Komunikacija.php';
  $query = "SELECT ID_Proizvod,Cijena FROM proizvod LIMIT 3";
		$result = db_select($query);
		$i = 0;
  foreach ($result as $rs){
	  if($i==0){
			$pisanje="Povoljno";	
		}else if($i == 1){
			$pisanje="Kupujte";
		}else{
			$pisanje="U nasem shopu";
		}
  print('<div class="col-sm-4" >
      <div class="panel panel-primary" >
        <div class="panel-heading">'.$pisanje.'</div>
        <div class="panel-body'.$i.'"><img src="dohvatiSliku.php?id='.$rs['ID_Proizvod'].'" width="320" class="img-responsive'.$i.'" style="width:100%; height:350px; "  alt="Image">
			<div class="middle'.$i.'">
			<a href="pojedinosti.php?id_slike='.$rs['ID_Proizvod'].'&brojStranice=1"  class="text" >Informacije</a>
			</div>
		</div>
        <div class="panel-footer">Cijena: <i>'.$rs['Cijena'].' kn/kom</i></div>
      </div>
  </div>');
  $i++;
  }
  
    ?>
  </div>
</div><br>'

<div class="container">    
  <div class="row">
     <?php
  $query = "SELECT ID_Proizvod,Cijena FROM proizvod LIMIT 6";
		$result = db_select($query);
		
		$i=0;
  foreach ($result as $rs){
	  $i++;
	   if($i==4){
			$pisanje="Ovaj tjedan";	
		}else if($i == 5){
			$pisanje="SPECIJALNI";
		}else{
			$pisanje="Popusti";
		}
	  if($i>3){
  print('<div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">'.$pisanje.'</div>
        <div class="panel-body'.$i.'"><img src="dohvatiSliku.php?id='.$rs['ID_Proizvod'].'" width="320" class="img-responsive'.$i.'" style="width:100%; height:350px; alt="Image">
		<div class="middle'.$i.'">
			<a href="pojedinosti.php?id_slike='.$rs['ID_Proizvod'].'&brojStranice=1 " class="text">Informacije</a>
			</div></div>
        <div class="panel-footer">Cijena: <i>'.$rs['Cijena'].' kn/kom</i></div>
      </div>
  </div>');
	  }
  }
    ?>
  </div>
</div><br><br>
<footer class="container-fluid text-center">
  <p>Nas Web Shop</p>  
	<p><span style="color:red;">@</span>RiTeh</p>
</footer>

</body>
</html>
