 // post form validation
 function post_validation() {

	var flag = true;

	var post_title = document.querySelector("#post_title").value;
	var post_summary = document.querySelector("#post_summary").value;
	var post_description = document.querySelector("#post_description").value;
	var featured_image = document.querySelector("#featured_image");
	var post_blog = document.querySelector("#post_blog").value;
	var category = document.querySelector("#category");
	var post_status_active = document.querySelector("#post_status_active").checked;
    var post_status_inactive = document.querySelector("#post_status_inactive").checked;
	var allow_comment_yes = document.querySelector("#allow_comment_yes").checked;
	var allow_comment_no = document.querySelector("#allow_comment_no").checked;

    
	var post_title_msg = document.querySelector("#post_title_msg");
	var post_summary_msg = document.querySelector("#post_summary_msg");
	var post_description_msg = document.querySelector("#post_description_msg");
	var featured_image_msg = document.querySelector("#featured_image_msg");
	var post_blog_msg = document.querySelector("#post_blog_msg");
	var category_msg = document.querySelector("#category_msg");
	var post_status_msg = document.querySelector("#post_status_msg");
	var allow_comment_msg = document.querySelector("#allow_comment_msg");


  if (post_title == "") {
    flag = false;
    post_title_msg.innerHTML = "Field Required";
  } else {
    post_title_msg.innerHTML = "";
  }
  

  if (post_summary == "") {
    flag = false;
    post_summary_msg.innerHTML = "Field Required";
  } else {
    post_summary_msg.innerHTML = "";
  }
  
 
  if (post_description == "") {
    flag = false;
    post_description_msg.innerHTML = "Field Required";
  } else {
    post_description_msg.innerHTML = "";
  }
  
  
  if(document.querySelector("#old_featured_image") === null){
  if (featured_image.value === "") {
    flag = false;
    featured_image_msg.innerHTML = "Field Required";
  } else {
    featured_image_msg.innerHTML = "";
  }
}
  
  
  if (post_blog == "") {
    flag = false;
    post_blog_msg.innerHTML = "Field Required";
  } else {
    post_blog_msg.innerHTML = "";
  }
  

  if (category.selectedOptions.length === 0) {
	flag = false;
	category_msg.innerHTML = "Field Required";
  } else {
	category_msg.innerHTML = "";
  }  
  
  
  if (!post_status_active && !post_status_inactive) {
    flag = false;
    post_status_msg.innerHTML = "Field Required";
  } else {
    post_status_msg.innerHTML = "";
  }
  

  if (!allow_comment_yes && !allow_comment_no) {
    flag = false;
    allow_comment_msg.innerHTML = "Field Required";
  } else {
    allow_comment_msg.innerHTML = "";
  }




	if(flag){
		return true;
	}else{
		return false;
	}
}

// post form validation

//admin register form validation
function admin_register_validation(){

	var flag = true;

	var alpha_pattern = /^[A-Z]{1}[a-z]{2,}$/;
	var email_pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.(com|net|[a-zA-Z]{2,})$/;

    var first_name = document.querySelector("#first_name").value;
    var last_name = document.querySelector("#last_name").value;
    var email = document.querySelector("#email").value;
    var password = document.querySelector("#password").value;
    var gender = document.querySelector("input[type='radio']:checked");
    var role = document.querySelector("#role").value;
    var date_of_birth = document.querySelector("#date_of_birth").value;
    var user_image = document.getElementById("user_image").files;
    var address = document.querySelector("#address").value;

    var first_name_msg = document.querySelector("#first_name_msg");
	var last_name_msg = document.querySelector("#last_name_msg");
	var email_msg = document.querySelector("#email_msg");
    var password_msg = document.querySelector("#password_msg");
	var gender_msg = document.querySelector('#gender_msg');
	var role_msg = document.querySelector('#role_msg');
    var date_of_birth_msg = document.querySelector("#date_of_birth_msg");
    var user_image_msg = document.querySelector('#user_image_msg');
	var address_msg = document.querySelector("#address_msg");

	if(first_name == ""){
		flag = false;
		first_name_msg.innerHTML = "Field Required";
	}else{
		first_name_msg.innerHTML = "";
		if(alpha_pattern.test(first_name) === false){
			flag = false;
			first_name_msg.innerHTML = "First Name should look like eg: Saad";
		}
	}

	if(last_name == ""){
		flag = false;
		last_name_msg.innerHTML = "Field Required";
	}else{
		last_name_msg.innerHTML = "";
		if(alpha_pattern.test(last_name) === false){
			flag = false;
			last_name_msg.innerHTML = "Last Name should look like eg: Ali";
		}
	}

	if(email == ""){
		flag = false;
		email_msg.innerHTML = "Field Required";
	}else{
		email_msg.innerHTML = "";
		if (email_pattern.test(email) === false){
			flag = false;
			email_msg.innerHTML = "Email should look like eg: saad123@gmail.com";
		}
	}

	if(password == ""){
		flag = false;
		password_msg.innerHTML = "Field Required";
	}else{
		password_msg.innerHTML = "";
	}

	if(!gender){
		flag = false;
		gender_msg.innerHTML = "Field Required";
	}else{
		gender_msg.innerHTML = "";
	}

	if(role == ""){
		flag = false;
		role_msg.innerHTML = "Field Required";
	}else{
		role_msg.innerHTML = "";
	}

	if(date_of_birth == ""){
		flag = false;
		date_of_birth_msg.innerHTML = "Field Required";
	}else{
		date_of_birth_msg.innerHTML = "";
	}

	if(user_image.length == 0 ) {
        flag = false;
		user_image_msg.innerHTML = "Field Required";
	}else{
        user_image_msg.innerHTML = "";
	}

	if(address == ""){
		flag = false;
		address_msg.innerHTML = "Field Required";
	}else{
		address_msg.innerHTML = "";
	}




	if(flag){
		return true;
	}else{
		return false;
	}

}
//admin register form validation


//blog form validation 
function blog_validation(){

	var flag = true;

    var post_per_page = document.querySelector("#post_per_page").value;
	var blog_title = document.querySelector("#blog_title").value;
	var blog_bg_image = document.querySelector("#blog_bg_image").files;
	var blog_status = document.querySelector("input[type='radio']:checked");

	var post_per_page_msg = document.querySelector("#post_per_page_msg");
	var blog_title_msg = document.querySelector("#blog_title_msg");
	var blog_bg_image_msg = document.querySelector("#blog_bg_image_msg");
	var blog_status_msg = document.querySelector('#blog_status_msg');

	if(post_per_page == 0){
		flag = false;
		post_per_page_msg.innerHTML = "Field Required";
	}else{
		post_per_page_msg.innerHTML = "";
	}

	if(blog_title == ""){
		flag = false;
		blog_title_msg.innerHTML = "Field Required";
	}else{
		blog_title_msg.innerHTML = "";
	}

  if(document.querySelector("#old_blog_bg_image") === null){
	if(blog_bg_image.length == 0) {
        flag = false;
		blog_bg_image_msg.innerHTML = "Field Required";
	}else{
        blog_bg_image_msg.innerHTML = "";
	}
}

	if(!blog_status){
		flag = false;
		blog_status_msg.innerHTML = "Field Required";
	}else{
		blog_status_msg.innerHTML = "";
	}



	if(flag){
		return true;
	}else{
		return false;
	}
}
//blog form validation 


//category form validation
function category_validation(){

	var flag = true;

	var category_title = document.querySelector("#category_title").value;
	var category_description = document.querySelector("#category_description").value;
	var category_status = document.querySelector("input[type='radio']:checked");

	var category_title_msg = document.querySelector("#category_title_msg");
	var category_description_msg = document.querySelector("#category_description_msg");
	var category_status_msg = document.querySelector('#category_status_msg');


	if(category_title == ""){
		flag = false;
		category_title_msg.innerHTML = "Field Required";
	}else{
		category_title_msg.innerHTML = "";
	}

	if(category_description == ""){
		flag = false;
		category_description_msg.innerHTML = "Field Required";
	}else{
		category_description_msg.innerHTML = "";
	}

	if(!category_status){
		flag = false;
		category_status_msg.innerHTML = "Field Required";
	}else{
		category_status_msg.innerHTML = "";
	}


	if(flag){
		return true;
	}else{
		return false;
	}

}
//category form validation

// Update Profile Validation
function update_profile_validation(){

	var flag = true;

    var alpha_pattern = /^[A-Z]{1}[a-z]{2,}$/;

    var first_name = document.querySelector("#first_name").value;
    var last_name = document.querySelector("#last_name").value;
    var gender = document.querySelector("input[type='radio']:checked");
    var date_of_birth = document.querySelector("#date_of_birth").value;
    var user_image = document.getElementById("user_image").files;
    var address = document.querySelector("#address").value;

    var first_name_msg = document.querySelector("#first_name_msg");
	var last_name_msg = document.querySelector("#last_name_msg");
	var gender_msg = document.querySelector('#gender_msg');
    var date_of_birth_msg = document.querySelector("#date_of_birth_msg");
    var user_image_msg = document.querySelector('#user_image_msg');
	var address_msg = document.querySelector("#address_msg");

	if(first_name == ""){
		flag = false;
		first_name_msg.innerHTML = "Field Required";
	}else{
		first_name_msg.innerHTML = "";
		if(alpha_pattern.test(first_name) === false) {
			flag = false;
			first_name_msg.innerHTML = "First Name should look like eg: Saad";
		}
	}

	if(last_name == ""){
        flag = false;
        last_name_msg.innerHTML = "Field Required";
	}else{
        last_name_msg.innerHTML = "";
        if(alpha_pattern.test(last_name) === false){
			flag = false;
			last_name_msg.innerHTML = "Last Name should look like eg: Ali";
		}
	}

	if(!gender){
		flag = false;
		gender_msg.innerHTML = "Field Required";
	}else{
		gender_msg.innerHTML = "";
	}

    if(date_of_birth == ""){
        flag = false;
        date_of_birth_msg.innerHTML = "Field Required";
    }else{
        date_of_birth_msg.innerHTML = "";
    }

	if(user_image.length == 0 ) {
        flag = false;
		user_image_msg.innerHTML = "Field Required";
	}else{
        user_image_msg.innerHTML = "";
	}
    
    if(address == ""){
        flag = false;
        address_msg.innerHTML = "Field Required";
    }else{
        address_msg.innerHTML = "";
    }




    if(flag){
        return true;
    }else{
        return false;
    }


}
// Update Profile Validation


