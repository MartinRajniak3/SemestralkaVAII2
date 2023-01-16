<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Models\Drop;
use App\Models\Mob;
use App\Core\Responses\Response;

class MobController extends AControllerBase
{
    /**
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        return true;
    }

    /**
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     * @throws \Exception
     */
    public function index(): Response
    {
        return $this->html([
            'data' => Mob::getAll()
        ]);
    }

    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws \Exception
     */
    public function delete()
    {
        $mob = Mob::getOne($this->request()->getValue('id'));

        $mob->delete();

        return $this->redirect("?c=mob");
    }

    /**
     * @return \App\Core\Responses\ViewResponse
     */
    public function create()
    {
        return $this->html([
            'mob' => new Mob()
        ],
            'mob.form'
        );
    }

    /**
     * @return \App\Core\Responses\ViewResponse
     * @throws \Exception
     */
    public function edit()
    {
        return $this->html([
            'mob' => Mob::getOne($this->request()->getValue('id'))
        ],
            'mob.form'
        );
    }

    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws \Exception
     */
    public function store()
    {
        $id = $this->request()->getValue('id');
        $mob = ($id ? Mob::getOne($id) : new Mob());
        $oldImage = $mob->getImage();
        $mob->setNazov($this->request()->getValue("nazov"));
        $mob->setPopis($this->request()->getValue("popis"));
        $mob->setImage($this->processUploadedFile($mob));
        if (!is_null($oldImage) && is_null($mob->getImage())) {
            $mob->setImage($oldImage);
        }
        $mob->save();

        return $this->redirect("?c=mob");
    }

    private function processUploadedFile(Mob  $mob)
    {
        $image = $this->request()->getFiles()["image"];
        if (!is_null($image) && $image['error'] == UPLOAD_ERR_OK) {
            $targetFile = "public" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR. "Obrazky" . DIRECTORY_SEPARATOR . time() . $image["name"];
            if (move_uploaded_file($image["tmp_name"], $targetFile)) {
                if ($mob->getId() && $mob->getImage()) {
                    unlink($mob->getImage());
                }
                return $targetFile;
            }
        }
        return null;
    }

    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws \Exception
     */
    public function deleteDrop()
    {
        $drop = Drop::getOne($this->request()->getValue('id'));

        $drop->delete();

        return $this->redirect("?c=mob");
    }

    /**
     * @return \App\Core\Responses\ViewResponse
     */
    public function createDrop()
    {
        return $this->html([
            'drop' => new Drop(),
            'mob' => $this->request()->getValue('mobID')
        ],
            'drop.form'
        );
    }

    /**
     * @return \App\Core\Responses\ViewResponse
     * @throws \Exception
     */
    public function editDrop()
    {
        return $this->html([
            'drop' => Drop::getOne($this->request()->getValue('id')),
            'mob' => $this->request()->getValue('mobID')
        ],
            'drop.form'
        );
    }

    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws \Exception
     */
    public function storeDrop()
    {
        $id = $this->request()->getValue('id');
        $drop = ($id ? Drop::getOne($id) : new Drop());
        $oldImage = $drop->getImage();
        $drop->setNazov($this->request()->getValue("nazov"));
        $drop->setMob($this->request()->getValue("mobId"));
        $drop->setImage($this->processUploadedFileDrop($drop));
        if (!is_null($oldImage) && is_null($drop->getImage())) {
            $drop->setImage($oldImage);
        }
        $drop->save();

        return $this->redirect("?c=mob");
    }

    private function processUploadedFileDrop(Drop  $drop)
    {
        $image = $this->request()->getFiles()["image"];
        if (!is_null($image) && $image['error'] == UPLOAD_ERR_OK) {
            $targetFile = "public" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR. "Obrazky" . DIRECTORY_SEPARATOR . time() . $image["name"];
            if (move_uploaded_file($image["tmp_name"], $targetFile)) {
                if ($drop->getId() && $drop->getImage()) {
                    unlink($drop->getImage());
                }
                return $targetFile;
            }
        }
        return null;
    }
}