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
 
   <h1> All Categories </h1>
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

    $database->query = "SELECT * FROM category ORDER BY category_id DESC";
    $result = $database->result = mysqli_query($database->connection,$database->query);

   ?>
   <div style="background-color: white; font-weight: bolder; padding: 10px; border-radius: 10px; margin: 20px;"> 
   <table id="example" class="display" style="width:100%; background-color: white;">
        <thead>
            <tr>
                <th style="text-align: left;">Category ID</th>
                <th>Category Title</th>
                <th>Category Description</th>
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
                <td style="text-align: left;" data-order="desc"><?= $category_id ?></td>
                <td><?= $category_title ?></td>
                <td><?= $category_description ?> </td>
                <td><?= $category_status ?> </td>
                <td>
                   <a href="category_form.php?action=edit_category&category_id=<?= $category_id ?>" class="btn btn-primary" style="width: 100px;"> Edit </a>
                </td>
                <td>
                    <?php if($category_status == 'InActive'){  ?>
                        <a href="../process.php?status=Active&category_id=<?= $category_id ?>" class="btn btn-success" style="width: 100px;"> Active </a>
                    
                    <?php }else{ ?>

                    <a href="../process.php?status=InActive&category_id=<?= $category_id ?>" class="btn btn-danger" style="width: 100px;"> InActive </a>  
                    <?php } ?>
                </td>
            </tr>         
    <?php } } ?>
         
        </tbody>
        <tfoot>
            <tr>
                <th style="text-align: left;">Category ID</th>
                <th>Category Title</th>
                <th>Category Description</th>
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
