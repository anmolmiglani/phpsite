<?php
// Start a session
session_start();

// Check if the user is not logged in or not an admin, then redirect to index.php
if(!isset($_SESSION["un"])|| $_SESSION["utype"]!="admin")
{
	header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Site Content - Restaurant Website</title>
    <?php
	// Include necessary head files
		require_once("headfiles.php");
	?>
</head>
<body>
	<?php
	// Include header
		require_once("header.php");
	?>
	<!-- header close -->
	
    <div id="contact">
        <h1 align="center">Add Site Content</h1>
        <div class="container">
            <div class="con con1">
                <h2>Fill following details</h2>
                <form name="form1" method="post" enctype="multipart/form-data">
					<select name="pagename">
						<option value="">Choose Page Name</option>
						<option value="index">Home Page</option>
						<option value="about">About Page</option>
					</select><br/><br/>
                    <input type="text" name="hcontent" placeholder="Heading Content" required minlength="2"/><br><br>
                    <textarea name="pagecontent" placeholder="Page Content"/></textarea><br/><br/>
					 <input type="file" name="pagepic" required/><br><br>
                    <button name="btn" type="submit">Add Content</button>
                </form><br><br>
				<?php
				if(isset($_POST["btn"]))
				{
					$conn = mysqli_connect("localhost","root","","projdb") or die("Cannot connect to database ". mysqli_connect_error());
					$pn=mysqli_real_escape_string($conn, $_POST["pagename"]);
					$heading=mysqli_real_escape_string($conn, $_POST["hcontent"]);
					$content=mysqli_real_escape_string($conn, $_POST["pagecontent"]);
					$picname = time() . $_FILES["pagepic"]["name"];
					$tname = $_FILES["pagepic"]["tmp_name"];
					move_uploaded_file($tname,"uploads/$picname");
					
					$q="insert into sitecontent(pagename,heading,sitecontent,picture) values('$pn','$heading','$content','$picname')";
					mysqli_query($conn,$q) or die("Error in query ". mysqli_error($conn));
					$count = mysqli_affected_rows($conn);
					mysqli_close($conn);
					if($count===1)
					{
						print "Content Added Successfully";
						
					}
					else
					{
						print "Error while adding";
					}
				}
				?>
            </div>
            <div class="con con2">
                <img src="images/content.webp">
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
