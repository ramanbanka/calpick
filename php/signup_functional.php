<?php
	
	//Include the required files
	require_once('connectvars.php');
	
	//Start the session
		//session_start(); Not starting here because it has already been started in the caller

	//Check if the form has been submitted
	if(isset($_POST['submit']))
	{
		//Check if the required fields are set or not
		if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['first_name']) && isset($_POST['password1']) && isset($_POST['password2']))
		{
			
			
			
			//Connect to the database
			$dbc =  mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME)
					or die("Error connecting to the database1.1");
					
			//Grab the values from the form
			$username=test_input($dbc,$_POST['username']);
			$email=test_input($dbc,$_POST['email']);
			$password=test_input($dbc,$_POST['password1']);	//Sensitive data here
			$first_name=test_input($dbc,$_POST['first_name']);
			$last_name=test_input($dbc,$_POST['last_name']);
			$joindate = time();
			
			//Check if the required fields are empty
			if(empty($username) || empty($email) || empty($password) || empty($first_name))
			{
				die("Please fill up all the required fields ");
			}
			
			//check if username is atleast 4 characters or not
			if(strlen($_POST['username'])<4)
			{
				die("The length of the username must be atleast 4 characters");
			}
			
			//Check if the two passwords match
			if($_POST['password1'] != $_POST['password2'])
			{
				die("The two passwords you entered do not match");
			}
			
			//query to check if the username already exists or not
			$query = "Select user_id from user where username='$username'";
			$data = mysqli_query($dbc,$query)
					or die("Error querying from the database error 1");
		
			//If the username doesn't already exist
			if(mysqli_num_rows($data)==0)
			{
				//Insert the new user entry into the database
				$query2= "insert into user(username,email,password,first_name,last_name,joindate) values('$username','$email	',SHA('password'),'$first_name','$last_name',$joindate)";
				$result = mysqli_query($dbc,$query2)
						 or die("Error querying from the database error 2");
				
				$user_id=mysqli_insert_id($dbc);
				
				//Login the user and remember him
				$_SESSION['user_id']=$user_id;
				$_SESSION['username']=$username;
				setcookie('user_id',$user_id,time() + 60*60*24*30);	//Expires in 30 days
				setcookie('username',$username,time() + 60*60*24*30);	//Expires in 30 days
				
				//Display the signup successful message
				echo "<p>Welcome to calpick Mr. $first_name $last_name. You have been signed up successfully..</p>";
				
				//Redirect the user to the userhome page
				$signup2_url='signup2.php';
				header('Location: ' . $signup2_url);
			}
			else
			{
				echo '<p>This username is already taken. Please try a different one.</p>';
			}
			
			//Close the database connection
			mysqli_close($dbc);
				
			
		}	
		else
		{
			echo '<p>Please enter all the information(* fields are compulsory)</p>';
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