<?php /** @var Array $data */ ?>

<div class="row">
    <div class="col-sm-2"></div>

    <div class="col-sm-8 block">
        <?php if ($data['user']->getPhoto() != null || $data['user']->getPhoto() != ''){?>
            <img class="card-img-top img-fluid" src="<?=$data['user']->getPhoto()?>" alt="Profilová fotka" style="float: left; max-width: 20%">
        <?php }?>


        <?php if (isset($data)){?>
            <div class="card-body" style="float: left">
                <b>Používateľské meno:</b> <?=$data['user']->getUsername()?><br>
                <b>Meno:</b> <?=$data['user']->getName()?><br>
                <b>Priezvisko:</b> <?=$data['user']->getSurname()?><br>
                <b>E-mail:</b> <?=$data['user']->getMail()?><br>
                <hr/>
                <a class="btn" href="?c=account&a=settingsForm">Zmena údajov</a>
                <a class="btn" href="?c=account&a=showMyRecipes">Moje recepty</a>

            </div>
        <?php }?>
    </div>

    <div class="col-sm-2"></div>
</div>