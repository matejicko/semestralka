<?php /** @var Array $data */?>

<!--Formular Prihlasenia sa-->
<div class="row">
    <div class="col-sm-2"></div>

    <div class="col-sm-8 block">

        <?php if($data['error'] != ''){?>
            <div class="alert alert-danger" role="alert">
                <?=$data['error']?>
            </div>
        <?php }?>

        <h4>Prihlásenie</h4>
        <form name="loginForm" method="post" action="?c=auth&a=login">
            <div class="mb-3">
                <label for="email_input" class="form-label">E-mailova adresa:</label>
                <input name="email" type="email" class="form-control" id="email_input" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Zadaj mail, pod ktorým si sa registroval.</div>
            </div>
            <div class="mb-3">
                <label for="password_input" class="form-label">Heslo:</label>
                <input name="password" type="password" class="form-control" id="password_input">
            </div>

            <div class="flex">
                <!--type="submit"-->
                <button type="submit" id="submit_button" class="btn btn-primary" action="?c=auth&a=login">Prihlásiť sa</button>
                    Nemáš u nás ešte konto?
                <a href="?c=auth&a=registrationForm" class="text-info">Zaregistruj sa</a>
            </div>
        </form>
    </div>

    <div class="col-sm-2"></div>
</div>