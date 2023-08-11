<?php
// Start a session
	session_start();

	//connect to the databse//
	$conn = mysqli_connect("localhost","root","","projdb") or die("Cannot connect to database ". mysqli_connect_error());

	// Query to fetch site content for the 'about' page
	$q="select * from sitecontent where pagename='about'";
	$res=mysqli_query($conn,$q) or die("Error in query ". mysqli_error($conn));

	// Get the number of affected rows from the query
	$count = mysqli_affected_rows($conn);

	// Close the database connection
	mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
     <title>About Us</title>
    <?php
	// Include necessary head files
		require_once("headfiles.php");
	?>
</head>

<body>
   	<?php
		require_once("header.php");
	?>
    <!-- header close -->

    <!-- Main Content -->
    <main id="ab">
        <div class="container">
			<?php
			if($count===1)
			{
				// Fetch content array
				$resarr=mysqli_fetch_array($res);
			?>	
			<div class="ab1">
				<h1><?php print $resarr[1]; ?></h1>
				<p>
				<?php print $resarr[2]; ?></p>
				<?php
					if(isset($_SESSION["un"]))
					{
						if($_SESSION["utype"]=="admin")
						{
							if($count==1)
							{
								// Display update and delete links for admin
								print "<a href='updatecontent.php?pgname=about'>Update</a>&nbsp;
								<a href='delcontent.php?pgname=about'>Delete</a>";
							}
						}
					}
				?>
			</div>
			<div class="ab1">
				<img src="uploads/<?php print $resarr[3]; ?>" alt=""><br/>
			</div>
			<?php
			}
			else
			{
				// If no content, display message
				print "<h1>No Content added</h1>";
			}
			?>
			
        </div>
    </main>

      

    <!-- Footer -->
      <?php
	  // Include footer
		require_once("footer.php");
	?>
</body>

</html>
