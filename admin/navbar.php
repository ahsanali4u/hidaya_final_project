<nav class="navbar navbar-dark bg-dark navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="../indexx.php" style="font-size: 30px; font-variant: small-caps; font-weight: bolder;">Pakistan News Blog</a>
        &nbsp; &nbsp; &nbsp; &nbsp;
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link me-3 btn btn-outline-primary" href="admin_panel.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-3 btn btn-outline-primary" href="feedback.php">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-3 btn btn-outline-primary" href="about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-3 btn btn-outline-primary" href="../indexx.php">User Panel</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <?php if(isset($_SESSION['user'])){ ?>
                    <li class="nav-item dropdown">
                        
                        <a class="nav-link dropdown-toggle me-3 btn btn-outline-primary" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-weight: bolder; font-size: 22px; color: white;" >
                        <img src="<?= $_SESSION['user']['user_image'];  ?>" style="width: 60px; height: 50px; border-radius: 50%;"> &nbsp;
                        <?php echo $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="edit_profile.php">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>
