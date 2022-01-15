<?php /** @var Array $data */ ?>

<!--Main image-->
<img class="img-fluid" alt="Náhľad jedla (<?=$data['recipe']->getTitle()?>)"
     src="<?=$data['recipe']->getImage()?>" style="max-height: 20%">

<!--Recipe-->
<div class="row">

    <div class="col-sm-2"></div>
    <div id="text-body" class="col-sm-8">

        <div class="block">
            <img class="vlajka img-fluid" alt="Vlajka (<?=$data['country']->getName()?>)" src="<?=$data['country']->getFlag()?>">
            <h1><?=$data['recipe']->getTitle()?></h1>
            <span class="badge bg-dark"><?=$data['country']->getName()?></span>
            <span class="badge bg-dark"><?=$data['recipe']->getPortions()?></span>
            <span class="badge bg-dark"><?=$data['recipe']->getDuration()?></span>
        </div>

        <?php if ($data['ingredients_list'] != null && $data['ingredients_list'] != "") { ?>
        <div class="block">
            <h2>Ingrediencie</h2>
            <?=$data['ingredients_list']?>
        </div>
        <?php } ?>

        <div class="block">
            <h2>Postup</h2>
            <?=$data['recipe']->getProcess()?>
        </div>

        <?php if ($data['recipe']->getAbout() != null && $data['recipe']->getAbout() !=""){ ?>

        <div class="block">
            <h2>O recepte</h2>
            <?=$data['recipe']->getAbout()?>
        </div>

        <?php } ?>


    </div>
    <div class="col-sm-2"></div>
</div>
