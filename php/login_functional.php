<?php
	//include the required files
	require_once('connectvars.php');
	
	//start the session
	//session_start();

	//check if the form has been submitted
	if(isset($_POST['submit']))
	{
		//Connect to the database
		$dbc=mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME)											
			 or die("Error connecting to the database.");
			 
		//Fetch the entered info in the form
		$username= test_input($dbc,$_POST['username']); 
		$password= test_input($dbc,$_POST['password']);
		
		
		if(!empty($username) && !empty($password))
		{		
		
			//Check if the username and password match
			$query = "select * from user where username='$username' and password=SHA('$password')";
			$data = mysqli_query($dbc,$query)
					or die("error querying from the database.");
			
			//If the username and passwords match,number of rows in the data will be 1, so login the user
			if(mysqli_num_rows($data)==1)
			{
				$row = mysqli_fetch_array($data);
				
				//Set the session variables
				$_SESSION['user_id']=$row['user_id'];
				$_SESSION['username']=$row['username'];
				
				//Set the cookies
				if(isset($_POST['remember_me']) && $_POST['remember_me']=="yes")
				{
					setcookie('user_id',$row['user_id'],time() + 60*60*24*30);	//Expires in 30 days
					setcookie('username',$row['username'],time() + 60*60*24*30);	//Expires in 30 days
				}
				
				//Redirect the user to their home page
				$userhome_url = "userhome.php";
				header("Location:" . $userhome_url);
			}
			else
			{
				//If the username and password do not match
				echo "Invalid login details";
			}
		}
		else
		{	
			//If the password or the username is left blank
			echo 'Please enter your username and password';
		}
	}
	
	function test_input($dbc,$data) 
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  $data	= mysqli_real_escape_string($dbc,$data);
	  return $data;
	}
?>
