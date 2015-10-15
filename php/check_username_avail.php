<?php
	require_once('connectvars.php');
	if(isset($_POST['username']))
	{
		$dbc = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME)
						or die("Error connecting to the database");
			
		$username = mysqli_real_escape_string($dbc,trim($_POST['username']));
		if(!empty($username))
		{
			if(strlen($username)>=4)
			{
				
				$query= "select user_id from user where username='$username'";
				$data =mysqli_query($dbc,$query)
						or die("Error querying from the database");
						
				if(mysqli_num_rows($data)==0)
				{
					echo "true";
				}
				else if(mysqli_num_rows($data)==1)
				{
					echo "false";
				}
				else
				{
					echo "fatal error occurred!";
				}
			}
			else
			{
				echo "short length error";
			}
		}
		else
		{
			echo "empty error";
		}
		mysqli_close($dbc);
	}
	else
	{
		echo "notset error";
	}
?>