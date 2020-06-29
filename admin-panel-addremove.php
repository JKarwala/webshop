<?php
		session_start();
		
		if((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==false) && ($_SESSION['email']!="admin@admin.com"))
		{
			header('Location: index.php');
			exit();
		}		
	
		$action=$_POST['action'];
		if($action=="remove")
		{
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
						$connect->query("DELETE FROM products WHERE product_id=$todelete;");
						$_SESSION['sqlinfo']='<span style="color:green;">Usunięto Produkt</span>';
						$connect->close();
					}
				}
				catch(Exception $errordb)
				{
					echo '<span style="color:red;">Błąd serwera. Przepraszamy za utrudnienia, spróbuj ponownie później</span>';
					//echo '<br>Informacja developoerska: '.$errordb;
				}	
				header("Location: admin-panel.php");
				exit();
		}
		else if($action=="add")
		{
			require_once "dbdata.php";

				mysqli_report(MYSQLI_REPORT_STRICT);
				try
				{
					$name=$_POST['name'];
					$img1=$_POST['img1'];
					$img2=$_POST['img2'];
					$img3=$_POST['img3'];
					$img4=$_POST['img4'];
					$price=$_POST['price'];
					$color=$_POST['color'];
					$type=$_POST['type'];
					if(isset($_POST['active']))
					{
						$active=1;
						unset($_POST['active']);
					}
					else
					{
						$active=0;
					}
					$connect=new mysqli($host,$db_user,$db_password,$db_name);
					if($connect->connect_errno!=0)
					{
						throw new Exception(mysqli_connect_errno());
					}
					else
					{
						
						$connect-> set_charset("utf8");
						if($connect->query("INSERT INTO products VALUES(NULL,'$name','$img1','$img2','$img3','$img4','$price','$color','$type','$active')"))
						{
							$_SESSION['sqlinfo']='<span style="color:green;">Dodano Produkt</span>';
						}
						else
						{
							throw new Exception($connect->error);
							echo $connect->error;
						}
							
						
						$connect->close();
					}
				}
				catch(Exception $errordb)
				{
					echo '<span style="color:red;">Błąd serwera. Przepraszamy za utrudnienia, spróbuj ponownie później</span>';
					//echo '<br>Informacja developoerska: '.$errordb;
				}	
			
			
			
			header("Location: admin-panel.php");
			exit();
		}
		else
		{
			echo "Coś poszło nie tak";
		}
	
		
?>

