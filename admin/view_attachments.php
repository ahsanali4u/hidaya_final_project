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
 
   <h1> All Attachments </h1>
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

    $post_id = $_GET['post_id']??''; 

    $database = new Database_connection();

    $database->query = "SELECT * FROM post_atachment pa INNER JOIN post p ON p.post_id = pa.post_id WHERE pa.post_id = '".$post_id."'";
    $result = $database->result = mysqli_query($database->connection,$database->query);

   ?>
   <div style="background-color: white; font-weight: bolder; padding: 10px; border-radius: 10px; margin: 20px;"> 
   <table id="example" class="display" style="width:100%; background-color: white;">
        <thead>
            <tr>
                <th>Attachment ID</th>
                <th>Attachment Title</th>
                <th>Post ID</th>
                <th>Attachments</th>
                <th>Status</th>
                <th>Edit</th>
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
                <td><?= $post_atachment_id ?></td>
                <td><?= $post_attachment_title ?> </td>
                <td><?= $post_title ?></td>
                
                <td>
                <?php 
                      $file = explode('.', $post_attachment_path); 
                      $extension = strtolower(end($file)); 
                      if($extension == 'docx'){ 
                  ?>
                      <img src='icons/1.jpg' height='30px' width='30px' alt='Docx File'> 
                      &nbsp; 
                      <a href=<?= $post_attachment_path?> download=<?= $post_attachment_path ?> style="font-weight: bolder; color:green;" > 
                          <?= $post_attachment_path ?> 
                      </a> 
                  <?php 
                      }elseif($extension == 'txt'){ 
                  ?>
                      <img src='icons/4.jpg' height='30px' width='30px' alt='Txt File'> 
                      &nbsp; 
                      <a href=<?= $post_attachment_path?> download=<?= $post_attachment_path ?> style="font-weight: bolder; color:green;" > 
                          <?= $post_attachment_path ?> 
                      </a> 
                  <?php 
                      }elseif($extension == 'pdf'){ 
                  ?>
                      <img src='icons/3.jpg' height='30px' width='30px' alt='Pdf File'> 
                      &nbsp; 
                      <a href=<?= $post_attachment_path?> download=<?= $post_attachment_path ?> style="font-weight: bolder; color:green;" > 
                          <?= $post_attachment_path ?> 
                      </a> 
                  <?php 
                      }elseif($extension == 'pptx'){ 
                  ?>
                      <img src='icons/2.jpg' height='30px' width='30px' alt='Pptx File'> 
                      &nbsp; 
                      <a href=<?= $post_attachment_path?> download=<?= $post_attachment_path ?> style="font-weight: bolder; color:green;" > 
                          <?= $post_attachment_path ?> 
                      </a> 
                  <?php 
                      }else{ 
                  ?>
                      <img src='<?= $post_attachment_path ?>' height='30px' width='30px' alt='Image'> 
                      <a href=<?= $post_attachment_path?> download=<?= $post_attachment_path ?> style="font-weight: bolder; color:green;" > 
                          <?= $post_attachment_path ?>
                      </a> 
                  <?php 
                      }  
                ?>
                </td>

                <td><?= $is_active ?> </td>
                <td>
                   <a href="update_attachments.php?attachment_id=<?= $post_atachment_id ?>" class="btn btn-primary" style="width: 100px;"> Edit </a>
                </td>
                <td>
                    <?php if($is_active == 'InActive'){  ?>
                        <a href="../process.php?is_active=Active&post_attachment_id=<?= $post_atachment_id ?>" class="btn btn-success" style="width: 100px;"> Active </a>
                    
                    <?php }else{ ?>

                    <a href="../process.php?is_active=InActive&post_attachment_id=<?= $post_atachment_id ?>" class="btn btn-danger" style="width: 100px;"> InActive </a>  
                    <?php } ?>
                </td>
            </tr>         
    <?php }
           }else{ 
            echo "No Attachments On this Post"; 
           }   ?>
         
        </tbody>
        <tfoot>
            <tr>
                <th>Attachment ID</th>
                <th>Attachment Title</th>
                <th>Post ID</th>
                <th>Attachments</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>

        </div>
    </div>
 





<?php include_once("require/footer.php"); ?>
