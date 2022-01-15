<?php /** @var Array $data */ ?>

<!--Form for adding recipe-->
<!--<form name="recipeUploadForm" method="post" action="?c=recipes&a=addRecipe" enctype="multipart/form-data">-->
<!--</form>-->
<?php if (isset($data) && isset($data['recipe'])) { ?>
    <input id="id_input" style="visibility: hidden" value="<?= $data['recipe']->getId() ?>">

    <!--Title and photo-->
    <div class="row">

        <div class="col-sm-2"></div>

        <div class="col-sm-8 block">

            <?php if (isset($_GET['error']) && $_GET['error'] != '') { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_GET['error'] ?>
                </div>
            <?php } ?>


            <h4>Názov a fotka jedla</h4>

            <div class="mb-2">
                <label for="title_input" class="form-label">Názov receptu:</label>
                <input name='title' type="text" class="form-control" id="title_input"
                       value="<?= $data['recipe']->getTitle() ?>" aria-describedby="photo_help">
                <div id="title_help" class="form-text"></div>
                <button id="title_button" class="btn">Zmeniť</button>

            </div>

            <div class="mb-2">
                <label for="image_input" class="form-label">Nový náhľad receptu:</label>
                <input name='photo' type="file" class="form-control" id="image_input"
                       aria-describedby="photo_help">
                <div id="photo_help" class="form-text">Maximálna veľkosť súboru je 10MB!</div>
                <button id="photo_button" class="btn">Zmeniť</button>
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
                <select id="country_input" name='country' class="form-select"  aria-label="Default select example"
                        aria-describedby="duration_help">
                    <option value="" disabled>Vyber krajinu</option>

                    <?php if (isset($data['countriesList'])) {
                        $countriesList = $data['countriesList'];
                        for ($i = 0; $i < count($countriesList); $i++) { ?>

                            <option value="<?= $countriesList[$i] ?>"><?= $countriesList[$i] ?></option>

                        <?php }
                    } ?>
                </select>

                <div id="country_help" class="form-text"></div>
                <button id="country_button" class="btn">Zmeniť</button>
            </div>

            <div class="mb-2">
                <label for="duration_input" class="form-label">Dĺžka trvania:</label>
                <input id="duration_value_input" name='duration_value' type="number" step="0.1" class="form-control" >
                <select id="duration_unit_input" name='duration_unit' class="form-select" aria-describedby="duration_help"
                        aria-label="Default select example">
                    <option value="" disabled>Vyber jednotku:</option>
                    <option value="hodina">hodina</option>
                    <option value="hodín">hodín</option>
                    <option value="minúta">minúta</option>
                    <option value="minút">minút</option>
                    <option value="deň">deň</option>
                    <option value="dní">dní</option>
                </select>

                <div id="duration_help" class="form-text"></div>
                <button id="duration_button" class="btn">Zmeniť</button>
            </div>

            <div class="mb-2">
                <label for="portion_input" class="form-label">Počet porcii:</label>
                <input name='portion' type="number" class="form-control" id="portion_input"
                    value="<?=$data['recipe']->getPortions()?>" aria-describedby="portion_help">
                <div id="portion_help" class="form-text"></div>
                <button id="portion_button" class="btn">Zmeniť</button>
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
                    <input name='ingredient_value_1' type="number" step="0.1" class="form-control"
                           id="ingredient_value_input" value="1">
                </div>
                <div class="col-auto">
                    <label for="ingredient_unit_input_1" class="form-label">Jednotka:</label>
                    <select id="ingredient_unit_input_1" name="ingredient_unit_1" class="form-select">

                        <option value="" disabled>Vyber jednotku</option>

                        <?php if (isset($data['unitsList'])) {
                            $unitsList = $data['unitsList'];
                            for ($i = 0; $i < count($unitsList); $i++) { ?>

                                <option value="<?= $unitsList[$i] ?>"><?= $unitsList[$i] ?></option>

                            <?php }
                        } ?>

                    </select>

                </div>
                <div class="col-auto">
                    <label for="ingredient_input" class="form-label">Surovina:</label>

                    <input id='ingredient_input_1' name="ingredient_1" type="text" class="form-control"
                           list="ingredient_list">
                    <datalist id="ingredients_list">
                        <?php if (isset($data['ingredientsList'])) {
                            $ingredientsList = $data['ingredientsList'];
                            for ($i = 1; $i < count($ingredientsList); $i++) { ?>

                                <option value="<?= $ingredientsList[$i] ?>"><?= $ingredientsList[$i] ?></option>

                            <?php }
                        } ?>
                    </datalist>
                    </input>
                </div>

                <div class="col-auto">
                    <label for="add_line_button" class="form-label">Pridať ďalšiu</label><br>
                    <button id='add_line_button' name="add_line_button" type="button" class="btn" style="float:bottom">
                        +
                    </button>
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
                <textarea type="text" class="form-control" name="process"></textarea>
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

<?php } ?>


<script src="public/scripts/editRecipe.js"></script>
