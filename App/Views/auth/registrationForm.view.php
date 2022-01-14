<?php /** @var Array $data */?>

<!--Formular Registracie-->
<div class="row">
    <div class="col-sm-2"></div>

    <div class="col-sm-8 block">

        <?php if($data['error'] != ''){?>
            <div class="alert alert-danger" role="alert">
                <?=$data['error']?>
            </div>
        <?php }?>

        <h4>Registrácia</h4>

        <form name="loginForm" method="post" action="?c=auth&a=registration" enctype="multipart/form-data">


            <div class="mb-2">
                <label for="image_input" class="form-label">Profilová fotka (nepovinná):</label>
                <input name='photo' type="file" class="form-control" id="image_input">
            </div>

            <div class="mb-3">
                <label for="nickname_input" class="form-label">Tvoja prezývka:</label>
                <input name="username" type="text" class="form-control"
                       id="nickname_input" aria-describedby="nickname_help" maxlength="20" required>
                <div id="nickname_help" class="form-text">Zadaj prezývku, pod ktorou budeš vystupovať na tejto stránke.</div>
            </div>

            <div class="mb-3">
                <label for="email_input" class="form-label">Tvoj e-mail:</label>
                <input name="mail" type="text" class="form-control" id="email_input"
                       aria-describedby="email_help" maxlength="128" required>
                <div id="email_help" class="form-text">Zadaj svoj e-mail.</div>
            </div>

            <div class="mb-3">
                <label for="name_input" class="form-label">Tvoje meno:</label>
                <input name="name" type="text" class="form-control" id="name_input"
                       aria-describedby="name_help" maxlength="32" required>
                <div id="name_help" class="form-text">Uveď prosím svoje skutočné meno.</div>
            </div>

            <div class="mb-3">
                <label for="surname_input" class="form-label">Tvoje priezvisko:</label>
                <input name="surname" type="text" class="form-control" id="surname_input"
                       aria-describedby="surname_help" maxlength="32" required>
                <div id="surname_help" class="form-text">Uveď prosím svoje skutočné priezvisko.</div>
            </div>

            <div class="mb-3">
                <label for="password_input" class="form-label">Tvoje heslo:</label>
                <input name="password" type="password" class="form-control" id="password_input"
                       aria-describedby="password_help" maxlength="64" required>
                <div id="password_help" class="form-text">Zadaj svoje heslo k novému kontu.</div>
            </div>

            <div class="mb-3">
                <label for="password_verify_input" class="form-label">Potvrdenie hesla:</label>
                <input type="password" class="form-control" id="password_verify_input"
                       aria-describedby="password_verify_help" maxlength="64" required>
                <div id="password_verify_help" class="form-text">Zadaj prosím svoje heslo ešte raz.</div>
            </div>

            <button id="registrationButton" type="submit" class="btn btn-primary" disabled>Registrácia</button>
        </form>


    </div>
    <div class="col-sm-2"></div>
</div>

<script src="public/scripts/formChecker.js"></script>