<?php
/** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Models\Tutorial $tutorial */

use App\Models\Kategoria;
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
                            <a href="?c=tutorial&a=edit&id=<?= $tutorial->getId() ?>" class="btn btn-success">Uprav návod</a>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <h5 class="StylTextUvodny riadok">
                <?= $tutorial->getNadpis() ?>
            </h5>
            <div class="riadok text-center">
                <div class="column pravy text-center">
                    <div>
                        <button id="krokUp" class="btn btn-secondary btn-lg stone"><---</button>
                        <button id="krokDown" class="btn btn-secondary btn-lg stone">---></button>
                    </div>
                </div>
            </div>
            <div class="riadok">
                <div>
                    <p id="popis" class="StylTextUvodny">

                    </p>
                    <p id="imag">

                    </p>

                </p>
            </div>
        </div>
    </div>
</div>
</body>
