<?php /** @var Array $data */?>

<?php if (isset($data['recipe'])){?>

    <?php if ($data['recipe']->getImage() != ''){ ?>
        <img class="img-fluid" alt="Náhľad jedla (Pizza)"
            src="<?=$data['recipe']->getImage()?>" style="max-height: 20%">
    <?php } ?>

    <!--Recept-->
    <div class="row">
        <div class="col-sm-2"></div>
        <div id="text-body" class="col-sm-8">

            <div class="block">

                <?php if (isset($data['country'])){ ?>
                    <img class="vlajka img-fluid" alt="Vlajka (<?=$data['country']->getName()?>)"
                         src="<?=$data['country']->getName()?>-vlajka.png">
                <?php }?>

                <h1><?=$data['recipe']->getTitle()?></h1>

                <?php if (isset($data['country'])){ ?>
                    <span class="badge bg-dark"><?=$data['country']?></span>
                <?php }?>

                <span class="badge bg-dark"><?=$data['recipe']->getPortions()?> porcii</span>
                <span class="badge bg-dark"><?=$data['recipe']->getDuration()?></span>
            </div>

            <div class="block">
                <h2>Ingrediencie</h2>

                <h5>Cesto</h5>
                <ul>
                    <li><b>600 g</b> hladkej múky
                    </li><li><b>250</b> ml vody
                    </li><li><b>90 ml</b> mlieka
                    </li><li><b>10 g</b> sušených pivných kvasníc / <b>21 g</b> droždia
                    </li><li><b>50 ml</b> olivového oleja
                    <li><b>12 g</b> soli</li>
                </ul>
                <h5>Omáčka</h5>
                <ul>
                    <li>stredne veľká cibuľa
                    </li><li><b>2</b> strúčky cesnaku
                    </li><li><b>8-12</b> väčších paradajok
                    </li><li>oregano
                    </li><li>soľ
                    </li><li>čierne korenie</li>
                </ul>
                <h5>Obloha</h5>
                <ul>
                    <li>syr (najlepšie mozarella)
                    </li><li>šunka/šampiňóny/olivy,...</li>
                </ul>
            </div>

            <div class="block">
                <h2>Postup</h2>
                <p><?=$data['recipe']->getProcess()?></p>
            </div>

        </div>
        <div class="col-sm-2"></div>
    </div>

<?php } ?>
