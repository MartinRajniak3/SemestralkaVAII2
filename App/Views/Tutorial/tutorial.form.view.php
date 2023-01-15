<?php
/** @var Array $data */

use App\Models\Kategoria;
use App\Models\Tutorial;

/** @var Tutorial $tutorial */
$tutorial = $data['tutorial'];
?>
<div class="container">
    <div class="row>">
        <div class="col">
            <h3>Editácia/pridanie Nápadu</h3>
            <form action="?c=tutorial&a=store" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $tutorial->getId() ?>" name="id">
                <div class="mb-3">
                    <label for="nadpis" class="form-label">Názov tutoriálu:</label>
                    <input type="text" class="form-control" id="nadpis" name="nadpis" aria-describedby="nadpis" value="<?= $tutorial->getNadpis() ?>" required>
                </div>
                <div class="mb-3">
                    <label for="popis">Popis stručný:</label>
                    <textarea class="form-control" id="popis" name="popis" style="height: 100px"required><?= $tutorial->getPopis() ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="kategoriaMC" class="form-label">Kategória tutoriálu:</label>
                    <select name="kategoriaMC" id="kategoriaMC">
                        <?php foreach (Kategoria::getAll() as $kategoria) { ?>
                            <option value="<?= $kategoria->getId() ?>"><?= $kategoria->getNazov() ?></option>
                        <?php } ?>
                    </select>
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

