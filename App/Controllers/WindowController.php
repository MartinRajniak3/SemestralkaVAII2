<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Like;
use App\Models\Window;

class WindowController extends AControllerBase
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
            'data' => Window::getAll()
        ]);
    }

    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws \Exception
     */
    public function like()
    {
        $windowId = $this->request()->getValue('id');
        $likes = Like::getAll("window_id = ? && who= ?", [$windowId, $this->app->getAuth()->getLoggedUserName()]);
        if (count($likes) == 0) {
            $like = new Like();
            $like->setWindowId($windowId);
            $like->setWho($this->app->getAuth()->getLoggedUserName());
            $like->save();
        } else if (count($likes) == 1) {
            $likes[0]->delete();
        } else {
            throw new \Exception("One post can't have more than one like from the same user.");
        }
        return $this->redirect("?c=posts");
    }

    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws \Exception
     */
    public function delete()
    {
        $window = Window::getOne($this->request()->getValue('id'));

        if ($window->getPicture()) {
            unlink($window->getPicture());
        }
        $window->delete();

        return $this->redirect("?c=window");
    }

    /**
     * @return \App\Core\Responses\ViewResponse
     * @throws \Exception
     */
    public function edit()
    {
        return $this->html([
            'window' => Window::getOne($this->request()->getValue('id'))
        ],
            'window.form'
        );
    }

    /**
     * @return \App\Core\Responses\ViewResponse
     */
    public function create()
    {
        return $this->html([
            'window' => new Window()
        ],
            'window.form'
        );
    }

    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws \Exception
     */
    public function store()
    {
        $id = $this->request()->getValue('id');
        $window = ($id ? Window::getOne($id) : new Window());

        $window->setTitle($this->request()->getValue("title"));
        $window->setText($this->request()->getValue("text"));
        $window->save();

        return $this->redirect("?c=window");
    }


}