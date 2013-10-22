<?php
	session_start();
	ob_start();
	$redirect = './homepage.php';	
	if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true)
	{
		header("Location: $redirect");
	}
	elseif(isset($_POST['login']))
	{
		
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		require_once('./php/authenticate-pdo-inc.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<?php require_once('./php/css-js-inc.php');?>
	</head>
	<?php require_once('./php/header-inc.php');?>
	<?php
		if ($error){
			echo '<div class="container form-group has-error">';
			echo "<label class=control-label for=inputError><p>$error</p></label>";}
		elseif(isset($_GET['expired']))
		{
	?>
	<div class="container form-group has-error">
	<label class=control-label for=inputError><p>Your session has expired. Please log in again.</p></label>
	<?php } ?>
	<body>
		<div class="container">
			<form id="login_form" class="form-horizontal push-down" role="form" method ="post" action ="">
				<div class="form-group">
					<label for="Username" class="col-md-2 control-label">Username</label>
					<div class="col-md-8">
						<input name="username" type="text" class="form-control" id="username" placeholder="Username">
					</div>
				</div>
			   <div class="form-group">
					<label for="password" class="col-md-2 control-label">Password</label>
					<div class="col-md-8">
						<input name="password" type="password" class="form-control" id="password" placeholder="Password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-2 col-md-10">
					<button name="login" type="submit" class="btn btn-default">Log in</button>
				 </div>
			  </div>
			</form>
		</div>
	</body>
</html>