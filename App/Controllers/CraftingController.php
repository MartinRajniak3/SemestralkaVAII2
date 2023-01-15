<?php

namespace App\Controllers;
use App\Core\Responses\Response;
use App\Core\AControllerBase;
use App\Models\Crafting;
use App\Models\Letter;

class CraftingController extends AControllerBase
{
    /**
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        return true;
    }

    public function index(): Response
    {
        return $this->html([
            'data' => Crafting::getAll()
        ]);
    }

    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws \Exception
     */
    public function delete()
    {
        $window = Crafting::getOne($this->request()->getValue('id'));
        $window->delete();

        return $this->redirect("?c=crafting");
    }

    /**
     * @return \App\Core\Responses\ViewResponse
     * @throws \Exception
     */
    public function edit()
    {
        return $this->html([
            'crafting' => Crafting::getOne($this->request()->getValue('id'))
        ],
            'crafting.form'
        );
    }

    /**
     * @return \App\Core\Responses\ViewResponse
     */
    public function create()
    {
        return $this->html([
            'crafting' => new Crafting()
        ],
            'crafting.form'
        );
    }


    public function store()
    {
        $id = $this->request()->getValue('id');
        $crafting = ($id ? Crafting::getOne($id) : new Crafting());
        $oldImage = $crafting->getImage();
        $crafting->setNazov($this->request()->getValue("nazov"));
        $crafting->setImage($this->processUploadedFile($crafting));

        if (!is_null($oldImage) && is_null($crafting->getImage())) {
            $crafting->setImage($oldImage);
        }

        $fstchar = substr($crafting->getNazov(), 0,1);
        $charid = -1;
        foreach (Letter::getAll() as $letter) {
            if ($letter->getPismeno() == $fstchar) {
                $charid = $letter->getId();
            }
        }
        if ($charid == -1) {
            return $this->html([
                'crafting' => $crafting,
                'odkaz' => 'Velke pismeno!'
            ],
                'crafting.form'
            );
        } else {
            $crafting->setPismeno($charid);

            $crafting->save();
        }


        return $this->redirect("?c=crafting");
    }

    private function processUploadedFile(Crafting  $crafting)
    {
        $image = $this->request()->getFiles()["image"];
        if (!is_null($image) && $image['error'] == UPLOAD_ERR_OK) {
            $targetFile = "public" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR. "Obrazky" . DIRECTORY_SEPARATOR . time() . $image["name"];
            if (move_uploaded_file($image["tmp_name"], $targetFile)) {
                if ($crafting->getId() && $crafting->getImage()) {
                    unlink($crafting->getImage());
                }
                return $targetFile;
            }
        }
        return null;
    }
}