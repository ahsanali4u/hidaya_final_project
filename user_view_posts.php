<?php
session_start();

if(!isset($_GET['blog_id'])){
   header("location:indexx.php");
}
?>
<?php include_once("require/header.php"); ?>
<?php include_once("database_class.php"); ?>
<br/>

<?php
if(isset($_GET['blog_id']) && isset($_GET['blog_title'])){
    ?>
    <h1 class="bg-dark text-light" style="font-variant: small-caps; font-weight: bolder; padding: 20px; text-align: center">Blog: <?= $_GET['blog_title'] ?> </h1>
    <br/>
    <?php
    $blog_id = $_GET['blog_id'];
    
    $database = new Database_connection();
    $database->query = "SELECT * FROM blog WHERE blog_id = '".$blog_id."'";
    $result = $database->result = mysqli_query($database->connection,$database->query);
    $data = mysqli_fetch_assoc($result);

    $post_per_page = $data['post_per_page'];
    $count_result = $database->count_blog_posts($blog_id);
    $data = mysqli_fetch_assoc($count_result);
    $total_pages = ceil($data['total_posts'] / $post_per_page);

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 0;
    }    
    $offset = $page * $post_per_page;

    $result = $database->fetch_blog_posts($blog_id, $post_per_page, $offset);
    if($result->num_rows > 0){
        ?>
        
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                while($data = mysqli_fetch_assoc($result)){
                    extract($data);
                    ?>
                    
                    <div class="col">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?= $featured_image ?>" class="img-fluid rounded-start" style="height: 100%;" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body bg-dark text-secondary h-100 d-flex flex-column">
                                        <h5 class="card-title"><?= $post_title ?></h5>
                                        <h5 class="card-title">At <?= $blog_title ?></h5>
                                        <p class="card-text"><?= $post_summary ?></p>
                                        <p class="card-text text-light small fw-bold">Last updated <?= $updated_at ?></p>
                                        <div class="mt-auto">
                                            <?php if(!isset($_SESSION['user'])) { ?>
                                                <a href="#" onclick="alert('Please Login First To View Post Details');" class="btn btn-primary">Post Details</a>                                                
                                                <?php }else{ ?> 
                                                <a href="post_details.php?post_title=<?= $post_title ?>&post_id=<?= $post_id ?>" class="btn btn-primary">Post Details</a>
                                                <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    
<!-- Pagination  -->
<div style="text-align: center;">
    <?php if($page > 0){ ?>
          <a href="?blog_id=<?=$blog_id ?>&blog_title=<?=$_GET['blog_title']?>&page=<?=($page - 1)?>" style="color: white; font-weight: bolder; font-size: 24px; text-decoration: none;" >Previous</a>
    <?php 
    } 
    
    for($i = 1; $i <= $total_pages; $i++){
        if($page == $i-1){ ?>
            <a style="color:white;font-size:24px; padding:5px; text-decoration:none;" href="?blog_id=<?= $blog_id ?>&blog_title=<?=$_GET['blog_title']?>&page=<?=($i - 1)?>">  <?= $i ?> </a>
            <?php }else{ ?>
            <a style="font-size:24px; padding:5px; text-decoration:none; color: white;" href="?blog_id=<?= $blog_id ?>&blog_title=<?=$_GET['blog_title']?>&page=<?=($i - 1)?>"> <?= $i ?> </a>
            <?php } 
        }
    if($page < $total_pages - 1){
    ?>
        <a href="?blog_id=<?= $blog_id ?>&blog_title=<?= $_GET['blog_title'] ?>&page=<?= ($page + 1) ?>" style="color: white; font-weight: bolder; font-size: 24px; text-decoration: none;">Next</a>
    <?php } ?>
</div>

<?php
    }else{
        echo "<h3 style='font-weight: bolder; text-align: center;'>No posts have been published yet.</h3>";     
    }

} 
?>

<!-- Pagination  -->


<?php include_once("require/footer.php"); ?>


