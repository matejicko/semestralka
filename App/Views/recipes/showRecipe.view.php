<?php /** @var Array $data */ ?>

<!--Main image-->
<?php if ($data['recipe']->getImage() != null && $data['recipe']->getImage() != "") { ?>
    <img class="img-fluid" alt="Náhľad jedla (<?= $data['recipe']->getTitle() ?>)"
         src="<?= $data['recipe']->getImage() ?>" style="max-height: 20%">
<?php } ?>

<!--Recipe-->
<div class="row">

    <div class="col-sm-2"></div>
    <div id="text-body" class="col-sm-8">

        <div class="block">
            <?php if ($data['country']->getFlag() != null && $data['country']->getFlag() != "") { ?>
                <img class="vlajka" alt="Vlajka (<?= $data['country']->getName() ?>)"
                     src="<?= $data['country']->getFlag() ?>">
            <?php } else { ?>
                Vlajka (<?= $data['country']->getName() ?>)
            <?php } ?>

            <h1><?= $data['recipe']->getTitle() ?></h1>
            <span class="badge bg-dark"><?= $data['country']->getName() ?></span>
            <span class="badge bg-dark"><?= $data['recipe']->getPortions() ?></span>
            <span class="badge bg-dark"><?= $data['recipe']->getDuration() ?></span>
        </div>

        <?php if ($data['ingredients_list'] != null && $data['ingredients_list'] != "") { ?>
            <div class="block">
                <h2>Ingrediencie</h2>
                <?= $data['ingredients_list'] ?>
            </div>
        <?php } ?>

        <div class="block">
            <h2>Postup</h2>
            <?= $data['recipe']->getProcess() ?>
        </div>

        <?php if ($data['recipe']->getAbout() != null && $data['recipe']->getAbout() != "") { ?>

            <div class="block">
                <h2>O recepte</h2>
                <?= $data['recipe']->getAbout() ?>
            </div>

        <?php } ?>

        <div class="col-sm-2"></div>
    </div>
</div>
