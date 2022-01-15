<?php /** @var Array $data */ ?>

<script src="public/scripts/deleteAlert.js"></script>

<?php
if (isset($data['recipes']) && count($data['recipes']) > 0 &&
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
                    <?php if ($recipe->getImage() != null && $recipe->getImage() != ""){
                        $viaRecipeImage = $recipe->getImage();
                    }else{
                        $viaRecipeImage = "#";
                    } ?>

                    <img class="img-fluid recipe-img-preview" src="<?=$viaRecipeImage?>" alt="Náhľad receptu">

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

                            <p><?= $recipe->getAbout() ?>...</p>

                            <hr/>
                            <a class="btn" href="?c=recipes&a=showRecipe&id=<?= $id ?>">Otvoriť</a>
                            <a class="btn btn-success" href="?c=recipes&a=editRecipeForm&id=<?= $id ?>">Upraviť</a>

                            <a id="delete_button_<?= $id ?>" class="btn btn-danger"
                               onclick="deleteRecipe('Naozaj si praješ odstrániť tento recept?', 'Operácia sa nedá zvrátiť', <?= $id ?>)">Odstrániť</a>

                        </div>
                    </div>

                </div>

                <div class="col-sm-3"></div>
            </div>
        </div>

    <?php }
} else {
    ?>

    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8">
            <div class="alert alert-danger" role="alert">
                Zatiaľ si nepridal žiaden recept...
                <a class="btn float-right" href="?c=recipes&a=addRecipeForm">
                    Pridať recept
                </a>
            </div>
        </div>

        <div class="col-sm-2"></div>
    </div>
<?php } ?>

<script src="public/scripts/deleteAlert.js"></script>
