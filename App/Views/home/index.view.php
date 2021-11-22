<?php /** @var Array $data */ ?>

<!--Formular vlozenia receptu-->
<form name="recipeUploadForm" method="post">

    <!--Nazov a obrazok-->
    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8 block">

            <h4>Názov a fotka jedla</h4>

            <div class="mb-2">
                <label for="title_input" class="form-label">Názov receptu:</label>
                <input type="text" class="form-control" id="title_input">
            </div>

            <div class="mb-2">
                <label for="image_input" class="form-label">Náhľad receptu:</label>
                <input type="file" class="form-control" id="image_input">
            </div>

        </div>

        <div class="col-sm-2"></div>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8 block">

            <h4>Atribúty receptu</h4>
            <div class="mb-2">
                <label for="country_input" class="form-label">Krajina:</label>
                <select class="form-select" name="country_input" aria-label="Default select example">
                    <option selected>Vyber krajinu</option>
                    <option value="1">Taliansko</option>
                    <option value="2">Slovensko</option>
                    <option value="3">Ukrajina</option>
                </select>
            </div>

            <div class="mb-2">
                <label for="duration_input" class="form-label">Dĺžka trvania:</label>
                <input type="number" step="0.1" class="form-control" id="duration_value_input" >
                <select class="form-select" name="duration_unit_input" aria-label="Default select example">
                    <option selected>Vyber jednotku:</option>
                    <option value="1">hodina</option>
                    <option value="2">hodín</option>
                    <option value="3">minút</option>
                    <option value="4">deň</option>
                    <option value="5">dní</option>
                </select>
            </div>

            <div class="mb-2">
                <label for="portion_input" class="form-label">Počet porcii:</label>
                <input type="number" class="form-control" id="portion_input">
            </div>

        </div>
            <div class="col-sm-2"></div>

    </div>

    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8 block">

            <h4>Ingrediencie</h4>
            <div class="mb-2">
                <label for="ingredient_value_input" class="form-label">Množstvo:</label>
                <input type="number" step="0.1" class="form-control" id="ingredient_value_input">

                <label for="ingredient_unit_input" class="form-label">Jednotka:</label>
                <select class="form-select" name="ingredient_unit_input" aria-label="Default select example">
                    <option selected>Vyber jednotku</option>
                    <option value="1">ks</option>
                    <option value="2">ml</option>
                    <option value="3">kg</option>
                    <option value="4">PL</option>
                    <option value="5">KL</option>
                </select>

                <label for="ingredient_input" class="form-label">Surovina:</label>
                <select class="form-select" name="ingredient_input" aria-label="Default select example">
                    <option selected>Vyber surovinu</option>
                    <option value="1">nová</option>
                    <option value="2">hladká múka</option>
                    <option value="3">olivový olej</option>
                    <option value="4">soľ</option>
                    <option value="5">čierne korenie</option>
                </select>
            </div>
        </div>

        <div class="col-sm-2"></div>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>


        <div class="col-sm-8 block">

            <h4>Proces</h4>
            <div class="mb-2">
                <textarea type="text" class="form-control" name="process_input"></textarea>
            </div>
        </div>

        <div class="col-sm-2"></div>

    </div>

    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8 block">
            <h4>O recepte</h4>
            <div class="mb-2">
                <textarea type="text" class="form-control" name="about_input"></textarea>
            </div>
        </div>

        <div class="col-sm-2"></div>

    </div>

    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8 block">
            <h4>Potvrdenie</h4>
            <button type="submit" class="btn btn-primary">Uverejniť</button>
            Kliknutím na tlačídlo sa recept odošle a pridá na stránku.
        </div>

        <div class="col-sm-2"></div>
    </div>



</form>

<!--Vyhľadávanie-->
<div id="podklad" class="container-fluid" >

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="input-group mb-3">
                <h1>Vyhľadávanie receptov</h1>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Vyhľadať na základe názvu receptu...">
                    <button class="btn" type="submit">Vyhľadaj</button>
                </div>

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




