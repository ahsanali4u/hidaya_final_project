<?php
    class Database_connection{
		public $connection;
        public $query;
        public $result;

        public function __construct(){
            
            mysqli_report(false);
            $this->connection = mysqli_connect("localhost","root","","22829_Ahsan_Ali");
            if(mysqli_connect_errno()){
                echo "Failed to connect to MySql <br/>";
                echo "Error No: " .mysqli_connect_errno()."<br/>";
                echo "Error Message: " .mysqli_connect_error()."<br/>"; 
            }
        }
        
        public function get_connection(){
            return $this->connection;
        }

        public function register_user($role_id='2',$first_name,$last_name,$email,$password,$gender,$date_of_birth,$user_image,$address){

            $this->query = "INSERT INTO user (role_id,first_name,last_name,email,password,gender,date_of_birth,user_image,address,is_active) 
            VALUES ($role_id,'".$first_name."','".$last_name."','".$email."','".$password."',
                   '".$gender."','".$date_of_birth."','".$user_image."','".$address."','InActive')";
            $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;      
        }

        public function login($email,$password){

            $this->query  = "SELECT * FROM user u WHERE u.email = '".$email."' AND u.password = '".$password."'";                   
            $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;
        }

        public function forgot_password($email){
            $this->query = "SELECT * FROM user WHERE email = '".$email."'";
            $this->result = mysqli_query($this->connection,$this->query);

            if(mysqli_num_rows($this->result) > 0) {
                return $this->result;
            }else{
                return false;
            }
        }

        public function user_status($status_name,$status_value,$user_id,$email){

            $this->query = "UPDATE user SET $status_name = '".$status_value."' WHERE user_id = '".$user_id."'";
            $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;

        }

        public function update_profile($first_name,$last_name,$gender,$date_of_birth,$user_image,$address,$updated_at,$user_id){
            date_default_timezone_set("Asia/Karachi");
            $updated_at = date("Y-m-d H:i:s");

            $this->query = "UPDATE user SET first_name = '".$first_name."', last_name = '".$last_name."',gender = '".$gender."', 
                            date_of_birth = '".$date_of_birth."', user_image = '".$user_image."', address = '".$address."',
                            updated_at = '".$updated_at."' WHERE user_id = '".$user_id."'"; 

            $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;
        }


        public function feedback($user_id,$name,$email,$feedback){

            $this->query = "INSERT INTO user_feedback (user_id,user_name,user_email,feedback) 
                            VALUES ($user_id,'".$name."','".$email."','".htmlspecialchars($feedback)."')";
            $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;

        }

        public function create_blog($user_id,$blog_title,$post_per_page,$blog_background_image,$blog_status){

            $this->query = "INSERT INTO blog (user_id,blog_title,post_per_page,blog_background_image,blog_status)
                            VALUES ($user_id,'".htmlspecialchars($blog_title,true)."','".$post_per_page."','".$blog_background_image."','".$blog_status."')";
            $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;
        }

        public function blog_status($status,$value,$blog_id){

           $this->query = "UPDATE blog SET $status = '".$value."' WHERE blog_id = '".$blog_id."'"; 
           $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;
        }

        public function blog_settings($blog_title,$post_per_page,$blog_background_image,$updated_at,$blog_id){
            date_default_timezone_set("Asia/Karachi");
            $updated_at = date("Y-m-d H:i:s");

            $this->query = "UPDATE blog SET blog_title = '".htmlspecialchars($blog_title,true)."', post_per_page = '".$post_per_page."',
            blog_background_image = '".$blog_background_image."',updated_at = '".$updated_at."' WHERE blog_id = '".$blog_id."'";
            $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;
        }

        public function follow_blog($user_id,$blog_following_id,$status){
            
            $this->query = "INSERT INTO following_blog (follower_id,blog_following_id,status) 
                            VALUES ('".$user_id."', '".$blog_following_id."', '".$status."')";
            $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;
        }

        public function update_follow($status,$blog_id,$follower_id,$updated_at){
            date_default_timezone_set("Asia/Karachi");
            $updated_at = date("Y-m-d H:i:s");

            $this->query = "UPDATE following_blog SET status = '".$status."', updated_at = '".$updated_at."' 
                            WHERE blog_following_id = '".$blog_id."' AND follower_id = '".$follower_id."'";
                        
            $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;
        }

        public function create_category($category_title,$category_description,$category_status){
            
            $this->query = "INSERT INTO category (category_title,category_description,category_status) 
                            VALUES ('".htmlspecialchars($category_title,true)."',
                            '".htmlspecialchars($category_description,true)."','".$category_status."')";
           
            $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;
        }

        public function update_category($category_title,$category_description,$category_status,$category_id,$updated_at){
            date_default_timezone_set("Asia/Karachi");
            $updated_at = date("Y-m-d H:i:s");

            $this->query = "UPDATE category SET category_title = '".htmlspecialchars($category_title,true)."', 
                            category_description = '".htmlspecialchars($category_description,true)."',
                            category_status = '".$category_status."', updated_at = '".$updated_at."' 
                            WHERE category_id = '".$category_id."'";

            $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;
        }

        public function category_status($status,$category_id){

           $this->query = "UPDATE category SET category_status = '".$status."' WHERE category_id = '".$category_id."'"; 
           $this->result = mysqli_query($this->connection,$this->query);
           return $this->result;
        }

        public function add_post($blog_id,$post_title,$post_summary,$post_description,$featured_image,$post_status,$is_comment_allowed){

            $this->query = "INSERT INTO post (blog_id,post_title,post_summary,post_description,featured_image,post_status,is_comment_allowed)
                            VALUES ('".$blog_id."','".htmlspecialchars($post_title,true)."','".htmlspecialchars($post_summary,true)."',
                            '".htmlspecialchars($post_description,true)."','".$featured_image."','".$post_status."','".$is_comment_allowed."')";
        
            $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;
        }

        public function post_status($post_status,$post_id){

           $this->query = "UPDATE post SET post_status = '".$post_status."' WHERE post_id = '".$post_id."'"; 
           $this->result = mysqli_query($this->connection,$this->query);
           return $this->result;

        }

        public function update_post($post_id,$blog_id,$post_title,$post_summary,$post_description,$featured_image,$post_status,$is_comment_allowed,$updated_at){
            date_default_timezone_set("Asia/Karachi");
            $updated_at = date("Y-m-d H:i:s");

            $this->query = "UPDATE post SET blog_id = '".$blog_id."', post_title = '".htmlspecialchars($post_title,true)."', 
                            post_summary = '".htmlspecialchars($post_summary,true)."', post_description = '".htmlspecialchars($post_description,true)."',
                            featured_image = '".$featured_image."',post_status = '".$post_status."', is_comment_allowed = '".$is_comment_allowed."', 
                            updated_at = '".$updated_at."' WHERE post_id = '".$post_id."' ";

            $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;
        }

        public function fetch_blog_posts($blog_id, $limit, $offset) {
            $this->query = "SELECT p.featured_image, p.post_title , p.post_summary, p.updated_at, p.post_id, b.blog_title
                            FROM post p INNER JOIN blog b ON b.blog_id = p.blog_id 
                            WHERE p.blog_id = '".$blog_id."' AND p.post_status = 'Active' LIMIT $limit OFFSET $offset";
            $this->result = mysqli_query($this->connection, $this->query);
            return $this->result;
        }
        
        public function count_blog_posts($blog_id){

            $this->query = "SELECT COUNT(post_id) AS 'total_posts' FROM post WHERE blog_id = '".$blog_id."' AND post_status = 'Active'";
            $this->result = mysqli_query($this->connection, $this->query);
            return $this->result;
        }

        public function update_attachment($attachment_title,$attachment_file,$attachment_id,$updated_at){
            date_default_timezone_set("Asia/Karachi");
            $updated_at = date("Y-m-d H:i:s");

            $this->query = "UPDATE post_atachment SET post_attachment_title = '".htmlspecialchars($attachment_title,true)."', post_attachment_path = '".$attachment_file."', 
                            updated_at = '".$updated_at."' WHERE post_atachment_id = '".$attachment_id."'";
            $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;
        }

        public function attachment_status($attachment_status,$attachment_id){

           $this->query = "UPDATE post_atachment SET is_active = '".$attachment_status."' WHERE post_atachment_id = '".$attachment_id."'"; 
           
           $this->result = mysqli_query($this->connection,$this->query);
           return $this->result;
        }

        public function comments($post_id,$user_id,$comment){

        $this->query = "INSERT INTO post_comment (post_id,user_id,comment,is_active)
                        VALUES ('".$post_id."', '".$user_id."', '".htmlspecialchars($comment,true)."','Active')";
        
        $this->result = mysqli_query($this->connection,$this->query);
           return $this->result;
        }

        public function fetch_comments($post_id){

            $this->query = "SELECT pc.comment, pc.created_at, u.first_name, u.last_name, u.user_image, pc.is_active 
                            FROM post_comment pc 
                            INNER JOIN user u ON u.user_id = pc.user_id 
                            WHERE post_id = '".$post_id."' AND pc.is_active = 'Active' ORDER BY pc.post_comment_id DESC";
            $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;
        }

        public function comment_status($comment_status,$post_comment_id){

            $this->query = "UPDATE post_comment SET is_active = '".$comment_status."' WHERE post_comment_id = '".$post_comment_id."'"; 
            $this->result = mysqli_query($this->connection,$this->query);
            return $this->result;
 
         }







       
        







        public function __destruct(){
            mysqli_close($this->connection);
         }
    }

   
   ?>