<?php
/** @var Array $data */

use App\Models\Link;

/** @var Link $link */
$link = $data['link'];
?>
<div class="container">
    <div class="row>">
        <div class="col">
            <h3>Pridanie Linku</h3>
            <form action="?c=link&a=store" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $link->getId() ?>" name="id">
                <div class="mb-3">
                    <label for="popis" class="form-label">Názov alebo popis k linku:</label>
                    <input type="text" class="form-control" id="popis" name="popis" aria-describedby="popis" value="" required>
                </div>
                <div class="mb-3">
                    <label for="odkaz" class="form-label">Odkaz/Link:</label>
                    <input type="text" class="form-control" id="odkaz" name="odkaz" aria-describedby="odkaz" value="" required>
                </div>
                <button type="submit" class="btn btn-primary">Odoslať</button>
            </form>
        </div>
    </div>
</div>

