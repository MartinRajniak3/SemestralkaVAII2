<?php
/** @var Array $data */

use App\Models\Window;

/** @var Window $window */
$window = $data['window'];
?>
<div class="container">
    <div class="row>">
        <div class="col">
            <h3>Editácia/pridanie príspevku</h3>
            <form action="?c=window&a=store" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $window->getId() ?>" name="id">
                <div class="mb-3">
                    <label for="title" class="form-label">Názov:</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="title" value="<?= $window->getTitle() ?>">
                </div>
                <div class="mb-3">
                    <label for="text">Komentár:</label>
                    <textarea class="form-control" id="text" name="text" style="height: 100px"><?= $window->getText() ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="picture" class="form-label">Obrázok:</label>
                    <input class="form-control" type="file" id="picture" name="picture">
                </div>
                <button type="submit" class="btn btn-primary">Odoslať príspevok</button>
            </form>
        </div>
    </div>
</div>
