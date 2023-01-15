<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\JsonResponse;
use App\Core\Responses\Response;
use App\Models\Steptutorial;
use App\Models\Tutorial;


class TutorialController extends AControllerBase
{
    /**
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        if ($action == 'index') {
            return true;
        } else {
            return $this->app->getAuth()->isLogged();
        }
    }
    /**
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     * @throws \Exception
     */
    public function index(): Response
    {
        return $this->html([
            'data' => Tutorial::getAll()
        ]);
    }
    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws \Exception
     */
    public function delete()
    {
        $tutorial = Tutorial::getOne($this->request()->getValue('id'));


        $tutorial->delete();

        return $this->redirect("?c=tutorial");
    }

    public function steps() : JsonResponse
    {
        $steps = Steptutorial::getAll('', [], 'id DESC');
        return $this->json($steps);
    }

    /**
     * @return \App\Core\Responses\ViewResponse
     * @throws \Exception
     */
    public function edit()
    {
        return $this->html([
            'tutorial' => Tutorial::getOne($this->request()->getValue('id'))
        ],
            'tutorial.form'
        );
    }
    public function one()
    {
        return $this->html([
            'tutorial' => Tutorial::getOne($this->request()->getValue('id'))
        ],
            'tutorial.one'
        );
    }
    /**
     * @return \App\Core\Responses\ViewResponse
     */
    public function create()
    {
        return $this->html([
            'tutorial' => new Tutorial()
        ],
            'tutorial.form'
        );
    }

    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws \Exception
     */
    public function store()
    {
        $id = $this->request()->getValue('id');
        $tutorial = ($id ? Tutorial::getOne($id) : new Tutorial());
        $oldImage = $tutorial->getImage();
        $tutorial->setNadpis($this->request()->getValue("nadpis"));
        $tutorial->setPopis($this->request()->getValue("popis"));
        $tutorial->setKategoriaMC($this->request()->getValue("kategoriaMC"));
        $tutorial->setImage($this->processUploadedFile($tutorial));

        if (!is_null($oldImage) && is_null($tutorial->getImage())) {
            $tutorial->setImage($oldImage);
        }

        $tutorial->save();

        return $this->redirect("?c=tutorial");
    }

    private function processUploadedFile(Tutorial  $tutorial)
    {
        $image = $this->request()->getFiles()["image"];
        if (!is_null($image) && $image['error'] == UPLOAD_ERR_OK) {
            $targetFile = "public" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR. "Obrazky" . DIRECTORY_SEPARATOR . time() . $image["name"];
            if (move_uploaded_file($image["tmp_name"], $targetFile)) {
                if ($tutorial->getId() && $tutorial->getImage()) {
                    unlink($tutorial->getImage());
                }
                return $targetFile;
            }
        }
        return null;
    }
}