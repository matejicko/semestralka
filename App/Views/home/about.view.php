<?php /** @var Array $data */ ?>

<!-- Foto-album -->
<div id="slide-show" class="carousel slide" data-bs-ride="carousel">

    <!-- Bodky -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#slide-show" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#slide-show" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#slide-show" data-bs-slide-to="2"></button>
    </div>

    <!-- Samotné fotky -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="public/images/wiener-schnitzel.jpg" alt="Wiener Schnitzel" class="d-block w-100">
            <div class="carousel-caption">
                <div class="caption-box">
                    <h3>Rakúsko</h3>
                    <p>Wiener Schnitzel</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="public/images/tulumba.jpg" alt="Tulumba" class="d-block w-100">
            <div class="carousel-caption">
                <div class="caption-box">
                    <h3>(Severné) Macedónsko</h3>
                    <p>Tulumba</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="public/images/ful-mudames.jpg" alt="Ful Medames" class="d-block w-100">
            <div class="carousel-caption">
                <div class="caption-box">
                    <h3>(Južný) Sudán</h3>
                    <p>Ful Medames</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Šípky -->
    <button class="carousel-control-prev" type="button" data-bs-target="#slide-show" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#slide-show" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Hlavný panel textu -->
<div class="row">
    <div class="col-sm-2"></div>
    <div id="text-body" class="col-sm-8">

        <h1>O projekte</h1>
        <p>Cieľom projektu je ukázať rôzne svetové kuchyne. Nájdete tu recepty z rôznych krajín sveta.
            Pre všetkých milovníkov varenia a experimentovania v kuchyni je táto stránka ako stvorená. Každá krajina má
            svoje národné jedlo, ktoré tu istotne nájdete s autentickým receptom od ľudí, z danej krajiny.
            Okrem hlavných jedál tu nájdete aj polievky a dezerty, ktoré sú symbolmi daných krajín.</p>
    </div>
    <div class="col-sm-2"></div>
</div>
