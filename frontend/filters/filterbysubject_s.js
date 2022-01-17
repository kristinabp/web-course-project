

const onFormSubmitted = event => {
    event.preventDefault();

    const formElement = event.target;
    subject = document.getElementById('subject').value;

    fetch("../../backend/api/filter_by_subject.php",
    {
        method: 'POST',
        body: JSON.stringify(subject),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Грешка при зареждане на поканите');
        }
        return response.json();
    })
    .then(response => {
        console.log(response);
        invitations = response.value;
        placeInvitations(invitations);
    });
}

function placeInvitations(invitations)
{
    counter=1;
    invitations.forEach((invitation) =>{
        const element = document.getElementById('tb');
        tablerow = document.createElement("tr");
        element.appendChild(tablerow);
        tabledata1 = document.createElement("th");
        tabledata1.innerText=counter;
        tabledata2 = document.createElement("th");
        tabledata2.innerText=invitation.title;
        tabledata3 = document.createElement("th");
        tabledata3.innerText=invitation.date;
        tabledata4 = document.createElement("th");
        tabledata4.innerText=invitation.time;
        tabledata5 = document.createElement("th");
        tabledata5.innerText=invitation.subject;
        tabledata6 = document.createElement("th");
        tabledata6.innerText=invitation.place;
        
        tablerow.appendChild(tabledata1);
        tablerow.appendChild(tabledata2);
        tablerow.appendChild(tabledata3);        
        tablerow.appendChild(tabledata4);
        tablerow.appendChild(tabledata5);
        tablerow.appendChild(tabledata6);

        counter++;
    });
}

document.getElementById("user-form").addEventListener("submit", onFormSubmitted);