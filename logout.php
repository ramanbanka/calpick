<?php
	//Start the session
	session_start();
	
	if(isset($_SESSION['user_id']))
	{
		//Delete all the session variables by assigning the $_SESSION superglobal an empty array
		$_SESSION=array();
	
		if(isset($_COOKIE[session_name()]))
		{
			//Delete the session_name() cookie by setting the expiration time to an hour before
			setcookie(session_name(),'',time()-3600,'/');
		}
	
		//Destroy the session
		session_destroy();
	}
	//Delete the user_id and username cookies by setting their expiration time to an hour before
	setcookie('user_id','',time()-3600,'/');
	setcookie('username','',time()-3600,'/');
	
	//Redirect to the index page
	$index_url="index.php";
	header("Location:" . $index_url);
?>