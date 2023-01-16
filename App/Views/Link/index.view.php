<?php
/** @var Array $data */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Models\Link $link */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Užitočné Odkazy</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../../public/css/csska.css">
</head>
<body>
	<div class="hlavicka">
        <div class="HlavickaText">
            <h1>Užitočné Odkazy</h1>
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
                        <div class="column">
                            <a href="?c=link&a=create" class="btn btn-success">Pridať nový link</a>
                        </div>
                    </div>
                <?php } ?>
                <div class="row stylLink">
                    <?php foreach ($data['data'] as $link) { ?>
                        <p  class="nadpis1"><?= $link->getPopis() ?></p>
                        <p  class="stylTextu1"><a class="btn sign signText stylLink1" href="<?= $link->getOdkaz() ?>">Navštíviť stránku</a></p>
                        <?php if ($auth->isLogged()) { ?>
                            <a href="?c=link&a=delete&id=<?= $link->getId() ?>" class="btn btn-danger">^Zmazať^</a>
                        <?php } else { ?>
                            <p></p>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

		</div>
	</div>
</body>
</html>