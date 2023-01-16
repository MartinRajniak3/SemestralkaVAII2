<?php
/** @var Array $data */

use App\Models\Mob;

/** @var Mob $mob */
$mob = $data['mob'];
?>
<div class="container">
    <div class="row>">
        <div class="col">
            <h3>Editácia/pridanie</h3>
            <form action="?c=mob&a=store" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $mob->getId() ?>" name="id">
                <div class="mb-3">
                    <label for="nazov" class="form-label">Názov:</label>
                    <input type="text" class="form-control" id="nazov" name="nazov" aria-describedby="nazov" value="<?= $mob->getNazov() ?>" required>
                </div>
                <div class="mb-3">
                    <label for="popis">Popis moba:</label>
                    <textarea class="form-control" id="popis" name="popis" style="height: 100px" required><?= $mob->getPopis() ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Obrázok:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Uložiť</button>
            </form>
        </div>
    </div>
</div>
