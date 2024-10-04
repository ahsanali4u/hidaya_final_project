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
 
   <h1>All Feedbacks</h1>
   <?php
      $database = new Database_connection();

      $database->query = "SELECT * FROM user_feedback ORDER BY feedback_id DESC";
      $result = $database->result =  mysqli_query($database->connection,$database->query);
   ?>
   <div style="background-color: white; font-weight: bolder; padding: 10px; border-radius: 10px; margin: 20px;"> 
   <table id="example" class="display" style="width:100%; background-color: white;">
        <thead>
            <tr>
                <th style="text-align: left;">Feedback ID</th>
                <th>User ID</th>            
                <th>Full Name</th>
                <th>Email</th>
                <th>Feedback</th>
            </tr>
        </thead>
        <tbody>
        <?php   
           if($result->num_rows > 0){
             while($data = mysqli_fetch_assoc($result)){
                 extract($data);
         ?>
        
            <tr>
                <td style="text-align: left;" data-order="desc"><?= $feedback_id ?></td>
                <td>
                <?php 
                
                if($user_id == ""){
                    echo "Guest User";
                }else{
                    echo  "$user_id" ."   "."(Registered User)";
                }

                ?>
                     
                 </td>
                <td><?= $user_name ?></td>
                <td><?= $user_email ?></td>
                <td><?= $feedback ?></td>
            </tr>
            <?php } } ?>
        </tbody>
     
        <tfoot>
            <tr>
                <th style="text-align: left;">Feedback ID</th>
                <th>User ID</th>            
                <th>Full Name</th>
                <th>Email</th>
                <th>Feedback</th>
            </tr>
        </tfoot>
    </table>
</div>
 

   		</div>
   	</div>
 





<?php include_once("require/footer.php"); ?>
