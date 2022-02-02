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
	
	const formData = new FormData(document.getElementById('user-form'));
    /*const formData = {
		title: formElement.querySelector("input[name='title']").value,
		date: formElement.querySelector("input[name='date']").value,
        time: formElement.querySelector("input[name='time']").value,
        subject: formElement.querySelector("input[name='subject']").value,
		place: formElement.querySelector("input[name='place']").value,
		invitation: formElement.querySelector("input[name='invitation']").files[0],
		
    };*/
	
	const fields = [
		formData.title,
		formData.date, 
		formData.time,
		formData.subject,	
		formData.place,
		formData.invitation,
		
	];
	
	const errors = [
		formElement.querySelector("p[id='title-error']").innerText,
		formElement.querySelector("p[id='date-error']").innerText, 
		formElement.querySelector("p[id='time-error']").innerText,
		formElement.querySelector("p[id='subject-error']").innerText,
        formElement.querySelector("p[id='place-error']").innerText,		
		];
	
	if (validate(errors, fields)) {		
		fetch('../../backend/api/get_invitation.php', {
			method: 'POST',
			body: formData,
		})
		.then(response=>response.json())
		.then(response => {
			if (response.success) {
				if(response.role == '7')
            	{
                	location.replace("../invitations/uploadedinv_students.html");
            	}
            	if(response.role == '8')
            	{
                	location.replace("../invitations/uploadedinv_teacher.html");
            	}
			} 
			else {
				document.getElementById('user-message').innerText = response.message;
			}
		});	
	}
};

document.getElementById('user-form').addEventListener('submit', onFormSubmitted);
