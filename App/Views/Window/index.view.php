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
</head>
<body>
<div class="hlavicka">
    <div class="HlavickaText">
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
                    <div class="col">
                        <a href="?c=window&a=create" class="btn btn-success">Pridať nový podnet</a>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
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
                                <?php if ($auth->isLogged()) { ?>
                                    <?php if ($auth->getLoggedUserId() == 1) { ?>
                                        <p>
                                            <a class="btn btn-info" href="?c=window&a=zmenStav&id=<?= $window->getId() ?>&stav=0">Základ</a>
                                            <a class="btn btn-success" href="?c=window&a=zmenStav&id=<?= $window->getId() ?>&stav=1">Hotovo</a>
                                            <a class="btn btn-danger" href="?c=window&a=zmenStav&id=<?= $window->getId() ?>&stav=2">Nebude</a>
                                        </p>
                                    <?php } ?>
                                <?php } ?>

                                <p class="card-text signText">
                                    <?= $window->getText() ?>
                                </p>

                                <?php if ($auth->isLogged()) { ?>
                                    <p><a href="?c=window&a=like&id=<?= $window->getId() ?>" class="btn btn-primary"><?= count($window->getLikes()) ?> Počet hlasov</a></p>
                                    <?php if ($auth->getLoggedUserId() == 1 || $auth->getLoggedUserId() == $window->getTvorca()) { ?>
                                        <p><a href="?c=window&a=edit&id=<?= $window->getId() ?>" class="btn btn-warning">Upraviť</a>
                                        <a href="?c=window&a=delete&id=<?= $window->getId() ?>" class="btn btn-danger">Zmazať</a></p>
                                    <?php } ?>
                                <?php } else { ?>
                                    <button class="btn btn-secondary"><?= count($window->getLikes()) ?> Hlas/Hlasy</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>

</div>

</body>
