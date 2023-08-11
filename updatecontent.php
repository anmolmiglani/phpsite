<?php
$pgname = $_GET["pgname"];
$conn = mysqli_connect("localhost","root","","projdb") or die("Cannot connect to database ". mysqli_connect_error());
$q="select * from sitecontent where pagename='$pgname'";
$res = mysqli_query($conn,$q) or die("Error in query ". mysqli_error($conn));
$count = mysqli_affected_rows($conn);
mysqli_close($conn);
if($count===1)
{
	$resarr2 = mysqli_fetch_array($res);
}

?>

<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <title>Update Site Content</title>
    <?php
		require_once("headfiles.php");
	?>
</head>
<body>
	<?php
		require_once("header.php");
	?>
	<!-- header close -->
	
    <div id="contact">
        <h1 align="center">Update Site Content</h1>
        <div class="container">
            <div class="con con1">
                <h2>Fill following details</h2>
                <form name="form1" method="post" enctype="multipart/form-data">
					<br/><br/>
                    <input type="text" value="<?php if(isset($resarr2)) print $resarr2[1];?>" name="hcontent" placeholder="Heading Content" required minlength="2"/><br><br>

                    <textarea name="pagecontent" placeholder="Page Content" rows="10"/><?php if(isset($resarr2)) print $resarr2[2];?></textarea><br/><br/>
					<?php
					if(isset($resarr2))
					print "<img src='uploads/$resarr2[3]' height='225px'><br/>";
					
					?>
					Choose new image, if required<br/><br/>
					<input type="file" name="pagepic"/><br/><br/>
                    <button name="btn" type="submit">Update Content</button>
                </form><br/><br/>
				<?php
				if(isset($_POST["btn"]))
				{
					$conn = mysqli_connect("localhost","root","","projdb") or die("Cannot connect to database ". mysqli_connect_error());
					
					$heading=mysqli_real_escape_string($conn, $_POST["hcontent"]);
					$content=mysqli_real_escape_string($conn, $_POST["pagecontent"]);
					
					$errcode=$_FILES["pagepic"]["error"];
					if($errcode==0)
					{
						$picname = time() . $_FILES["pagepic"]["name"];
						$tname = $_FILES["pagepic"]["tmp_name"];
						move_uploaded_file($tname,"uploads/$picname");
					}
					else
					{
						$picname=$resarr2[3];
					}
					$q="update sitecontent set heading='$heading',sitecontent='$content',picture='$picname' where pagename='$pgname'";
					mysqli_query($conn,$q) or die("Error in query ". mysqli_error($conn));
					$count = mysqli_affected_rows($conn);
					mysqli_close($conn);
					if($count===1)
					{
						$dest=$pgname.".php";
						header("location:$dest");
					}
					else
					{
						print "Error while updating";
					}
				}
				?>
            </div>
            <div class="con con2">
                <img src="images/content.webp">
            </div>
        </div>
    </div>
    <!-- update content div close -->

    <?php
		require_once("footer.php");
	?>
	<!-- footer close -->
</body>

</html>
