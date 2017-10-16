window.onload = initPage;

function initPage() {
    document.getElementById("name").onmouseout = checkLogin;
    document.getElementById("pass").onmouseout = checkLogin;
    document.getElementById("login").disabled = true;
}

function checkLogin() {
    var name = document.getElementById("name").value;
    var pass = document.getElementById("pass").value;
    if ((name === '') || (pass === '')) {
        document.getElementById("login").disabled = true;
    } else {
        document.getElementById("login").disabled = false;
    }
}