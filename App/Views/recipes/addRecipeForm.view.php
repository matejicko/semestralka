<?php /** @var Array $data */ ?>

<!--Form for adding recipe-->
<form name="recipeUploadForm" method="post" action="?c=recipes&a=addRecipe" enctype="multipart/form-data">

    <!--Title and photo-->
    <div class="row">

        <div class="col-sm-2"></div>

        <div class="col-sm-8 block">

            <?php if(isset($_GET['error']) && $_GET['error'] != ''){?>
                <div class="alert alert-danger" role="alert">
                    <?=$_GET['error']?>
                </div>
            <?php }?>


            <h4>Názov a fotka jedla</h4>

            <div class="mb-2">
                <label for="title_input" class="form-label" >Názov receptu:</label>
                <input name='title' type="text" class="form-control" id="title_input" required>
            </div>

            <div class="mb-2">
                <label for="image_input" class="form-label">Náhľad receptu:</label>
                <input name='photo' type="file" class="form-control" id="image_input"
                       aria-describedby="photo_help" required>
                <div id="photo_help" class="form-text">Maximálna veľkosť súboru je 10MB!</div>
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
                <select name='country' class="form-select" name="country_input"
                        aria-label="Default select example" required>
                    <option value="" disabled>Vyber krajinu</option>

                    <?php if (isset($data['countriesList'])){
                        $countriesList = $data['countriesList'];
                        for ($i = 0; $i < count($countriesList); $i++){ ?>

                            <option value="<?=$countriesList[$i]?>"><?=$countriesList[$i]?></option>

                        <?php }
                    }?>
                </select>
            </div>

            <div class="mb-2">
                <label for="duration_input" class="form-label">Dĺžka trvania:</label>
                <input name='duration_value' type="number" step="0.1" class="form-control" id="duration_value_input" >
                <select name='duration_unit' class="form-select" name="duration_unit_input"
                        aria-label="Default select example" required>
                    <option value="" disabled>Vyber jednotku:</option>
                    <option value="hodina">hodina</option>
                    <option value="hodiny">hodiny</option>
                    <option value="hodín">hodín</option>
                    <option value="minúta">minúta</option>
                    <option value="minút">minút</option>
                    <option value="deň">deň</option>
                    <option value="dní">dní</option>
                </select>
            </div>

            <div class="mb-2">
                <label for="portion_input" class="form-label">Počet porcii:</label>
                <input id="portion_input" name='portion' type="number" class="form-control" value="4" required>
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
                    <input id="ingredient_value_input" name='ingredient_value_1' type="number" step="0.1" class="form-control"
                            value="1" required>
                </div>
                <div class="col-auto">
                    <label for="ingredient_unit_input_1" class="form-label">Jednotka:</label>
                    <select id="ingredient_unit_input_1" name="ingredient_unit_1" class="form-select" required>

                        <option value="" disabled>Vyber jednotku</option>

                        <?php if (isset($data['unitsList'])){
                            $unitsList = $data['unitsList'];
                            for ($i = 0; $i < count($unitsList); $i++){ ?>

                                <option value="<?=$unitsList[$i]?>"><?=$unitsList[$i]?></option>

                            <?php }
                        }?>

                    </select>

                </div>
                <div class="col-auto">
                    <label for="ingredient_input" class="form-label">Surovina:</label>

                    <input id='ingredient_input_1' name="ingredient_1" type="text" class="form-control"
                           list="ingredient_list" required>

                    <datalist id="ingredients_list">
                        <?php if (isset($data['ingredientsList'])){
                            $ingredientsList = $data['ingredientsList'];
                            for ($i = 1; $i < count($ingredientsList); $i++){ ?>

                                <option value="<?=$ingredientsList[$i]?>"><?=$ingredientsList[$i]?></option>

                            <?php }
                        }?>
                    </datalist>
                </div>

                <div class="col-auto">
                    <label for="add_line_button" class="form-label">Pridať ďalšiu</label><br>
                    <button id='add_line_button' name="add_line_button" type="button" class="btn" style="float:bottom">+</button>
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
                <textarea type="text" class="form-control" name="process" required></textarea>
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
                <textarea type="text" class="form-control" name="about"></textarea>
            </div>
        </div>

        <div class="col-sm-2"></div>

    </div>

    <!--Submission-->
    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8 block">
            <h4>Potvrdenie</h4>
            <button id="submit_button" type="submit" class="btn btn-primary">Uverejniť</button>
            Kliknutím na tlačídlo sa recept odošle a pridá na stránku.
        </div>

        <div class="col-sm-2"></div>
    </div>
</form>

<script src="public/scripts/addRecipeForm.js"></script>