<?php
	session_start();
	$conn = mysqli_connect("localhost","root","","projdb") or die("Cannot connect to database ". mysqli_connect_error());
	$q="select * from sitecontent where pagename='index'";
	$res=mysqli_query($conn,$q) or die("Error in query ". mysqli_error($conn));
	$count = mysqli_affected_rows($conn);
	mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
	
<head>
    <meta charset="UTF-8">
     <title>Grill House :: HomePage</title>
    <?php
		require_once("headfiles.php");
	?>
</head>

<body>
   	<?php
		require_once("header.php");
	?>
    <!-- Header close -->

    <!-- Main Content -->
    <main id="ab" class="contentnew">
        <div class="container">
			<?php
			if($count===1)
			{
				$resarr=mysqli_fetch_array($res);
			?>	
			<div class="ab1">
				<?php print "<h1>" . $resarr[1] . "</h1>"; ?>
				<p>
				<?php print $resarr[2]; ?></p>
				<?php
					if(isset($_SESSION["un"]))
					{
						if($_SESSION["utype"]=="admin")
						{
							if($count==1)
							{
								print "<a href='updatecontent.php?pgname=index'>Update</a>&nbsp;
								<a href='delcontent.php?pgname=index'>Delete</a>";
							}
						}
					}
				?>
			</div>
			<div class="ab1 ab11">
				<img src="uploads/<?php print $resarr[3]; ?>" alt=""><br/>
			</div>
			<?php
			}
			else
			{
				print "<h1>No Content added</h1>";
			}
			?>
			
        </div>
    </main>

      

    <!-- Footer -->
      <?php
		require_once("footer.php");
	?>
</body>

</html>
