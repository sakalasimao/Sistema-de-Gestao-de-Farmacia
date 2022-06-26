var myvar = setInterval(btn_disable, 100);
                                            
let email =  document.getElementById('email');
let pass =  document.getElementById('pass');
let btn_login =  document.getElementById('btn_login');

function showPass(){

    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
    
}

function btn_disable(){

if(email.value == ""){
    pass.disabled = true;
}else{
    pass.disabled = false;
}


if(pass.value == ""){
    btn_login.disabled = true;
}else{
    btn_login.disabled = false;
}
}