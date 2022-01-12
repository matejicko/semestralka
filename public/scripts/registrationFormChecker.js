class RegistrationFormChecker{


    constructor(){
        //--------------------------------USERNAME--------------------------------
        this.username = document.getElementById('nickname_input');
        this.usernameHelp = document.getElementById('nickname_help');
        this.usernameCorrect = false;

        this.usernameRegex = new RegExp("^(?=[a-zA-Z0-9._]{3,20}$)(?!.*[_.]{2})[^_.].*[^_.]$");

        //--------------------------------MAIL--------------------------------
        this.email = document.getElementById('email_input');
        this.emailHelp = document.getElementById('email_help');

        this.emailRegex = new RegExp("^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\\.[a-zA-Z0-9-]+)*$");

        //--------------------------------NAME--------------------------------
        this.name = document.getElementById('name_input');
        this.nameHelp = document.getElementById('name_help');
        this.nameCorrect = false;

        this.nameLengthRegex = new RegExp("^.{3,64}");
        this.nameRegex = new RegExp("^([A-ZÀ-ÿ][-a-z.]{2,31})$");

        //--------------------------------SURNAME--------------------------------
        this.surname = document.getElementById('surname_input');
        this.surnameHelp = document.getElementById('surname_help');
        this.surnameCorrect = false;

        //--------------------------------PASWORD--------------------------------
        this.password = document.getElementById('password_input');
        this.passwordHelp = document.getElementById('password_help')
        this.passwordCorrect = false;

        this.secondPassword = document.getElementById('password_verify_input');
        this.secondPasswordHelp = document.getElementById('password_verify_help');
        this.secondPasswordCorrect = false;

        this.strongPassowordRegEx = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,}$)");

        //--------------------------------HELP VARIABLES--------------------------------
        this.submitButton = document.getElementById('registrationButton');

        this.successColor = '#5cb85c';
        this.failColor = '#df4759';

        this.correctFields = 0;
    }

    //test if input value matches regex expression and notify user via text under input field
    testInputField(inputField, inputHelp, correctionFlag, regex, successMessage, failMessage){
        if (regex.test(inputField.value)){
            inputHelp.style.color = this.successColor;
            inputHelp.innerText = successMessage;
            this.submitButton.disabled = false;
            return true;
            //correctionFlag = true;
        }else{
            inputHelp.style.color = this.failColor;
            inputHelp.innerText = failMessage;
            correctionFlag = false;
            return false;
            //submitButton.disabled = true;
        }
    }

}

window.onload = function () {
    const registrationForm = new RegistrationFormChecker();
    const successColor = '#5cb85c';
    const failColor = '#df4759';

    registrationForm.username.oninput = function () {
        let successMessage = "Používateľské meno spĺňa všetky podmienky! :)";
        let failMessage = "Použivateľské meno musí byť dlhé 3 až 20 znakov, musí obsahovať len písmena, číslice, '.' a '_'. " +
            "Bodkou a podtržníkom nesmie začínať ani končiť a taktiež sa tieto znaky nesmú ísť priamo za sebou";

        if (registrationForm.testInputField(registrationForm.username, registrationForm.usernameHelp,
            registrationForm.usernameCorrect, registrationForm.usernameRegex, successMessage, failMessage)){

            let via = "?c=auth&a=isUniqueUsername&username=" + registrationForm.username.value;

            fetch(via)
                .then(response => response.json())
                .then(data => {
                    if (data === 'false'){
                        registrationForm.usernameHelp.innerText = "Toto používateľské meno je už obsadené :(";
                        registrationForm.usernameHelp.style.color = failColor;
                    }else{
                        //return true;
                    }
                });
        };
    }

    registrationForm.email.oninput = function (){
        if (registrationForm.emailRegex.test(registrationForm.email.value)){
            let via = "?c=auth&a=isUniqueMail&mail=" + registrationForm.email.value;

            fetch(via)
                .then(response => response.json())
                .then(data => {
                    if (data === 'false'){
                        registrationForm.emailHelp.innerText = "Tento e-mail je už obsadený :(";
                        registrationForm.emailHelp.style.color = failColor;
                    }else{
                        registrationForm.emailHelp.innerText = "Tento e-mail môže byť použitý :)";
                        registrationForm.emailHelp.style.color = successColor;
                    }
                });
        }
    }

    registrationForm.name.oninput = function () {
        let successMessage = "Meno spĺňa všetky podmienky! :)";
        let failMessage = "Meno musí byť aspoň 3 znaky a najviac 32 znakov dlhé, musí začínať veľkým písmenom a nesmie obsahovať špeciálne znaky.";

        //testInputField(name, nameHelp, nameCorrect, nameLengthRegex, successMessage, failMessage);
        registrationForm.testInputField(registrationForm.name,
            registrationForm.nameHelp, registrationForm.nameCorrect,
            registrationForm.nameRegex, successMessage, failMessage);
    }

    registrationForm.surname.oninput = function () {
        let successMessage = "Priezvisko spĺňa všetky podmienky! :)";
        let failMessage = "Priezvisko musí byť aspoň 3 znaky a najviac 32 znakov dlhé, musí začínať veľkým písmenom a nesmie obsahovať špeciálne znaky.";

        //testInputField(surname, surnameHelp, surnameCorrect, nameLengthRegex, successMessage, failMessage);
        registrationForm.testInputField(registrationForm.surname, registrationForm.surnameHelp,
            registrationForm.surnameCorrect, registrationForm.nameRegex, successMessage, failMessage);
    }


    //[password] first step is to verify, if password is strong enough
    registrationForm.password.oninput = function () {
        let successMessage = "Heslo je dostatočne silné! :)";
        let failMessage = "Heslo musí obsahovať aspoň 6 znakov, jedno malé písmeno, jedno veľké písmeno a jednu číslicu!";

        registrationForm.testInputField(registrationForm.password, registrationForm.passwordHelp,
            registrationForm.passwordCorrect, registrationForm.strongPassowordRegEx, successMessage, failMessage);
    }

    //[password] second password has to match with original one
    registrationForm.secondPassword.oninput = function () {
        if (registrationForm.password.value === registrationForm.secondPassword.value){
            registrationForm.secondPasswordHelp.style.color = successColor;
            registrationForm.secondPasswordHelp.innerText = "Overenie hesla je správne!";
            registrationForm.secondPasswordCorrect = true;
            registrationForm.submitButton.disabled = false;
        }else{
            registrationForm.secondPasswordHelp.style.color = failColor;
            registrationForm.secondPasswordHelp.innerText = "Zadané heslá sa nezhodujú!";
            //submitButton.disabled = true;
            registrationForm.secondPasswordCorrect = false;
        }
    }

}

// //--------------------------------USERNAME--------------------------------
// let username = document.getElementById('nickname_input');
// let usernameHelp = document.getElementById('nickname_help');
// let usernameCorrect = false;
//
// let usernameRegex = new RegExp("^(?=[a-zA-Z0-9._]{3,20}$)(?!.*[_.]{2})[^_.].*[^_.]$");
//
// //--------------------------------MAIL--------------------------------
// let email = document.getElementById('email_input');
// let emailHelp = document.getElementById('email_help');
//
// let emailRegex = new RegExp("^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\\.[a-zA-Z0-9-]+)*$");
//
// //--------------------------------NAME--------------------------------
// let name = document.getElementById('name_input');
// let nameHelp = document.getElementById('name_help');
// let nameCorrect = false;
//
// let nameLengthRegex = new RegExp("^.{3,64}");
// let nameRegex = new RegExp("^([A-ZÀ-ÿ][-a-z.]{2,31})$");
//
// //--------------------------------SURNAME--------------------------------
// let surname = document.getElementById('surname_input');
// let surnameHelp = document.getElementById('surname_help');
// let surnameCorrect = false;
//
// //--------------------------------PASWORD--------------------------------
// let password = document.getElementById('password_input');
// let passwordHelp = document.getElementById('password_help')
// let passwordCorrect = false;
//
// let secondPassword = document.getElementById('password_verify_input');
// let secondPasswordHelp = document.getElementById('password_verify_help');
// let secondPasswordCorrect = false;
//
// let strongPassowordRegEx = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,}$)");
//
// //--------------------------------HELP VARIABLES--------------------------------
// let submitButton = document.getElementById('registrationButton');
//
// let successColor = '#5cb85c';
// let failColor = '#df4759';
//
// let correctFields = 0;

//--------------------------------FUNCTIONS--------------------------------

// //test if input value matches regex expression and notify user via text under input field
// function testInputField(inputField, inputHelp, correctionFlag, regex, successMessage, failMessage){
//     if (regex.test(inputField.value)){
//         inputHelp.style.color = successColor;
//         inputHelp.innerText = successMessage;
//         submitButton.disabled = false;
//         return true;
//         //correctionFlag = true;
//     }else{
//         inputHelp.style.color = failColor;
//         inputHelp.innerText = failMessage;
//         correctionFlag = false;
//         return false;
//         //submitButton.disabled = true;
//     }
// }

// /**Performs AJAX communication.
//  * Demands url on which is action performed.
//  * Returns boolean value of response.
//  */
// function boolAJAX(url){
//
//     fetch(url)
//         .then(response => response.json())
//         .then(data => {
//             if (data === 'false'){
//                 return false;
//             }else{
//                 return true;
//             }
//         });
// }

// username.oninput = function () {
//     let successMessage = "Používateľské meno spĺňa všetky podmienky! :)";
//     let failMessage = "Použivateľské meno musí byť dlhé 3 až 20 znakov, musí obsahovať len písmena, číslice, '.' a '_'. " +
//         "Bodkou a podtržníkom nesmie začínať ani končiť a taktiež sa tieto znaky nesmú ísť priamo za sebou";
//
//     if (testInputField(username, usernameHelp, usernameCorrect, usernameRegex, successMessage, failMessage)){
//
//         let via = "?c=auth&a=isUniqueUsername&username=" + username.value;
//
//         fetch(via)
//             .then(response => response.json())
//             .then(data => {
//                 if (data === 'false'){
//                     usernameHelp.innerText = "Toto používateľské meno je už obsadené :(";
//                     usernameHelp.style.color = failColor;
//                 }else{
//                     //return true;
//                 }
//             });
//
//         // if (!boolAJAX(via)){
//         //
//         // }else{
//         //     usernameHelp.innerText = successMessage;
//         //     usernameHelp.style.color = successColor;
//         // }
//
//     };
// }

// email.oninput = function (){
//     if (emailRegex.test(email.value)){
//         let via = "?c=auth&a=isUniqueMail&mail=" + email.value;
//
//         fetch(via)
//             .then(response => response.json())
//             .then(data => {
//                 if (data === 'false'){
//                     emailHelp.innerText = "Tento e-mail je už obsadený :(";
//                     emailHelp.style.color = failColor;
//                 }else{
//                     emailHelp.innerText = "Tento e-mail môže byť použitý :)";
//                     emailHelp.style.color = successColor;
//                 }
//             });
//     }
// }

// name.oninput = function () {
//     let successMessage = "Meno spĺňa všetky podmienky! :)";
//     let failMessage = "Meno musí byť aspoň 3 znaky a najviac 32 znakov dlhé, musí začínať veľkým písmenom a nesmie obsahovať špeciálne znaky.";
//
//     //testInputField(name, nameHelp, nameCorrect, nameLengthRegex, successMessage, failMessage);
//     testInputField(name, nameHelp, nameCorrect, nameRegex, successMessage, failMessage);
// }
//
// surname.oninput = function () {
//     let successMessage = "Priezvisko spĺňa všetky podmienky! :)";
//     let failMessage = "Priezvisko musí byť aspoň 3 znaky a najviac 32 znakov dlhé, musí začínať veľkým písmenom a nesmie obsahovať špeciálne znaky.";
//
//     //testInputField(surname, surnameHelp, surnameCorrect, nameLengthRegex, successMessage, failMessage);
//     testInputField(surname, surnameHelp, surnameCorrect, nameRegex, successMessage, failMessage);
// }
//
//
// //[password] first step is to verify, if password is strong enough
// password.oninput = function () {
//     let successMessage = "Heslo je dostatočne silné! :)";
//     let failMessage = "Heslo musí obsahovať aspoň 6 znakov, jedno malé písmeno, jedno veľké písmeno a jednu číslicu!";
//
//     testInputField(password, passwordHelp, passwordCorrect, strongPassowordRegEx, successMessage, failMessage);
// }
//
// //[password] second password has to match with original one
// secondPassword.oninput = function () {
//     if (password.value === secondPassword.value){
//         secondPasswordHelp.style.color = successColor;
//         secondPasswordHelp.innerText = "Overenie hesla je správne!";
//         secondPasswordCorrect = true;
//         submitButton.disabled = false;
//     }else{
//         secondPasswordHelp.style.color = failColor;
//         secondPasswordHelp.innerText = "Zadané heslá sa nezhodujú!";
//         //submitButton.disabled = true;
//         secondPasswordCorrect = false;
//     }
// }

// document.onchange = function() {
//     if (usernameCorrect && nameCorrect && surnameCorrect && passwordCorrect && secondPasswordCorrect){
//         submitButton.disabled = false;
//     }else{
//         submitButton.disabled = true;
//     }
// }



