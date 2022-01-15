<?php /** @var Array $data */?>

<form name="loginForm" method="post" enctype="multipart/form-data" action="?c=account&a=edit">

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 block">

            <?php if (isset($data)){?>
            <?php if(isset($data['error']) && $data['error'] != ''){?>
                <div class="alert alert-danger" role="alert">
                    <?=$data['error']?>
                </div>
            <?php }?>


            <?php if ($data['photo'] != null || $data['photo'] != ''){?>
                <img id="profilePicture" class="card-img-top img-fluid" src="<?=$data['photo']?>"
                     alt="Profilová fotka" style="max-width: 20%"><br>
                <hr/>
                <?php }?>

                <div class="mb-2">
                    <label for="image_input" class="form-label">Nová profilová fotka:</label>
                    <input name='photo' type="file" class="form-control" id="image_input"
                           aria-describedby="photo_help">
                    <div id="photo_help" class="form-text">Maximálna veľkosť súboru je 10MB!</div>
                </div>

                <div class="mb-3">
                    <label for="nickname_input" class="form-label">Tvoja nová prezývka:</label>
                    <input name="username" type="text" class="form-control" id="nickname_input"
                           aria-describedby="nickname_help" value="<?=$data['username']?>" required>
                    <div id="nickname_help" class="form-text">Zadaj svoju novú prezývku. (Môže ostať aj rovnaká)</div>
                </div>

                <div class="mb-3">
                    <label for="email_input" class="form-label">Tvoj nový e-mail:</label>
                    <input name="mail" type="text" class="form-control" id="email_input"
                           aria-describedby="email_help" value="<?=$data['mail']?>" required>
                    <div id="email_help" class="form-text">Zadaj svoju nový e-mail. (Môže ostať aj rovnaký)</div>
                </div>

                <div class="mb-3">
                    <label for="name_input" class="form-label">Tvoje nové meno:</label>
                    <input name="name" type="text" class="form-control" id="name_input"
                           aria-describedby="name_help" value="<?=$data['name']?>" required>
                    <div id="name_help" class="form-text">V prípade, že si sa prekrstil...</div>
                </div>

                <div class="mb-3">
                    <label for="surname_input" class="form-label">Tvoje nové priezvisko:</label>
                    <input name="surname" type="text" class="form-control" id="surname_input"
                           aria-describedby="surname_help" value="<?=$data['surname']?>" required>
                    <div id="surname_help" class="form-text">V prípade zmeny priezviska...</div>
                </div>

                <div class="mb-3">
                    <label for="new_password_input" class="form-label">Tvoje nové heslo:</label>
                    <input id="new_password_input" name="new_password" type="password" class="form-control"
                           aria-describedby="new_password_help" maxlength="64">
                    <div id="new_password_help" class="form-text">V prípade, že chceš zmeniť heslo zadaj ho do poľa nad tebou, v opačnom prípade ti ostane aktuálne heslo.</div>
                </div>

                <div class="mb-3">
                    <label for="password_verify_input" class="form-label">Potvrdenie nového hesla:</label>
                    <input name="new_password_check" type="password" class="form-control" id="password_verify_input"
                           aria-describedby="password_verify_help" maxlength="64">
                    <div id="password_verify_help" class="form-text">Zadaj prosím svoje nové heslo ešte raz.</div>
                </div>

                <div class="mb-3">
                    <label for="check_password_input" class="form-label">Zadaj aktuálne heslo:</label>
                    <input id="check_password_input" name="password" type="password" class="form-control"
                           aria-describedby="password_help" maxlength="64" required>
                    <div id="password_help" class="form-text">Zadaj aktuálne heslo pre potvrdenie zmien.</div>
                </div>

            <?php }?>

            <button type="submit" class="btn btn-primary">Ulož zmeny</button>
        </div>

        <div class="col-sm-2"></div>

    </div>


</form>

<script src="public/scripts/formChecker.js"></script>