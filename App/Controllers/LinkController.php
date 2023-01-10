<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Link;

class LinkController extends AControllerBase
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
            'data' => Link::getAll()
        ]);
    }

    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws \Exception
     */
    public function delete()
    {
        $link = Link::getOne($this->request()->getValue('id'));


        $link->delete();

        return $this->redirect("?c=link");
    }

    /**
     * @return \App\Core\Responses\ViewResponse
     */
    public function create()
    {
        return $this->html([
            'link' => new Link()
        ],
            'link.form'
        );
    }

    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws \Exception
     */
    public function store()
    {
        $id = $this->request()->getValue('id');
        $link = ($id ? Link::getOne($id) : new Link());

        $link->setPopis($this->request()->getValue("popis"));
        $link->setOdkaz($this->request()->getValue("odkaz"));
        $link->save();

        return $this->redirect("?c=link");
    }
}