<?php
session_start();
require_once "FPDF/fpdf.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

require_once "database_class.php";

$database = new Database_connection();

/*........All Process.......*/

if (isset($_REQUEST['user_register'])) {
    extract($_REQUEST);

    $directory = "Images";
    if(!is_dir($directory)){
        if (!mkdir($directory)){
            echo "Directory Not Created";
        }
    }
    $file_name = $_FILES['user_image']['name'];
    $temp_name = $_FILES['user_image']['tmp_name'];
    $file_path = $directory . "/" . $file_name;
    move_uploaded_file($temp_name, $file_path);

    $result = $database->register_user($role_id = '2', $first_name, $last_name, $email, $password, $gender, $date_of_birth, $file_path, $address);

    if ($result) {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFillColor(200, 200, 200);
        $pdf->Rect(0, 0, 210, 297, "F");
        $pdf->SetFont("Arial", "B", 28);
        $pdf->SetFillColor(0, 128, 128);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 22, "Account Details", 0, 1, "C", 1);
        $pdf->Ln(10);
        $pdf->SetFont("Arial", "", 14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(0, 10, "Name: " . $first_name . " " . $last_name, 0, 1);
        $pdf->Cell(0, 10, "Email: " . $email, 0, 1);
        $pdf->Cell(0, 10, "Password: " . $password, 0, 1);
        $pdf->Cell(0, 10, "Gender: " . $gender, 0, 1);
        $pdf->Cell(0, 10, "Date of Birth: " . $date_of_birth, 0, 1);
        $pdf->MultiCell(0, 10, "Address: " . $address, 0);
        $pdf_path = "registered_user_pdfs/" . $first_name . " " . $last_name . ".pdf";
        $pdf->Output("F", $pdf_path);

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'ahsanhist4u@gmail.com';
        $mail->Password = 'uvypzcvocoertwwp';
        $mail->setFrom('ahsanhist4u@gmail.com', 'Pakistan News Blogs');
        $mail->addReplyTo('ahsanhist4u@gmail.com');
        $mail->addAddress($email);
        $mail->Subject = "Your Account Is In Pending";
        $mail->msgHTML("<h3><b>Your Account Request Is In Pending. Please Wait For Admin Approval.</b></h3>");
        $mail->addAttachment($pdf_path);

        $database->query = "SELECT * FROM user u INNER JOIN role r ON u.role_id = r.role_id WHERE u.role_id = '1'";
        $result = $database->result = mysqli_query($database->connection, $database->query);

        if($result->num_rows > 0){
            while ($data = $result->fetch_assoc()) {
                $mail_admin = new PHPMailer();
                $mail_admin->isSMTP();
                $mail_admin->Host = 'smtp.gmail.com';
                $mail_admin->Port = 587;
                $mail_admin->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail_admin->SMTPAuth = true;
                $mail_admin->Username = 'ahsanhist4u@gmail.com';
                $mail_admin->Password = 'uvypzcvocoertwwp';
                $mail_admin->setFrom('ahsanhist4u@gmail.com', 'Pakistan News Blogs');
                $mail_admin->addReplyTo('ahsanhist4u@gmail.com');
                $mail_admin->addAddress($data['email']);
                $mail_admin->Subject = "New User Registered";
                $mail_admin->msgHTML("<h3><b>New User is Registered In Pakistan News Blogs.</b></h3>");

                if(!$mail_admin->send()){
                    echo "Email Not Send: " . $mail_admin->ErrorInfo;
                }
            }
        }
        if(!$mail->send()){
            echo "Email Not Send: " . $mail->ErrorInfo;
        }else{
            header("location:user_register.php?msg=Registration Successfully&background_color=green");
        }
    }else{
        header("location:user_register.php?msg=Registration Failed&background_color=red");
    }


}elseif(isset($_REQUEST['admin_register'])){
    extract($_REQUEST);

    $directory = "Images";
    if(!is_dir($directory)){
        if (!mkdir($directory)){
            echo "Directory Not Created";
        }
    }
    $file_name = $_FILES['user_image']['name'];
    $temp_name = $_FILES['user_image']['tmp_name'];
    $file_path = $directory . "/" . $file_name;
    move_uploaded_file($temp_name, $file_path);

    $result = $database->register_user($role, $first_name, $last_name, $email, $password, $gender, $date_of_birth, $file_path, $address);

    if($result){
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFillColor(200, 200, 200);
        $pdf->Rect(0, 0, 210, 297, "F");
        $pdf->SetFont("Arial", "B", 28);
        $pdf->SetFillColor(0, 128, 128);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 22, "Account Details", 0, 1, "C", 1);
        $pdf->Ln(10);
        $pdf->SetFont("Arial", "", 14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(0, 10, "Name: " . $first_name . " " . $last_name, 0, 1);
        $pdf->Cell(0, 10, "Email: " . $email, 0, 1);
        $pdf->Cell(0, 10, "Password: " . $password, 0, 1);
        $pdf->Cell(0, 10, "Gender: " . $gender, 0, 1);
        $pdf->Cell(0, 10, "Date of Birth: " . $date_of_birth, 0, 1);
        $pdf->MultiCell(0, 10, "Address: " . $address, 0);
        $pdf_path = "registered_user_pdfs/" . $first_name . " " . $last_name . ".pdf";
        $pdf->Output("F", $pdf_path);

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'ahsanhist4u@gmail.com';
        $mail->Password = 'uvypzcvocoertwwp';
        $mail->setFrom('ahsanhist4u@gmail.com', 'Pakistan News Blogs');
        $mail->addReplyTo('ahsanhist4u@gmail.com');
        $mail->addAddress($email);
        $mail->Subject = "Your Account Is In Pending";
        $mail->msgHTML("<h3><b>Your Account Request Is In Pending. Please Wait For Admin Approval.</b></h3>");
        $mail->addAttachment($pdf_path);

        $database->query = "SELECT * FROM user u INNER JOIN role r ON u.role_id = r.role_id WHERE u.role_id = '1'";
        $result = $database->result = mysqli_query($database->connection, $database->query);
        if($result->num_rows > 0){
            while($data = $result->fetch_assoc()){
                $mail_admin = new PHPMailer();
                $mail_admin->isSMTP();
                $mail_admin->Host = 'smtp.gmail.com';
                $mail_admin->Port = 587;
                $mail_admin->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail_admin->SMTPAuth = true;
                $mail_admin->Username = 'ahsanhist4u@gmail.com';
                $mail_admin->Password = 'uvypzcvocoertwwp';
                $mail_admin->setFrom('ahsanhist4u@gmail.com', 'Pakistan News Blogs');
                $mail_admin->addReplyTo('ahsanhist4u@gmail.com');
                $mail_admin->addAddress($data['email']);
                $mail_admin->Subject = "New User Registered";
                $mail_admin->msgHTML("<h3><b>New User is Registered In Pakistan News Blogs.</b></h3>");

                if(!$mail_admin->send()){
                    echo "Email Not Send: " . $mail_admin->ErrorInfo;
                }
            }
        }

        if(!$mail->send()){
            echo "Email Not Send: " . $mail->ErrorInfo;
        }else{
            header("location:admin/admin_register.php?msg=Registration Successfully&background_color=green");
        }
    }else{
        header("location:admin/admin_register.php?msg=Registration Failed&background_color=red");
    }

}elseif(isset($_REQUEST['login'])){
    extract($_REQUEST);

    $result = $database->login($email, $password);

    if($result->num_rows > 0){
        $data = mysqli_fetch_assoc($result);

        if($data['role_id'] == "2" && $data['is_approved'] == "Pending"){
            header("location:login.php?msg=Your Account Request Is Pending&background_color=red");
        
        }elseif($data['role_id'] == "2" && $data['is_approved'] == "Rejected"){
            header("location:login.php?msg=Your Account Request Is Rejected Please Register Again&background_color=darkred");
        
        }elseif($data['role_id'] == "2" && $data['is_active'] == "InActive"){
            header("location:login.php?msg=Your Account Is InActive&background_color=blue");
        
        }else{
            $_SESSION['user'] = $data;

            if($_SESSION['user']['role_id'] == "1"){
                header("location:admin/admin_panel.php");
            }elseif($_SESSION['user']['role_id'] == "2"){
                header("location:indexx.php");
            }
        }
    }else{
        header("location:login.php?msg=Incorrect Email Or Password&background_color=red");
    }

}elseif(isset($_POST['forgot_pass'])){

    $email = $_POST['email'];
    $result = $database->forgot_password($email);

    if(!$result){
        header("location:forgot_password.php?msg=Email Not Found&background_color=red");
        exit;
    }else{
        $data = mysqli_fetch_assoc($result);
        extract($data);

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFillColor(200, 200, 200);
        $pdf->Rect(0, 0, 210, 297, "F");
        $pdf->SetFont("Arial", "B", 28);
        $pdf->SetFillColor(0, 128, 128);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 22, "Account Details", 0, 1, "C", 1);
        $pdf->Ln(10);
        $pdf->SetFont("Arial", "", 14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(0, 10, "Name: " . $first_name . " " . $last_name, 0, 1);
        $pdf->Cell(0, 10, "Email: " . $email, 0, 1);
        $pdf->Cell(0, 10, "Password: " . $password, 0, 1);
        $pdf->Cell(0, 10, "Gender: " . $gender, 0, 1);
        $pdf->Cell(0, 10, "Date of Birth: " . $date_of_birth, 0, 1);
        $pdf->MultiCell(0, 10, "Address: " . $address, 0);
        $pdf_path = "registered_user_pdfs/" . $first_name . " " . $last_name . ".pdf";
        $pdf->Output("F", $pdf_path);

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'ahsanhist4u@gmail.com';
        $mail->Password = 'uvypzcvocoertwwp';
        $mail->setFrom('ahsanhist4u@gmail.com', 'Pakistan News Blogs');
        $mail->addReplyTo('ahsanhist4u@gmail.com');
        $mail->addAddress($email);
        $mail->Subject = "Forgot Your Password?";
        $mail->msgHTML("<h3><b>Here is Your Account Details.</b></h3>");
        $mail->addAttachment($pdf_path);

        if(!$mail->send()){
            echo "Email Not Send: " . $mail->ErrorInfo;
        }
       
        header("location:forgot_password.php?msg=Please Check Your Registered Email&background_color=green");
    }

}elseif(isset($_REQUEST['update_user_profile'])){
    extract($_REQUEST);

    $directory = "Images";
    if(!is_dir($directory)){
        if (!mkdir($directory)){
            echo "Directory Not Created";
        }
    }
    $file_name = $_FILES['user_image']['name'];
    $temp_name = $_FILES['user_image']['tmp_name'];
    $file_path = $directory . "/" . $file_name;
    move_uploaded_file($temp_name, $file_path);

    $result = $database->update_profile($first_name, $last_name, $gender, $date_of_birth, $file_path, $address,$updated_time, $_SESSION['user']['user_id']);

    if($result){
        header("location:update_user_profile.php?msg=Account Details Updated Successfully&background_color=green");
    }else{
        header("location:update_user_profile.php?msg=Account Details Not Updated&background_color=red");
    }

}elseif(isset($_REQUEST['update_admin_profile'])){
    extract($_REQUEST);

    $directory = "Images";
    if(!is_dir($directory)){
        if (!mkdir($directory)) {
            echo "Directory Not Created";
        }
    }
    $file_name = $_FILES['user_image']['name'];
    $temp_name = $_FILES['user_image']['tmp_name'];
    $file_path = $directory . "/" . $file_name;
    move_uploaded_file($temp_name, $file_path);

    $result = $database->update_profile($first_name, $last_name, $gender, $date_of_birth, $file_path, $address,$updated_time, $_SESSION['user']['user_id']);

    if($result){
        header("location:admin/edit_profile.php?msg=Account Details Updated Successfully&background_color=green");
    }else{
        header("location:admin/edit_profile.php?msg=Account Details Not Updated&background_color=red");
    }


}elseif(isset($_REQUEST['update_user_profile_admin'])){
    extract($_REQUEST);

    if(isset($_FILES['user_image']) && $_FILES['user_image']['error'] != 4){

    $directory = "Images";
    if(!is_dir($directory)){
        if (!mkdir($directory)) {
            echo "Directory Not Created";
        }
    }
    $file_name = $_FILES['user_image']['name'];
    $temp_name = $_FILES['user_image']['tmp_name'];
    $file_path = $directory . "/" . $file_name;
    move_uploaded_file($temp_name, $file_path);

    }else{
        $file_path = $old_user_image;
    }

    $result = $database->update_profile($first_name,$last_name,$gender,$date_of_birth,$file_path,$address,$updated_at,$user_id);

    if($result){
        header("location:admin/view_all_user.php?msg=User Account Updated Successfully&background_color=green");
    }else{
        header("location:admin/view_all_user.php?msg=User Account Not Updated&background_color=red");
    }



}elseif(isset($_REQUEST['feedback_submit'])){
    extract($_REQUEST);

    if(isset($_SESSION['user'])){
        $result = $database->feedback($_SESSION['user']['user_id'], $_SESSION['user']['first_name'] . " " . $_SESSION['user']['last_name'], $_SESSION['user']['email'], $feedback);
    }else{
        $result = $database->feedback('NULL', $name, $email, $feedback);
    }

    if($result){
        $database->query = "SELECT * FROM user u INNER JOIN role r ON u.role_id = r.role_id WHERE u.role_id = '1'";
        $result = $database->result = mysqli_query($database->connection, $database->query);

        if($result->num_rows > 0){
            while ($data = $result->fetch_assoc()) {
                $mail_admin = new PHPMailer();
                $mail_admin->isSMTP();
                $mail_admin->Host = 'smtp.gmail.com';
                $mail_admin->Port = 587;
                $mail_admin->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail_admin->SMTPAuth = true;
                $mail_admin->Username = 'ahsanhist4u@gmail.com';
                $mail_admin->Password = 'uvypzcvocoertwwp';
                $mail_admin->setFrom('ahsanhist4u@gmail.com', 'Pakistan News Blogs');
                $mail_admin->addReplyTo('ahsanhist4u@gmail.com');
                $mail_admin->addAddress($data['email']);
                $mail_admin->Subject = "New Feedback Submitted";
                $mail_admin->msgHTML("<h3><b>An User Submitted his Feedback In Pakistan News Blogs.</b></h3>");

                if(!$mail_admin->send()){
                    echo "Email Not Send: " . $mail_admin->ErrorInfo;
                }
            }
        }
    
        header("location:feedback.php?msg=Feedback Submitted Successfully&background_color=green");
    }else{
        header("location:feedback.php?msg=Something Went Wrong&background_color=red");
    }

}elseif(isset($_REQUEST['feedback_admin'])){
    extract($_REQUEST);

    if(isset($_SESSION['user'])){
        $result = $database->feedback($_SESSION['user']['user_id'], $_SESSION['user']['first_name'] . " " . $_SESSION['user']['last_name'], $_SESSION['user']['email'], $feedback);
    }

    if($result){
        $database->query = "SELECT * FROM user u INNER JOIN role r ON u.role_id = r.role_id WHERE u.role_id = '1'";
        $result = $database->result = mysqli_query($database->connection, $database->query);

        if($result->num_rows > 0){
            while ($data = $result->fetch_assoc()) {
                $mail_admin = new PHPMailer();
                $mail_admin->isSMTP();
                $mail_admin->Host = 'smtp.gmail.com';
                $mail_admin->Port = 587;
                $mail_admin->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail_admin->SMTPAuth = true;
                $mail_admin->Username = 'ahsanhist4u@gmail.com';
                $mail_admin->Password = 'uvypzcvocoertwwp';
                $mail_admin->setFrom('ahsanhist4u@gmail.com', 'Pakistan News Blogs');
                $mail_admin->addReplyTo('ahsanhist4u@gmail.com');
                $mail_admin->addAddress($data['email']);
                $mail_admin->Subject = "New Feedback Submitted";
                $mail_admin->msgHTML("<h3><b>An User Submitted his Feedback In Pakistan News Blogs.</b></h3>");

                if(!$mail_admin->send()){
                    echo "Email Not Send: " . $mail_admin->ErrorInfo;
                }
            }
        }
        
        header("location:admin/feedback.php?msg=Feedback Submitted Successfully&background_color=green");
    }else{
        header("location:admin/feedback.php?msg=Something Went Wrong&background_color=red");
    }

}elseif(isset($_REQUEST['create_blog'])){
    extract($_REQUEST);

    $directory = "Images";
    if (!is_dir($directory)) {
        if (!mkdir($directory)) {
            echo "Directory Not Created";
        }
    }
    $file_name = $_FILES['blog_bg_image']['name'];
    $temp_name = $_FILES['blog_bg_image']['tmp_name'];
    $file_path = $directory . "/" . $file_name;
    move_uploaded_file($temp_name, $file_path);

    $result = $database->create_blog($_SESSION['user']['user_id'], $blog_title, $post_per_page, $file_path, $blog_status);

    if($result){
        header("location:admin/blog_form.php?msg=Blog Created Successfully&background_color=green");
    }else{
        header("location:admin/blog_form.php?msg=Something Went Wrong&background_color=red");
    }

}elseif(isset($_REQUEST['update_blog'])){
    extract($_REQUEST);
    
    if(isset($_FILES['blog_bg_image']) && $_FILES['blog_bg_image']['error'] != 4){
     
     $directory = "Images";
        if (!is_dir($directory)) {
        if (!mkdir($directory)) {
            echo "Directory Not Created";
        }
     }
    $file_name = $_FILES['blog_bg_image']['name'];
    $temp_name = $_FILES['blog_bg_image']['tmp_name'];
    $file_path = $directory . "/" . $file_name;
    
    }else{
        $file_path = $old_blog_background_image;
    }

    $result = $database->blog_settings($blog_title,$post_per_page,$file_path,$updated_at,$blog_id);

    if($result){
        header("location:admin/blog_settings.php?msg=Blog Settings Updated Successfully&background_color=green");
    }else{
        header("location:admin/blog_settings.php?msg=Something Went Wrong&background_color=red");
    }

}elseif(isset($_REQUEST['create_category'])){
    extract($_REQUEST);

    $result = $database->create_category($category_title,$category_description,$category_status);

    if($result){
        header("location:admin/category_form.php?msg=Category Created Successfully&background_color=green");
    }else{
        header("location:admin/category_form.php?msg=Something Went Wrong&background_color=red");
    }

}elseif(isset($_REQUEST['update_category'])){
    extract($_REQUEST);

    $result = $database->update_category($category_title,$category_description,$category_status,$category_id,$updated_at);
    
    if($result){
        header("location:admin/view_category.php?msg=Category Updated Successfully&background_color=green");
    }else{
        header("location:admin/view_category.php?msg=Category Something Went Wrong&background_color=red");
    }
    
}elseif(isset($_REQUEST['add_post'])){

    extract($_REQUEST);

    $directory = "Images";
        if (!is_dir($directory)) {
        if (!mkdir($directory)) {
            echo "Directory Not Created";
        }
     }
    $file_name = $_FILES['featured_image']['name'];
    $temp_name = $_FILES['featured_image']['tmp_name'];
    $file_path = $directory . "/" . $file_name;

    $result = $database->add_post($blog,$post_title,$post_summary,$post_description,$file_path,$post_status,$is_comment_allowed);
    $connection = $database->get_connection();
    $post_id = $connection->insert_id;
    
    if($result){

      foreach($category as $value){
        $database->query = "INSERT INTO post_category (post_id,category_id) VALUES ($post_id,$value)";  
        $database->result = mysqli_query($database->connection,$database->query);
      }
      
      if(isset($_FILES['attachment_file']['name'])) {

        $directory = "attachments";
        if (!is_dir($directory)) {
            if (!mkdir($directory)) {
                echo "Directory Not Created";
            }
        }
        for ($i = 0; $i < count($_FILES['attachment_file']['name']); $i++) {
            $attachment_file_name = $_FILES['attachment_file']['name'][$i];
            $attachment_file_temp_name = $_FILES['attachment_file']['tmp_name'][$i];
            $attachment_file_path = $directory . "/" . $attachment_file_name;
            move_uploaded_file($attachment_file_temp_name, $attachment_file_path);
    
            $attachment_title = $_POST['attachment_title'][$i];
            $attachment_status = 'Active';
    
            $database->query = "INSERT INTO post_atachment (post_id, post_attachment_title, post_attachment_path, is_active) 
                                VALUES ($post_id, '".htmlspecialchars($attachment_title,true)."', '".$attachment_file_path."', '".$attachment_status."')";
           
            $database->result = mysqli_query($database->connection, $database->query);
        }
    }
   
    $database->query = "SELECT u.email, b.blog_title 
                        FROM following_blog fb 
                        INNER JOIN user u ON u.user_id = fb.follower_id 
                        INNER JOIN blog b ON b.blog_id = fb.blog_following_id 
                        WHERE fb.blog_following_id = '$blog'";
    $result = $database->result = mysqli_query($database->connection, $database->query);
    
    if($result->num_rows > 0){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'ahsanhist4u@gmail.com';
        $mail->Password = 'uvypzcvocoertwwp';
        $mail->setFrom('ahsanhist4u@gmail.com', 'Pakistan News Blogs');
        $mail->addReplyTo('ahsanhist4u@gmail.com');
    
        while ($data = $result->fetch_assoc()) {
            $mail->addAddress($data['email']);
            $mail->Subject = 'New Post Added In Blog: ' . $data['blog_title'];
            $mail->msgHTML("<h3><b>New Post Added In Blog Which You Followed In Pakistan News Blogs</b></h3>");
    
            if(!$mail->send()){
                echo "Email Not Send: " . $mail->ErrorInfo;
            }
        }
    }
    
        header("location:admin/post_form.php?msg=Post Added Successfully&background_color=green");
    }else{
        header("location:admin/post_form.php?msg=Post Something Went Wrong&background_color=red");
    }
    
}elseif(isset($_REQUEST['update_post'])){
    extract($_REQUEST);
   
    if(isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] != 4){
     
        $directory = "Images";
           if (!is_dir($directory)) {
           if (!mkdir($directory)) {
               echo "Directory Not Created";
           }
        }
       $file_name = $_FILES['featured_image']['name'];
       $temp_name = $_FILES['featured_image']['tmp_name'];
       $file_path = $directory . "/" . $file_name;
       
       }else{
           $file_path = $old_featured_image;
       }

    $result = $database->update_post($post_id,$blog,$post_title,$post_summary,$post_description,$file_path,$post_status,$is_comment_allowed,$updated_at);
    
    if($result){

        $database->query = "DELETE FROM post_category WHERE post_id = '".$post_id."'";
        $database->result = mysqli_query($database->connection, $database->query);
      
        foreach($category as $value){
        date_default_timezone_set("Asia/Karachi");
        $updated_at = date("Y-m-d H:i:s");
          $database->query = "INSERT INTO post_category (post_id, category_id, updated_at) VALUES ('".$post_id."', '".$value."','".$updated_at."')";
          $database->result = mysqli_query($database->connection, $database->query);
        }
        header("location:admin/manage_all_posts.php?msg=Post Updated Successfully&background_color=green");
    }else{
        header("location:admin/manage_all_posts.php?msg=Post Updated Something Went Wrong&background_color=red");
    }

}elseif(isset($_REQUEST['update_attachment'])){
    extract($_REQUEST);

    if(isset($_FILES['attachment_file']) && $_FILES['attachment_file']['error'] != 4){
     
        $directory = "attachments";
        if (!is_dir($directory)) {
            if (!mkdir($directory)) {
                echo "Directory Not Created";
            }
        }
       $file_name = $_FILES['attachment_file']['name'];
       $temp_name = $_FILES['attachment_file']['tmp_name'];
       $file_path = $directory . "/" . $file_name;
       
       }else{
           $file_path = $old_attachment_file;
       }

    $result = $database->update_attachment($attachment_title,$file_path,$attachment_id,$updated_at);
    
    if($result){
        header("location:admin/update_attachments.php?msg=Attachment Updated Successfully&background_color=green");
    }else{
        header("location:admin/update_attachments.php?msg=Attachment Not Updated&background_color=red");
    }

}elseif(isset($_REQUEST['post_comment'])){

    extract($_REQUEST);
    $result = $database->comments($post_id, $_SESSION['user']['user_id'], $user_comment);
    if($result){
        header("location:post_details.php?msg=Comment Added Successfully&post_id=$post_id");
    }else{
        header("location:post_details.php?msg=Comment Something Went Wrong&post_id=$post_id");
    }

}


/*........All Process.......*/



/*........Status Process.......*/

if(isset($_GET['status_name']) == 'is_active' && isset($_GET['status_value']) == 'Active' || isset($_GET['status_value']) == 'InActive'  && isset($_GET['user_id'])){
    extract($_REQUEST);

    $result = $database->user_status($status_name, $status_value, $user_id, $email);

    if($result){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'ahsanhist4u@gmail.com';
        $mail->Password = 'uvypzcvocoertwwp';
        $mail->setFrom('ahsanhist4u@gmail.com', 'Pakistan News Blogs');
        $mail->addReplyTo('ahsanhist4u@gmail.com');
        $mail->addAddress($email);

        if($status_value == "Active"){
            $mail->Subject = "Congrats! Your Account is Active";
            $mail->msgHTML("<h3><b>Your Account Status is Active now you can explore our website.</b></h3>");
        }elseif($status_value == "InActive") {
            $mail->Subject = "Your Account is InActive";
            $mail->msgHTML("<h3><b>Your Account Status is InActive.</b></h3>");
        }

        if(!$mail->send()){
            echo "Email Not Sent: " . $mail->ErrorInfo;
        }else{
            header("location:admin/view_all_user.php?msg=Account Status Updated Successfully&background_color=green");
        }
    }else{
        header("location:admin/view_all_user.php?msg=Account Status Not Updated&background_color=red");
    }


}

if(isset($_GET['status_name']) == 'is_approved' && isset($_GET['status_value']) == 'Approved' || isset($_GET['status_value']) == 'Rejected' && isset($_GET['user_id'])){
    extract($_REQUEST);

    $result = $database->user_status($status_name, $status_value, $user_id, $email);
    
    if($result){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'ahsanhist4u@gmail.com';
        $mail->Password = 'uvypzcvocoertwwp';
        $mail->setFrom('ahsanhist4u@gmail.com', 'Pakistan News Blogs');
        $mail->addReplyTo('ahsanhist4u@gmail.com');
        $mail->addAddress($email);

        if($status_value == "Approved"){
            $mail->Subject = "Your Account Request is Approved!.";
            $mail->msgHTML("<h3><b>Your Account Request is Approved now you can explore our website 'Pakistan News Blogs'. All Right Reserved 'Pakistan News Blogs'</b></h3>");
        
        }elseif($status_value == "Rejected"){
            $mail->Subject = "Your Account Request is Rejected!.";
            $mail->msgHTML("<h3><b>Your Account Request is Rejected!. Please Register Again to get latest news updates only on 'Pakistan News Blogs'. All Right Reserved 'Pakistan News Blogs'</b></h3>");
        }

        if(!$mail->send()){
            echo "Email Not Sent: " . $mail->ErrorInfo;
        }else{
            header("location:admin/pending_users.php?msg=Account Request Status is Updated Successfully&background_color=green");
        }
    }else{
        header("location:admin/pending_users.php?msg=Account Request Not Updated&background_color=red");
    }

}

if(isset($_GET['status']) == 'blog_status' && isset($_GET['value']) == 'Active' || isset($_GET['value']) == 'InActive'  && isset($_GET['blog_id'])) {
    extract($_REQUEST);
    
    $result = $database->blog_status($status,$value,$blog_id);
    
    if($result){
        header("location:admin/blog_settings.php?msg=Blog Status Updated Successfully&background_color=green");
    }else{
        header("location:admin/blog_settings.php?msg=Blog Something Went Wrong&background_color=red");
    }
    
}elseif(isset($_GET['status']) == 'Active' || isset($_GET['status']) == 'InActive' && isset($_GET['category_id'])){
    extract($_REQUEST);

    $result = $database->category_status($status,$category_id);

    if($result){
        header("location:admin/view_category.php?msg=Category Status Updated Successfully&background_color=green");
    }else{
        header("location:admin/view_category.php?msg=Category Something Went Wrong&background_color=red");
    }

}

if(isset($_GET['post_status']) == 'Active' || isset($_GET['post_status']) == 'InActive'  && isset($_GET['post_id'])){
    extract($_REQUEST);

    $result = $database->post_status($post_status,$post_id);
    if($result){
        header("location:admin/post.php?msg=Post Status Updated Successfully&background_color=green");
    }else{
        header("location:admin/post.php?msg=Post Something Went Wrong&background_color=red");
    }

}

if(isset($_GET['comment_status']) == 'Active' || isset($_GET['comment_status']) == 'InActive'  && isset($_GET['post_comment_id'])){
    extract($_REQUEST);

    $result = $database->comment_status($comment_status,$post_comment_id);
    if($result){
        header("location:admin/view_comments.php?msg=Comment Status Updated Successfully&background_color=green");
    }else{
        header("location:admin/view_comments.php?msg=Comment Something Went Wrong&background_color=red");
    }

}

if(isset($_GET['is_active']) == 'Active' || isset($_GET['is_active']) == 'InActive'  && isset($_GET['post_attachment_id'])){
    extract($_REQUEST);

    $result = $database->attachment_status($is_active,$post_attachment_id);
    if($result){
        header("location:admin/view_attachments.php?msg=Attachment Status Updated Successfully&background_color=green");
    }else{
        header("location:admin/view_attachments.php?msg=Attachment Something Went Wrong&background_color=red");
    }

}


if(isset($_GET['blogs']) == 'follow_blog' && isset($_GET['status'])){
    extract($_REQUEST);

    $result = $database->follow_blog($_SESSION['user']['user_id'],$blog_id,$status);

    if($result){
        header("location:indexx.php?msg=Follow Blog Successfully&background_color=green");
    }else{
        header("location:indexx.php?msg=Follow BLog Something Went Wrong&background_color=red");
    }

}

if(isset($_GET['action']) == 'update_follow' && isset($_GET['status'])){
    extract($_REQUEST);

    $result = $database->update_follow($status,$blog_id,$_SESSION['user']['user_id'],$updated_at);

    if($result){
        header("location:indexx.php?msg=Follow Status Updated Successfully&background_color=green");
    }else{
        header("location:indexx.php?msg=Something Went Wrong&background_color=red");
    }
}






/*........Status Process.......*/

?>
