<?php
	session_start();
	
	if((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==false) && ($_SESSION['email']!="admin@admin.com"))
	{
		header('Location: index.php');
		exit();
	}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Admin-Panel</title>
    <meta name="keywords" content="Elegancka Odzież, Garnitury, Sukienki, Smokingi, Wyjściowe, Dla Dzieci, Garnitury Dziecięce, Junior Garnitur, Junior Sukienki, Diecięce Sukienki, Męskie, Damskie, Dziecięce, Junior, Dla Mężczyzn, Dla Kobiet"/>
    
    <link rel="stylesheet" href="css/mainstyle.css" type="text/css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,900&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="img/logo.png">
	

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
								if($_SESSION['email']=="JarekYT@gmail.com")
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
		<h1><div class="col-12 text-dark display-2 text-center">ADMIN PANEL</div></h1>
		<canvas class="col-12 p-0 mb-4" height="1" id="simplecanvas"></canvas>

		
		<section class="content">
		<div class="row">
			<div class="col-12 text-center display-4">
			<?php
				if(isset($_SESSION['sqlinfo']))
				{
					echo $_SESSION['sqlinfo'];
					unset($_SESSION['sqlinfo']);
				}
			?>
			</div>
		</div>
			<div class="row mb-3">
				<div class="external-info col-12 text-left">
							<a href="#productslist" title="" type="button" class="title text-decoration-none text-dark " data-toggle="collapse">
								<h5>Lista Produktów ▼ </h5>
							</a>

							<div class="collapse in col-12 " id="productslist">
								<div class="content">
									<?php 
										require_once "admin-panel-productslist.php";
									?>
								</div>
							</div>
				</div>
			</div>
			<div class="row mb-3">
				<div class="external-info col-12 text-left">
							<a href="#addremove" title="" type="button" class="title text-decoration-none text-dark " data-toggle="collapse">
								<h5>Dodaj / Usuń / Aktualizuj Produkt ▼ </h4>
							</a>

							<div class="collapse in" id="addremove">
								<div class="content">

									<form style="border: 1px black solid;" class="row p-1 mb-1" action="admin-panel-addremove.php" method="post">
									<div class="col-md-4 d-flex align-items-center"><h5>Podaj ID produktu do usunięcia: </h5></div>
									<div class="col-md-2 d-flex align-items-center"><input style="width:100px;" type="number" name="removeid"></div>
									<input type="hidden" name="action" value="remove">
									<div class="col-md-2 offset-md-4"><input style="margin: 0;" type="submit" value="Usuń"></div>
									</form>

									
									<form style="border: 1px black solid;" class="row p-1 mb-1"  action="admin-panel-addremove.php" method="post">
									<div class="col-md-12"><h5>Podaj dane produktu: </h5></div>
									<div class="col-md-2">Nazwa: <input type="text" name="name"></div>
									<div class="col-md-2">Zdjęcia: 
										<input type="text" name="img1">
										<input type="text" name="img2">
										<input type="text" name="img3">
										<input type="text" name="img4">
									</div>
									<div class="col-md-2">Cena: <input type="number" name="price"></div>
									<div class="col-md-2">Kolor: <input type="text" name="color"></div>
									<div class="col-md-2">Typ<br>
										<select class="custom-select" name="type">
											<option value="male">Męskie</option>
											<option value="female">Damskie</option>
											<option value="junior">Dziecięce</option>
										</select>
									</div>
									<div class="col-md-1"><label style="border: 0;">Aktywny <input type="checkbox" name="active" checked></label></div>
									<input type="hidden" name="action" value="add">
									<div class="col-md-2 offset-md-10"><input type="submit" value="Dodaj"></div>
									</form>

								</div>
							</div>
				</div>
			</div>
			<div class="row mb-3">
				<div class="external-info col-12 text-left">
							<a href="#userlist" title="" type="button" class="title text-decoration-none text-dark " data-toggle="collapse">
								<h5>Lista Użytkowników ▼ </h5>
							</a>

							<div class="collapse in col-12 " id="userlist">
								<div class="content">
									<?php 
										require_once "admin-panel-userlist.php";
									?>
								</div>
							</div>
				</div>
			</div>
			<div class="row mb-3">
				<div class="external-info text-left col-12">
							<a href="#userremove" title="" type="button" class="title text-decoration-none text-dark " data-toggle="collapse">
								<h5>Usuń / Aktualizuj Użytkownika ▼ </h5>
							</a>

						<div class="collapse in" id="userremove">
							<div class="content">
							
									<form style="border: 1px black solid;" class="row p-1 mb-1" action="admin-panel-userremove.php" method="post">
									<div class="col-md-4 d-flex align-items-center"><h5>Podaj ID użytkownika do usunięcia: </h5></div>
									<div class="col-md-2 d-flex align-items-center"><input style="width:100px;" type="number" name="removeid"></div>
									<div class="col-md-2 offset-md-4"><input style="margin: 0;" type="submit" value="Usuń"></div>
									</form>
							
							</div>
						</div>
					</div>
			</div>
			
		</section>
		
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
	<script src="js/canvas.js"  type="text/javascript" ></script>
</body>
</html>


