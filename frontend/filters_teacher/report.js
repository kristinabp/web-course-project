function getUserReport() {
  

    fetch("../../backend/api/report.php")
    .then(response => {
        if (!response.ok) {
            throw new Error('Грешка при зареждане на потребителите');
        }
        return response.json();
    })
    .then(response => {
        console.log(response);
        users = response.value;
        placeInvitations(users);
    });
}

function placeInvitations(users)
{
    counter = 1;
    users.forEach((user) =>{
            element = document.getElementById('tb');
            tablerow = document.createElement("tr");
            element.appendChild(tablerow);
            tabledata1 = document.createElement("th");
            tabledata1.innerText=counter;
            tabledata2 = document.createElement("th");
            tabledata2.innerText=user.fn;
            tabledata3 = document.createElement("th");
            tabledata3.innerText=user.username;
            console.log(user.username);
            console.log(user.upload);
            tabledata4 = document.createElement("th");
            tabledata4.innerText=user.upload;
    
            tablerow.appendChild(tabledata1);
            tablerow.appendChild(tabledata2);
            tablerow.appendChild(tabledata3);        
            tablerow.appendChild(tabledata4);
     
            counter++;
        });  
}

getUserReport();