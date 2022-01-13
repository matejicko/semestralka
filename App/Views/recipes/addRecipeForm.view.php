<?php /** @var Array $data */ ?>



<!--Form for adding recipe-->
<form name="recipeUploadForm" method="post">

    <!--Title and photo-->
    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8 block">

            <h4>Názov a fotka jedla</h4>

            <div class="mb-2">
                <label for="title_input" class="form-label" >Názov receptu:</label>
                <input name='title' type="text" class="form-control" id="title_input" required>
            </div>

            <div class="mb-2">
                <label for="image_input" class="form-label">Náhľad receptu:</label>
                <input name='photo' type="file" class="form-control" id="image_input">
            </div>

        </div>

        <div class="col-sm-2"></div>
    </div>

    <!--Recipe attributes: Country, Duration and Portions-->
    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8 block">

            <h4>Atribúty receptu</h4>
            <div class="mb-2">
                <label for="country_input" class="form-label">Krajina:</label>
                <select name='country' class="form-select" name="country_input" aria-label="Default select example">
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
                <input name='duration_value' type="number" step="0.1" class="form-control" id="duration_value_input" >
                <select name='duration_unit' class="form-select" name="duration_unit_input" aria-label="Default select example">
                    <option selected>Vyber jednotku:</option>
                    <option value="hodina"></option>
                    <option value="hodín"></option>
                    <option value="minúta"></option>
                    <option value="minút"></option>
                    <option value="deň"></option>
                    <option value="dní"></option>
                </select>
            </div>

            <div class="mb-2">
                <label for="portion_input" class="form-label">Počet porcii:</label>
                <input name='portion' type="number" class="form-control" id="portion_input">
            </div>

        </div>
        <div class="col-sm-2"></div>

    </div>

    <!--Ingredients-->
    <div class="row">
        <div class="col-sm-2"></div>

        <div id="ingredients_grid" class="col-sm-8 block">

            <h4>Ingrediencie</h4>

            <div class="row">
                <div class="col-auto">
                    <label for="ingredient_value_input" class="form-label">Množstvo:</label>
                    <input name='ingredient_value' type="number" step="0.1" class="form-control" id="ingredient_value_input">
                </div>
                <div class="col-auto">
                    <label for="ingredient_unit_input_1" class="form-label">Jednotka:</label>
                    <select id="ingredient_unit_input_1" name="ingredient_unit" class="form-select">

                        <option selected>Vyber jednotku</option>

                        <?php if (isset($data['unitsList'])){
                            $unitsList = $data['unitsList'];
                            for ($i = 1; $i < count($unitsList); $i++){ ?>

                                <option value="<?=$unitsList[$i]?>"><?=$unitsList[$i]?></option>

                            <?php }
                        }?>

                    </select>

                </div>
                <div class="col-auto">
                    <label for="ingredient_input" class="form-label">Surovina:</label>

                    <input id='ingredient_input_1' name="ingredient_input" type="text" class="form-control">
                        <datalist id="ingredients_list">
                            <?php if (isset($data['ingredientsList'])){
                                $ingredientsList = $data['ingredientsList'];
                                for ($i = 1; $i < count($ingredientsList); $i++){ ?>

                                    <option value="<?=$ingredientsList[$i]?>"><?=$ingredientsList[$i]?></option>

                                <?php }
                            }?>
                        </datalist>
                    </input>
                </div>

                <div class="col-auto">
                    <button id='add_line_button' type="button" class="btn" style="float:bottom">+</button>
                </div>

            </div>
        </div>

        <div class="col-sm-2"></div>
    </div>

    <!--Process input-->
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

    <!--About recipe input-->
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

    <!--Submission-->
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

<script src="public/scripts/addRecipeForm.js"></script>