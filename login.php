<?php
	session_start();
	
	if((!isset($_POST['email'])) || (!isset($_POST['password'])))
	{
		header('Location: logowanie.php');
		exit();
	}
	
	require_once "dbdata.php";
    $connect=@new mysqli($host,$db_user,$db_password,$db_name);
    if($connect->connect_errno!=0)
    {
        echo "DB connect Error: ".$connect->connect_erno;
    }
	else
	{
		$login=$_POST['email'];
		$password=$_POST['password'];
		$connect-> set_charset("utf8");
		$login=htmlentities($login, ENT_QUOTES, "UTF-8");


		if($result=@$connect->query(sprintf("SELECT * FROM users WHERE email='%s'",mysqli_real_escape_string($connect,$login))))
		{
			$num_users=$result->num_rows;
			if($num_users>0)
			{
				$row=$result->fetch_assoc();
				if(password_verify($password,$row['password']))
				{
					$_SESSION['zalogowany']=true;
					

					$_SESSION['name']=$row['name'];
					$_SESSION['surname']=$row['surname'];
					$_SESSION['email']=$row['email'];
					

					$result->close();
					header('Location: index.php');
				}
				else
				{
					$_SESSION['loginerror']='<span class="errorlogininfo" style="color:red;">Nieprawidłowy login lub hasło!</span>';
					header('Location: logowanie.php');
				}
			}
			else
			{
				$_SESSION['loginerror']='<span class="errorlogininfo" style="color:red;">Nieprawidłowy login lub hasło!</span>';
				header('Location: logowanie.php');
			}
			
		}
		$connect->close();
	}
?>

