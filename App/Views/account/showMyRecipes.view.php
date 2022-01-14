<?php /** @var Array $data */ ?>

<script src="public/scripts/deleteAlert.js"></script>

<?php
if (isset($data['recipes']) && count($data['recipes']) > 0 &&
        isset($data['countries']) && count($data['countries']) > 0){
    $countries = $data['countries'];

    foreach ($data['recipes'] as $recipe){
        $id = $recipe->getId();
        $c_id = $recipe->getCountryId()?>

    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8 block">

            <div class="vr"></div>
            <img class="card-img-top img-fluid" src="<?=$recipe->getImage()?>" alt="Náhľad receptu" style="float: left; max-width: 20%">

            <div class="card-body" style="float: left">
                <img class="vlajka" alt="Vlajka (<?=$countries[$c_id]->getName()?>)" src="<?=$countries[$c_id]->getFlag()?>">

                <div>
                    <h2><?=$recipe->getTitle()?></h2>
                    <span class="badge bg-dark"><?=$countries[$c_id]->getName()?></span>
                    <span class="badge bg-dark"><?=$recipe->getDuration()?></span>
                    <span class="badge bg-dark"><?=$recipe->getPortions()?> porcii</span>

                    <p><?=$recipe->getAbout()?>...</p>

                    <hr/>
                    <a class="btn" href="?c=recipes&a=showRecipe&id=<?=$id?>">Otvoriť</a>
                    <a class="btn btn-success" href="?c=account&a=showMyRecipes">Upraviť</a>
                    <a id="fake_button" class="btn btn-danger"
                       onclick="deleteAlertSwal('Naozaj si praješ odstrániť tento recept?', 'Operácia sa nedá zvrátiť', <?=$id?>)">Odstrániť</a>

                    <a id="delete_button_<?=$id?>" class="btn btn-danger"
                       href="?c=recipes&a=deleteRecipe&which=<?=$id?>" style="visibility: hidden"></a>

                </div>
            </div>

        </div>

        <div class="col-sm-2"></div>
    </div>

<?php }
}else{?>

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
<?php }?>
