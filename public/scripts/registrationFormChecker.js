//--------------------------------USERNAME--------------------------------
let username = document.getElementById('nickname_input');
let usernameHelp = document.getElementById('nickname_help');
let usernameCorrect = false;

let usernameRegex = new RegExp("^(?=[a-zA-Z0-9._]{3,20}$)(?!.*[_.]{2})[^_.].*[^_.]$");

//--------------------------------NAME--------------------------------
let name = document.getElementById('name_input');
let nameHelp = document.getElementById('name_help');
let nameCorrect = false;

let nameLengthRegex = new RegExp("^.{3,64}");
let nameRegex = new RegExp("^([A-ZÀ-ÿ][-a-z.]{2,31})$");

//--------------------------------SURNAME--------------------------------
let surname = document.getElementById('surname_input');
let surnameHelp = document.getElementById('surname_help');
let surnameCorrect = false;

//--------------------------------PASWORD--------------------------------
let password = document.getElementById('password_input');
let passwordHelp = document.getElementById('password_help')
let passwordCorrect = false;

let secondPassword = document.getElementById('password_verify_input');
let secondPasswordHelp = document.getElementById('password_verify_help');
let secondPasswordCorrect = false;

let strongPassowordRegEx = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,}$)");

//--------------------------------HELP VARIABLES--------------------------------
let submitButton = document.getElementById('registrationButton');

let successColor = '#5cb85c';
let failColor = '#df4759';

let correctFields = 0;

//--------------------------------FUNCTIONS--------------------------------

//test if input value matches regex expression and notify user via text under input field
function testInputField(inputField, inputHelp, correctionFlag, regex, successMessage, failMessage){
    if (regex.test(inputField.value)){
        inputHelp.style.color = successColor;
        inputHelp.innerText = successMessage;
        submitButton.disabled = false;
        correctionFlag = true;
    }else{
        inputHelp.style.color = failColor;
        inputHelp.innerText = failMessage;
        correctionFlag = false;
        //submitButton.disabled = true;
    }
}

username.oninput = function () {
    let successMessage = "Používateľské meno spĺňa všetky podmienky! :)";
    let failMessage = "Použivateľské meno musí byť dlhé 3 až 20 znakov, musí obsahovať len písmena, číslice, '.' a '_'. " +
        "Bodkou a podtržníkom nesmie začínať ani končiť a taktiež sa tieto znaky nesmú ísť priamo za sebou";

    testInputField(username, usernameHelp, usernameCorrect, usernameRegex, successMessage, failMessage);
}

name.oninput = function () {
    let successMessage = "Meno spĺňa všetky podmienky! :)";
    let failMessage = "Meno musí byť aspoň 3 znaky a najviac 32 znakov dlhé, musí začínať veľkým písmenom a nesmie obsahovať špeciálne znaky.";


    //testInputField(name, nameHelp, nameCorrect, nameLengthRegex, successMessage, failMessage);
    testInputField(name, nameHelp, nameCorrect, nameRegex, successMessage, failMessage);
}

surname.oninput = function () {
    let successMessage = "Priezvisko spĺňa všetky podmienky! :)";
    let failMessage = "Priezvisko musí byť aspoň 3 znaky a najviac 32 znakov dlhé, musí začínať veľkým písmenom a nesmie obsahovať špeciálne znaky.";

    //testInputField(surname, surnameHelp, surnameCorrect, nameLengthRegex, successMessage, failMessage);
    testInputField(surname, surnameHelp, surnameCorrect, nameRegex, successMessage, failMessage);
}


//[password] first step is to verify, if password is strong enough
password.oninput = function () {
    let successMessage = "Heslo je dostatočne silné! :)";
    let failMessage = "Heslo musí obsahovať aspoň 6 znakov, jedno malé písmeno, jedno veľké písmeno a jednu číslicu!";

    testInputField(password, passwordHelp, passwordCorrect, strongPassowordRegEx, successMessage, failMessage);
}

//[password] second password has to match with original one
secondPassword.oninput = function () {
    if (password.value === secondPassword.value){
        secondPasswordHelp.style.color = successColor;
        secondPasswordHelp.innerText = "Overenie hesla je správne!";
        secondPasswordCorrect = true;
        submitButton.disabled = false;
    }else{
        secondPasswordHelp.style.color = failColor;
        secondPasswordHelp.innerText = "Zadané heslá sa nezhodujú!";
        //submitButton.disabled = true;
        secondPasswordCorrect = false;
    }
}

// document.onchange = function() {
//     if (usernameCorrect && nameCorrect && surnameCorrect && passwordCorrect && secondPasswordCorrect){
//         submitButton.disabled = false;
//     }else{
//         submitButton.disabled = true;
//     }
// }



