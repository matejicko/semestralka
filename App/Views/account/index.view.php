<?php /** @var Array $data */ ?>

<div class="row">
    <div class="col-sm-2"></div>

    <div class="col-sm-8 block">
        <?php if ($data['photo'] != null || $data['photo'] != ''){?>
            <img class="card-img-top img-fluid" src="<?=$data['photo']?>" alt="Profilová fotka" style="float: left; max-width: 20%">
        <?php }?>

        <?php if (isset($data)){?>
            <div class="card-body" style="float: left">
                <b>Používateľské meno:</b> <?=$data['username']?><br>
                <b>Meno:</b> <?=$data['name']?><br>
                <b>Priezvisko:</b> <?=$data['surname']?><br>
                <b>E-mail:</b> <?=$data['mail']?><br>
                <hr/>
                <a class="btn" href="?c=account&a=settingsForm">Zmena údajov</a>
                <a class="btn" href="?c=account&a=showMyRecipes">Moje recepty</a>

                <a id="fake_button" class="btn btn-danger" href="#"
                   onclick="deleteAlertSwal('Naozaj si praješ odstrániť účet?', 'Táto akcia sa nedá zvrátiť')">Odstrániť účet</a>

                <a id="delete_button" href="?c=account&a=deleteAccount" style="visibility: hidden"></a>
            </div>
        <?php }?>
    </div>

    <div class="col-sm-2"></div>
</div>

<script src="public/scripts/deleteAccountAlert.js"></script>