<?php
	
		require_once "dbdata.php";
		
		if(isset($_POST['cartitem']))
		{
			if(isset($_SESSION['koszyknum']))
			{
				$_SESSION['item'.$_SESSION['koszyknum']]=$_POST['cartitem'];
				unset($_POST['cartitem']);
			}
			else
			{
				$_SESSION['koszyknum']=0;
				$_SESSION['item'.$_SESSION['koszyknum']]=$_POST['cartitem'];
				unset($_POST['cartitem']);
			}
			if(isset($_POST['size']))
			{
				$_SESSION['size'.$_SESSION['koszyknum']]=$_POST['size'];
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
						$result=$connect->query("SELECT * FROM products WHERE active=1 AND product_id>3 LIMIT 4");
						if(!$result)throw new Exception($connect->error);
						
						$num_products=$result->num_rows;
						$number=0;
						while($row=$result->fetch_assoc())
						{
						$number++;
						echo '<div class="col-10 offset-1 col-sm-4 offset-sm-0 col-md-3 mb-3"><form action="shopitem.php" method="GET" id="form'.$number.'"><input type="hidden" name="idofproduct" value="'.$row['product_id'].'"><button style="padding: 0;" value="submit" type="submit" form="form'.$number.'"><img src="img/products/'.$row['img1'].'" alt="Zdjęcie Produktu"></button><h5 style="min-height: 56px;"><button style="background: rgb(0,255,255,-.2);" value="submit" type="submit" form="form'.$number.'">'.$row['name'].'</button></h5><p class="pricefont">'.$row['color'].'</p></form><form action="index.php" method="post"  id="formbutton'.$number.'"><input type="hidden" name="cartitem" value="'.$row['product_id'].'"/><button class="buttonstyle" value="submit" type="submit" form="formbutton'.$number.'"><img class="col-4" style="border: 0; width: 30%;" src="img/shopcart.png" alt="Ikona koszyka">'.$row['price'].' ,-</button></form></div>';
						}
						
						$connect->close();
					}
				}
				catch(Exception $errordb)
				{
					echo '<span style="color:red;">Błąd serwera. Przepraszamy za utrudnienia, spróbuj ponownie później</span>';
					echo '<br>Informacja developoerska: '.$errordb;
				}	
?>

