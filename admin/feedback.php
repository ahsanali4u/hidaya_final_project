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
    .form-container{
        border: 1px solid white;
        padding: 20px;
        border-radius: 10px;
        margin: 40px;
    }
    .form-control{
        border-radius: 5px;
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


            <form method="POST" action="../process.php" class="form-container">
                
                <div class="form-group">
                    <label for="feedback" class="form-label"> Feedback: </label>
                    <textarea name="feedback" id="feedback" class="form-control" rows="5" placeholder="Enter Your Feedback" required></textarea>
                </div>

                <div class="text-center" style="padding: 20px;">
                    <input type="submit" class="btn btn-primary" name="feedback_admin" value="Submit Your Feedback">
                </div>
            </form>
        </div>
    </div>

<?php include_once("require/footer.php"); ?>
