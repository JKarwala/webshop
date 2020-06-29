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
						$result=$connect->query("SELECT * FROM users");
						if(!$result)throw new Exception($connect->error);

						while($row=$result->fetch_assoc())
						{
							echo '
							<div class="row mb-1" style="border: 1px black solid;">
							<div class="col-2 col-md-1"><b>ID:</b> '.$row['ID'].'</div>
							<div class="col-6 col-md-3"><b>Email:</b> <br>'.$row['email'].'</div>
							<div class="col-2 col-md-1"><b>Imię:</b> <br>'.$row['name'].'</div>
							<div class="col-4 col-md-2"><b>Nazwisko:</b> <br>'.$row['surname'].'</div>
							</div>';
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

