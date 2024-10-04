<?php include_once("require/header.php"); ?>

<style>
    body {
        background-color: teal;
        color: white;
    }
    h1 {
        font-variant: small-caps;
        font-weight: bolder;
        font-size: 40px;
        margin-bottom: 20px;
    }
    .container {
        margin-top: 50px;
        padding: 20px;
    }
    .form-label {
        font-size: 24px;
        font-weight: bold;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <center> 
        <h1 class="text-center">Forgot Password</h1>    
        <p style="background-color:<?= $_GET['background_color']??'';?>;
         padding: 10px;
         border-radius: 10px;
         width: 80%;
         text-align: center;
         font-variant: small-caps;
         font-weight: bold;
         font-size: 22px;">
         <?= $_GET['msg']??'';?></p>
        </center>
            <hr/>
            <form method="POST" action="process.php">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary btn-lg" name="forgot_pass" value="Send Email">
                </div>
            </form>

        </div>
    </div>
</div>

<?php include_once("require/footer.php"); ?>