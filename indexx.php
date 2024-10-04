<?php session_start(); ?>
<?php include_once("require/header.php"); ?>
<?php require_once("database_class.php"); ?>

<?php include_once("slider.php"); ?>

<style>
    .card-img-top{
        width: 100%;
        height: 255px;
        filter: blur(2px) brightness(0.8);
        object-fit: cover;
    }
    .card{
        background-color: black;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
    }
</style>

<div class="container-fluid">
  <div class="row">
    <h1 class="bg-dark text-light" style="font-variant: small-caps; font-weight: bolder; padding: 10px; text-align: center;">Latest News Blogs</h1>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
      <?php
      $database = new Database_connection();
      
      $database->query = "SELECT b.blog_background_image, b.blog_title, b.blog_id, b.updated_at FROM blog b 
                          INNER JOIN user u ON u.user_id = b.user_id
                          WHERE b.blog_status = 'Active' ORDER BY b.blog_id DESC";
                        
      $result = $database->result = mysqli_query($database->connection,$database->query);
      
      if($result->num_rows > 0){
        while($data = mysqli_fetch_assoc($result)){
          extract($data);
          
          if(isset($_SESSION['user'])){

            $database->query = "SELECT follower_id,follow_id,status,blog_following_id FROM following_blog 
                                WHERE follower_id = '".$_SESSION['user']['user_id']."' AND blog_following_id = '".$blog_id."'";
            $follow_result = $database->result = mysqli_query($database->connection,$database->query);
            
            if($follow_result->num_rows > 0){
              $follow_data = mysqli_fetch_assoc($follow_result);
              extract($follow_data);
            
            }else{
              $status = '';
              $follower_id = '';
              $follow_id = '';
            }
          }
          ?>
          <div class="col">
            <br/>
            <div class="card text-bg-dark">
              <img src="<?= $blog_background_image ?>" class="card-img-top">
              <div class="card-img-overlay d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between">
                  <h5 class="card-title" style="font-weight: bolder;"> Followers: 
                  <?php 
                   $database->query = "SELECT COUNT(follow_id) AS 'TOTAL FOLLOWERS' FROM following_blog 
                                       WHERE blog_following_id = '".$blog_id."' AND status = 'Followed'";
                   $result2 = $database->result =  mysqli_query($database->connection,$database->query);
                   $data2 = mysqli_fetch_assoc($result2);
                   echo $data2['TOTAL FOLLOWERS'];
                  ?>

                  </h5>

                  <div></div>

                  <?php if(isset($_SESSION['user'])){ 
                          if($status == ''){ ?>
                      <a href="process.php?blogs=follow_blog&status=Followed&blog_id=<?= $blog_id ?>" style="font-weight: bolder; font-size: 18px; width:120px" class="btn btn-primary align-self-start">Follow</a>
                    
                      <?php }elseif($_SESSION['user']['user_id'] == $follower_id && $status == 'Followed'){ ?>
                      <a href="process.php?action=update_follow&status=Unfollowed&follow_id=<?= $follow_id ?>&blog_id=<?= $blog_id ?>" style="font-weight: bolder; font-size: 18px; width:120px" class="btn btn-primary align-self-start">Unfollow</a>
                    
                      <?php }else{ ?>
                      <a href="process.php?action=update_follow&status=Followed&follow_id=<?= $follow_id ?>&blog_id=<?= $blog_id ?>" style="font-weight: bolder; font-size: 16px; width:120px" class="btn btn-primary align-self-start">Follow</a>
                    
                    <?php } } ?>
                </div>
             
                <div>
                  <h5 class="card-title" style="font-weight: bolder;"><?= $blog_title ?></h5>
                  <a href="user_view_posts.php?blog_id=<?= $blog_id ?>&blog_title=<?= $blog_title ?>" class="btn btn-primary" style="font-weight: bolder;">View Posts</a>
                  <p class="card-text" style="text-align: right; font-weight: bolder;"><small>Last updated <?= $updated_at ?></small></p>
                </div>
              </div>
            </div>
          </div>

        <?php } } ?>
    </div>
  </div>
</div>


<!-- Latest Blogs -->
<br/>

<!-- Recent Posts -->
<h1 class="bg-dark text-light" style="font-variant: small-caps; font-weight: bolder; padding: 10px; text-align: center;">Recent Posts</h1>
<br/>
<div class="container-fluid">
    <div class="row">
        <?php
        $database->query = "SELECT p.featured_image, p.post_title , p.post_summary, p.updated_at, p.post_id, b.blog_title
                            FROM post p 
                            INNER JOIN blog b ON b.blog_id = p.blog_id 
                            WHERE post_status = 'Active' AND blog_status = 'Active' ORDER BY p.post_id DESC";
                        
        $result = $database->result = mysqli_query($database->connection,$database->query);
      
        if($result->num_rows > 0){
         while($data = mysqli_fetch_assoc($result)){
          extract($data);

        ?>
<div class="col-lg-4 col-md-2 col-sm-6 col-xs-12 mb-3">
    <div class="card">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= $featured_image ?>" class="img-fluid rounded-start" style=" height: 100%;" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body bg-dark text-secondary h-100 d-flex flex-column">
                    <h5 class="card-title"><?= $post_title ?></h5>
                    <h5 class="card-title">At <?= $blog_title ?></h5>
                    <p class="card-text"><?= $post_summary ?></p>
                    <p class="card-text text-light small fw-bold">Last updated <?= $updated_at ?></p>
                    <div class="mt-auto">
                        <?php if (!isset($_SESSION['user'])) { ?>
                            <a href="#" onclick="alert('Please Login First To View Post Details');"  class="btn btn-primary">Post Details</a>
                        <?php } else { ?>
                            <a href="post_details.php?post_id=<?= $post_id ?>&post_title=<?= $post_title ?>" class="btn btn-primary">Post Details</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>




         <?php }
      } ?>
      
    </div>
  </div>        
<!-- Recent Posts -->

<?php include_once("require/footer.php"); ?>
