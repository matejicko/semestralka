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

                    <p><?=substr($recipe->getProcess(),0,255)?>...</p>

                    <hr/>
                    <a class="btn" href="?c=account&a=settingsForm">Otvoriť</a>
                    <a class="btn btn-success" href="?c=account&a=showMyRecipes">Upraviť</a>
                    <a class="btn btn-danger" href="c=account&a=deleteAccount">Odstrániť</a>

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
                <a class="btn float-right" href="#">
                    Pridať recept
                </a>
            </div>
        </div>

        <div class="col-sm-2"></div>
</div>
<?php }?>
