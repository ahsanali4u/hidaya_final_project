<?php session_start(); ?>
<?php include_once("require/header.php"); ?>
<style>
    body{
        background-color: teal;
        color: white;
    }
    h1{
        font-variant: small-caps;
        font-weight: bolder;
        font-size: 50px;
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
    span{
      color: red;
      font-weight: bolder;
      padding: 5px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-12">
            <center> 
            <h1>Feedback</h1>
            <p style="background-color:<?= $_GET['background_color']??'';?>;
            padding: 10px;
            border-radius: 10px;
            width: 50%;
            text-align: center;
            font-variant: small-caps;
            font-weight: bold;
            color: white;
            font-size: 22px;">
            <?= $_GET['msg']??'';?>
            </p>
            </center>
            <form method="POST" action="process.php" class="form-container" onsubmit="return feedback_validation();">
           
                <div class="form-group">
                    <label for="name" class="form-label">Full Name: </label> <span id="name_msg"></span>
                    <input type="text" <?=isset($_SESSION['user'])? 'disabled':''  ?> name="name" 
                    value="<?= ($_SESSION['user']['first_name']??'') ." ".($_SESSION['user']['last_name']??'') ?>" id="name" class="form-control" placeholder="Enter Your Name">
                </div>

                <div class="form-group"> 
                    <label for="email" class="form-label"> Email: </label>
                    <span id="email_msg"></span>
                    <input type="email" <?=isset($_SESSION['user'])? 'disabled':'' ?> name="email" id="email" value="<?= $_SESSION['user']['email']??''?>" class="form-control" placeholder="Enter Your Email">
                </div>
              
                <div class="form-group">
                    <label for="feedback" class="form-label"> Feedback: </label>
                    <span id="feedback_msg"></span>
                    <textarea name="feedback" id="feedback" class="form-control" rows="5" placeholder="Enter Your Feedback"></textarea>
                </div>

                <div class="text-center" style="padding: 20px;">
                    <input type="submit" class="btn btn-primary" name="feedback_submit" value="Submit Your Feedback">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once("require/footer.php"); ?>
