
<?php
session_start();
include 'Komunikacija.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dodaj proizvod</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script text="text/javascript">
   function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
  </script>
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
        <li ><a href="Kupci.php">Kupci</a></li>
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
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user'] ?></a></li><?php
		if($_SESSION['ovlasti'] == 1){
			print('<li><a href="Kosarice.php"><span class="glyphicon glyphicon-shopping-cart"></span> Kosarice</a></li>');
		}
        ?>
      </ul>
    </div>
  </div>
</nav>
<script type="text/javascript">
function odustanak(){
	window.location.href = "http://localhost:8080/shop/index1.php";  
}

</script>
<?php
$query = "SELECT * FROM `vrstap`";	
$result = db_select($query);
$query = "SELECT count(*) br FROM `vrstap`";	
$result1 = db_select($query);
	print('<div class="container-fluid" id="konetenjer">');
		print('<div class="col-xs-6 col-sm-3" style="height:300px; width:300px;">
				<form method="POST" action="dodaj.php"  enctype="multipart/form-data">
				<label class="control-label" style="margin-left:0%;">Naziv: </label>
				
				<input type ="text" name= "Naziv"></br>
				<label class="control-label" style="margin-left:0%;">Kolicina: </label>
				<input type ="text" name= "Kolicina"></br>
				<label class="control-label" style="margin-left:0%;">Cijena: </label>
				<input type ="text" name ="Cijena""></br>
		<label class="control-label" style="margin-left:0%;">Odaberi vrstu proizvoda: </label>
				<select name="odabirvr">');
	for($i = 0; $i < $result1[0]['br'] ; $i++){
			print('<option value="'.$result[$i]['ID_Vrste'].'">'.$result[$i]['Naziv_vrste'].'</option>');
		}	
				print('</select>
				</br>
				<label class="control-label" style="margin-left:0%;">Uploadaj sliku: </label>
				<input type="file" name="slika" onchange="readURL(this);" />
				<input type="submit" value="Spremi novi zapis u bazu!">			
				<input type="button" value="Odustani (povratak)..." onclick="odustanak();"">
			</form>');
		print('</div>');
			print('<div class="col-xs-6 col-sm-3" style="height:300px; width:400px; ;">
		<label class="control-label" style="margin-left:0%;">Tvoja Slika: </label>
		<img id="blah" src="#"  />
		</div>');
		print('</div>');
	print('	</div>');
/*		
<a id="gumbicPovratka" href="'.$href.'" class="btn btn-default">Vrati se natrag</a>
		<a id="gumbicPovratka" href="IzbrisiZapis.php?id='.$_GET['id'].'" class="btn btn-default">Izbrisi Zapis</a>
*/

?>

<footer class="container-fluid text-center">
  <p>Nas Web Shop</p>  
	<p><span style="color:red;">@</span>RiTeh</p>
</footer>

</body>
</html>
