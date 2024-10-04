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
   <h1> All InActive Users </h1>
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

      $database->query = "SELECT user_id,first_name,last_name,email,gender,date_of_birth,u.is_active,is_approved 
                          FROM user u INNER JOIN role r ON u.role_id = r.role_id 
                          WHERE u.role_id = '2' AND u.is_active = 'InActive' ORDER BY u.user_id DESC";
      $result = $database->result =  mysqli_query($database->connection,$database->query);
   ?>
   <div style="background-color: white; font-weight: bolder; padding: 10px; border-radius: 10px; margin: 20px;"> 
   <table id="example" class="display" style="width:100%; background-color: white;">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th style="text-align: left;">Date Of Birth</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php   
           if($result->num_rows > 0){
             while($data = mysqli_fetch_assoc($result)){
                 extract($data);
         ?>
            <tr>
                <td style="text-align: left;" data-order="desc"><?= $user_id ?></td>
                <td><?= $first_name." ".$last_name ?></td>
                <td><?= $email ?></td>
                <td><?= $gender ?></td>
                <td style="text-align: left;"><?= $date_of_birth ?></td>
                <td><?= $is_active ?></td>
            </tr>
            <?php } } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>User ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th style="text-align: left;">Date Of Birth</th>
                <th>Status</th>
            </tr>
        </tfoot>
    </table>
</div>

   		</div>
   	</div>





<?php include_once("require/footer.php"); ?>
