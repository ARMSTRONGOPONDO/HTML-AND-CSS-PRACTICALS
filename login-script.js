
document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('login-form');

    loginForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        if (username === 'Armstrong' && password === 'password') {

            window.location.href = 'shcoolflix.html';
            alert("welcome to our website"+" "+ username)
        } else {
            alert('Invalid username or password please try again or create an account');
        }
    });
}
);







