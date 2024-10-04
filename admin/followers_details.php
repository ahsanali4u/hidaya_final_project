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
    $blog_id = $_GET['blog_id']??'';

    $database = new Database_connection();

    $database->query = "SELECT * FROM following_blog fb
                        INNER JOIN user u ON u.user_id = fb.follower_id
                        WHERE fb.blog_following_id = '".$blog_id."' AND status = 'Followed'";
    $result = $database->result = mysqli_query($database->connection,$database->query);

   ?>
   <div style="background-color: white; font-weight: bolder; padding: 10px; border-radius: 10px; margin: 20px;"> 
   <table id="example" class="display" style="width:100%; background-color: white;">
        <thead>
            <tr>
                <th>Follower ID</th>
                <th>Follower Name</th>
                <th style="text-align: left;">Follow Date/Time</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if($result->num_rows > 0){
              while($data = mysqli_fetch_assoc($result)){
                    extract($data);

        ?>
            <tr>
                <td style="text-align: left;" data-order="desc"><?= $follower_id ?></td>
                <td> <img src="<?= $user_image ?>" width="50px" height="50px"> &nbsp; &nbsp; <?= $first_name." ".$last_name ?></td>
                <?php
                date_default_timezone_set("Asia/Karachi");
                $created_at = date("d-M-Y ",strtotime($created_at));
                ?>
                
                <td style="text-align: left;"> <?= $created_at ?> </td>  
            </tr>
            <?php } } ?>
        </tbody>   
        
        <tfoot>
             <tr>
                <th>Follower ID</th>
                <th>Follower Name</th>
                <th style="text-align: left;">Follow Date/Time</th>
            </tr>
        </tfoot>
    </table>
    </div>
 
   		</div>
   	</div>





<?php include_once("require/footer.php"); ?>
