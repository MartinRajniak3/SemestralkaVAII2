<?php
/** @var Array $data */

use App\Models\Steptutorial;

/** @var Steptutorial $step */
$step = $data['step'];
?>
<div class="container">
    <div class="row>">
        <div class="col">
            <h3>Editácia/pridanie</h3>
            <form action="?c=tutorial&a=storeStep" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $step->getId() ?>" name="id">
                <input type="hidden" value="<?= @$data['tut'] ?>" name="tutorialId">
                <div class="mb-3">
                    <label for="popis">Popis:</label>
                    <textarea class="form-control" id="popis" name="popis" style="height: 100px"required><?= $step->getPopis() ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Obrázok:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Odoslať</button>
            </form>
        </div>
    </div>
</div>

