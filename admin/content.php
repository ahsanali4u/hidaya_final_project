<?php require_once ("../database_class.php"); ?>

<h1 class="mt-4" style="color: white;">Admin Panel Dashboard</h1>

<?php if(isset($_SESSION['user'])){ ?>

<h3 class="mt-4" style="color: white; font-variant: small-caps; font-weight: bolder;">Welcome: <?php echo $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']; ?></h3>
<br/>

<?php } ?>

<?php 
  $database = new Database_connection();

  $database->query = "SELECT COUNT(user_id) AS 'TOTAL USERS' FROM user WHERE role_id = '2'";
  $result = $database->result =  mysqli_query($database->connection,$database->query);

  if($result->num_rows > 0){
    while($data = mysqli_fetch_assoc($result)){

?>
  <div class="row">
    <div class="col-sm-3">
      <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Total Users</div>
        <div class="card-body">
          <p class="card-text" style="font-size: 20px; font-weight: bolder;"><?= $data['TOTAL USERS']; ?></p>
          <a href="view_all_user.php" class="btn btn-primary" >View All Users</a>
        </div>
      </div>
    </div>
    <?php 
       }
     }
    ?>

<?php 
  $database->query = "SELECT COUNT(blog_id) AS 'TOTAL BLOGS' FROM blog";
  $result = $database->result =  mysqli_query($database->connection,$database->query);

  if($result->num_rows > 0){
    while($data = mysqli_fetch_assoc($result)){

?>
    <div class="col-sm-3">
      <div class="card text-bg-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header">Total Blogs</div>
        <div class="card-body">
          <p class="card-text" style="font-size: 20px; font-weight: bolder;"><?= $data['TOTAL BLOGS']; ?></p>
          <a href="blog_settings.php" class="btn btn-primary">View All Blogs</a>
        </div>
      </div>
    </div>

    <?php 
       }
     }
    ?>

<?php 
  $database->query = "SELECT COUNT(post_id) AS 'TOTAL POSTS' FROM post";
  $result = $database->result =  mysqli_query($database->connection,$database->query);

  if($result->num_rows > 0){
    while($data = mysqli_fetch_assoc($result)){

?>
    <div class="col-sm-3">
      <div class="card text-bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header">Total Posts</div>
        <div class="card-body">
          <p class="card-text" style="font-size: 20px; font-weight: bolder;"><?= $data['TOTAL POSTS']; ?></p>
          <a href="post.php" class="btn btn-primary">View All Posts</a>
        </div>
      </div>
    </div>
  </div>
  <?php
     }
   }
     ?>

  <?php
  $database->query = "SELECT COUNT(feedback_id) AS 'TOTAL FEEDBACKS' FROM user_feedback";
  $result = $database->result =  mysqli_query($database->connection,$database->query);

  if($result->num_rows > 0){
    while($data = mysqli_fetch_assoc($result)){
 
  ?>

  <div class="row">
    <div class="col-sm-3">
      <div class="card text-bg-danger mb-3" style="max-width: 18rem;">
        <div class="card-header">Total Feedbacks</div>
        <div class="card-body">
            <p class="card-text" style="font-size: 20px; font-weight: bolder;"><?= $data['TOTAL FEEDBACKS']; ?></p>
            <a href="view_feedbacks.php" class="btn btn-primary">View All Feedbacks</a>
        </div>
      </div>
    </div>
    <?php
     }
   }
     ?>
   
   <?php 
  $database = new Database_connection();

  $database->query = "SELECT COUNT(post_comment_id) AS 'TOTAL COMMENTS' FROM post_comment";
  $result = $database->result =  mysqli_query($database->connection,$database->query);

  if($result->num_rows > 0){
    while($data = mysqli_fetch_assoc($result)){
?>
    <div class="col-sm-3">
      <div class="card text-bg-warning mb-3" style="max-width: 18rem;">
        <div class="card-header">All Comments</div>
        <div class="card-body">
            <p class="card-text" style="font-size: 20px; font-weight: bolder;"><?= $data['TOTAL COMMENTS']; ?></p>
            <a href="view_comments.php" class="btn btn-primary">View All Comments</a>
        </div>
      </div>
    </div>
<?php
     }
   }
     ?>


<?php 
  $database->query = "SELECT COUNT(post_id) AS 'MANAGE POSTS' FROM post";
  $result = $database->result =  mysqli_query($database->connection,$database->query);

  if($result->num_rows > 0){
    while($data = mysqli_fetch_assoc($result)){

?>
    <div class="col-sm-3">
      <div class="card text-bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header">Manage Posts</div>
        <div class="card-body">
          <p class="card-text" style="font-size: 20px; font-weight: bolder;"><?= $data['MANAGE POSTS']; ?></p>
          <a href="manage_all_posts.php" class="btn btn-primary">Manage All Posts</a>
        </div>
      </div>
    </div>
    </div>
  <?php
     }
   }
     ?>


<?php 
  $database = new Database_connection();

  $database->query = "SELECT COUNT(user_id) AS 'REJECTED USERS' FROM user WHERE is_approved = 'Rejected'";
  $result = $database->result =  mysqli_query($database->connection,$database->query);

  if($result->num_rows > 0){
    while($data = mysqli_fetch_assoc($result)){
?>
  <div class="row">
    <div class="col-sm-3">
      <div class="card text-bg-warning mb-3" style="max-width: 18rem;">
        <div class="card-header">All Rejected Users</div>
        <div class="card-body">
            <p class="card-text" style="font-size: 20px; font-weight: bolder;"><?= $data['REJECTED USERS']; ?></p>
            <a href="view_rejected_users.php" class="btn btn-primary">View All Rejected Users</a>
        </div>
      </div>
    </div>
<?php
     }
   }
     ?>

    <div class="col-sm-3">
      <div class="card text-bg-warning mb-3" style="max-width: 18rem;">
        <div class="card-header">All Followers</div>
        <div class="card-body">
            <p class="card-text" style="font-size: 20px; font-weight: bolder;">Blog Followers Details</p>
            <a href="view_followers.php" class="btn btn-primary" >View All Followers</a>
        </div>
      </div>
    </div>
 



<?php 
  $database = new Database_connection();

  $database->query = "SELECT COUNT(user_id) AS 'PENDING USERS' FROM user u 
                      INNER JOIN role r ON u.role_id = r.role_id 
                      WHERE r.role_id = '2' AND is_approved = 'Pending'";
  $result = $database->result =  mysqli_query($database->connection,$database->query);

  if($result->num_rows > 0){
    while($data = mysqli_fetch_assoc($result)){

?>
    <div class="col-sm-3">
      <div class="card text-bg-info mb-3" style="max-width: 18rem;">
        <div class="card-header">Pending Users Requests</div>
        <div class="card-body">
          <p class="card-text" style="font-size: 20px; font-weight: bolder;"><?= $data['PENDING USERS']; ?></p>
          <a href="pending_users.php" class="btn btn-primary">View All Pending Users</a>
        </div>
      </div>
    </div>
  </div>
  <?php 
       }
     }
  ?>
  



