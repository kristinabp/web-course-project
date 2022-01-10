

    const onFormSubmitted = event => {
        event.preventDefault();
    
        const formElement = event.target;
        
        const formData = {
             username: document.getElementById('username').value,
             password: document.getElementById('password').value,
        };
        
        fetch('../../backend/api/login.php', {
            method: 'POST',
            body: JSON.stringify(formData),
        })
        .then(response=>response.json())
        .then(response => {
            if (response.success) {
                location.replace("../login/afterlogin.html");
            } else {
                document.getElementById('user-message').innerText = response.message;
            }
        });
    
        return false;
    }
    



    const onFormSubmitted = event => {
        event.preventDefault();
    
        const formElement = event.target;
        
        const formData = {
             username: document.getElementById('username').value,
             password: document.getElementById('password').value,
        };
        
        fetch('../../backend/api/login.php', {
            method: 'POST',
            body: JSON.stringify(formData),
        })
        .then(response=>response.json())
        .then(response => {
            if (response.success) {
                location.replace("../login/afterlogin.html");
            } else {
                document.getElementById('user-message').innerText = response.message;
            }
        });
    
        return false;
    }

    document.getElementById('login-form').addEventListener('submit', onFormSubmitted);