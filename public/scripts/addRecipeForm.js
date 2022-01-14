
window.onload = function () {
    let i = 1;
    let button = document.getElementById('add_line_button');

    button.onclick = function () {
        i++;
        appendLine(i);
    }

}

function appendLine(i){
    let ingredientsGrid = document.getElementById('ingredients_grid');

    let row = document.createElement('div');
    row.className = "row";

    //----------------------Quantity--------------------------

    let col1 = document.createElement('div')
    col1.className = "col-auto";

    let valueInput = document.createElement('input');
    valueInput.name = 'ingredient_value_' + i;
    valueInput.className = "form-control";
    valueInput.type = "number";
    valueInput.value = "1";
    valueInput.step = "0.1";

    col1.appendChild(valueInput);

    //----------------------Unit--------------------------

    let col2 = document.createElement('div')
    col2.className = "col-auto";

    let unitSelect = document.createElement('select');
    unitSelect.name = 'ingredient_unit_' + i;
    unitSelect.className = "form-select";
    unitSelect.innerHTML = document.getElementById('ingredient_unit_input_1').innerHTML;

    col2.appendChild(unitSelect);

    //----------------------Ingredient--------------------------

    let col3 = document.createElement('div')
    col3.className = "col-auto";

    let ingredientInput = document.createElement('input');
    ingredientInput.name = 'ingredient_' + i;
    ingredientInput.className = "form-control";
    ingredientInput.setAttribute('list', 'ingredients_list');

    col3.appendChild(ingredientInput);

    //-------------------------------------------------------

    row.appendChild(col1);
    row.appendChild(col2);
    row.appendChild(col3);

    ingredientsGrid.appendChild(row);
};
