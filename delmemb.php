<?php
$un = $_GET["un"];

// Connect to the database
$conn = mysqli_connect("localhost","root","","projdb") or die("Cannot connect to database ". mysqli_connect_error());

// Query to delete user with the specified username
$q="delete from register where username='$un'";
$res = mysqli_query($conn,$q) or die("Error in query ". mysqli_error($conn));

// Get the number of affected rows from the query
$count = mysqli_affected_rows($conn);
mysqli_close($conn);
if($count===1)
{
	// Redirect to the allmembers.php page if deletion is successful
	header("location:allmembers.php");
}
else
{
	// Print error message if deletion fails
	print "Error while deleting data";
}

?>
