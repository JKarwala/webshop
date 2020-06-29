<?php
	session_start();
	
	setLocale(LC_CTYPE, 'PL_pl.UTF-8');
	
	if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: index.php');
		exit();
	}
	
	if(isset($_POST['email']))
	{
		$all_ok=true;
		
		
		$email=$_POST['email'];
		$name=$_POST['name'];
		$surname=$_POST['surname'];
		$password=$_POST['password'];
		$passwordagain=$_POST['passwordagain'];
		
		$emailB=filter_var($email, FILTER_SANITIZE_EMAIL);
		
		
		if((filter_var($emailB,FILTER_SANITIZE_EMAIL)==false) || ($emailB!=$email))
		{
			$all_ok=false;
			$_SESSION['e_email']="Podaj poprawny adres email";
		}
		if((strlen($name)<3) || (strlen($name)>20))
		{
			$all_ok=false;
			$_SESSION['e_name']="Imię musi posiadać od 3 do 20 znaków";
		}
		/*
		if(ctype_print($name)==false)
		{
			$all_ok=false;
			$_SESSION['e_name2']="Imię może składać się tylko z liter";
		}
		*/
		if((strlen($surname)<3) || (strlen($surname)>30))
		{
			$all_ok=false;
			$_SESSION['e_surname']="Nazwisko musi posiadać od 3 do 30 znaków";
		}
		/*
		if(ctype_print($surname)==false)
		{
			$all_ok=false;
			$_SESSION['e_surname2']="Nazwisko może składać się tylko z liter";
		}
		*/
		
		if(strlen($password)<8 || (strlen($password)>20))
		{
			$all_ok=false;
			$_SESSION['e_password']="Hasło musi posiadać od 8 do 20 znaków";
		}
		
		if($password!=$passwordagain)
		{
			$all_ok=false;
			$_SESSION['e_passwordagain']="Hasła muszą być identyczne";
		}
		if(!isset($_POST['regulamin']))
		{
			$all_ok=false;
			$_SESSION['e_checkbox']="Regulamin nie został zaakceptowany";
		}
		$secret_key="6LeQvN8UAAAAACeEEk-4TS_IR2lxtFJNeUjjCDQ5";
		
		$checkkey=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
		
		$googlerespons=json_decode($checkkey);
		
		if($googlerespons->success==false)
		{
			$all_ok=false;
			$_SESSION['e_bot']="Potwierdź że nie jesteś botem";
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
						$result=$connect->query("SELECT ID FROM users WHERE email='$email'");
						if(!$result)throw new Exception($connect->error);
						
						$num_emails=$result->num_rows;
						if($num_emails>0)
						{
							$all_ok=false;
							$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu email";
						}
						if($all_ok==true)
						{
							$pass_hash=password_hash($password,PASSWORD_DEFAULT);
							if($connect->query("INSERT INTO users VALUES(NULL,'$email','$name','$surname','$pass_hash')"))
							{
								$_SESSION['successregister']='<span style="color:green;">Rejestracja zakończona pomyślnie</span>';
								header('Location: logowanie.php');
							}
							else
							{
								throw new Exception($connect->error);
							}
							
						}
						else
						{
							header('Location: rejestracja.php');
							$connect->close();
							exit();
						}
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

