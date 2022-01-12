const onFormSubmitшed = event => {
    event.preventDefault();

    const formElement = event.target;
	
    const formData = {
		date: formElement.querySelector("input[name='date']").value
    };
	
	const fields = [
		formData.date, 
	];
	
    fetch('../../backend/api/filter_by_date.php', {
		method: 'POST',
		body: JSON.stringify(formData),
	})
    .then(data => {
        invitations = data.value;
        placeInvitations(invitations);
    });
}

function placeInvitations(invitations)
{
    invitations.forEach((invitation) =>{
        const element = document.getElementById('table-inv');
        counter = 1;
        element.innerHTML = "<tr><th>"+counter+"</th><th>"+invitation.title+"</th><th>"+invitation.date+
        "</th><th>"+invitation.time+"</th><th>"+invitation.subject+"</th><th>"+invitation.place+"</th></tr>";
        counter++;
    })
    
}

document.getElementById("user-form").addEventListener("click", onFormSubmitшed);