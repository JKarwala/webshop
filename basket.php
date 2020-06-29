<?php
		require_once "dbdata.php";
		if(!isset($_SESSION['koszyknum']))
		{
			echo '<div class="col-12 text-center koszykd">';
			echo '<span class="emptyinf">Twój koszyk jest pusty</span>';
			echo '</div>';
		}
		else
		{
			mysqli_report(MYSQLI_REPORT_STRICT);
					try
					{
						$connect=new mysqli($host,$db_user,$db_password,$db_name);
						if($connect->connect_errno!=0)
						{
							throw new Exception(mysqli_connect_errno());
						}
						else
						{
							$connect-> set_charset("utf8");
							$suma=0;
							for($i=0;$i<$_SESSION['koszyknum'];$i++)
							{
								$tempid=$_SESSION['item'.$i];
								$result=$connect->query("SELECT * FROM products WHERE product_id=$tempid");
								if(!$result)throw new Exception($connect->error);
								$num_products=$result->num_rows;
								$row=$result->fetch_assoc();
								echo '<div class="row text-left border border-dark mb-1">';
								echo '<div class="col-6 col-sm-1 p-2"><img src="img/products/'.$row['img1'].'" alt="Zdjęcie Produktu"></div><div class="col-6 col-sm-4 text-left d-flex align-items-center"><h2>'.$row['name'].'</h2></div><div class="col-4 col-sm-2 font-weight-bold d-flex align-items-center"><p>Kolor: '.$row['color'].'</div><div class="col-4 col-sm-2 d-flex align-items-center font-weight-bold"><p>Rozmiar: '.$_SESSION['size'.$i].'</div><div class="col-4 col-sm-2 offset-sm-1 d-flex align-items-center "><div class="buttonstyle text-center" style="cursor: default;">'.$row['price'].' ,-</div></div>';
								echo '</div>';
								$suma+=$row['price'];
							}
							echo '<div class="row"><div class="col-8 col-sm-2 offset-4 offset-sm-10 mt-3"><div class="buttonstyle text-center" style="cursor: default;">Suma: '.$suma.' ,-</div></div></div>';
							$connect->close();
						}
					}
					catch(Exception $errordb)
					{
						echo '<span style="color:red;">Błąd serwera. Przepraszamy za utrudnienia, spróbuj ponownie później</span>';
						//echo '<br>Informacja developoerska: '.$errordb;
					}	
		}
?>

