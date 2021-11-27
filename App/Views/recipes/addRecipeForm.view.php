<?php /** @var Array $data */ ?>

<script src="public/scripts/addRecipeForm.js"></script>

<!--Formular vlozenia receptu-->
<form name="recipeUploadForm" method="post">

    <!--Nazov a obrazok-->
    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8 block">

            <h4>Názov a fotka jedla</h4>

            <div class="mb-2">
                <label for="title_input" class="form-label" >Názov receptu:</label>
                <input type="text" class="form-control" id="title_input" required>
            </div>

            <div class="mb-2">
                <label for="image_input" class="form-label">Náhľad receptu:</label>
                <input type="file" class="form-control" id="image_input">
            </div>

        </div>

        <div class="col-sm-2"></div>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8 block">

            <h4>Atribúty receptu</h4>
            <div class="mb-2">
                <label for="country_input" class="form-label">Krajina:</label>
                <select class="form-select" name="country_input" aria-label="Default select example">
                    <option selected>Vyber krajinu</option>

                    <?php if (isset($data['countriesList'])){
                        $countriesList = $data['countriesList'];
                        for ($i = 1; $i < count($countriesList); $i++){ ?>

                            <option value="<?=$i?>"> <?=$countriesList[$i]?> </option>

                        <?php }
                    }?>
                </select>
            </div>

            <div class="mb-2">
                <label for="duration_input" class="form-label">Dĺžka trvania:</label>
                <input type="number" step="0.1" class="form-control" id="duration_value_input" >
                <select class="form-select" name="duration_unit_input" aria-label="Default select example">
                    <option selected>Vyber jednotku:</option>
                    <option value="1">hodina</option>
                    <option value="2">hodín</option>
                    <option value="3">minút</option>
                    <option value="4">deň</option>
                    <option value="5">dní</option>
                </select>
            </div>

            <div class="mb-2">
                <label for="portion_input" class="form-label">Počet porcii:</label>
                <input type="number" class="form-control" id="portion_input">
            </div>

        </div>
        <div class="col-sm-2"></div>

    </div>

    <div class="row">
        <div class="col-sm-2"></div>

        <div id="ingredients_grid" class="col-sm-8 block">

            <h4>Ingrediencie</h4>

            <div class="row">
                <div class="col-auto">
                    <label for="ingredient_value_input" class="form-label">Množstvo:</label>
                    <input type="number" step="0.1" class="form-control" id="ingredient_value_input">
                </div>
                <div class="col-auto">
                    <label for="ingredient_unit_input" class="form-label">Jednotka:</label>
                    <select class="form-select" name="ingredient_unit_input" list="units_list">

                        <datalist id="units_list">
                            <option selected>Vyber jednotku</option>

                        <?php if (isset($data['unitsList'])){
                            $unitsList = $data['unitsList'];
                            for ($i = 1; $i < count($unitsList); $i++){ ?>

                                <option value="<?=$i?>"> <?=$unitsList[$i]?> </option>

                            <?php }
                        }?>

                        </datalist>

                    </select>

                </div>
                <div class="col-auto">
                    <label for="ingredient_input" class="form-label">Surovina:</label>

                    <input name="ingredient_input" type="text" class="form-control" list="ingredients_list" />
                        <datalist id="ingredients_list">
                            <?php if (isset($data['ingredientsList'])){
                                $ingredientsList = $data['ingredientsList'];
                                for ($i = 1; $i < count($ingredientsList); $i++){ ?>

                                    <option> <?=$ingredientsList[$i]?> </option>

                                <?php }
                            }?>
                        </datalist>
                </div>

                <div class="col-auto">
                    <button type="button" class="btn" onclick="appendLine()" style="float:bottom">+</button>
                </div>

            </div>
        </div>

        <div class="col-sm-2"></div>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>


        <div class="col-sm-8 block">

            <h4>Proces</h4>
            <div class="mb-2">
                <textarea type="text" class="form-control" name="process_input" required></textarea>
            </div>
        </div>

        <div class="col-sm-2"></div>

    </div>

    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8 block">
            <h4>O recepte</h4>
            <div class="mb-2">
                <textarea type="text" class="form-control" name="about_input"></textarea>
            </div>
        </div>

        <div class="col-sm-2"></div>

    </div>

    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8 block">
            <h4>Potvrdenie</h4>
            <button type="submit" class="btn btn-primary">Uverejniť</button>
            Kliknutím na tlačídlo sa recept odošle a pridá na stránku.
        </div>

        <div class="col-sm-2"></div>
    </div>
</form>