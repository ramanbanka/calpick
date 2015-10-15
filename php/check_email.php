<?php
	if(isset($_POST['email']))
	{
		$email = $_POST['email'];
		if(!empty($email))
		{
			if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
				echo "false";
			else
				echo "true";
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