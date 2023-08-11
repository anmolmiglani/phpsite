<?php
$pgname = $_GET["pgname"];

// Connect to the database
$conn = mysqli_connect("localhost","root","","projdb") or die("Cannot connect to database ". mysqli_connect_error());

// Query to delete content with the specified page name
$q="delete from sitecontent where pagename='$pgname'";

// Get the number of affected rows from the query
$res = mysqli_query($conn,$q) or die("Error in query ". mysqli_error($conn));
$count = mysqli_affected_rows($conn);

// Close the database connection
mysqli_close($conn);
if($count===1)
{
	 // Redirect to the corresponding page using the page name
    $dest=$pgname.".php";
	header("location:$dest");
}
else
{
	// Print error message if deletion fails
	print "Error while deleting data";
}

?>
\