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
			font-size: 60px;
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
    }
    label{
      font-weight: bold;
     }

		
</style>

<div class="container">
  <div class="row">
    <div class="col-12">
      <center> 
      <h1> Sign In </h1>
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
    
      <form method="POST" action="process.php" class="form-container">
        <div class="form-group">
          <label for="email"  class="form-label"> Email: </label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email">
        </div>
        <div class="form-group">
          <label for="password"  class="form-label"> Password:</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your Password">
        </div>
        <div class="text-center" style="padding: 20px;">
          <input type="submit" class="btn btn-primary" name="login" value="Login"> &nbsp; &nbsp;
          <input class="btn btn-secondary" type="reset" name="reset" value="Reset">
        </div>
      </form>
      
      <p style="font-weight: bolder; text-align: center; margin-top: 20px;">Forgot Your Password?  &nbsp; <a class="btn btn-primary" href="forgot_password.php">Forgot Password</a></p>
      
	</div>
  </div>
</div>



	<?php include_once("require/footer.php"); ?>