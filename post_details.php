<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("location:indexx.php");
 } 

?>
<?php include_once("require/header.php"); ?>

<?php require_once("database_class.php"); ?>

<style>
     .form-label {
        font-size: 24px;
        font-weight: bold;
    }
</style>
<br/>
<div class="container-fluid">
    <div class="row">
      <div class="col-2"></div>

      <div class="col-8"> 
        <?php
        if(isset($_GET['post_id'])){
            extract($_REQUEST);
            
        $database = new Database_connection();
        $database->query = "SELECT p.post_title, p.post_summary, p.post_description, p.updated_at, 
                            p.featured_image, p.is_comment_allowed ,b.blog_title, u.first_name, u.last_name 
                            FROM post p INNER JOIN blog b ON b.blog_id = p.blog_id 
                            INNER JOIN user u ON b.user_id = u.user_id
                            WHERE p.post_id = '".$post_id."' AND p.post_status = 'Active'";
                        
        $result = $database->result = mysqli_query($database->connection,$database->query);
        $data = mysqli_fetch_assoc($result);
          extract($data);
        }
    
        ?>

<div class="card bg-dark" style="padding: 10px; border-radius: 10px;">
    <div class="card-header row">
        <div class="col">
            <h5 class="card-title" style="font-weight: bolder;">Blog: <?= $blog_title ?></h5>
        </div>
        <div class="col text-right">
            <h5 class="card-title" style="text-align: right; font-weight: bolder;">Created By: <?= $first_name." ".$last_name ?></h5>
        </div>
    </div>
    <img class="card-img-bottom" height="300px" src="<?= $featured_image ?>" alt="Card image cap">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h5 class="card-title" style="font-weight: bolder;">Title: <?= $post_title ?></h5>
                <p class="card-text"><b>Summary: </b> <?= $post_summary ?></p>
                <p class="card-text"><b>Description: </b> <?= $post_description ?></p>

                <?php 
                 $database->query = "SELECT c.category_title FROM category c 
                                     INNER JOIN post_category pc ON pc.category_id = c.category_id
                                     INNER JOIN post p ON p.post_id = pc.post_id 
                                     WHERE p.post_id = '".$post_id."'";
                $result3 = $database->result = mysqli_query($database->connection, $database->query);
                if($result3->num_rows > 0){
                    ?>
                    <label for='attachment' class='form-label'>Categories: </label>
                    <br/>
                <?php
                    $count = 0;
                    while($data3 = mysqli_fetch_assoc($result3)){
                        $count++;
                        extract($data3);
                ?> 
                <h6 class="card-text"> <?= $count.": ".$category_title ?></h6>
                <?php
                    }
                 }else{
                    echo "No categories Selected With This Post";
                 }

                ?>
            </div>

            <div class="col-4 text-right">
                <?php 
                $database->query = "SELECT post_attachment_path,post_attachment_title  
                                    FROM post_atachment WHERE post_id = '".$post_id."' AND is_active = 'Active'";
                $result2 = $database->result = mysqli_query($database->connection, $database->query);
                if ($result2->num_rows > 0) { 
                ?>
                <label for='attachment' class='form-label'>Post Attachments:</label>
                <br/>
                <?php 
                while ($data2 = mysqli_fetch_assoc($result2)) { 
                    extract($data2); 
                    $file = explode('.', $post_attachment_path); 
                    $extension = strtolower(end($file)); 
                    if($extension == 'docx'){ 
                ?>
                    <img src='admin/icons/1.jpg' height='30px' width='30px' alt='Docx File'> 
                    &nbsp; 
                    <a href=<?= $post_attachment_path?> download=<?= $post_attachment_path ?> style="font-weight: bolder; text-decoration: none; color:lightgreen;" > 
                        <?= $post_attachment_title ?> 
                    </a> 
                    <br/><br/>
                <?php 
                    }elseif($extension == 'txt'){ 
                ?>
                    <img src='admin/icons/4.jpg' height='30px' width='30px' alt='Txt File'> 
                    &nbsp; 
                    <a href=<?= $post_attachment_path?> download=<?= $post_attachment_path ?> style="font-weight: bolder; text-decoration: none; color:lightgreen;" > 
                        <?= $post_attachment_title ?> 
                    </a> 
                    <br/><br/>
                <?php 
                    }elseif($extension == 'pdf'){ 
                ?>
                    <img src='admin/icons/3.jpg' height='30px' width='30px' alt='Pdf File'> 
                    &nbsp; 
                    <a href=<?= $post_attachment_path?> download=<?= $post_attachment_path ?> style="font-weight: bolder; text-decoration: none; color:lightgreen;" > 
                        <?= $post_attachment_title ?>  
                    </a> 
                    <br/><br/>
                <?php 
                    }elseif($extension == 'pptx'){ 
                ?>
                    <img src='admin/icons/2.jpg' height='30px' width='30px' alt='Pptx File'> 
                    &nbsp; 
                    <a href=<?= $post_attachment_path?> download=<?= $post_attachment_path ?> style="font-weight: bolder; text-decoration: none; color:lightgreen;" > 
                        <?= $post_attachment_title ?> 
                    </a> 
                    <br/> 
                    <br/>
                <?php 
                    }else{ 
                ?> 
                    <img src='<?= $post_attachment_path ?>' height='30px' width='30px' alt='Image'> 
                    &nbsp;
                    <a href=<?= $post_attachment_path?> download=<?= $post_attachment_path ?> style="font-weight: bolder; text-decoration: none; color:lightgreen;" > 
                         <?= $post_attachment_title ?>  
                    </a> 
                    <br/> 
                    <br/>
                <?php 
                    } 
                } 
                }else{ 
                    echo "No Attachments On this Post"; 
                } 
                ?>
                <h6 class="card-text">Last updated <?= $updated_at ?> </h6>
            </div>
        </div>
    </div>
</div>



<?php 
$result = $database->fetch_comments($post_id);
if($result->num_rows > 0){
    ?>
    <label for="comment" class="form-label">All User Comments:</label>
    <div class="show_comments" style="overflow: auto; max-height: 400px;">
    <?php

    while ($data = mysqli_fetch_assoc($result)) {
        extract($data);
        ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-dark" style="border-radius: 20px 10px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 text-center" style="border-right: 1px solid #444;">
                            <img src="<?= $user_image ?>" height="50px" width="50px" alt="" class="rounded-circle">
                            <h5 class="card-title" style="font-weight: bolder;"><?= $first_name . " " . $last_name ?></h5>
                        </div>
                        <div class="col-9" style="padding-left: 20px;">
                            <p style="font-weight: bold;"><?= $comment ?></p>
                            <p class="card-text" style="text-align: right; margin-top: 30px;">Commented on <?= $created_at ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
</div>


    <?php } ?>
    </div>
    <?php
}else{
    echo "<p>No comments found.</p>";
}
?>



<?php 
if($is_comment_allowed == '1'){
?>

<form method="POST" action="process.php">
    <input type="hidden" id="post_id" name="post_id" value="<?= $post_id ?>">
    <div class="row">
        <div class="col-md-10">
            <div class="form-group mb-3">
                <label for="comment" class="form-label">Comment:</label>
                <textarea name="user_comment" id="user_comment" rows="2" placeholder="Enter Your Comment" class="form-control" required></textarea>
            </div>
        </div>
        <div class="col-md-2">
            <div class="text-right">
                <input type="submit" name="post_comment" value="Comment" class="btn btn-primary btn-lg" style="margin-top: 50px; font-weight: bolder;">
            </div>
        </div>
    </div>
</form>
<?php 
  }else{
    echo "<br/>";
    echo "<h3 style='font-weight: bolder; text-align: center;'>Comments are disabled on this post.</h3>";
  }
    
    ?>




</div>

<div class="col-2"></div>




<?php include_once("require/footer.php"); ?>