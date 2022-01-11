function appendLine(){
    let ingredientsGrid = document.getElementById('ingredients_grid');

    let row = document.createElement('div');
    row.className = "row";

    //----------------------Quantity--------------------------

    let col1 = document.createElement('div')
    col1.className = "col-auto";


    let valueInput = document.createElement('input');
    valueInput.className = "form-control";
    valueInput.type = "number";
    valueInput.step = "0.1";

    col1.appendChild(valueInput);

    //----------------------Unit--------------------------

    let col2 = document.createElement('div')
    col2.className = "col-auto";

    let unitSelect = document.createElement('select');
    unitSelect.className = "form-select";
    unitSelect.list = document.getElementById('units_list');

    col2.appendChild(unitSelect);

    //----------------------Ingredient--------------------------

    let col3 = document.createElement('div')
    col3.className = "col-auto";

    let ingredientInput = document.createElement('input');
    let ingredientsList = document.getElementById('ingredients_list');
    ingredientInput.className = "form-select";
    ingredientInput.list = ingredientsList;

    col3.appendChild(ingredientInput);

    //-------------------------------------------------------

    row.appendChild(col1);
    row.appendChild(col2);
    row.appendChild(col3);

    ingredientsGrid.appendChild(row);
};
