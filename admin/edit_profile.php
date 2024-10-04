<?php include_once("require/header.php"); ?>
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
        padding: 10px;
    }
    .container{
        padding: 20px;
    }
    .form-container{
        border: 1px solid white;
        padding: 20px;
        border-radius: 10px;
        margin: 40px;
    }
    .form-control{
        border-radius: 5px;
        padding: 10px;
    }
    .gender-radio{
        margin: 20px;
    }
    label{
        font-weight: bold;
    }
</style>

    <div class="row">
        <div class="col-sm-3">
            <?php include_once("sidebar.php"); ?>
        </div>

        <div class="col-sm-9">
            <h1>Update Your Profile</h1>
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
            
                <form method="POST" action="../process.php" class="form-container" enctype="multipart/form-data" onsubmit="return update_profile_validation();">
                    <div class="form-group">
                        <label for="first_name" class="form-label"> First Name: </label>
                        <span id="first_name_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter Your First Name">
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="form-label"> Last Name: </label>
                        <span id="last_name_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Your Last Name">
                    </div>

                    <div class="form-group">
                        <label for="gender" class="form-label">Gender:</label> 
                        <input type="radio" name="gender" id="gender" value="male" class="gender-radio"> Male
                        <input type="radio" name="gender" id="gender" value="female" class="gender-radio"> Female
                        <span id="gender_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth" class="form-label"> Date Of Birth: </label>
                        <span id="date_of_birth_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth">
                    </div>

                    <div class="form-group">
                        <label for="profile_pic" class="form-label"> Profile Pic: </label>
                        <span id="user_image_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                        <input type="file" class="form-control" name="user_image" id="user_image">
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label"> Address: </label>
                        <span id="address_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
                        <textarea class="form-control" name="address" id="address"></textarea>
                    </div>

                    <div class="text-center" style="padding: 20px;">
                        <input type="submit" class="btn btn-primary" name="update_admin_profile" value="Update Profile"> &nbsp; &nbsp; 
                        <input class="btn btn-secondary" type="reset" name="reset" value="Reset"> 
                        <br />
                    </div>
                    
                </form>
            </div>
       
    
    </div>

<?php include_once("require/footer.php"); ?>
