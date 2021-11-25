let password = document.getElementById('password_input');
let passwordHelp = document.getElementById('password_help')

let secondPassword = document.getElementById('password_verify_input');
let secondPasswordHelp = document.getElementById('password_verify_help');

let submitButton = document.getElementById('registrationButton');

let strongPassowordRegEx = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,}$)");

//najprv sa zistit ci heslo vyhovuje podmienke silneho hesla
password.oninput = function () {
    if (strongPassowordRegEx.test(password.value)){
        passwordHelp.style.color = '#5cb85c';
        passwordHelp.innerText = "Heslo je dostatočne silné! :)";
        submitButton.disabled = false;
    }else{
        passwordHelp.style.color = '#df4759';
        passwordHelp.innerText = "Heslo musí obsahovať aspoň 6 znakov, jedno malé písmeno, jedno veľké písmeno a jednu číslicu!";
    }
}

//heslo na potvrdenie sa musi rovnat zadanemu
secondPassword.oninput = function () {
    if (password.value == secondPassword.value){
        secondPasswordHelp.style.color = '#5cb85c';
        secondPasswordHelp.innerText = "Overenie hesla je správne!";
        submitButton.disabled = false;
    }else{
        secondPasswordHelp.style.color = '#df4759';
        secondPasswordHelp.innerText = "Zadané heslá sa nezhodujú!";
        submitButton.disabled = true;
    }
}
