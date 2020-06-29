<?php
	
		require_once "dbdata.php";
		
		if(isset($_GET['cartitem']))
		{
			if(isset($_SESSION['koszyknum']))
			{
				$_SESSION['item'.$_SESSION['koszyknum']]=$_GET['cartitem'];
				unset($_GET['cartitem']);
			}
			else
			{
				$_SESSION['koszyknum']=0;
				$_SESSION['item'.$_SESSION['koszyknum']]=$_GET['cartitem'];
				unset($_POST['cartitem']);
			}
			if(isset($_GET['size']))
			{
				$_SESSION['size'.$_SESSION['koszyknum']]=$_GET['size'];
			}
			else
			{
				$_SESSION['size'.$_SESSION['koszyknum']]='m';
			}
			$_SESSION['koszyknum']++;
		}
				
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
						$result=$connect->query("SELECT * FROM products WHERE product_id=$idofproduct");
						if(!$result)throw new Exception($connect->error);
						
						$num_products=$result->num_rows;
						$row=$result->fetch_assoc();
						

						
						$connect->close();
					}
				}
				catch(Exception $errordb)
				{
					echo '<span style="color:red;">Błąd serwera. Przepraszamy za utrudnienia, spróbuj ponownie później</span>';
					//echo '<br>Informacja developoerska: '.$errordb;
				}	
?>

