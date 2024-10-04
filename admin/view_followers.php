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
 
   <h1> All Blog Followers </h1>
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

    $database->query = "SELECT * FROM blog b
                        WHERE b.user_id = '{$_SESSION['user']['user_id']}' ORDER BY blog_id DESC";
    $result = $database->result = mysqli_query($database->connection,$database->query);

   ?>
   <div style="background-color: white; font-weight: bolder; padding: 10px; border-radius: 10px; margin: 20px;"> 
   <table id="example" class="display" style="width:100%; background-color: white;">
        <thead>
            <tr>
                <th>Blog ID</th>
                <th>Blog Title</th>
                <th style="text-align: left;">Followers</th>
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
                <td><?= $blog_title ?></td>
                <td style="text-align: left;">
                    <?php 
                   $database->query = "SELECT COUNT(follow_id) AS 'TOTAL FOLLOWERS' FROM following_blog 
                                       WHERE blog_following_id = '".$blog_id."' AND status = 'Followed'";
                   $result2 = $database->result =  mysqli_query($database->connection,$database->query);
                   $data2 = mysqli_fetch_assoc($result2);
                   echo $data2['TOTAL FOLLOWERS'];
                  ?>

                </td>
                <td>
                   <a href="followers_details.php?blog_id=<?= $blog_id ?>" class="btn btn-primary" style="width: 150px;"> View Followers </a>
                </td>
                
            </tr>
            <?php 
            } } ?>
         
        </tbody>   
        
        <tfoot>
             <tr>
                <th>Follower ID</th>
                <th>Blog Title</th>
                <th style="text-align: left;">Followers</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
    </div>
 
   		</div>
   	</div>





<?php include_once("require/footer.php"); ?>
