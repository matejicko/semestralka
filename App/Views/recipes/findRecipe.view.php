<?php /** @var Array $data */ ?>

    <script src="public/scripts/deleteAlert.js"></script>

<?php if (isset($data['recipes']) && count($data['recipes']) > 0 &&
    isset($data['countries']) && count($data['countries']) > 0) {
    $countries = $data['countries'];

    foreach ($data['recipes'] as $recipe) {
        $id = $recipe->getId();
        $c_id = $recipe->getCountryId() ?>

        <div class="container">
            <div id="recipe_block_<?= $id ?>" class="row">
                <div class="col-sm-3"></div>

                <div class="col-sm-6 block">

                    <div class="vr"></div>
                    <img class="img-fluid recipe-img-preview" src="<?= $recipe->getImage() ?>" alt="Náhľad receptu">

                    <div class="card-body" style="float: left">
                        <?php if ($countries[$c_id]->getFlag() != null && $countries[$c_id]->getFlag() != ""){ ?>
                            <img class="vlajka" alt="Vlajka (<?= $countries[$c_id]->getName() ?>)"
                                 src="<?= $countries[$c_id]->getFlag() ?>">
                        <?php }else{ ?>
                            Vlajka (<?= $countries[$c_id]->getName() ?>)
                        <?php } ?>
                        <div>
                            <h2><?= $recipe->getTitle() ?></h2>
                            <span class="badge bg-dark"><?= $countries[$c_id]->getName() ?></span>
                            <span class="badge bg-dark"><?= $recipe->getDuration() ?></span>
                            <span class="badge bg-dark"><?= $recipe->getPortions() ?> porcii</span>

                            <p><?= substr($recipe->getProcess(), 0, 254) ?>...</p>

                            <hr/>
                            <a class="btn" href="?c=recipes&a=showRecipe&id=<?= $id ?>">Otvoriť</a>

                            <!--                    Ak je prihlaseny uzivatel, moze upravit alebo odstranit recept, ak je samozrejme jeho-->
                            <?php if (\App\Authentification::isLogged() &&
                                $recipe->getUserId() == \App\AccountHandler::getLoggedUser()->getId()) { ?>
                                <a class="btn btn-success" href="?c=recipes&a=editRecipeForm&id=<?= $id ?>">Upraviť</a>

                                <a id="delete_button_<?= $id ?>" class="btn btn-danger"
                                   onclick="deleteRecipe('Naozaj si praješ odstrániť tento recept?', 'Operácia sa nedá zvrátiť', <?= $id ?>)">Odstrániť</a>
                            <?php } ?>

                        </div>
                    </div>

                </div>

            </div>


        </div>
        <div class="col-sm-2"></div>

    <?php }
} else { ?>

    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8 block">
            <div class="alert alert-danger" role="alert">
                Pre zadaný výraz sa nenašiel žiaden recept :(
            </div>

            <form method="post" class="input-group mb-3" action="?c=recipes&a=findRecipe">
                <input type="text" class="form-control" name="title"
                       placeholder="Vyhľadať na základe názvu receptu...">
                <button class="btn" type="submit">Vyhľadaj</button>
            </form>

        </div>

        <div class="col-sm-2"></div>
    </div>
<?php } ?>