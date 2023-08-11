<?php
//start session
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
     <title>GrillHouse</title>
    <?php
	// Include necessary head files
		require_once("headfiles.php");
	?>
</head>
<body>
   	<?php
	//include header//
		require_once("header.php");
	?>
    <!-- header close -->
	
    <!-- Main Content -->
    <main id="ab1">
        <div class="container">
           <?php
		   // Connect to the database
			$conn = mysqli_connect("localhost","root","","projdb") or die("Cannot connect to database ". mysqli_connect_error());
			
			// Query to fetch normal users
			$q="select * from register where usertype='normal'";
			$res=mysqli_query($conn,$q) or die("Error in query ". mysqli_error($conn));

			// Get the number of affected rows from the query
			$count = mysqli_affected_rows($conn);

			// Close the database connection
			mysqli_close($conn);
			if($count==0)
			{
				// If no members found, display message
				print "<h1>No members found</h1>";
			}
			else
			{
				// If members found, display the list
				print "<h1>List of Members</h1><br/><br/>";
				print "<div class='table-responsive'><table class='table table-striped'><tbody><tr><th>Name</th>
				<th>Phone</th>
				<th>Username</th>
				<th>Picture</th>
				<th>Update</th>
				<th>Delete</th>
				</tr>";
				while($resarr=mysqli_fetch_array($res))
				{
					print "<tr>
					<td>$resarr[0]</td>
					<td>$resarr[1]</td>
					<td>$resarr[2]</td>
					<td><img src='uploads/$resarr[4]' height='50'></td>
					<td><a href='updateuser.php?un=$resarr[2]'>Update</a></td>
					<td><a href='delmemb.php?un=$resarr[2]'>Delete</a></td>
					</tr>";
				}
				print "</tbody></table></div>";
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
