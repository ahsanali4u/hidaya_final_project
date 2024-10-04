// User Register Form Validation
function user_register_validation(){
    var flag = true;

    var alpha_pattern = /^[A-Z]{1}[a-z]{2,}$/;
    var email_pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.(com|net|[a-zA-Z]{2,})$/;

    var first_name = document.querySelector("#first_name").value;
    var last_name = document.querySelector("#last_name").value;
    var email = document.querySelector("#email").value;
    var password = document.querySelector("#password").value;
    var gender = document.querySelector("input[type='radio']:checked");
    var date_of_birth = document.querySelector("#date_of_birth").value;
    var user_image = document.getElementById("user_image").files;
    var address = document.querySelector("#address").value;

  
    var first_name_msg = document.querySelector("#first_name_msg");
	var last_name_msg = document.querySelector("#last_name_msg");
	var email_msg = document.querySelector("#email_msg");
    var password_msg = document.querySelector("#password_msg");
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

	if(email == ""){
		flag = false;
		email_msg.innerHTML = "Field Required";
	}else{
		email_msg.innerHTML = "";
		if (email_pattern.test(email) === false){
			flag = false;
			email_msg.innerHTML = "Email should look like eg: ali123@gmail.com";
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
// User Register Form Validation

//feedback form validation
function feedback_validation(){
	var flag = true;

    var full_name_pattern = /^[A-Z][a-z]+ [A-Z][a-z]+( [A-Z][a-z]+)?$/;
    var email_pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.(com|net|[a-zA-Z]{2,})$/;


    var name = document.querySelector("#name").value;
    var email = document.querySelector("#email").value;
    var feedback = document.querySelector("#feedback").value;


    var name_msg = document.querySelector("#name_msg");
    var email_msg = document.querySelector("#email_msg");
    var feedback_msg = document.querySelector("#feedback_msg");


    if(name == ""){
    	flag = false;
    	name_msg.innerHTML = "Field Required";
    }else{
    	name_msg.innerHTML = "";
    	if(full_name_pattern.test(name) === false){
    		flag = false;
    		name_msg.innerHTML = "Name should look like eg: Saad Ali";
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

	if(feedback == ""){
		flag = false;
		feedback_msg.innerHTML = "Field Required";
	}else{
		feedback_msg.innerHTML = "";
	}



    if(flag){
        return true;
    }else{
        return false;
    }
}
//feedback form validation


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