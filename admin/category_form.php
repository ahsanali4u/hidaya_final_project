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
            <?php
            if(isset($_GET['action']) == 'edit_category' && isset($_GET['category_id'])){
            ?>
            <h1>Update Category</h1>
            <?php }else{ ?>
            <h1>Create New Category</h1>
            <?php } ?>
            <center>
            <p style="background-color:<?= $_GET['background_color']??'';?>;
            padding: 10px;
            border-radius: 10px;
            width: 50%;
            text-align: center;
            font-variant: small-caps;
            font-weight: bold;
            font-size: 22px;">
            <?= $_GET['msg']??'';?></p>
            </center>
            <?php
            if(isset($_GET['action']) == 'edit_category' && isset($_GET['category_id'])){
                extract($_REQUEST);
            
                $database = new Database_connection();
                $database->query = "SELECT * FROM category WHERE category_id = '".$category_id."'";
                $result = $database->result = mysqli_query($database->connection,$database->query);
                $data = mysqli_fetch_assoc($result);
                extract($data);
            }
            ?>

            <form method="POST" action="../process.php" class="form-container" onsubmit="return category_validation();">
            <input type="hidden" name="category_id" value="<?= $category_id; ?>">

                <div class="form-group">
                    <label for="category_title" class="form-label">Category Title:</label>
                    <span id="category_title_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                    <input type="text" name="category_title" id="category_title" value="<?= $category_title??'' ?>" class="form-control" placeholder="Enter Category Title">
                </div>

                <div class="form-group">
                    <label for="category_description" class="form-label">Category Description:</label>
                    <span id="category_description_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                    <textarea name="category_description" id="category_description" class="form-control" rows="3"> <?= $category_description??'' ?></textarea>
                </div>

                <div class="form-group">
                        <label for="category_status" class="form-label">Category Status:</label> 
                        <input type="radio" name="category_status" id="category_status" value="Active" class="category_status-radio" <?=isset($category_status) && $category_status == 'Active'?'checked':'';?>> Active
                        <input type="radio" name="category_status" id="category_status" value="InActive" class="category_status-radio" <?=isset($category_status) && $category_status == 'InActive'?'checked':'';?>> InActive
                        <span id="category_status_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                    </div>

                <div class="text-center" style="padding: 20px;">
                    <input type="submit" class="btn btn-primary" name="<?php echo isset($_GET['category_id'])?"update_category" :"create_category";?>" value="<?php echo isset($_GET['category_id'])?"Update Category" :"Create Category";?>"> &nbsp; &nbsp;
                    <input class="btn btn-secondary" type="reset" name="reset" value="Reset">
                </div>
            </form>
        </div>
    
    </div>
    
<?php include_once("require/footer.php"); ?>
