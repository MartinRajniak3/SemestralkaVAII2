<?php
/** @var Array $data */

use App\Models\Crafting;

/** @var Crafting $crafting */
$crafting = $data['crafting'];
?>
<div class="container">
    <div class="row>">
        <div class="col">
            <h3>Editácia/pridanie</h3>
            <form action="?c=crafting&a=store" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $crafting->getId() ?>" name="id">
                <div class="mb-3">
                    <label for="nazov" class="form-label">Názov:</label>
                    <div class="odkaz"><?= @$data['odkaz'] ?></div>
                    <input type="text" class="form-control" id="nazov" name="nazov" aria-describedby="nazov" value="<?= $crafting->getNazov() ?>" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Obrázok:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Odoslať príspevok</button>
            </form>
        </div>
    </div>
</div>


