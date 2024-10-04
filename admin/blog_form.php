<?php
 include_once("require/header.php");
 require_once("../database_class.php");
?>
<style>
    body{
        background-color: teal;
        color: white;
    }
    label{
        font-weight: bold;
    }
    .form-container{
        border: 1px solid white;
        padding: 20px;
        border-radius: 10px;
        margin: 40px;
    }
    h1{
        font-variant: small-caps;
        font-weight: bolder;
        font-size: 40px;
        text-align: center;
        margin-bottom: 20px;
        padding: 10px;
    }
    .blog_status-radio{
        margin: 20px;
    }
</style>

    <div class="row">
        <div class="col-sm-3">
            <?php include_once("sidebar.php"); ?>
        </div>

        <div class="col-sm-9">
            <?php 
            if(isset($_GET['action']) == 'edit_blog' && isset($_GET['blog_id'])){
              echo "<h1> Update Blog </h1>";
          }else{
             echo "<h1> Create New Blog </h1>";
          }
            ?>
            
            <center>
            <p style="background-color:<?= $_GET['background_color']??'';?>;
            padding: 10px;
            border-radius: 10px;
            width: 30%;
            text-align: center;
            font-variant: small-caps;
            font-weight: bold;
            font-size: 22px;">
            <?= $_GET['msg']??'';?></p>
            </center>
            <?php 
            if(isset($_GET['action']) == 'edit_blog' && isset($_GET['blog_id'])){
                extract($_REQUEST);
            
                $database = new Database_connection();
                $database->query = "SELECT * FROM blog WHERE blog_id = '".$blog_id."'";
                $result = $database->result = mysqli_query($database->connection,$database->query);
                $data = mysqli_fetch_assoc($result);
                extract($data);
            }
                ?>
        
                <form method="POST" action="../process.php" class="form-container" enctype="multipart/form-data" onsubmit="return blog_validation();">
                <input type="hidden" name="blog_id" value="<?= $blog_id; ?>">
                <input type="hidden" name="old_blog_background_image" value="<?= $blog_background_image; ?>">

                    <div class="form-group">
                        <label for="post_per_page" class="form-label">Post Per Page:</label>
                        <span id="post_per_page_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                        <input type="text" name="post_per_page" id="post_per_page" value="<?= $post_per_page??'' ?>" class="form-control" placeholder="Enter Posts Per Page">
                    </div>

                    <div class="form-group">
                        <label for="blog_title" class="form-label">Blog Title:</label>
                        <span id="blog_title_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                        <input type="text" name="blog_title" id="blog_title" value="<?= $blog_title??'' ?>" class="form-control" placeholder="Enter Blog Title">
                    </div>

                    <div class="form-group">
                        <label for="blog_bg_image" class="form-label">Blog Background Image:</label>
                        <span id="blog_bg_image_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                        <input type="file" name="blog_bg_image" id="blog_bg_image" class="form-control">
                    <?php  if(isset($_GET['action']) == 'edit_blog' && isset($_GET['blog_id'])){  ?>                    
                        <span id="old_blog_bg_image"> <?= $blog_background_image ?> <img src="<?= $blog_background_image ?>" height="100px" width="150px" style="padding: 10px;">  </span>
                    <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="blog_status" class="form-label">Blog Status:</label> 
                        <input type="radio" name="blog_status" id="blog_status" value="Active" class="blog_status-radio" <?=isset($blog_status) && $blog_status == 'Active'?'checked':'';?>> Active
                        <input type="radio" name="blog_status" id="blog_status" value="InActive" class="blog_status-radio" <?=isset($blog_status) && $blog_status == 'InActive'?'checked':'';?>> InActive
                        <span id="blog_status_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                    </div>
                     
                    <div class="text-center" style="padding: 20px;">
                        <input type="submit" class="btn btn-primary" name="<?php echo isset($_GET['blog_id'])?"update_blog" :"create_blog";?>" value="<?php echo isset($_GET['blog_id'])?"Update Blog" :"Create Blog";?>"> &nbsp; &nbsp;
                        <input class="btn btn-secondary" type="reset" name="reset" value="Reset">
                    </div>
                </form>
            </div>
       
	</div>

<?php include_once("require/footer.php"); ?>
