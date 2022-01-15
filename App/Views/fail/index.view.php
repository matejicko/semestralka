<?php /** @var Array $data */ ?>

<?php if (isset($data['error'])) {?>
<div class="row">
    <div class="col-sm-2"></div>

    <div class="col-sm-8">
        <div class="alert alert-danger" role="alert">
            <?=$data['error']?>
        </div>
    </div>

    <div class="col-sm-2"></div>
</div>

<?php } ?>
