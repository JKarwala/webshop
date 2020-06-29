<?php
	session_start();
	
	if(isset($_GET['idofproduct']))
	{
		$idofproduct=$_GET['idofproduct'];
	}
	else
	{
		header('Location: index.php');
	}
		
	
	require_once "itemdata.php";
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>WearYourSelf - Produkt</title>
    <meta name="description" content="Elegancka Odzież - Sklep Internetowy. W naszej ofercie znajdziesz: Odzież Elegencka Damska, Męska, Dziecięca w tym Garnitury, Sukienki, Smokigni, Żakiety, Marynarki, Płaszcze i wiele więcej!"/>
    <meta name="keywords" content="Elegancka Odzież, Garnitury, Sukienki, Smokingi, Wyjściowe, Dla Dzieci, Garnitury Dziecięce, Junior Garnitur, Junior Sukienki, Diecięce Sukienki, Męskie, Damskie, Dziecięce, Junior, Dla Mężczyzn, Dla Kobiet"/>
    
    <link rel="stylesheet" href="css/mainstyle.css" type="text/css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,900&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="img/logo.png">
	
	<script src="js/pictrues.js"></script>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-162157262-2"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-162157262-2');
	</script>
	

</head>
<body>
	
    <div class="container">
	
		<header>
			<nav class="navbar navbar-light bg-menucolor navbar-expand-md">
				<a class="navbar-brand" href="index.php"><div class="logo"><img class="d-inline-block" width="30" height="30" src="img/logo.png" alt="logo">WearYourSelf.com</div></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Przełącznik nawigacji"><span class="navbar-toggler-icon"></span></button>
				<div id="menu" class="collapse navbar-collapse">
				
					<ul class="navbar-nav ml-auto">
					
						<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false" id="submenu1" aria-haspopup="true">Sklep</a>
						
							<div class="dropdown-menu" aria-labelledby="submenu1">
							
								<a class="dropdown-item" href="forwomen.php">Dla Kobiet</a>
								<a class="dropdown-item" href="formen.php">Dla Mężczyzn</a>
								<a class="dropdown-item" href="forjunior.php">Dla Dzieci</a>
								
							</div>
							
						</li>
						
						<li class="nav-item"><a class="nav-link" href="kontakt.php">Kontakt</a></li>
						
						<li class="nav-item"><a class="nav-link" href="koszyk.php">Koszyk <?php if(isset($_SESSION['koszyknum'])){echo " (".$_SESSION['koszyknum'].")";} ?></a></li>
					
						<?php
							if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
							{
								echo '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false" id="submenu2" aria-haspopup="true">Moje Konto</a>';
								echo '<div class="dropdown-menu" aria-labelledby="submenu2">';
								echo '<a class="dropdown-item" href="#">'.$_SESSION['name'].'</a>';
								echo '<a class="dropdown-item" href="#">Kupione</a>';
								echo '<a class="dropdown-item" href="logout.php">Wyloguj</a>';
								echo '</div></li>';
								if($_SESSION['email']=="admin@admin.com")
								{
									echo '<li class="nav-item"><a class="nav-link" href="admin-panel.php"> ADMIN-PANEL</a></li>';
								}
					
							}
							else
							{
								echo '<li class="nav-item"><a class="nav-link" href="rejestracja.php"> Rejestracja</a></li>';
								echo '<li class="nav-item"><a class="nav-link" href="logowanie.php"> Logowanie</a></li>';
							}

							
						 ?>
					</ul>
				</div>
			</nav>
		</header>
		
		
		<div class="banner">
					<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					  <div class="carousel-inner">
						<div class="carousel-item active">
						  <img class="d-block w-100" src="slider/slide1.png" alt="First slide">
						</div>
						<div class="carousel-item">
						  <img class="d-block w-100" src="slider/slide2.png" alt="Second slide">
						</div>
						<div class="carousel-item">
						  <img class="d-block w-100" src="slider/slide3.png" alt="Third slide">
						</div>
					  </div>
					  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					  </a>
					</div>

		</div>

		
		<main class="content">
			<section>
			<h2 class="display-3"><?php echo $row['name']; ?> </h2>
			<div class="row">
			
				<div class="col-12 col-sm-6 p-5"><div class="col-12" id="pic"><img src="img/products/<?php echo $row['img1']; ?>" alt="Zdjęcie Produktu"></div>
					<div class="row mt-1">
					<div class="col-2 offset-2  p-1"><input type="hidden" id="img1" value="img/products/<?php echo $row['img1']; ?>"><img class="img-fluid" src="img/products/<?php echo $row['img1']; ?>" alt="Zdjęcie Produktu" onclick="setpic(1)" style="cursor:pointer;"></div>
					<div class="col-2  p-1"><input type="hidden" id="img2" value="img/products/<?php echo $row['img2']; ?>"><img class="img-fluid" src="img/products/<?php echo $row['img2']; ?>" alt="Zdjęcie Produktu" onclick="setpic(2)" style="cursor:pointer;"></div>
					<div class="col-2  p-1"><input type="hidden" id="img3" value="img/products/<?php echo $row['img3']; ?>"><img class="img-fluid" src="img/products/<?php echo $row['img3']; ?>" alt="Zdjęcie Produktu" onclick="setpic(3)" style="cursor:pointer;"></div>
					<div class="col-2  p-1"><input type="hidden" id="img4" value="img/products/<?php echo $row['img4']; ?>"><img class="img-fluid" src="img/products/<?php echo $row['img4']; ?>" alt="Zdjęcie Produktu" onclick="setpic(4)" style="cursor:pointer;"></div>
					</div>
				</div>
				<div class="col-12 col-sm-6 p-5"><br>
				<p class="display-4">Kolor: <?php echo $row['color']; ?></p>
				<form action="shopitem.php" method="get"  id="formitemadd">
				<div class="select-size">
					  <input type="radio" name="size" id="small" value="s"/>
					  <input type="radio" name="size" id="medium" value="m" checked />
					  <input type="radio" name="size" id="large" value="l" />
					  <input type="radio" name="size" id="x-large" value="xl" />
					  <input type="radio" name="size" id="xx-large" value="xxl" />

					  <label for="small">S</label>
					  <label for="medium">M</label>
					  <label for="large">L</label>
					  <label for="x-large">XL</label>
					  <label for="xx-large">XXL</label>

				</div>
					<a href="https://www.rozmiar.com/ubran.php" class="text-decoration-none text-dark" target="_blank">Tabela rozmiarów</a><br>
					<div class="row mt-2">
						<div class="col-8 offset-2">
							<?php echo '<input type="hidden" name="cartitem" value="'.$row['product_id'].'"/><input type="hidden" name="idofproduct" value="'.$idofproduct.'"><button class="buttonstyle" value="submit" type="submit" form="formitemadd"><img class="col-4" style="border: 0; width: 30%;" src="img/shopcart.png" alt="Ikona koszyka">'.$row['price'].' ,-</button>';
							?>
						</div>	
					</div>
				</form>
					<p style="font-size: 25px">Wysyłka w 2-10 dni!</p>
					<div class="external-info">
                        <a href="#return" title=""  class="title text-decoration-none text-dark" data-toggle="collapse">
                            Dostawa i płatność ▼ <i class="text-uppercase"></i>
                        </a>

                        <div class="collapse in" id="return">
                            <div class="content">
                            	<p style="margin-left: 35.4pt; text-align: justify;"><strong>Możliwe metody płatności za zamówienie to:</strong></p>

								<p style="margin-left: 35.4pt; text-align: justify;">- płatność przy odbiorze</p>

								<p style="margin-left: 35.4pt; text-align: justify;">- przelew internetowy z pośrednictwem PayU</p>

								<p style="margin-left: 35.4pt; text-align: justify;">- płatność kartą za pośrednictwem PayU</p>

								<p style="margin-left: 35.4pt; text-align: justify;"><strong>Dostępne formy dostawy:</strong></p>

								<p style="margin-left: 35.4pt; text-align: justify;">- przesyłka kurierska <span style="color:#FF8C00;"><strong>DPD 24h</strong></span> - <strong>15,00 zł</strong></p>

								<p style="margin-left: 35.4pt; text-align: justify;">- przesyłka kurierska za pobraniem <span style="color:#FF8C00;"><strong>DPD 24h</strong></span> - <strong>16,50 zł</strong></p>

								<p style="margin-left: 35.4pt; text-align: justify;">- przesyłka zagraniczna (Europa) <span style="color:#FF8C00;"><strong>DPD</strong></span> - <strong>95,00&nbsp;zł</strong></p>

								<p style="margin-left: 35.4pt; text-align: justify;">- odbiór osobisty- <strong>0,00 zł&nbsp;</strong></p>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
			</section>
			<div class="row">
				<article class="col-10 offset-1">
				<h2><?php echo $row['name']; ?></h2>
				<p><?php echo $row['descript'];?></p>
				</article>
			</div>
		</main>
		
		<footer class="page-footer font-small bg-footercolor ">


		  <div class="container text-center text-md-left">

			<div class="row">

			  <div class="col-md-4 mx-auto">

				<h5 class="font-weight-bold text-uppercase mt-3 mb-4">WearYourSelf</h5>
				<p>Kupuj i noś produkty najwyższej jakości. Eleganckie garnitury, smokingi, sukienki, żakiety i wiele więcej! W celu złożenia niestandardowego zamówienia prosimy o kontakt mailowy.</p>

			  </div>

			  <hr class="clearfix w-100 d-md-none">

			  <div class="col-md-2 mx-auto">

				<h5 class="font-weight-bold text-uppercase mt-3 mb-4">Info</h5>

				<ul class="list-unstyled">
				  <li>
					<a href="#!" class="text-decoration-none text-light">Facebook</a>
				  </li>
				  <li>
					<a href="#!" class="text-decoration-none text-light">Instagram</a>
				  </li>
				  <li>
					<a href="#!" class="text-decoration-none text-light">kontakt@kontakt.com</a>
				  </li>
				  <li>
					<a href="#!" class="text-decoration-none text-light">+48 123 456 789</a>
				  </li>
				</ul>

			  </div>
			</div>

		  </div>


		  

		 
		  

		  <!-- Copyright -->
		  <div class="footer-copyright text-center py-1"><p>
			© 2020 Copyright:
			<a href="index.php" class="text-light text-decoration-none"> WearYourSelf</a></p>
		  </div>
		  <!-- Copyright -->
		
		</footer>
    
    </div>
	
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	
	<script src="js/bootstrap.min.js"></script>
</body>
</html>


