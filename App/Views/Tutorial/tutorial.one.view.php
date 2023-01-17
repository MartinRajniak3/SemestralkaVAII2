<?php
/** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Models\Tutorial $tutorial */

use App\Models\Kategoria;
use App\Models\Steptutorial;
use App\Models\Tutorial;

/** @var Tutorial $tutorial */
$tutorial = $data['tutorial'];
?>
<head>
    <meta charset="utf-8">
    <title>Návody do Minecraftu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../public/css/csska.css">
    <script src="../../../public/js/script.js"></script>
</head>
<body>
<div class="hlavicka">
    <div class="HlavickaText">
        <h1>Návody</h1>
    </div>
</div>
<div class="riadok">
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
                <?php if ($auth->getLoggedUserId() == 1) { ?>
                    <div class="riadok">
                        <div class="col">
                            <a href="?c=tutorial&a=edit&id=<?= $tutorial->getId() ?>" class="btn btn-warning">Uprav návod</a>
                            <a href="?c=tutorial&a=delete&id=<?= $tutorial->getId() ?>" class="btn btn-danger">Vymaž návod</a>
                            <a href="?c=tutorial&a=createStep&idTut=<?= $tutorial->getId() ?>" class="btn btn-success">Pridaj krok</a>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <?php if ($auth->isLogged()) { ?>
                <label hidden for="logged"></label>
                <input hidden id="logged" value="<?= $auth->getLoggedUserId() ?>">
                <label hidden for="idTut"></label>
                <input hidden id="idTut" value="<?= $tutorial->getId() ?>">
            <?php } ?>
            <div  class="StylTextUvodny riadok text-center">
                <div class="stylLink">
                    <h2 class="stylLink1">
                        <?= $tutorial->getNadpis() ?>
                    </h2>
                </div>
                <label hidden for="idNavod"></label>
                <input hidden type="text" id="idNavod" value="<?= $tutorial->getId() ?>">
                <p>
                    <div class="stylLink">
                        <div class="stylLink1"><?= $tutorial->getPopis() ?></div>
                    </div>
                <p>
                    <img class="imgCrafting" src="<?= $tutorial->getImage() ?>" alt=".">
                </p>
            </div>

            <div class="riadok">
                <div id="kroky" class="column pravy">

                </div>
            </div>
        </div>
    </div>
</div>
</body>
