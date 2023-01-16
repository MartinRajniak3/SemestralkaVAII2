<?php
/** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Models\Tutorial $tutorial */

use App\Models\Kategoria;

?>
<head>
    <meta charset="utf-8">
    <title>Návody do Minecraftu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../public/css/csska.css">
</head>
<body>
<div class="hlavicka">
    <div class="HlavickaText">
        <h1>Návody</h1>
    </div>
</div>
<div class="riadok row">
    <div class="column lavy brick" >
        <div class="text-center">
            <p><a class="btn sign signText" href="/index.php">Domov</a></p>
            <p><a class="btn sign signText" href="/index.php?c=tutorial">Návody</a></p>
            <p><a class="btn sign signText" href="/index.php?c=crafting">Craftingy</a></p>
            <p><a class="btn sign signText" href="/index.php?c=mob">Beštiár</a></p>
            <p><a class="btn sign signText" href="/index.php?c=window">Skrinka podnetov</a></p>
            <p><a class="btn sign signText" href="/index.php?c=link">Užitočné odkazy</a></p>
            <p><a class="btn sign signText" href="?c=home&a=contact">O Autorovi</a></p>

        </div>
    </div>
    <div class="column pravy wood" >
        <div class="container-fluid">
            <?php if ($auth->isLogged()) { ?>
                <div class="riadok row">
                    <div class="col">
                        <a href="?c=tutorial&a=create" class="btn btn-success">Pridať návod</a>
                    </div>
                </div>
            <?php } ?>
            <div class=" row card-deck text-center">
                <?php foreach (Kategoria::getAll() as $kategoria) { ?>
                <div class="column lavy card bg-info carpet">
                    <div class="card-header stylLink1"><?= $kategoria->getNazov() ?></div>
                    <div class="card-body ">
                    <a class="" href="#<?= $kategoria->getId() ?>">
                        <img class="kateg card-img" src="<?= $kategoria->getImage() ?>" alt="...">
                    </a>
                    </div>
                </div>
                <?php } ?>
            </div>


            <?php foreach (Kategoria::getAll() as $kategoria) { ?>
                <h1 class="riadok row" id="<?= $kategoria->getId() ?>">
                    <?= $kategoria->getNazov() ?>
                </h1>
                <div class="riadok row">
                    <?php foreach ($data['data'] as $tutorial) { ?>
                        <?php if ($kategoria->getId() == $tutorial->getKategoriaMC()) { ?>
                            <div class="col-xl-4 col-md-4 col-sm-6">
                                <div class="card my-3 text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?= $tutorial->getNadpis() ?>
                                        </h5>
                                        <p class="card-text">
                                            <?= $tutorial->getPopis() ?>
                                        </p>
                                        <img class="card-img" src="<?= $tutorial->getImage() ?>" alt="...">
                                        <a class="btn btn-secondary" href="?c=tutorial&a=one&id=<?= $tutorial->getId() ?>">Pozrieť návod</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</body>


