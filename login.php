<?php include '../classes/Adminlogin.php' ?>
<?php 
	$al = new Adminlogin();
	if ($_SERVER['REQUEST_METHOD']== 'POST') {
		$admin_user = $_POST['admin_user'];
		$admin_pass = md5($_POST['admin_pass']);

		$logincheck = $al->AdminLogin($admin_user,$admin_pass);    //passing value to Adminlogin class
	}


?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<span style="color: red;font-size: 18px;" >
			<?php if (isset($logincheck)) {
				echo $logincheck;
				
			}
			?>

			</span>
			<div>
				<input type="text" placeholder="Username"  name="admin_user"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="admin_pass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">for a cupon site</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>