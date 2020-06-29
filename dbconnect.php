<?php
    require_once "dbdata.php";
    $connect=@new mysqli($host,$db_user,$db_password,$db_name);
    if($connect->connect_errno!=0)
    {
        echo "DB connect Error: ".$connect->connect_erno;
    }
    else
    {
		$result=mysqli_query($connect,"SELECT * FROM test") or die('Blad zapytania');  
		if(mysqli_num_rows($result) > 0) 
			{
				while($row = mysqli_fetch_assoc($result)) 
				{
					echo "$row[imie]";
				}
			mysqli_close($connect);
			}
    }
?>

