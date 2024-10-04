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
 
   <h1>All Comments</h1>
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

      $database->query = "SELECT pc.post_comment_id, pc.post_id, pc.user_id, pc.comment, p.post_title, 
                          p.post_id, u.first_name, u.user_id, u.last_name, pc.is_active FROM post_comment pc
                          INNER JOIN post p ON p.post_id = pc.post_id 
                          INNER JOIN blog b ON b.blog_id = p.blog_id 
                          INNER JOIN user u ON u.user_id = pc.user_id 
                          WHERE b.user_id = '".$_SESSION['user']['user_id']."' 
                          ORDER BY pc.post_comment_id DESC";
  
  
  
                           
      $result = $database->result =  mysqli_query($database->connection,$database->query);
      if (!$result) {
        echo "Query Error: " . mysqli_error($database->connection);
        exit;
    }

   ?>
   <div style="background-color: white; font-weight: bolder; padding: 10px; border-radius: 10px; margin: 20px;"> 
   <table id="example" class="display" style="width:100%; background-color: white;">
        <thead>
            <tr>
                <th style="text-align: left;">Comment ID</th>         
                <th>Full Name</th>
                <th>Post Title</th>
                <th>Comment</th>
                <th>Status</th>
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
                <td style="text-align: left;" data-order="desc"><?= $post_comment_id ?></td>
                <td><?= $first_name." ".$last_name ?></td>
                <td><?= $post_title ?></td>
                <td><?= $comment ?></td>
                <td><?= $is_active ?></td>
                <td>
                    <?php if($is_active == 'InActive'){  ?>
                        <a href="../process.php?comment_status=Active&post_comment_id=<?= $post_comment_id ?>" class="btn btn-success" style="width: 100px;"> Active </a>
                    
                    <?php }else{ ?>

                    <a href="../process.php?comment_status=InActive&post_comment_id=<?= $post_comment_id ?>" class="btn btn-danger" style="width: 100px;"> InActive </a>  
                    <?php } ?>
                </td>
            </tr>
            <?php } } ?>
        </tbody>
       
        <tfoot>
            <tr>
                <th style="text-align: left;">Comment ID</th>         
                <th>Full Name</th>
                <th>Post Title</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>
 

   		</div>
   	</div>
 





<?php include_once("require/footer.php"); ?>
