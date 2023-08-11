<?php
// Get the username from the query parameter "un"
$uname = $_GET["un"];

// Connect to the database
$conn = mysqli_connect("localhost","root","","projdb") or die("Cannot connect to database ". mysqli_connect_error());

// Query to retrieve user information based on the provided username
$q="select * from register where username='$uname'";
$res = mysqli_query($conn,$q) or die("Error in query ". mysqli_error($conn));

// Get the number of rows affected by the query
$count = mysqli_affected_rows($conn);
mysqli_close($conn);

// If a user is found, fetch their details into an array
if($count===1)
{
	$resarr2 = mysqli_fetch_array($res);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update User - Restaurant Website</title>
    <?php
	// Include necessary head files (stylesheets, scripts, etc.)
		require_once("headfiles.php");
	?>
</head>
<body>
	<?php
		require_once("header.php");
	?>
	<!-- header close -->
	
    <div id="contact">
        <h1 align="center">Update User</h1>
        <div class="container">
            <div class="con con1">
                <h2>Fill your details</h2>
                <form name="form1" method="post" enctype="multipart/form-data">
                    <input type="text" value="<?php if(isset($resarr2)) print $resarr2[0];?>" name="pname" placeholder="Name" required minlength="2"><br><br>

					 <!-- Input field for user's phone number -->
                    <input type="tel" value="<?php if(isset($resarr2)) print $resarr2[1];?>" name="phone" placeholder="Phone no" required maxlength="10" minlength="10" pattern="^[0-9]+$"><br><br>
                    
                    <?php
					 // Display the user's current profile picture if available
					if(isset($resarr2))
					print "<img src='uploads/$resarr2[4]' height='225px'><br/>";
					
					?>
					<!-- Input field for uploading a new profile picture -->
					Choose new image, if required<br/><br/>
					 <input type="file" name="profpic"><br><br>

                    <button name="btn" type="submit">Update</button>
                </form><br><br>
				<?php
				if(isset($_POST["btn"]))
				{
					$conn = mysqli_connect("localhost","root","","projdb") or die("Cannot connect to database ". mysqli_connect_error());
					$pn=mysqli_real_escape_string($conn,$_POST["pname"]);
					$ph=mysqli_real_escape_string($conn,$_POST["phone"]);
					
					$errcode=$_FILES["profpic"]["error"];
					if($errcode==0)
					{
						$picname = time() . $_FILES["profpic"]["name"];
						$tname = $_FILES["profpic"]["tmp_name"];
						move_uploaded_file($tname,"uploads/$picname");
					}
					else
					{
						$picname=$resarr2[4];
					}
					$q="update register set name='$pn',phone='$ph', pic='$picname' where username='$uname'";
					mysqli_query($conn,$q) or die("Error in query ". mysqli_error($conn));
					$count = mysqli_affected_rows($conn);
					mysqli_close($conn);
					if($count===1)
					{
						header("location:allmembers.php");
					}
					else
					{
						print "Error while updating";
					}
				}
				?>
            </div>
            <div class="con con2">
                <img src="images/edit_user.png">
            </div>
        </div>
    </div>
    <!-- content close -->

    <?php
		require_once("footer.php");
	?>
	<!-- footer close -->
</body>

</html>
