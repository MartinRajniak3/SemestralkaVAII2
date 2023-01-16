<?php
/** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Models\Mob $mob */

use App\Models\Drop;
use App\Models\Mob;

?>
<head>
    <meta charset="utf-8">
    <title>Návody do Minecraftu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../public/css/csska.css">
</head>
<body>
<div class="hlavicka" id="start">
    <div class="HlavickaText">
        <h1>Beštiár</h1>
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
            <div class="riadok">
                <div  class="column pravy text-center">
                    <?php foreach ($data['data'] as $mob) { ?>
                        <a class="btn btn-secondary stone stylLink1" href="#<?= $mob->getId() ?>"> -<?= $mob->getNazov() ?>- </a>
                    <?php } ?>
                </div>
            </div>
            <div class="riadok"><p></p></div>
            <?php if ($auth->isLogged()) { ?>
                <?php if ($auth->getLoggedUserId() == 1) { ?>
                    <div class="riadok row">
                        <div class="col">
                            <a href="?c=mob&a=create" class="btn btn-success">Pridať moba</a>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>


            <?php foreach ($data['data'] as $mob) { ?>
                <div class="row bordOkolo carpet">
                    <div class="column in bordPravy text-center">
                        <h1 id="<?= $mob->getId() ?>"><a class="stylLink1" href="#start"><?= $mob->getNazov() ?></a></h1>
                        <img class="imgCrafting" src="<?= $mob->getImage() ?>" alt="...">
                        <?php if ($auth->isLogged()) { ?>
                            <?php if ($auth->getLoggedUserId() == 1) { ?>
                                <p>
                                    <a href="?c=mob&a=edit&id=<?= $mob->getId() ?>" class="btn btn-warning">Upraviť moba</a>
                                <p>
                                    <a href="?c=mob&a=delete&id=<?= $mob->getId() ?>" class="btn btn-danger">Zmazať moba</a>
                                </p>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="column pravy ">
                        <h3 class="signText"><?= $mob->getPopis()?></h3>
                        <?php foreach (Drop::getAll() as $drop) { ?>
                            <?php if ($mob->getId() == $drop->getMob()) { ?>
                                <div class="riadok rPad">
                                    <div><img class="imgDrop" src="<?= $drop->getImage() ?>" alt="."></div>
                                    <div class="dropText"><?= $drop->getNazov() ?></div>
                                    <?php if ($auth->isLogged()) { ?>
                                        <?php if ($auth->getLoggedUserId() == 1) { ?>
                                            <div class="margAPad"><a class="btn btn-warning" href="?c=mob&a=editDrop&id=<?= $drop->getId() ?>&mobID=<?= $mob->getId() ?>">Upravit</a></div>
                                            <div class="margAPad"><a class="btn btn-danger" href="?c=mob&a=deleteDrop&id=<?= $drop->getId() ?>">Zmazat</a></div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <?php if ($auth->isLogged()) { ?>
                            <?php if ($auth->getLoggedUserId() == 1) { ?>
                                <a class="btn btn-success" href="?c=mob&a=createDrop&mobID=<?= $mob->getId() ?>">Pridat Drop</a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</body>
