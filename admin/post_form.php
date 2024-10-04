<?php include_once("require/header.php"); ?>
<?php require_once("../database_class.php") ?>
<style>
    body{
        background-color: teal;
        color: white;
    }
    h1{
        font-variant: small-caps;
        font-weight: bolder;
        font-size: 40px;
        text-align: center;
        margin-bottom: 20px;
        padding: 10px;
    }
    .form-container{
        border: 1px solid white;
        padding: 20px;
        border-radius: 10px;
        margin: 40px;
    }
    .form-control{
        border-radius: 5px;
    }
    label{
        font-weight: bold;
    }
    .post_status-radio{
        margin: 20px;
    }
    .post_comment-radio{
        margin: 20px;
    }
    
</style>

    <div class="row">
		
        <div class="col-sm-3">
            <?php include_once("sidebar.php"); ?>
        </div>

        <div class="col-sm-9">
            <br/>
            <p style="background-color:<?= $_GET['background_color']??'';?>;
             padding: 10px;
             border-radius: 10px;
             width: 100%;
             text-align: center;
             font-variant: small-caps;
             font-weight: bold;
             color: white;
             font-size: 20px;">
            <?= $_GET['msg']??'';?>
            </p>
        <?php
    if(isset($_GET['action']) == 'edit_post' && isset($_GET['post_id'])){
    extract($_REQUEST);

    $database = new Database_connection();
    $database->query = "SELECT * FROM post p INNER JOIN blog b ON b.blog_id = p.blog_id WHERE post_id = '".$post_id."'";
    $result = $database->result = mysqli_query($database->connection,$database->query);
    $data = mysqli_fetch_assoc($result);
    extract($data);
    ?>
    <h1> Edit Post Form </h1>
    <?php

 }
         ?>

            <form method="POST" action="../process.php" class="form-container" enctype="multipart/form-data" onsubmit="return post_validation();">
            <input type="hidden" name="old_featured_image" value="<?= $featured_image; ?>">
            <input type="hidden" name="post_id" value="<?= $post_id ?>">

                <div class="form-group">
                    <label class="form-label">Select Blog:</label>
                    <span id="post_blog_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                    <?php
                     $database = new Database_connection();
                     $database->query = "SELECT * FROM blog WHERE blog_status = 'Active' AND user_id = '".$_SESSION['user']['user_id']."'";
                     $result = $database->result =  mysqli_query($database->connection,$database->query);
                     if($result->num_rows > 0){
                    ?>
                    <select name="blog" id="post_blog" class="form-control" >
                        <option value="<?= $data['blog_id']??''; ?>"> <?= $data['blog_title']??'Select Blog'; ?> </option>
                    <?php
                      while($data = mysqli_fetch_assoc($result)){
                      extract($data);
                    ?>
                        <option value="<?= $blog_id ?>"> <?= $blog_title ?> </option>
                    <?php } ?>
                    </select>
                    <?php } ?>
                </div>

            <div class="form-group">
                <label class="form-label">Select Category:</label>
                <span id="category_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                <?php 
                 $database = new Database_connection(); 
                 $database->query = "SELECT * FROM category WHERE category_status = 'Active'";
                 $result = $database->result = mysqli_query($database->connection,$database->query);
                 
                 $post_id = $_GET['post_id'] ??'';
                 $database->query = "SELECT c.category_id FROM category c 
                                     INNER JOIN post_category pc ON c.category_id = pc.category_id 
                                     WHERE pc.post_id = '".$post_id."'";
                 $selected_categories = $database->result = mysqli_query($database->connection,$database->query);
                 $selected_category_ids = array();
                 while($data = mysqli_fetch_assoc($selected_categories)){
                 $selected_category_ids[] = $data['category_id'];
                 }
    
                if($result->num_rows > 0){ ?>
               <select name="category[]" id="category" class="form-control" multiple>
               <?php while($data = mysqli_fetch_assoc($result)){ extract($data); ?>
               <option value="<?= $category_id ?>" <?= (in_array($category_id, $selected_category_ids)) ? 'selected' : ''; ?>> 
               <?= $category_title ?> 
               </option>
               <?php } ?>
              </select>
              <?php } ?>
            </div>


                <div class="form-group">
                    <label class="form-label">Post Title:</label>
                    <span id="post_title_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                    <input type="text" name="post_title" id="post_title" value="<?= $post_title??'' ?>" class="form-control" placeholder="Enter Post Title" >
                </div>

                <div class="form-group">
                    <label class="form-label">Post Summary:</label>
                    <span id="post_summary_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                    <textarea name="post_summary" id="post_summary" class="form-control" rows="3"> <?= $post_summary??'' ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Post Description:</label>
                    <span id="post_description_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                    <textarea name="post_description" id="post_description" class="form-control" rows="7"><?= $post_description??''  ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Featured Image:</label>
                    <span id="featured_image_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                    <input type="file" name="featured_image" id="featured_image" class="form-control">
                <?php if(isset($_GET['action']) == 'edit_post' && isset($_GET['post_id'])){    ?>
                    <span id="old_featured_image"> Old Featured Image: <?= $featured_image??'' ?> <img src="<?= $featured_image??'' ?>" height="100px" width="120px" style="padding: 10px;">  </span>
                <?php } ?>
                </div>
                
    
                <div class="form-group">
                <div id="dynamic-attachments" style="padding: 10px;"></div>
                <button type="button" class="btn btn-secondary" onclick="addAttachmentField()">Add Attachments</button>
                </div>

                 <div class="form-group">
                        <label class="form-label">Post Status:</label> 
                        <input type="radio" name="post_status" id="post_status_active" value="Active" class="post_status-radio"<?=isset($post_status) && $post_status == 'Active'?'checked':'';?> 
                        > Active
                        <input type="radio" name="post_status" id="post_status_inactive" value="InActive" class="post_status-radio" <?=isset($post_status) && $post_status == 'InActive'?'checked':'';?> 
                        > InActive
                        <span id="post_status_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Allow Comment:</label>
                    <input type="radio" name="is_comment_allowed" id="allow_comment_yes" value="1" class="post_comment-radio" <?=isset($is_comment_allowed) && $is_comment_allowed == '1'?'checked':'';?> 
                    > Yes 
                    <input type="radio" name="is_comment_allowed" id="allow_comment_no"  value="0" class="post_comment-radio" <?=isset($is_comment_allowed) && $is_comment_allowed == '0'?'checked':'';?> 
                    > No
                    <span id="allow_comment_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                </div>

                <div class="text-center">
                    <input type="submit" class="btn btn-primary" name="<?php echo isset($_GET['post_id'])?"update_post" :"add_post";?>" value="<?php echo isset($_GET['post_id'])?"Update Post" :"Add Post";?>"> &nbsp; &nbsp;
                    <input class="btn btn-secondary" type="reset" name="reset" value="Reset"> 
                </div>

            </form>
        </div>

    </div>

<script>
  var count = 0;
  function addAttachmentField(){
    count++;
    var container = document.getElementById("dynamic-attachments");
    var html = `
      <div class="form-group">
        <label class="form-label">Attachment Title: ${count}:</label>
        <input type="text" name="attachment_title[]" class="form-control" placeholder="Enter Attachment Title">
      </div>
      <div class="form-group">
        <label class="form-label">Attachment File: ${count}:</label>
        <input type="file" name="attachment_file[]" class="form-control">
      </div>
      
    `;
    container.innerHTML += html;
  }
</script>

<?php include_once("require/footer.php"); ?>
