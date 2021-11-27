<?php /** @var Array $data */ ?>

<?php if(isset($_GET['success_message'])){ ?>
    <script>
        swal({
            title: "<?=$_GET['success_message']?>",
            icon: "success",
            button: "OK"
        });
    </script>
<?php } ?>


<!--Vyhľadávanie-->
<div id="podklad" class="container-fluid" >

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="input-group mb-3">
                <h1>Vyhľadávanie receptov</h1>
                <form method="post" class="input-group mb-3" action="?c=recipes&a=findRecipe">
                    <input type="text" class="form-control" name="title"
                           placeholder="Vyhľadať na základe názvu receptu...">
                    <button class="btn" type="submit">Vyhľadaj</button>
                </form>

            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>

<!-- Hlavný panel textu -->
<div class="row">
    <div class="col-sm-2"></div>
    <div id="text-body" class="col-sm-8">

        <h1>Svetové kuchyne</h1>
        <p>Vitajte na webovom portáli Svetové kuchyne! Nájdete tu recepty z rôznych krajín. Táto stránka je zatiaľ statická
            a ponúka len základné info. V budúcnosti plánujem pridať databázu receptov, ktoré sa budú dať vyhľadávať pomocou
            názvu receptu alebo podľa krajiny, pre ktorú je toto jedlo typické. Pribudne taktiež prihlasovací systém, ktorý
            umožní registrovaným členom pridávať, hodnotiť a komentovať recepty.</p>

    </div>
    <div class="col-sm-2"></div>
</div>




