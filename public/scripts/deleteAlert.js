function deleteAlertSwal(titleString, textString) {
    let deleteButton = document.getElementById('delete_button');

    swal({
        title: titleString,
        text: textString,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((confirmation) => {
            if (confirmation) {
                deleteButton.click();
            }
        });
}

function deleteRecipe(titleString, textString, id) {
    swal({
        title: titleString,
        text: textString,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((confirmation) => {

        if (confirmation) {
            let via = '?c=recipes&a=deleteRecipe&which=' + id;

            fetch(via)
                .then(response => response.json())
                .then(data => {
                    if (data === 'false') {
                        swal({
                            title: "Chyba",
                            text: "Nepodarilo sa vymazať recept",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        });
                    } else {
                        swal({
                            title: "Recept bol úspešne vymazaný",
                            icon: "success",
                            button: "OK"
                        });

                        document.getElementById('recipe_block_' + id).remove();
                    }
                });
        }
    });
}

