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
        padding: 10px;
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
		
      <?php
            if(isset($_GET['action']) == 'edit_user' && isset($_GET['user_id'])){
            ?>
            <h1>Update User Profile</h1>
            <?php }else{ ?>
            <h1>Add New User/Admin</h1>
      <?php } ?>
<center>
      <p 
      style="background-color:<?= $_GET['background_color']??'';?>;
      padding: 10px;
      border-radius: 10px;
      width: 30%;
      text-align: center;
      font-variant: small-caps;
      font-weight: bold;
      font-size: 22px;">
      <?= $_GET['msg']??'';?></p>
  </center>
  <?php 
  if(isset($_GET['action']) == 'edit_user' && isset($_GET['user_id'])){
    extract($_REQUEST);

    $database = new Database_connection();
    $database->query = "SELECT * FROM user WHERE user_id = '".$user_id."'";
    $result = $database->result = mysqli_query($database->connection,$database->query);
    $data = mysqli_fetch_assoc($result);
    extract($data);
  }
    ?>
 
<form method="POST" action="../process.php" class="form-container" enctype="multipart/form-data" onsubmit="return admin_register_validation();">
    <input type="hidden" name="user_id" value="<?= $user_id; ?>">
    <input type="hidden" name="old_user_image" value="<?= $user_image; ?>">
 
   <div class="form-group">
    <label for="first_name" class="form-label">First Name:</label> 
    <span id="first_name_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
      <input type="text" name="first_name" id="first_name" value="<?= $first_name??'' ?>" class="form-control" placeholder="Enter Your First Name">
    </div>

  <div class="form-group">
    <label for="last_name" class="form-label">Last Name:</label>
    <span id="last_name_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
      <input type="text" name="last_name" id="last_name" value="<?= $last_name??'' ?>" class="form-control" placeholder="Enter Your Last Name">
    </div>

    <?php if(isset($_GET['action']) != 'edit_user'){ ?>

  <div class="form-group">
    <label for="email" class="form-label">Email:</label>
    <span id="email_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
      <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
    </div>

  <div class="form-group">
    <label for="password" class="form-label">Password:</label>
    <span id="password_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
      <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password">
    </div>

  <?php } ?>
  
  <div class="form-group">
    <label for="gender" class="form-label">Gender:</label> 
      <input type="radio" name="gender" id="gender" value="male" class="gender-radio" <?=isset($gender) && $gender == 'Male'?'checked':'';?>> Male
      <input type="radio" name="gender" id="gender" value="female" class="gender-radio" <?=isset($gender) && $gender == 'Female'?'checked':'';?>> Female
      <span id="gender_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
    </div>
  
   <?php if(isset($_GET['action']) != 'edit_user'){ ?>

  <div class="form-group">
    <label for="role" class="form-label">Select Role:</label>
    <span id="role_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
    <?php
      $database = new Database_connection();
      
      $database->query = "SELECT * FROM role";
      $result = $database->result =  mysqli_query($database->connection,$database->query);
      if($result->num_rows > 0){
      ?>
      <select name="role" id="role" class="form-control">
        <option value="">Select Role</option>
      <?php
          while($data = mysqli_fetch_assoc($result)){
          extract($data);
      ?>
      <option value="<?= $role_id ?>"> <?= $role_type; ?> </option>
      <?php
         }
      ?>
      </select>
      <?php
      }
    ?>
    </div>
    <?php } ?>

  <div class="form-group">
    <label for="date_of_birth" class="form-label">Date Of Birth:</label>
    <span id="date_of_birth_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
      <input type="date" name="date_of_birth" id="date_of_birth" value="<?= $date_of_birth ?>" class="form-control">
    </div>
  
  <div class="form-group">
    <label for="user_image" class="form-label">Profile Pic:</label>
    <span id="user_image_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
      <input type="file" name="user_image" id="user_image" class="form-control">
      <?php  if(isset($_GET['action']) == 'edit_user' && isset($_GET['user_id'])){ ?>                        
      <span> <?= $user_image ?> <img src="<?= $user_image ?>" height="100px" width="120px" style="padding: 10px;">  </span>
      <?php } ?>
    </div>

  <div class="form-group">
    <label for="address" class="form-label">Address:</label>
    <span id="address_msg" style=" color: red; font-weight: bolder; padding: 5px;"> </span>
      <textarea name="address" id="address" class="form-control" rows="3"> <?= $address??'' ?></textarea>
    </div>

  <div class="text-center" style="padding: 20px;">
      <input type="submit" class="btn btn-primary" name="<?php echo isset($_GET['user_id'])?"update_user_profile_admin" :"admin_register";?>" value="<?php echo isset($_GET['user_id'])?"Update Profile" :"Register";?>"> &nbsp; &nbsp;
      <input class="btn btn-secondary" type="reset" name="reset" value="Reset">
    </div>
 
</form>
			
			</div>
		</div>


	 <?php include_once("require/footer.php"); ?>