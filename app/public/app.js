var selectedUser = 0;

function sendRegistration() {
    var form = document.getElementById('registrationForm');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'api/user', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if(xhr.responseText){
                window.location.replace("/");
            }
        }
    };
    xhr.send(formData);
}

function sendLogin() {
    var form = document.getElementById('loginForm');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'api/login', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            response = JSON.parse(xhr.responseText);
            if(response['access_token']){
                window.localStorage.setItem("token", response['access_token']);
                window.location.replace("/messenger");
            }
        }
    };
    xhr.send(formData);
}

function sendMessage() {
    
    if(selectUser == 0){
        alert("Please select a recipient");
        return;
    }
    
    var form = document.getElementById('messageForm');
    var formData = new FormData(form);
    var token = window.localStorage.getItem("token");
    document.getElementById('message').value = '';
    formData.append('receiver_id', selectedUser);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'api/message', true);
    xhr.setRequestHeader('Authorization', 'Bearer ' + token);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            response = JSON.parse(xhr.responseText);
            console.log(response);
        }
    };
    xhr.send(formData);
    loadMessages();
}

function selectUser(id) {
    selectedUser = id;
    console.log(selectedUser);
    loadMessages();
}

function loadMessages() {
    console.log("Loading messages");
    var token = window.localStorage.getItem("token");
    var xhr = new XMLHttpRequest();
    var user = "";
    if(selectedUser > 0){
        user = "/" + selectedUser;
    }
    xhr.open('GET', 'api/message'+user, true);
    xhr.setRequestHeader('Authorization', 'Bearer ' + token);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            response = JSON.parse(xhr.responseText);
            showMessages(response);
        }
    };
    xhr.send();
}

function showMessages(messages) {
    var messageDiv = document.getElementById('messageList');
    messageDiv.innerHTML = '';
    for (var i = 0; i < messages.length; i++) {
        var message = messages[i];
        var messageElement = document.createElement('li');
        messageElement.innerHTML =  "<strong>" + message['sender'].username+ " :</strong>" + message['message'];
        messageDiv.appendChild(messageElement);
    }
}