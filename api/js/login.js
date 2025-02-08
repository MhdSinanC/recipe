
function login_submitForm() {
    // Get form data
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Create JSON object
    var data = {
        "username": username,
        "password": password
    };

    // Send data to the API using fetch
    fetch('http://yourdomain/api/login/verify', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        // Display result message
        document.getElementById("result").innerHTML = result.message || result.error;
    })
    .catch(error => console.error('Error:', error));
}
