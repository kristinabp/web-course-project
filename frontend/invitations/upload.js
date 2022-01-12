function getInvitations() {
    fetch("../../backend/api/show_all_invitations.php")
    .then(response => {
        if (!response.ok) {
            throw new Error('Грешка при зареждане на поканите');
        }
        return response.json();
    })
    .then(data => {
        invitations = data.value;
        placeInvitations(invitations);
    })
    .catch(error => {
        console.error('Грешка при зареждане на поканите.');
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
getInvitations();