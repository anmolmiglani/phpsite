<?php
// Check if session is not started, then start it
if(session_status() === PHP_SESSION_NONE)
{
	session_start();
}
?> 

<?php
// Logout functionality
if(isset($_POST["logoutbtn"]))
{
	session_destroy();
	header("location:index.php");
}

?>

<div id="header">
    <div class="container d-block">
		<div class="row">
				<div class="col-lg-2 col-12">
					<div class="logo">
						<a href="index.php"><img src="images/restaurant.png"> <h1>Grill House</h1></a>
					</div>
				</div>
				<!-- logo close -->
				<div class="col-lg-5 text-lg-left text-center hd1">
					<div class="login_form w-100">
						<form name="form3" method="post">
							<?php
							// Check if user is not logged in
							if(!isset($_SESSION["un"]))
							{
							?>
							<input type="text" name="uname" placeholder="Username"/>
							<input type="password" name="pass" placeholder="Password"/>
							<button name="btn5" type="submit">Login</button>
							
							<?php
							}
							else
							{
								// Display welcome message and logout button if user is logged in
								print "<div class='subform'>Welcome " .  $_SESSION["pn"];
								print "<form name='form1' method='post'>
								<input type='submit' name='logoutbtn' value='Logout'></form></div>";
							}
							?>
							<?php
							
							if(isset($_POST["btn5"]))
							{
								$un=$_POST["uname"];
								$pass=$_POST["pass"];
								$conn = mysqli_connect("localhost","root","","projdb") or die("Cannot connect to database ". mysqli_connect_error());
								$q="select * from register where username='$un'";
								$resh=mysqli_query($conn,$q) or die("Error in query ". mysqli_error($conn));
								$count = mysqli_affected_rows($conn);
								mysqli_close($conn);
								if($count===1)
								{
									$resarrh = mysqli_fetch_array($resh);
									if(password_verify($pass, $resarrh[3]))
									{
										
										$_SESSION["un"]=$resarrh[2];
										$_SESSION["pn"]=$resarrh[0];
										$_SESSION["utype"]=$resarrh[5];
										if($resarrh[5]=="admin")
										{
											// Redirect to appropriate page based on user type
											header("location:allmembers.php");	
										}
										else
										{
											header("location:index.php");
										}
										
										
									}
									else
									{
										print "Incorrect Password";
									}
								}
								else
								{
									print "Incorrect Username";
								}
							}
							?>
						</form>
						</div>
				</div>
				<!-- msg close -->
				<div class="col-lg-5 hd2">
					<div class="nav1 w-100">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="about.php">About</a></li>
							<?php
							if(!isset($_SESSION["pn"]))
							{
								// Display "Register" link if user is not logged in
								print '<li><a href="register.php">Register</a></li>';
							}
							
							if(isset($_SESSION["pn"]))
							{
								if($_SESSION["utype"]=="admin")
								{
									// Display additional links for admin users
									print '<li><a href="addcontent.php">Add Content</a></li>';
									print '<li><a href="allmembers.php">All Members</a></li>';
									print '<li><a href="addmember.php">Add Member</a></li>';
								}
							}
							?>
						</ul>
					</div>
				</div>
				<!-- nav close -->
			</div>
		</div>
	</div>
<!-- header close -->