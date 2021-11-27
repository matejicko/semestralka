<?php /** @var Array $data */ ?>

<script src="public/scripts/deleteAlert.js"></script>

<?php if (isset($data['recipes']) && count($data['recipes']) > 0 &&
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

                        <p><?=substr($recipe->getProcess(),0,254)?>...</p>

                        <hr/>
                        <a class="btn" href="?c=recipes&a=showRecipe&id=<?=$recipe->getId()?>">Otvoriť</a>

<!--                    Ak je prihlaseny uzivatel, moze upravit alebo odstranit recept, ak je samozrejme jeho-->
                        <?php if(\App\Authentification::isLogged() &&
                                    $recipe->getUserId() == \App\AccountHandler::getLoggedUser()->getId()){ ?>
                            <a id="fake_button" class="btn btn-danger"
                               onclick="deleteAlertSwal('Naozaj si praješ odstrániť tento recept?', 'Operácia sa nedá zvrátiť', <?=$id?>)">Odstrániť</a>

                            <a id="delete_button_<?=$id?>" class="btn btn-danger"
                               href="?c=recipes&a=deleteRecipe&which=<?=$id?>" style="visibility: hidden"></a>
                        <?php }?>

                    </div>
                </div>

            </div>

            <div class="col-sm-2"></div>
        </div>

    <?php }
}else{?>

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
<?php }?>