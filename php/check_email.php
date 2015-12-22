<?php
	if(isset($_POST['email']))
	{
		require_once('connectvars.php');
		$dbc = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME)
				or die("Error connecting to the database");
			
		$email =trim($_POST['email']);
	
		if(!empty($email))
		{
			if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
				echo "invalid";
			else
			{
				$query= "select user_id from user where email='$email'";
				//echo $query;
				$data =mysqli_query($dbc,$query)
						or die("Error querying from the database");
						
				if(mysqli_num_rows($data)==0)
				{
					echo "true";
				}
				else if(mysqli_num_rows($data)==1)
				{
					echo "taken";
				}
				else
				{
					echo "fatal error occurred!";
				}
			}
				
		}
		else
		{
			echo "empty error";
		}
	}
	else
	{
		echo "notset error";
	}
?>