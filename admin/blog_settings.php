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
 
   <h1> All Blogs </h1>
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

    $database->query = "SELECT * FROM blog WHERE user_id = '{$_SESSION['user']['user_id']}' ORDER BY blog_id DESC";
    $result = $database->result = mysqli_query($database->connection,$database->query);

   ?>
   <div style="background-color: white; font-weight: bolder; padding: 10px; border-radius: 10px; margin: 20px;"> 
   <table id="example" class="display" style="width:100%; background-color: white;">
        <thead>
            <tr>
                <th>Blog ID</th>
                <th style="text-align: left;">Post Per Pages</th>
                <th>Blog Title</th>
                <th>Blog Background Image</th>
                <th>Blog Status</th>
                <th>Edit Blog</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if($result->num_rows > 0){
                while($data = mysqli_fetch_assoc($result)){
                    extract($data);
        ?>
            <tr>
                <td style="text-align: left;" data-order="desc"><?= $blog_id ?></td>
                <td style="text-align: left;"><?= $post_per_page ?></td>
                <td><?= $blog_title ?></td>
                <td><img src="<?= $blog_background_image ?>" width="50px" height="50px"> &nbsp; <?= $blog_background_image ?></td>
                <td><?= $blog_status ?></td>
                <td>
                   <a href="blog_form.php?action=edit_blog&blog_id=<?= $blog_id ?>" class="btn btn-primary" style="width: 100px;"> Edit </a>
                </td>
                <td>
                    <?php if($blog_status == 'InActive'){  ?>
                        <a href="../process.php?status=blog_status&value=Active&blog_id=<?= $blog_id ?>" class="btn btn-success" style="width: 100px;"> Active </a>
                    
                    <?php }else{ ?>

                    <a href="../process.php?status=blog_status&value=InActive&blog_id=<?= $blog_id ?>" class="btn btn-danger" style="width: 100px;"> InActive </a>  
                    <?php } ?>
                </td>
            </tr>
            <?php } 
             } ?>
         
        </tbody>   
        
        <tfoot>
            <tr>
                <th>Blog ID</th>
                <th style="text-align: left;">Post Per Pages</th>
                <th>Blog Title</th>
                <th>Blog Background Image</th>
                <th>Blog Status</th>
                <th>Edit Blog</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
    </div>
 
   		</div>
   	</div>





<?php include_once("require/footer.php"); ?>
