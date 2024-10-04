<?php 
include_once("require/header.php");
require_once("../database_class.php");
?>
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
        margin: 50px;
    }
    .form-control{
        border-radius: 5px;
    }
    label{
        font-weight: bold;
    }
    .category_status-radio{
        margin: 20px;
    }
</style>
    <div class="row">

        <div class="col-sm-3">
            <?php include_once("sidebar.php"); ?>
        </div>

        <div class="col-sm-9">
           <br/>
           <h1> Update Attachments </h1>
            <center>
            <p style="background-color:<?= $_GET['background_color']??'';?>;
             padding: 10px;
             border-radius: 10px;
             width: 50%;
             text-align: center;
             font-variant: small-caps;
             font-weight: bold;
             color: white;
             font-size: 20px;">
            <?= $_GET['msg']??'';?>
            </p>
            </center>

        <?php
    if(isset($_GET['attachment_id'])){
    extract($_REQUEST);

    $database = new Database_connection();
    $database->query = "SELECT * FROM post_atachment WHERE post_atachment_id = '".$attachment_id."'";
    $result = $database->result = mysqli_query($database->connection,$database->query);
    $data = mysqli_fetch_assoc($result);
    extract($data);
}
    ?>

    <form method="POST" action="../process.php" class="form-container" enctype="multipart/form-data">
        <input type="hidden" name="attachment_id" value="<?= $post_atachment_id ?>">
        <input type="hidden" name="old_attachment_file" value="<?= $post_attachment_path ?>">

      
      <div class="form-group">
        <label class="form-label">Attachment Title: </label>
        <input type="text" name="attachment_title" class="form-control" value="<?= $post_attachment_title??'' ?>" placeholder="Enter Attachment Title">
      </div>

      <div class="form-group">
        <label class="form-label">Attachment File: </label>
        <input type="file" name="attachment_file" class="form-control">
        <br/>
        <span style="font-weight: bolder;"> Old Attachment File: <?= $post_attachment_path??'' ?>   </span>
      </div>

      <div class="text-center">
         <input type="submit" class="btn btn-primary" name="update_attachment" value="Update Attachment"> &nbsp; &nbsp;
         <input class="btn btn-secondary" type="reset" name="reset" value="Reset"> 
     </div>

      </div>
    
    </div>
    
<?php include_once("require/footer.php"); ?>
