
<?php require_once("database_class.php"); ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="indexx.php" style="font-size: 30px; font-variant: small-caps; font-weight: bolder;">Pakistan News Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <div class="d-lg-flex justify-content-between align-items-center w-100">
        <ul class="navbar-nav">
          <li class="nav-item mx-2">
            <a class="nav-link btn btn-outline-primary" href="indexx.php">Home</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link btn btn-outline-primary" href="feedback.php">Contact Us</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link btn btn-outline-primary" href="about.php">About Us</a>
          </li>
          <?php if(isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1){ ?>
          <li class="nav-item mx-2">
            <a class="nav-link btn btn-outline-primary" href="admin/admin_panel.php">Admin Dashboard</a>
          </li>
          <?php } ?>
        </ul>

        <ul class="navbar-nav ms-auto">
          <?php if(isset($_SESSION['user'])){ ?>
          <li class="nav-item dropdown mx-2">
            <a class="nav-link dropdown-toggle btn btn-outline-primary" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-weight: bolder; font-size: 20px; color: white;" >
              <img src="<?= $_SESSION['user']['user_image']; ?>" style="width: 60px; height: 50px;" class="rounded-circle"> 
              <?php echo $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="update_user_profile.php">Edit Profile</a></li>
              <li><a class="dropdown-item" href="#">Theme Settings</a></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
          <?php }else{ ?>
          <li class="nav-item mx-2">
            <a class="nav-link btn btn-outline-primary" href="login.php">Sign In</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link btn btn-outline-primary" href="user_register.php">Register Here</a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</nav>
