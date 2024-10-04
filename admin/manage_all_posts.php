<?php include_once("require/header.php"); ?>
<?php require_once("../database_class.php"); ?>

<style>
      h1{
        font-variant: small-caps;
        font-weight: bolder;
        font-size: 40px;
        margin-bottom: 20px;
        padding: 10px;
        color: white;
    }
    
</style>
   	<div class="row">
   		<div class="col-sm-3">
   			<?php include_once("sidebar.php"); ?>
   		</div>
   		<div class="col-sm-9">
 
   <h1>Manage All Posts </h1>
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
    $database = new Database_connection();

    $database->query = "SELECT * FROM post p 
                        INNER JOIN blog b ON p.blog_id = b.blog_id 
                        INNER JOIN user u ON u.user_id = b.user_id
                        WHERE b.user_id = '".$_SESSION['user']['user_id']."'
                        ORDER BY p.post_id DESC";
    $result = $database->result = mysqli_query($database->connection,$database->query);

   ?>
   <div style="background-color: white; font-weight: bolder; padding: 10px; border-radius: 10px; margin: 20px;"> 
   <table id="example" class="display" style="width:100%;">
        <thead>
            <tr>
                <th>Post ID</th>
                <th>Blog Name</th>
                <th>Post Title</th>
                <th>Post Category</th>
                <th>Is Comment Allowed</th>
                <th>Status</th>
                <th>Edit Attachmennts</th>
                <th>Edit Post</th>
            </tr>
        </thead>
        <tbody>
         <?php
            if($result->num_rows > 0){
                while($data = mysqli_fetch_assoc($result)){
                    extract($data);
        ?>
    
            <tr>
                <td style="text-align: left;" data-order="desc"><?= $post_id ?></td>
                <td><?= $blog_title ?></td>
                <td><?= $post_title ?></td>
                <td>
                    <?php
                    $database = new Database_connection();
                    $database->query = "SELECT * FROM category c 
                                        INNER JOIN post_category pc ON c.category_id = pc.category_id 
                                        WHERE post_id = '".$post_id."'";
                    $result2 = $database->result = mysqli_query($database->connection,$database->query);
                    while($data2 = mysqli_fetch_assoc($result2)){
                    echo $data2['category_title']. "<br/>"; 
                    }
                    ?>
                </td>

                <td style="text-align: center;">
                <?php
                if($is_comment_allowed == '1'){
                    echo "Yes";
                }else{
                    echo "No";
                }
                 ?>                
                 </td>
                <td><?= $post_status ?></td>
                
                <td>
                <?php
                $database->query = "SELECT * FROM post_atachment WHERE post_id = '".$post_id."'";
                $result2 = $database->result = mysqli_query($database->connection,$database->query);
                $data2 = mysqli_fetch_assoc($result2);
                if($result2->num_rows > 0){ ?>
                    <a href="view_attachments.php?action=edit_attachments&post_id=<?= $post_id ?>" class="btn btn-dark" style="width: 150px; margin-top: 10px;" > Edit Attachments </a> &nbsp;
                <?php 
                }else{
                    echo "No Attachments";
                } 
                ?>
                </td>
                <td>
                    <a href="post_form.php?action=edit_post&post_id=<?= $post_id ?>&post_blog_id=<?= $blog_id ?>" class="btn btn-primary" style="width: 100px;" > Edit </a> &nbsp;
                </td>
        
            </tr>
            <?php } } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Post ID</th>
                <th>Blog Name</th>
                <th>Post Title</th>
                <th>Post Category</th>
                <th>Is Comment Allowed</th>
                <th>Status</th>
                <th>Edit Attachmennts</th>
                <th>Edit Post</th>
            </tr>
        </tfoot>
    </table>
    </div>
 

   		</div>
   	</div>
 





<?php include_once("require/footer.php"); ?>
