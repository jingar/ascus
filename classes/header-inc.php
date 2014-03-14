<nav class="navbar navbar-default navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand nav-link" href="homepage.php">Ascus</a>
        </div> <!-- /.navbar-header -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#tour" class="nav-link">People</a></li>
                <li><a href="#about" class="nav-link">About</a></li>
                <li><a href="#contact">Contact Us</a></li>
                <?php
                $member = new Member();
                if($member->isLoggedIn()){ ?>
                <li><a href="#profile" class="nav-link">Profile</a></li>
                <li class="dropdown dropdown-transparent">
                    <a  href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Account
                        <span class="caret"></span>
                    </a>
                    <ul class="navbar-inverse dropdown-menu" role="menu"aria-labelledby="dropdownMenu1">
                        <li><a href="<?php echo Sanitize::escape('profile.php?id=' . $member->getData()->members_id) ?>">
                            Profile</a></li>
                            <li><a href=" <?php echo Sanitize::escape('editprofile.php?id=' . $member->getData()->members_id) ?>">
                                Settings</a></li>
                                <li role="presentation" class="divider"></li>
                                <li><a href="logout.php">Sign Out</a></li>
                            </ul>
                        </li>
                        <?php } else{ ?>
                        <li>
                            <FORM METHOD="LINK" ACTION="login.php">
                                <INPUT style="margin-left: 10px;" class="btn btn-warning btn-sm navbar-btn" TYPE="submit" VALUE="Log in"/>
                            </FORM>
                        </li>
                        <?php } ?>
                    </ul>
                </div> <!-- /.navbar-collapse -->
            </div> <!-- /.container -->
</nav> <!-- /.navbar -->