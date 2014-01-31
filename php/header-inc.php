<div class="container">
    <div class="masthead text-muted">
        <ul class="nav nav-justified">
            <li><h3>Ascus</h3></li>
            <li class="active"><a href="../homepage.php">Home</a></li>
            <li><a href="#">Forum</a></li>
            <li><a href="#">About</a></li>
            <?php if ($_SESSION['authenticated'] === true) { ?>
                <li><a href="../logout.php">Log out</a></li>
            <?php } else { ?>
                <li><a href="../login.php">Log in</a></li>
            <?php } ?>
        </ul>
    </div>
</div>