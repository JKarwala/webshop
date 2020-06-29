<?php
		session_start();

		if((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==false) && ($_SESSION['email']!="admin@admin.com"))
		{
			header('Location: index.php');
			exit();
		}
			require_once "dbdata.php";

				mysqli_report(MYSQLI_REPORT_STRICT);
				try
				{
					$todelete=$_POST['removeid'];
					$connect=new mysqli($host,$db_user,$db_password,$db_name);
					if($connect->connect_errno!=0)
					{
						throw new Exception(mysqli_connect_errno());
					}
					else
					{
						$connect-> set_charset("utf8");
						$connect->query("DELETE FROM users WHERE ID=$todelete;");
						$_SESSION['sqlinfo']='<span style="color:green;">Usunięto Użytkownika</span>';
						$connect->close();
					}
				}
				catch(Exception $errordb)
				{
					echo '<span style="color:red;">Błąd serwera. Przepraszamy za utrudnienia, spróbuj ponownie później</span>';
					//echo '<br>Informacja developoerska: '.$errordb;
				}	
				header("Location: admin-panel.php");
?>

