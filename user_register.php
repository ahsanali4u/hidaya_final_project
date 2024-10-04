<?php
session_start();
if(isset($_SESSION['user'])){
  header("location:indexx.php");
}

?>
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
      margin-bottom: 20px;
			padding: 10px;
		}
		.container{
			padding: 20px;
		}
		.form-container{
      border: 1px solid white;
      padding: 20px;
      border-radius: 10px;
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
    span{
      color: red;
      font-weight: bolder;
      padding: 5px;
    }
   

</style>

<div class="container">
  <div class="row">
    <div class="col-12">

      <h1>Register Your Account</h1>
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

      <div class="form-container">
        <form method="POST" action="process.php" enctype="multipart/form-data" onsubmit="return user_register_validation()">
          <div class="form-group">
            <label for="first_name"  class="form-label"> First Name: </label> <span id="first_name_msg"></span>
            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter Your First Name">
          </div>

          <div class="form-group">
            <label for="last_name"  class="form-label"> Last Name: </label>  <span id="last_name_msg"></span>
            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Your Last Name">
          </div>

          <div class="form-group">
            <label for="email"  class="form-label"> Email: </label> <span id="email_msg"></span>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email">
          </div>

          <div class="form-group">
            <label for="password"  class="form-label"> Password: </label> <span id="password_msg"></span>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your Password">
          </div>
       
		      <div class="form-group">
            <label for="gender" class="form-label"> Gender: </label> 
            <input type="radio" name="gender" value="Male" class="gender-radio"> Male
            <input type="radio" name="gender" value="Female" class="gender-radio"> Female
            <span id="gender_msg"></span>
          </div>
      
		      <div class="form-group">
            <label for="date_of_birth" class="form-label"> Date Of Birth: </label> <span id="date_of_birth_msg"></span>
            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth">
          </div>
        
		      <div class="form-group">
            <label for="user_image" class="form-label"> Profile Pic: </label> <span id="user_image_msg"></span>
            <input type="file" class="form-control" name="user_image" id="user_image">
          </div>
       
		      <div class="form-group">
            <label for="address" class="form-label"> Address: </label> <span id="address_msg"></span>
            <textarea class="form-control" name="address" id="address"></textarea>
          </div>
        
		      <div class="text-center" style="padding: 20px;">
            <input type="submit" class="btn btn-primary" name="user_register" value="Register">  &nbsp; &nbsp;
            <input class="btn btn-secondary" type="reset" name="reset" value="Reset"> <br/> <br/> 
            <p style="margin-top: 15px;">Already Have an account? <a class="btn btn-primary" href="login.php">Login Here</a></p>
          </div>

        </form>
      </div>
   
	  </div>
  </div>
</div>


	 <?php include_once("require/footer.php"); ?>