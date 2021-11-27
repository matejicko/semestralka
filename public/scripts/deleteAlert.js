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

function deleteAlertSwal(titleString, textString, id) {
    let deleteButton = document.getElementById('delete_button_' + id);

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

