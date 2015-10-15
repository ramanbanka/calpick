<?php
echo '<div id="headerContainer">
<div id="header" class="section clearfix contained">
		<!--Header Left(Logo)-->
		<div id="header_left" class="col span_1_of_5">
			<a href="index.php"><strong>CALPICK</strong><i>(dev 1.2)</i></a>
		</div>
		
		<!--Header Right(Options)-->
		<div id="header_right" class="col span_4_of_5">
			<div id="wrapper" class="clearfix">
			<div id="nav_menu">
				<ul>
					<li><a href="#">Settings</a>
						<ul>
							<li><a href="logout.php">Log out</a></li>
							<li><a href="editprofile.php">Edit profile</a></li>
							<li><a href="#">Privacy</a></li>
							<hr/>
							<li><a href="#">Report a problem</a></li>
							<li><a href="#">Help</a></li>
							<li><a href="#">Contact Support</a></li>
						</ul>
					</li>
					<li><a href="#">Friends</a>
						<ul>
							<li><a href="#">View Friends</a></li>
							<li><a href="#">Add Friends</a></li>
						</ul>
					</li>
					<li><a href="#">Contacts</a>
						<ul>
							<li><a href="#">View Contacts</a></li>
							<li><a href="#">Add Contacts</a></li>
						</ul>
					</li>
					<li><a href="#">Groups</a>
						<ul>
							<li><a href="#">View Groups</a></li>
							<li><a href="#">Create new Group</a></li>
							<li><a href="#">Join a group</a></li>
						</ul>
					</li>
					<li><a href="viewprofile.php">'.$_SESSION['username'].'</a></li>
					<li><a href="userhome.php">home</a></li>
					<li><input type="text" name="search" id="search" placeholder="Search people or group"></li>
				</ul>
			</div>
			</div>
		</div>
</div>
</div>';
?>