class FormChecker {

    constructor() {
        //--------------------------------USERNAME--------------------------------
        this.username = document.getElementById('nickname_input');
        this.usernameHelp = document.getElementById('nickname_help');

        this.usernameRegex = new RegExp("^(?=[a-zA-Z0-9._]{3,20}$)(?!.*[_.]{2})[^_.].*[^_.]$");

        //--------------------------------MAIL--------------------------------
        this.email = document.getElementById('email_input');
        this.emailHelp = document.getElementById('email_help');

        this.emailRegex = new RegExp("^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\\.[a-zA-Z0-9-]+)*$");

        //--------------------------------NAME--------------------------------
        this.name = document.getElementById('name_input');
        this.nameHelp = document.getElementById('name_help');

        this.nameRegex = new RegExp("^([A-ZÀ-ÿ][-a-z.]{1,31})$");

        //--------------------------------SURNAME--------------------------------
        this.surname = document.getElementById('surname_input');
        this.surnameHelp = document.getElementById('surname_help');

        //--------------------------------PASSWORD--------------------------------
        this.password = document.getElementById('password_input');
        this.passwordHelp = document.getElementById('password_help')

        this.secondPassword = document.getElementById('password_verify_input');
        this.secondPasswordHelp = document.getElementById('password_verify_help');

        this.strongPassowordRegEx = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,}$)");

        //--------------------------------HELP VARIABLES--------------------------------
        this.submitButton = document.getElementById('registration_button');
        this.fakeButton = document.getElementById('fake_button');

        this.successColor = '#5cb85c';
        this.failColor = '#df4759';

        this.correctFields = 0;
    }

    //test if input value matches regex expression and notify user via text under input field
    testInputField(inputField, inputHelp, regex, successMessage, failMessage) {
        if (regex.test(inputField.value)) {
            inputHelp.style.color = this.successColor;
            inputHelp.innerText = successMessage;
            this.fakeButton.disabled = false;
            return true;
        } else {
            inputHelp.style.color = this.failColor;
            inputHelp.innerText = failMessage;
            return false;
        }
    }

}

window.onload = function () {
    const form = new FormChecker();
    const successColor = '#5cb85c';
    const failColor = '#df4759';


    form.username.oninput = function () {
        let successMessage = "Používateľské meno spĺňa všetky podmienky! :)";
        let failMessage = "Použivateľské meno musí byť dlhé 3 až 20 znakov, musí obsahovať len písmena, číslice, '.' a '_'. " +
            "Bodkou a podtržníkom nesmie začínať ani končiť a taktiež sa tieto znaky nesmú ísť priamo za sebou";

        if (form.testInputField(form.username, form.usernameHelp,
            form.usernameRegex, successMessage, failMessage)) {

            let via = "?c=auth&a=isUniqueUsername&username=" + form.username.value;

            fetch(via)
                .then(response => response.json())
                .then(data => {
                    if (data === 'false') {
                        form.usernameHelp.innerText = "Toto používateľské meno je už obsadené :(";
                        form.usernameHelp.style.color = failColor;
                    } else {
                        //return true;
                    }
                });
        }

    }

    form.email.oninput = function () {
        if (form.emailRegex.test(form.email.value)) {
            let via = "?c=auth&a=isUniqueMail&mail=" + form.email.value;

            fetch(via)
                .then(response => response.json())
                .then(data => {
                    if (data === 'false') {
                        form.emailHelp.innerText = "Tento e-mail je už obsadený :(";
                        form.emailHelp.style.color = failColor;
                    } else {
                        form.emailHelp.innerText = "Tento e-mail môže byť použitý :)";
                        form.emailHelp.style.color = successColor;
                    }
                });
        }
    }

    form.name.oninput = function () {
        let successMessage = "Meno spĺňa všetky podmienky! :)";
        let failMessage = "Meno musí byť aspoň 3 znaky a najviac 32 znakov dlhé, musí začínať veľkým písmenom a nesmie obsahovať špeciálne znaky.";

        //testInputField(name, nameHelp, nameCorrect, nameLengthRegex, successMessage, failMessage);
        form.testInputField(form.name,
            form.nameHelp, form.nameRegex, successMessage, failMessage);
    }

    form.surname.oninput = function () {
        let successMessage = "Priezvisko spĺňa všetky podmienky! :)";
        let failMessage = "Priezvisko musí byť aspoň 3 znaky a najviac 32 znakov dlhé, musí začínať veľkým písmenom a nesmie obsahovať špeciálne znaky.";

        //testInputField(surname, surnameHelp, surnameCorrect, nameLengthRegex, successMessage, failMessage);
        form.testInputField(form.surname, form.surnameHelp,
            form.nameRegex, successMessage, failMessage);
    }


    //[password] first step is to verify, if password is strong enough
    form.password.oninput = function () {
        let successMessage = "Heslo je dostatočne silné! :)";
        let failMessage = "Heslo musí obsahovať aspoň 6 znakov, jedno malé písmeno, jedno veľké písmeno a jednu číslicu!";

        form.testInputField(form.password, form.passwordHelp,
            form.strongPassowordRegEx, successMessage, failMessage);
    }

    //[password] second password has to match with original one
    form.secondPassword.oninput = function () {
        if (form.password.value === form.secondPassword.value) {
            form.secondPasswordHelp.style.color = successColor;
            form.secondPasswordHelp.innerText = "Overenie hesla je správne!";
            form.secondPasswordCorrect = true;
            form.fakeButton.disabled = false;
        } else {
            form.secondPasswordHelp.style.color = failColor;
            form.secondPasswordHelp.innerText = "Zadané heslá sa nezhodujú!";
            form.secondPasswordCorrect = false;
        }
    }

    form.fakeButton.onclick = function () {

        if ((form.password.value !== "" &&
            form.secondPassword.value !== "")){
            console.log("COJE");
        }

        if (form.usernameRegex.test(form.username.value) &&
            form.emailRegex.test(form.email.value) &&
            form.nameRegex.test(form.name.value) &&
            form.nameRegex.test(form.surname.value) &&

            //in case of editing account, new password could be empty
            ((form.password.value === "" &&
                form.secondPassword.value === "") ||
                //in case of registration, password fields has to be fulfilled and correct
            (form.strongPassowordRegEx.test(form.password.value) &&
            form.strongPassowordRegEx.test(form.secondPassword.value) &&
            form.password.value === form.secondPassword.value))){

            form.submitButton.click();
        } else {
            let alertDiv = document.createElement('div');
            alertDiv.className = "alert alert-danger d-flex align-items-center fading-item";
            alertDiv.role = "alert";

            alertDiv.innerText = "Uprav vstupy do správneho formátu!";

            form.fakeButton.parentNode.insertBefore(alertDiv, form.fakeButton.nextSibling);

            window.setTimeout(function () {
                alertDiv.remove();
            }, 2500);
        }

    }

}




