<?php
//start session//
session_start();
if(!isset($_SESSION["un"])|| $_SESSION["utype"]!="admin")
{
	header("location:index.php");
}

?>

<!-- addmember -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Member - Restaurant Website</title>
   <?php
		require_once("headfiles.php");
	?>
</head>
<body>
	<?php
		require_once("header.php");
	?>
    <div id="contact">
        <h1 align="center">Add Member</h1>
        <div class="container">
            <div class="con con1">
                <h2>Fill your details</h2>
                <form name="form1" method="post" enctype="multipart/form-data">
                    <input type="text" name="pname" placeholder="Name" required minlength="2"><br><br>
                    <input type="tel" name="phone" placeholder="Phone no" required maxlength="10" minlength="10" pattern="^[0-9]+$"><br><br>
					 <input type="email" name="username" placeholder="Email(Username)" required><br><br>
                     <input type="password" name="pass" placeholder="Password" required><br><br>
                     <select name="role" required>
                        <option value="">Choose Role</option>
                        <option value="normal">User</option>
                        <option value="admin">Admin</option>    
                    </select><br><br>
					 <input type="file" name="profpic" required><br><br>
                    <button name="btn" type="submit">Register</button>
                </form><br><br>
				<?php
				if(isset($_POST["btn"]))
				{
					$conn = mysqli_connect("localhost","root","","projdb") or die("Cannot connect to database ". mysqli_connect_error());
					$pn=mysqli_real_escape_string($conn,$_POST["pname"]);
					$ph=mysqli_real_escape_string($conn,$_POST["phone"]);
					$un=mysqli_real_escape_string($conn,$_POST["username"]);
					$role=mysqli_real_escape_string($conn,$_POST["role"]);
					$pass=password_hash($_POST["pass"], PASSWORD_BCRYPT);
					$picname = time() . $_FILES["profpic"]["name"];
					$tname = $_FILES["profpic"]["tmp_name"];
					move_uploaded_file($tname,"uploads/$picname");
					$q="insert into register values('$pn','$ph','$un','$pass','$picname','$role')";
					mysqli_query($conn,$q) or die("Error in query ". mysqli_error($conn));
					$count = mysqli_affected_rows($conn);
					mysqli_close($conn);
					if($count===1)
					{
						print "Member Added successfully";
					}
					else
					{
						print "Error while adding member";
					}
				}
				?>
            </div>
            <div class="con con2">
                <img src="images/addmember.png">
            </div>
        </div>
    </div>
    <!-- contact div close -->

    <?php
		require_once("footer.php");
	?>
	
</body>

</html>
