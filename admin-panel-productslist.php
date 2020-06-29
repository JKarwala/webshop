<?php
		if((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==false) && ($_SESSION['email']!="admin@admin.com"))
		{
			header('Location: index.php');
			exit();
		}
		
		require_once "dbdata.php";

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
						$result=$connect->query("SELECT * FROM products");
						if(!$result)throw new Exception($connect->error);
						while($row=$result->fetch_assoc())
						{
							if($row['active']>=1)
							{
								$active="tak";
							}
							else
							{
								$active="nie";
							}
							echo '
							<div class="row mb-1" style="border: 1px black solid;">
							<div class="col-2 col-md-1"><b>ID:</b> '.$row['product_id'].'</div>
							<div class="col-6 col-md-3"><b>Nazwa:</b> <br>'.$row['name'].'</div>
							<div class="col-4 col-md-2"><b>Zdjęcia:</b> <br>
							'.$row['img1'].'<br>
							'.$row['img2'].'<br>
							'.$row['img3'].'<br>
							'.$row['img4'].'<br>
							</div>
							<div class="col-2 col-md-1"><b>Cena:</b> <br>'.$row['price'].'</div>
							<div class="col-4 col-md-2"><b>Kolor:</b> <br>'.$row['color'].'</div>
							<div class="col-4 col-md-2"><b>Płeć:</b> <br>'.$row['type'].'</div>
							<div class="col-2 col-md-1"><b>Aktywny:</b> <br>'.$active.'</div>
							</div>
							';
						}
						
						$connect->close();
					}
				}
				catch(Exception $errordb)
				{
					echo '<span style="color:red;">Błąd serwera. Przepraszamy za utrudnienia, spróbuj ponownie później</span>';
					//echo '<br>Informacja developoerska: '.$errordb;
				}	
?>

