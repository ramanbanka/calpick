<?php
	//Include the required files
	require_once('php/connectvars.php');
	require_once('php/appvars.php');
	
	//Start the session
	session_start();
	
	//If the session variable is not set
	if(!isset($_SESSION['user_id']))
	{
		//Redirect the user to the index page
		$index_url='index.php';
		header('Location: ' . $index_url);
	}
	
	//Connect to the database
	$dbc=mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME)
		or die("Error connecting to the database");
	
	//Query the database from the data
	$user_id=$_SESSION['user_id'];
	$query="select * from user where user_id = $user_id";
	$data=mysqli_query($dbc,$query)
		or die("Error querying from the database");
	
	//check if only one entry is recieved or not
	if(mysqli_num_rows($data)!=1)
	{
		//close the connection and die
		mysqli_close($dbc);
		die("unique entry not found");
	}
	
	//fetch the unique row from the data array
	$row=mysqli_fetch_array($data);
	
	//fetch all the information from the row array
	$username=$row['username'];
	$email=$row['email'];
	$first_name=$row['first_name'];
	$last_name=$row['last_name'];
	$country=$row['country'];
	$gender=$row['gender'];
	if(!empty($row['avatar']))
		$avatar=$row['avatar'];
	else
		$avatar='default_avatar.jpg';
	$timezone=$row['timezone'];
	$joindate=$row['joindate'];
	
	//close the connection
	mysqli_close($dbc);
?>

<!doctype html>
<html>
<head>
	<title>Calpick</title>
	<link rel="stylesheet" type="text/css" href="css/theme.css" />
	<link rel="stylesheet" type="text/css" href="css/viewprofile.css" />
</head>
</body>
<!--The header section-->
<?php require_once('php/header.php'); ?>

<!--The main section-->
<div id="mainContainer">
<div id="main" class="contained">
		
	<!--main1-->
	<div id="main1" class="section clearfix">
		
		<!--main1 Left-->
		<div id="main1_left" class="col span_1_of_2">
			<img id="avatar" src="<?php echo UPLOADPATH.$avatar; ?>" 
			alt="avatar"/>
			<br/><a href="#">Change</a>
		</div>
		
		<!--main1 Right-->
		<div id="main1_right" class="col span_1_of_2">
			<h2>Your profile information</h2>
			<table>
			<?php echo
			"
				<tr>
					<th>Name</th>
					<td>$first_name $last_name</td>
				</tr>
				<tr>
					<th>username</th>
					<td>$username</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>$email</td>
				</tr>
				<tr>
					<th>Country</th>
					<td>$country</td>
				</tr>
				<tr>
					<th>Gender</th>
					<td>$gender</td>
				</tr>
				<tr>
					<th>Time Zone</th>
					<td>$timezone</td>
				</tr>
				<tr>
					<th>Join Date</th>
					<td>$joindate</td>
				</tr>
			
			";
			?>
			<tr>
				<td></td>
				<td><a href="editprofile.php">Edit</a></td>
			</tr>
			</table>
		</div>
	</div>
		
</div>
</div>

<!--The footer section-->
<div id="footerContainer">
	<div id="footer" class="section clearfix contained">
		<div id="footer1" class="span_1_of_1">Copyright &copy; 2015. All rights reserved. ARBY productions</div>
	</div>
</div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/signup.js"></script>
</body>
</html>