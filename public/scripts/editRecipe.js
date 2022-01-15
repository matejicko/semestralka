function AJAX(via, button, notificationSegment){
    let successColor = '#5cb85c';
    let failColor = '#df4759';

    let strong = document.createElement('strong');
    let alertDiv = document.createElement('div');
    alertDiv.role = "alert";

    fetch(via)
        .then(response => response.json())
        .then(data => {
            if (data === 'false') {
                alertDiv.className = "alert alert-danger d-flex align-items-center fading-item";

                strong.innerText = "Zmenu sa nepodarilo nahrať!";
                alertDiv.appendChild(strong);

                button.parentNode.insertBefore(alertDiv, button);

                window.setTimeout(function (){
                    alertDiv.remove();
                }, 2500);

            } else {
                alertDiv.className = "alert alert-success d-flex align-items-center fading-item";

                strong.innerText = "Zmenu sa podarilo úspešne nahrať :)";
                alertDiv.appendChild(strong);

                button.parentNode.insertBefore(alertDiv, button);

                window.setTimeout(function (){
                    alertDiv.remove();
                }, 2500);
            }
        });
}

function insertAfter(newNode, referenceNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

window.onload = function () {
    let id = document.getElementById('id_input').value;

    let titleButton = document.getElementById('title_button');
    let durationButton = document.getElementById('duration_button');
    let countryButton = document.getElementById('country_button');
    let portionButton = document.getElementById('portion_button');
    let processButton = document.getElementById('process_button');
    let aboutButton = document.getElementById('about_button');

    titleButton.onclick = function () {
        let title = document.getElementById('title_input').value;
        if (title !== "") {
            let via = "?c=recipes&a=changeTitle&id=" + id +
                "&title=" + title;

            AJAX(via, titleButton); //document.getElementById('title_help'));
        }
    }

    countryButton.onclick = function () {
        let country = document.getElementById('country_input').value;

        if (country !== ""){
            let via = "?c=recipes&a=changeCountry&id=" + id +
                "&country=" + country;

            AJAX(via, countryButton);
        }

    }

    durationButton.onclick = function () {
        let durationValue = document.getElementById('duration_value_input').value;
        let durationUnit = document.getElementById('duration_unit_input').value;

        if (parseFloat(durationValue) >= 0 && durationUnit !== ""){
            let via = "?c=recipes&a=changeDuration&id=" + id +
                "&value=" + durationValue + "&unit=" + durationUnit;

            AJAX(via, durationButton);
        }
    }

    portionButton.onclick = function () {
        let portion = document.getElementById('portion_input').value;

        if (parseFloat(portion) >= 0){
            let via = "?c=recipes&a=changePortions&id=" + id + "&portions=" + portion;

            AJAX(via, portionButton);
        }
    }

    processButton.onclick = function () {
        let process = document.getElementById('process_input').value;

        if (process !== ""){
            let via = "?c=recipes&a=changeProcess&id=" + id + "&process=" + process;

            AJAX(via, processButton);
        }
    }

    aboutButton.onclick = function () {
        let about = document.getElementById('about_input').value;

        if (about !== ""){
            let via = "?c=recipes&a=changeAbout&id=" + id + "&about=" + about;

            AJAX(via, aboutButton);
        }
    }

}

