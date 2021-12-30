function validate(errors, fields) {
	
	for (const field of fields) {
		if(field == "") {
			document.getElementById('user-message').innerText = "Моля, попълнени всички задължителни полета.";
			return false;
		}
	}
	
	for (const err of errors) {
		if (err != "") {
			document.getElementById('user-message').innerText = "Mоля, въведете валидни данни.";
			return false;
		}
	}
	
	document.getElementById('user-message').innerText = "";
	return true;
}

const onFormSubmitted = event => {
    event.preventDefault();

    const formElement = event.target;
	
    roleId = -1;
    if(role = document.getElementById("role").value == "student")
    {
        roleId = 7;
    }
    else
    {
        roleId = 8;
    }
	
    const formData = {
		username: formElement.querySelector("input[name='username']").value,
		password: formElement.querySelector("input[name='password']").value,
		password2: formElement.querySelector("input[name='password2']").value,
        email: formElement.querySelector("input[name='email']").value,
        fn: formElement.querySelector("input[name='fn']").value,
		role: roleId,
    };
	
	const fields = [
		formData.username,
		formData.password,
		formData.password2, 
		formData.email,
		formData.fn,	
		formData.role,
	];
	
	const errors = [
		formElement.querySelector("p[id='username-error']").innerText,
		formElement.querySelector("p[id='password1-error']").innerText,
		formElement.querySelector("p[id='password2-error']").innerText, 
		formElement.querySelector("p[id='email-error']").innerText,
		formElement.querySelector("p[id='fn-error']").innerText,		
		];
	
	if (validate(errors, fields)) {		
		fetch('../../backend/api/registration.php', {
			method: 'POST',
			body: JSON.stringify(formData),
		})
		.then(response=>response.json())
		.then(response => {
			if (response.success) {
				var popup = document.getElementById("successful-registration");
				//var login = document.getElementsByClassName("login")[0];
				
				popup.style.display = "block";
				
				//login.onclick = function() {
				  //popup.style.display = "none";
				  //window.location.replace("../login/login.html");
				//}
			} else {
				document.getElementById('user-message').innerText = response.message;
			}
		});	
	}
};

document.getElementById('user-form').addEventListener('submit', onFormSubmitted);