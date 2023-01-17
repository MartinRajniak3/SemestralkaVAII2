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
        return true;
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
        $tut = $this->request()->getValue('tut');
        $steps = Steptutorial::getAll("tutorial = ?", [$tut]);
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

    public function createStep()
    {
        return $this->html([
            'step' => new Steptutorial(),
            'tut' => $this->request()->getValue('idTut')
        ],
            'step.form'
        );
    }

    public function editStep()
    {
        return $this->html([
            'step' => Steptutorial::getOne($this->request()->getValue('id')),
            'tut' => $this->request()->getValue('idTut')
        ],
            'step.form'
        );
    }

    public function deleteStep()
    {
        $step = Steptutorial::getOne($this->request()->getValue('id'));
        $step->delete();
        return $this->redirect("?c=tutorial");
    }

    public function storeStep()
    {
        $id = $this->request()->getValue('id');
        $step = ($id ? Steptutorial::getOne($id) : new Steptutorial());
        $oldImage = $step->getImage();
        $step->setPopis($this->request()->getValue("popis"));
        $step->setImage($this->processUploadedFile($step));
        $tutID = $this->request()->getValue("tutorialId");
        $step->setTutorial(intval($tutID));
        if (!is_null($oldImage) && is_null($step->getImage())) {
            $step->setImage($oldImage);
        }
        $step->save();

        return $this->redirect("?c=tutorial");
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


    private function processUploadedFile($tutorial)
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