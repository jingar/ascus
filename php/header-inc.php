<div class="container">
		<h3 class="text-muted">Ascus</h3>
		<ul class="nav nav-justified navbar-inverse">
			<li class="active">
				<a href="homepage.php">Home</a>
			</li>
			<li>
				<a href="#">Event</a>
			</li>
			<li>
				<a href="#">About</a>
			</li>
			<li>
				<a href="#">contact</a>
			</li>
			<li  class="dropdown">
			<?php if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true)
				{
			?>
				<a data-toggle="dropdown" href="profile.php">Account</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li role = "presentation">
						<a href="profile.php">Profile</a>
					</li>
					<li role = "presentation">
						<a href="logout.php">Log out</a>
					</li>
				</ul>
			<?php
				}
				else
				{
			?>
				<a href="login.php">Log In</a>
			<?php } ?>
			</li>
		</ul>
	</div>