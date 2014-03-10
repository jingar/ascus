    <div class="container">
        <div class="masthead text-muted">
            <ul class="nav nav-justified">
                <li><h3>Ascus</h3></li>
                <li class="active"><a href="../homepage.php">Home</a></li>
                <li><a href="#">Forum</a></li>
                <li><a href="#">About</a></li>
                <?php
                $member = new Member();
                if($member->isLoggedIn()){ ?>
                <li class="dropdown">
                    <a  href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Account
                        <span class="caret"></span>
                    </a>
                 <ul class="dropdown-menu" role="menu"aria-labelledby="dropdownMenu1">
                        <li><a href="<?php echo Sanitize::escape('profile.php?id=' . $member->getData()->members_id) ?>">
                        Profile</a></li>
                        <li><a href=" <?php echo Sanitize::escape('editprofile.php?id=' . $member->getData()->members_id) ?>">
                        Settings</a></li>
                        <li role="presentation" class="divider"></li>
                        <li><a href="logout.php">Sign Out</a></li>
                    </ul>
                </li>
                <?php } else{ ?>
                <li> <a href="login.php">Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>