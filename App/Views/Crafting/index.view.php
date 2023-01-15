<?php
/** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Models\Crafting $crafting */

use App\Models\Letter;

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
        <h1 id="start">Craftingy</h1>
    </div>
</div>
<div class="riadok row">
    <div class="column lavy brick" >
        <div class="text-center">
            <p><a class="btn sign signText" href="/index.php">Domov</a></p>
            <p><a class="btn sign signText" href="/index.php?c=tutorial">Návody</a></p>
            <p><a class="btn sign signText" href="/index.php?c=crafting">Kraftingy</a></p>
            <p><a class="btn sign signText" href="/index.php?c=window">Skrinka podnetov</a></p>
            <p><a class="btn sign signText" href="/index.php?c=link">Užitočné odkazy</a></p>
            <p><a class="btn sign signText" href="?c=home&a=contact">O Autorovi</a></p>

        </div>
    </div>
    <div class="column pravy wood" >
        <div class="container-fluid">
            <div class="riadok">
                <div  class="column pravy text-center">
                    <?php foreach (Letter::getAll() as $letter) { ?>
                        <a class="btn btn-secondary stone stylLink1" href="#<?= $letter->getId() ?>"> -<?= $letter->getPismeno() ?>- </a>

                    <?php } ?>
                </div>
            </div>
            <div class="riadok"><p></p></div>
            <?php if ($auth->isLogged()) { ?>
                <div class="riadok row">
                    <div class="col">
                        <a href="?c=crafting&a=create" class="btn btn-success">Pridať crafting</a>
                    </div>
                </div>
            <?php } ?>


            <?php foreach (Letter::getAll() as $letter) { ?>
                <div class="row bordOkolo carpet">
                    <div class="column lavy bordPravy text-center">
                        <h1 id="<?= $letter->getId() ?>"><a class="stylLink1" href="#start"><?= $letter->getPismeno() ?></a></h1>
                    </div>
                    <div class="column pravy ">
                        <?php foreach ($data['data'] as $crafting) { ?>
                            <?php if ($letter->getId() == $crafting->getPismeno()) { ?>
                                <div class="riadok">
                                    <div class="column pravy ">
                                        <img class="imgCrafting" src="<?= $crafting->getImage()?>" alt="...">
                                    </div>
                                    <div class="column pravy ">
                                        <p>
                                            <h2><?= $crafting->getNazov()?></h2>
                                        <p>
                                            <a href="?c=crafting&a=edit&id=<?= $crafting->getId()?>" class="btn btn-warning">Upravit</a>
                                            <a href="?c=crafting&a=delete&id=<?= $crafting->getId()?>" class="btn btn-danger">Zmazat</a>
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

    </div>
</div>
</body>



