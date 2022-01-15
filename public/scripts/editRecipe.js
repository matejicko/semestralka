function AJAX(via, notificator){
    let successColor = '#5cb85c';
    let failColor = '#df4759';

    fetch(via)
        .then(response => response.json())
        .then(data => {
            if (data === 'false') {
                notificator.innerText = "Zmenu sa nepodarilo nahrať...";
                notificator.style.color = failColor;
            } else {
                notificator.innerText = "Zmenu sa podarilo úspešne nahrať :)";
                notificator.style.color = successColor;
            }
        });
}

window.onload = function () {
    let id = document.getElementById('id_input').value;

    let titleButton = document.getElementById('title_button');
    let durationButton = document.getElementById('duration_button');
    let countryButton = document.getElementById('country_button');
    let portionButton = document.getElementById('portion_button');

    titleButton.onclick = function () {
        let title = document.getElementById('title_input').value;
        if (title !== "") {
            let via = "?c=recipes&a=changeTitle&id=" + id +
                "&title=" + title;

            AJAX(via, document.getElementById('title_help'));
        }
    }

    countryButton.onclick = function () {
        let country = document.getElementById('country_input').value;

        if (country !== ""){
            let via = "?c=recipes&a=changeCountry&id=" + id +
                "&country=" + country;

            AJAX(via, document.getElementById('country_help'));
        }

    }

    durationButton.onclick = function () {
        let durationValue = document.getElementById('duration_value_input').value;
        let durationUnit = document.getElementById('duration_unit_input').value;

        if (parseFloat(durationValue) >= 0 && durationUnit !== ""){
            let via = "?c=recipes&a=changeDuration&id=" + id +
                "&value=" + durationValue + "&unit=" + durationUnit;

            AJAX(via, document.getElementById('duration_help'));
        }
    }

    portionButton.onclick = function () {
        let portion = document.getElementById('portion_input').value;

        if (parseFloat(portion) >= 0){
            let via = "?c=recipes&a=changePortions&id=" + id + "&portions=" + portion;

            AJAX(via, document.getElementById('portion_help'));
        }
    }

}

