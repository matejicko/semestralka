<?php /** @var Array $data */?>

<form name="loginForm" method="post" action="?c=account&a=edit">

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
                     alt="Profilová fotka" style="float: top; max-width: 20%"><br>
                <hr/>
                <?php }?>

                <div class="mb-3">
                    <label for="nickname_input" class="form-label">Tvoja prezývka:</label>
                    <input name="username" type="text" class="form-control" id="nickname_input"
                           aria-describedby="nickname_help" value="<?=$data['username']?>" required>
                    <div id="nickname_help" class="form-text">Zadaj prezývku, pod ktorou budeš vystupovať na tejto stránke.</div>
                </div>

                <div class="mb-3">
                    <label for="email_input" class="form-label">Tvoj e-mail:</label>
                    <input name="mail" type="text" class="form-control" id="email_input"
                           aria-describedby="email_help" value="<?=$data['mail']?>" required>
                    <div id="email_help" class="form-text">Zadaj svoj e-mail.</div>
                </div>

                <div class="mb-3">
                    <label for="name_input" class="form-label">Tvoje meno:</label>
                    <input name="name" type="text" class="form-control" id="name_input"
                           aria-describedby="name_help" value="<?=$data['name']?>" required>
                    <div id="name_help" class="form-text">Uveď prosím svoje skutočné meno.</div>
                </div>

                <div class="mb-3">
                    <label for="surname_input" class="form-label">Tvoje priezvisko:</label>
                    <input name="surname" type="text" class="form-control" id="surname_input"
                           aria-describedby="surname_help" value="<?=$data['surname']?>" required>
                    <div id="surname_help" class="form-text">Uveď prosím svoje skutočné priezvisko.</div>
                </div>
            <?php }?>

            <button type="submit" class="btn btn-primary">Ulož zmeny</button>
        </div>

        <div class="col-sm-2"></div>

    </div>


</form>