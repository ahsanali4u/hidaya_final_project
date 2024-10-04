<div class="flex-shrink-0 p-3 bg-dark" style="width: 100%; height: 100%; ">
    <a href="admin_panel.php" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom" style="color: white;">
    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="40" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
    </svg>
    <i  class="bi bi-person-square"></i>
        <svg class="bi me-1" width="5" height="24"><use xlink:href="#bootstrap" /></svg>
        <span class="fs-2 fw-semibolds" style="font-variant: small-caps;"><?php echo $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']; ?></span>
    </a>
    <ul class="list-unstyled ps-0">
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false" style="color: white;">
                Users
            </button>
            <div class="collapse" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small" >
                    <li><a href="admin_register.php" class="link-dark rounded" style="color: white;">Add New User</a></li>
                    <li><a href="view_all_user.php" class="link-dark rounded" style="color: white;">View All User</a></li>
                    <li><a href="pending_users.php" class="link-dark rounded" style="color: white;">Pending Users</a></li>
                </ul>
            </div>
        </li>

        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false" style="color: white;">
                Blogs
            </button>
            <div class="collapse" id="dashboard-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="blog_form.php" class="link-dark rounded" style="color: white;">Add New Blog</a></li>
                    <li><a href="blog_settings.php" class="link-dark rounded" style="color: white;">Blog Settings</a></li>
                    <li><a href="view_followers.php" class="link-dark rounded" style="color: white;">View Followers</a></li>
                </ul>
            </div>
        </li>

        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#post-collapse" aria-expanded="false" style="color: white;">
                Posts
            </button>
            <div class="collapse" id="post-collapse" >
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small" >
                    <li><a href="post_form.php" class="link-dark rounded" style="color: white;">Add New Post</a></li>
                    <li><a href="post.php" class="link-dark rounded" style="color: white;">View All Post</a></li>
                    <li><a href="manage_all_posts.php" class="link-dark rounded" style="color: white;">Manage All Post</a></li>
                </ul>
            </div>
        </li>

        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false" style="color: white;">
                Categories
            </button>
            <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="category_form.php" class="link-dark rounded" style="color: white;">Add New Categories</a></li>
                    <li><a href="view_category.php" class="link-dark rounded" style="color: white;">View All Categories</a></li>
                </ul>
            </div>
        </li>

        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#feedback-collapse" aria-expanded="false" style="color: white;">
                Comments & Feedback
            </button>
            <div class="collapse" id="feedback-collapse" >
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small" >
                    <li><a href="feedback.php" class="link-dark rounded" style="color: white;">Give Feedback</a></li>
                    <li><a href="view_feedbacks.php" class="link-dark rounded" style="color: white;">View All Feedback</a></li>
                    <li><a href="view_comments.php" class="link-dark rounded" style="color: white;">View All Comments</a></li>
                </ul>
            </div>
        </li>

        <li class="border-top my-3"></li>
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false" style="color: white;">
                Account
            </button>
            <div class="collapse" id="account-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 large">
                    <li><a href="admin_register.php" class="link-dark rounded" style="color: white;">Add New User</a></li>
                    <li><a href="edit_profile.php" class="link-dark rounded" style="color: white;">Edit Profile</a></li>
                    <li><a href="#" class="link-dark rounded" style="color: white;">Theme Settings</a></li>
                    <li><a href="../logout.php" class="link-dark rounded" style="color: white;">Log out</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>
