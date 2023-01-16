<?php
/** @var Array $data */

use App\Models\Drop;
use App\Models\Mob;

/** @var Drop $drop */
$drop = $data['drop'];
?>
<div class="container">
    <div class="row>">
        <div class="col">
            <h3>Editácia/pridanie</h3>
            <form action="?c=mob&a=storeDrop" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $drop->getId() ?>" name="id">
                <input type="hidden" value="<?= @$data['mob'] ?>" name="mobId">
                <div class="mb-3">
                    <label for="nazov" class="form-label">Názov:</label>
                    <input type="text" class="form-control" id="nazov" name="nazov" aria-describedby="nazov" value="<?= $drop->getNazov() ?>" required>
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

