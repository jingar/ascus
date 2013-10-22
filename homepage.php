<?php
	session_start();
	ob_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<?php require_once('./php/css-js-inc.php'); ?>
		<title>Ascus</title>
	</head>
  <body>
	
		<?php require_once('./php/header-inc.php');?>
		<div class="container">
			<div id="Carousel" class="carousel slide">
				<div class="carousel-inner carousel-max-height">
					<div class="item active">
						<img src="./images/grey.png">
					</div>
					<div class="item">
						<img src="./images/grey-pattern.jpg">
					</div>
				</div>
				<a class="left carousel-control" href="#Carousel" data-slide="prev">
					<span class="icon-prev"></span>
				</a>
				<a class="right carousel-control" href="#Carousel" data-slide="next">
					<span class="icon-next"></span>
				</a>
			</div>
		</div>
	</body>
</html>
