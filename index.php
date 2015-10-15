<!DOCTYPE html>

<?php

	//starting the session
	session_start();

	//check if the user is already logged in
	//if session is not already set try to set it using cookies
	if(!isset($_SESSION['user_id']))
	{
		
		if(isset($_COOKIE['user_id']) && isset($_COOKIE['username']))
		{
			$_SESSION['user_id']=$_COOKIE['user_id'];
			$_SESSION['username']=$_COOKIE['username'];
		}
	}
	
	//If now session is set, redirect the user to his home page
	if(isset($_SESSION['user_id']))
	{
		$userhome_url='home.php';
		header('Location: ' . $userhome_url);
	}
?>

<html lang="en">
<head>

  <title>Calpick</title>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!--------------------------------STYLE INCLUDES----------------------------->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style type="text/css">
	body
	{
		background-color:#DDD;
		color: #446;
	}
	
	#header_inner
	{
		margin-top:20px;
		margin-bottom:10px;
		font-size:40px;
	}
	
	#login_modal_trigger
	{
		width:90px;
		font-size:15px;
		background-color:transparent;
		border-color:#777
	}
	
	#login_submit,#signup_submit
	{
		width:90px;
		font-size:15px;
	}
	
	#advert1
	{
		font-size:50px;
	}
	
	#advert2
	{
		font-size:20px;
	}
  </style>
  <!---------------------------------------------------------------->
  
</head>

<body>

<!--The header section-->

<!--Outer fluid container-->
<div id="header_outer" class="container-fluid">
	
	<!--Inner container-->
	<div id="header_inner" class="container" >
		<div class="row">
			<div id="header-left" class="col-lg-6">
				calpick
			</div>
			<div id="header-right" class="col-lg-6 text-right">
				<button id="login_modal_trigger" class="btn btn-default " data-toggle="modal" data-target="#login_modal">Log in</button>
				<button id="know_more" class="btn btn-primary ">Know More</button>
			</div>
		</div>
	</div><!--header_inner ends-->

</div><!--header_outer ends-->



<!--The main section-->

<!--Outer fluid container-->
<div id="main_outer" class="container-fluid"> 
	<!--Inner container-->
	<div id="main_inner" class="container">
		<div class="row">
			
			<!--Main left-->
			<div id="main_left" class="col-lg-7">
				
				<br/><br/><br/><br/><br/><br/><br/>
				<p id="advert1"> Now never miss a deadline with calpick.</p>
				<p id="advert2"> Time for a completely new social experience.</p>
				<br/><br/><br/><br/><br/><br/><br/>
				
			</div>
			
			<!--Main right-->
			<div id="main_right" class="col-lg-5">
				
				<h2 align="center">Join now</h2>
				<p align="center">It is free, easy and takes only a minute.</p>
				
				<form method="post" action="#" id="signup_form" class="form-horizontal" role="form">
			
					<div id="first_name_group" class="form-group has-feedback">
						<label class="control-label col-sm-4" for="first_name">First name</label>
						<div class="col-sm-8">
							<input type="text" name="first_name" id="first_name" maxlength="32" class="form-control" placeholder="Enter your first name" required="required"/>
							<span id="first_name_feedback" class="glyphicon form-control-feedback"></span>
						</div>
						<div class="help-block"><p id="first_name_feedback" class="text-danger"></p></div>
					</div>
					
					<div id="last_name_group" class="form-group has-feedback" >
						<label class="control-label col-sm-4" for="last_name">Last name</label>
						<div class="col-sm-8">
							<input type="text" name="last_name" id="last_name"  class="form-control" placeholder="Enter your last name" required="required"/>
							<span id="last_name_feedback" class="glyphicon form-control-feedback"></span>
						</div>
						<div class="help-block"><p id="last_name_feedback" class="text-danger"></p></div>
					</div>
					
					<div id="email_group" class="form-group has-feedback">
						<label class="control-label col-sm-4" for="email">Email</label>
						<div class="col-sm-8">
							<input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address" required="required"/>
							<span id="email_feedback" class="glyphicon form-control-feedback"></span>
							
						</div>
						<div class="help-block"><p id="email_feedback" class="text-danger"></p></div>
					</div>
				
					<div id="username_group" class="form-group has-feedback">
						<label class="control-label col-sm-4" for="username">Username</label>
						<div class="col-sm-8">
							<input type="text" name="username" id="username" class="form-control" required="required" placeholder="Choose a username."/>
							<span id="username_feedback" class="glyphicon form-control-feedback"></span>
						</div>
						<div class="help-block"><p id="username_feedback" class="text-danger"></p></div>
					</div>
					
					<div id="password1_group" class="form-group has-feedback">
						<label class="control-label col-sm-4" for="password1">Create Password</label>
						<div class="col-sm-8">
							<input type="password" name="password1" id="password1" class="form-control" placeholder="atleast 6 characters long" required="required"/>
							<span id="password1_feedback" class="glyphicon form-control-feedback"></span>
						</div>
						<div class="help-block"><p id="password1_feedback" class="text-danger"></p></div>
					</div>
					
					<div id="password2_group" class="form-group has-feedback">
						<label class="control-label col-sm-4" for="password2">Re enter Password</label>
						<div class="col-sm-8">
							<input type="password" name="password2" id="password2" class="form-control" placeholder="the two passwords must match" required="required"/>
							<span id="password2_feedback" class="glyphicon form-control-feedback"></span>
						</div>
						<div class="help-block"><p id="password2_feedback" class="text-danger"></p></div>
					</div>
					
					<p>By clicking submit you confirm that you have read the <a href="#">terms and conditions</a>, that you understand them and that you agree to be bound by them.</p>
					
					<div class="col-sm-4"></div>
					<div class="col-sm-8">
						<button id="signup_submit" name="signup_submit" type="submit" class="btn btn-primary">Submit</button>
					</div>
					<div class="help-block"><p id="signup_submit_feedback" class="text-danger"></p></div>
			</form>
			
			</div>
		</div>
	</div><!--Main inner ends-->
</div><!--main outer ends>


<!--Footer Section-->

<!--Footer Outer-->
<div id="footer_outer" class="container-fluid">
	
	<!--Footer inner-->
	<div id="footer_inner" class="container">
		All rights reserved. Copyright &copy 2015 Calpick inc.
	</div>

</div>



<!------------------------------OVERLAY ITEMS------------------------------------->

<!-------------Login modal------------->
<div id="login_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				
				<h4>Enter your login credentials: </h4>
				
				<form role="form">
					<div class="form-group">
						<label for="login_username"> Username </label>
						<input id="login_username" type="text" name="login_username" class="form-control" placeholder="Enter Username"/>
					</div>
					<div class="form-group">
						<label for="login_password"> Password </label>
						<input id="login_password" type="password" name="login_password" class="form-control" placeholder="Enter Password"/>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="yes" checked="none"/> Remember me</label>
					</div>
					
					<button id="login_submit" type="submit" class="btn btn-primary">Log In</button>
					<div class="help-block"><p class="text-danger"></p></div>
					<a href="#"> Forgot password? </a>
				</form>
			</div>
			
		</div>
	</div>
</div>

<!-----------------------------SCRIPT INCLUDES------------------------------->
 
  <!--Include bootstrap and jquery-->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  
  <!--Include my javascript-->
  <script src="js/index.js"></script>
<!--------------------------------------------------------------------------->

</body>
</html>
