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
        if(data.role==8)
        {
            placeInvitationsT(invitations);
        }
        if(data.role==7)
        {
            placeInvitations(invitations);
        }
    })
    .catch(error => {
        console.error('Грешка при зареждане на поканите.');
    });
}

function placeInvitations(invitations)
{
    counter = 1;
    invitations.forEach((invitation) =>{
            element = document.getElementById('tb');
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


function placeInvitationsT(invitations)
{
    counter = 1;
    invitations.forEach((invitation) =>{
            element = document.getElementById('tb');
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
            tabledata7 = document.createElement('th');
            btn = document.createElement("button");
            btn.innerText="Изтегли";
            tabledata7.appendChild(btn);
            tablerow.appendChild(tabledata1);
            tablerow.appendChild(tabledata2);
            tablerow.appendChild(tabledata3);        
            tablerow.appendChild(tabledata4);
            tablerow.appendChild(tabledata5);
            tablerow.appendChild(tabledata6);
            tablerow.appendChild(tabledata7);

            counter++;
        });  
    
}

getInvitations();
