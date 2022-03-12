function login(){
    var user = document.getElementById('user').value;
    var pass = document.getElementById('pass').value;

    if(user == "admin" && pass == "admin123"){
        window.location.href = "calculate.html";
    }else{
        alert("user = admin, pass = admin123")
    }
}
