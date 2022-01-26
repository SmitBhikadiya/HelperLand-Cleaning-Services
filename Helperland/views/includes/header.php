<?php
$usertype_loc = "#";
if (isset($_SESSION["usertype"])) {
    $usertype_loc = $_SESSION["usertype"][1];
}
?>
<header class="header">
    <nav class="navbar">
        <a class="navbar-brand" href="Homepage.php"><img src="./static/images/nav-logo.png" alt=""></a>
        <ul class="nav-list">
            <li><a href="book-now.php" class="nav-btn">Book a Cleaner</a></li>
            <li><a href="Prices.php">Prices</a></li>
            <li><a href="#">Warranty</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="contact.php">Contact Us</a></li>

            <?php if (isset($userdata)) { ?>
                <li class="nav-item notification-icon">
                    <div class="seprators">
                        <div class="n-counter">12</div>
                        <img src="./static/images/icon-notification.png" alt="">
                    </div>
                </li>
                <li class="nav-item li-custom-dropdown li-dropdown">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                            <img src="./static/images/admin-user.png" alt="">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <div class="dropdown-item">
                                Welcome, <br><b><?= $userdata["firstname"] . " " . $userdata["lastname"] ?></b>
                            </div>
                            <hr style="margin: 5px;">
                            <a class="dropdown-item" href="<?= $usertype_loc ?>">
                                My Dashboard
                            </a>
                            <a class="dropdown-item" href="<?= './' . $usertype_loc . '?req=setting' ?>">
                                My Setting
                            </a>
                            <a class="dropdown-item" href="../controllers/UsersController.php?lg=logout">
                                Logout
                            </a>
                        </div>
                    </div>
                </li><?php
                    } else {
                        ?>
                <li><a href="Homepage.php?login=m" class="nav-btn">Login</a></li>
                <li><a href="sp-sign-up.php" class="nav-btn">Become a Helper</a></li>
            <?php
                    } ?>

        </ul>
        <div class="menu-bar">
            <i class="fa fa-bars"></i>
        </div>
    </nav>
</header>