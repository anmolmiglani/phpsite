<!-- about.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register - Restaurant Website</title>
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
        <h1 align="center">Register</h1>
        <div class="container">
            <div class="con con1">
                <h2>Fill your details</h2>
                <form name="form1" method="post" enctype="multipart/form-data">
                    <input type="text" name="pname" placeholder="Name" required minlength="2"><br><br>
                    <input type="tel" name="phone" placeholder="Phone no" required maxlength="10" minlength="10" pattern="^[0-9]+$"><br><br>
					 <input type="email" name="username" placeholder="Email(Username)" required><br><br>
                     <input type="password" name="pass" placeholder="Password" required><br><br>
					 <input type="file" name="profpic" required><br><br>
                    <button name="btn" type="submit">Register</button>
                </form><br><br>
				<?php
				if(isset($_POST["btn"]))
				{
					$conn = mysqli_connect("localhost","root","","projdb") or die("Cannot connect to database ". mysqli_connect_error());
					$sql = "CREATE TABLE if not exists `register` (
						`Name` varchar(100) NOT NULL,
						`Phone` varchar(20) NOT NULL,
						`Username` varchar(100) NOT NULL,
						`Password` varchar(300) NOT NULL,
						`Pic` varchar(100) NOT NULL,
						`UserType` varchar(10) NOT NULL
					  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
						
						if (mysqli_query($conn, $sql)) {
							$pn=mysqli_real_escape_string($conn,$_POST["pname"]);
							$ph=mysqli_real_escape_string($conn,$_POST["phone"]);
							$un=mysqli_real_escape_string($conn,$_POST["username"]);
							$pass=password_hash($_POST["pass"], PASSWORD_BCRYPT);
							$picname = time() . $_FILES["profpic"]["name"];
							$tname = $_FILES["profpic"]["tmp_name"];
							move_uploaded_file($tname,"uploads/$picname");
							$q="insert into register values('$pn','$ph','$un','$pass','$picname','normal')";
							mysqli_query($conn,$q) or die("Error in query ". mysqli_error($conn));
							$count = mysqli_affected_rows($conn);
							mysqli_close($conn);
							if($count===1)
							{
								print "Registration Successfull, now you can login";
							}
							else
							{
								print "Error while registration";
							}
						} else {
						  echo "Error creating table: " . mysqli_error($conn);
						}
				}
				?>
            </div>
            <div class="con con2">
                <img src="images/signupp.png">
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
