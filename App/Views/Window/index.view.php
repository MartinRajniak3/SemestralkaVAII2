<?php
/** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Models\Window $window */
?>
<head>
    <meta charset="utf-8">
    <title>Návody do Minecraftu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../public/css/csska.css">
    <script src="../../../public/js/podnety.js"></script>
</head>
<body>
<div class="hlavicka">
    <div id="start" class="HlavickaText">
        <h1>Skrinka podnetov</h1>
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
                <div class="row">
                    <div  class="column pravy text-center">
                        <a class="btn btn-secondary stone stylLink1" href="#1"> -V Procese- </a>
                        <a class="btn btn-secondary stone stylLink1" href="#2"> -Hotovo- </a>
                        <a class="btn btn-secondary stone stylLink1" href="#3"> -Nebude- </a>
                    </div>
                    <label for="tvorcaIN"></label>
                    <input hidden  class="form-control" type="text" id="tvorcaIN" value="<?= $auth->getLoggedUserId() ?>">
                    <div class="mb-3">
                        <label for="titleIN" class="form-label stylLink1">Nadpis:</label>
                        <input  class="form-control" type="text" id="titleIN">
                    </div>
                    <div class="mb-3">
                        <label for="textIN" class="form-label stylLink1">Text:</label>
                        <input  class="form-control" type="text" id="textIN">
                    </div>

                    <button id="pridajBTN" class="btn btn-secondary text-center stone stylLink1">Pridať podnet</button>
                </div>
            <?php } else { ?>
                <label for="tvorcaIN"></label>
                <input hidden  class="form-control" type="text" id="tvorcaIN" value="0">
                <div class="mb-3">
                    <label hidden for="titleIN" class="form-label stylLink1">Nadpis:</label>
                    <input hidden class="form-control" type="text" id="titleIN">
                </div>
                <div class="mb-3">
                    <label hidden for="textIN" class="form-label stylLink1">Text:</label>
                    <input hidden class="form-control" type="text" id="textIN">
                </div>
                <button hidden id="pridajBTN" class="btn btn-success text-center">Pridať podnet</button>
            <?php } ?>


            <div class="row">
                <?php if ($auth->isLogged()) { ?>
                    <label for="logged"></label>
                    <input hidden  class="form-control" type="text" id="logged" value="<?= $auth->getLoggedUserId() ?>">
                    <div id="1" class="stylLink column lavy text-center"><h1><a class="stylLink1" href="#start">V procese</a></h1></div>
                    <div class="row" id="cyan">

                    </div>
                    <div id="2" class="stylLink column lavy text-center"><h1><a class="stylLink1" href="#start">Hotovo</a></h1></div>
                    <div class="row" id="lime">

                    </div>
                    <div id="3" class="stylLink column lavy text-center"><h1><a class="stylLink1" href="#start">Nebude</a></h1></div>
                    <div class="row" id="red">

                    </div>
                <?php } else { ?>
                    <?php foreach ($data['data'] as $window) { ?>
                        <div class="col-xl-3 col-md-4 col-sm-6">
                        <?php if ($window->getStav() == 1) { ?>
                            <div class="card my-3 limecarpet">
                        <?php } elseif ($window->getStav() == 2) { ?>
                            <div class="card my-3 redcarpet">
                        <?php } else { ?>
                            <div class="card my-3 carpet">
                        <?php } ?>
                        <h5 class="card-header signText">
                            <?= $window->getTitle() ?>
                        </h5>
                        <div class="card-body">


                            <p class="card-text signText">
                                <?= $window->getText() ?>
                            </p>
                            <button class="btn btn-secondary"><?= count($window->getLikes()) ?> Hlas/Hlasy</button>
                        </div>
                        </div>
                        </div>
                    <?php } ?>
                    </div>
                    </div>

                <?php } ?>

    </div>
</div>

</body>
