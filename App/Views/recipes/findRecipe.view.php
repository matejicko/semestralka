<?php /** @var Array $data */

if (count($data['recipes']) > 0){
    foreach ($data['recipes'] as $recipe){?>

        <div class="row">
            <div class="col-sm-2"></div>

            <div class="col-sm-8 block">

                <div class="vr"></div>
                <img class="card-img-top img-fluid" src="<?=$recipe->getImage()?>" alt="Náhľad receptu" style="float: left; max-width: 20%">

                <div class="card-body" style="float: left">
                    <img class="vlajka" alt="Vlajka (Taliansko)" src="public/images/taliansko-vlajka.png">

                    <div>
                        <h2>Pizza</h2>
                        <span class="badge bg-dark">Taliansko</span>
                        <span class="badge bg-dark"><?=$recipe->getDuration()?></span>
                        <span class="badge bg-dark"><?=$recipe->getPortions()?> porcii</span>

                        <p><?=substr($recipe->getProcess(),0,254)?>...</p>

                        <hr/>
                        <a class="btn" href="?c=recipes&a=showRecipe&id=<?=$recipe->getId()?>">Otvoriť</a>

<!--                    Ak je prihlaseny uzivatel, moze upravit alebo odstranit recept-->
                        <?php if(isset($_SESSION['name']) && $_SESSION['name'] != ''){ ?>
                            <a class="btn btn-success" href="?c=account&a=showRecipe">Upraviť</a>
                            <a class="btn btn-danger" href="c=account&a=deleteRecipe">Odstrániť</a>
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