<?php
/** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Models\Window $window */
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../csska.css">
</head>
<body>
<div class="hlavicka">
    <h1>Skrinka podnetov</h1>
</div>
<div class="riadok">
    <div class="column lavy" style="background-color: #052aad;">
        <div>
            <p><a href="../HlavnaStranka.html">Domov</a></p>
            <p> <a href="../Podstranky/Navody.html">Návody</a></p>
            <p> <a href="index.php?c=window">Skrinka podnetov</a></p>
            <p><a href="../Podstranky/TypyNaServery.html">Typy na servery</a></p>
            <p><a href="../Podstranky/UzitocneLinky.html">Užitočné linky</a></p>
            <p><a href="../Podstranky/OAutorovi.html">O Autorovi</a></p>
        </div>
    </div>
    <div class="column pravy" style="background-image: url('../../../Obrazky/minecraft-pozadie.jpg');">
        <div class="container-fluid">
            <?php if ($auth->isLogged()) { ?>
                <div class="row">
                    <div class="col">
                        <a href="?c=window&a=create" class="btn btn-success">Pridať nový príspevok</a>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <?php foreach ($data['data'] as $window) { ?>
                    <div class="col-xl-3 col-md-4 col-sm-6">
                        <div class="card my-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?= $window->getTitle() ?>
                                </h5>
                                <p class="card-text">
                                    <?= $window->getText() ?>
                                </p>
                                <?php if ($auth->isLogged()) { ?>
                                    <a href="?c=window&a=like&id=<?= $window->getId() ?>" class="btn btn-primary"><?= count($window->getLikes()) ?> Počet hlasov</a>
                                    <a href="?c=window&a=edit&id=<?= $window->getId() ?>" class="btn btn-warning">Upraviť</a>
                                    <a href="?c=window&a=delete&id=<?= $window->getId() ?>" class="btn btn-danger">Zmazať</a>
                                <?php } else { ?>
                                    <button class="btn btn-secondary"><?= count($window->getLikes()) ?> Počet hlasov</button>
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
