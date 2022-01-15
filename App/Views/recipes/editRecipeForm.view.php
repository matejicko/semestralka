<?php /** @var Array $data */ ?>

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

            <h4>Názov receptu</h4>

            <div class="mb-2">
                <label for="title_input" class="form-label">Názov receptu:</label>
                <input name='title' type="text" class="form-control" id="title_input"
                       value="<?= $data['recipe']->getTitle() ?>">
                <button id="title_button" class="btn">Zmeniť</button>


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
                <select id="country_input" name='country' class="form-select"  aria-label="Default select example">
                    <option value="" disabled>Vyber krajinu</option>

                    <?php if (isset($data['countriesList'])) {
                        $countriesList = $data['countriesList'];
                        for ($i = 0; $i < count($countriesList); $i++) { ?>

                            <option value="<?= $countriesList[$i] ?>"><?= $countriesList[$i] ?></option>

                        <?php }
                    } ?>
                </select>

                <button id="country_button" class="btn">Zmeniť</button>
            </div>

            <div class="mb-2">
                <label for="duration_input" class="form-label">Dĺžka trvania:</label>
                <input id="duration_value_input" name='duration_value' type="number" step="0.1" class="form-control"
                    value="<?=(float) filter_var( $data['recipe']->getDuration(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION )?>">

                <select id="duration_unit_input" name='duration_unit' class="form-select"
                        aria-label="Default select example">
                    <option value="" disabled>Vyber jednotku:</option>
                    <option value="hodina" selected>hodina</option>
                    <option value="hodiny">hodiny</option>
                    <option value="hodín">hodín</option>
                    <option value="minúta">minúta</option>
                    <option value="minút">minút</option>
                    <option value="deň">deň</option>
                    <option value="dní">dní</option>
                </select>

                <button id="duration_button" class="btn">Zmeniť</button>
            </div>

            <div class="mb-2">
                <label for="portion_input" class="form-label">Počet porcii:</label>
                <input name='portion' type="number" class="form-control" id="portion_input"
                    value="<?=$data['recipe']->getPortions()?>">
                <button id="portion_button" class="btn">Zmeniť</button>
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
                <textarea id="process_input" type="text" class="form-control" name="process"><?=$data['recipe']->getProcess() ?></textarea>
                <button id="process_button" class="btn">Zmeniť</button>

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
                <textarea id="about_input" type="text" class="form-control" name="about"><?=$data['recipe']->getAbout()?></textarea>
                <button id="about_button" class="btn">Zmeniť</button>
            </div>
        </div>

        <div class="col-sm-2"></div>

    </div>

<?php } ?>


<script src="public/scripts/editRecipe.js"></script>
