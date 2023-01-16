<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\User;

/**
 * Class AuthController
 * Controller for authentication actions
 * @package App\Controllers
 */
class AuthController extends AControllerBase
{
    /**
     *
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\Response
     */
    public function index(): Response
    {
        return $this->redirect(Configuration::LOGIN_URL);
    }

    /**
     * Login a user
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\ViewResponse
     */
    public function login(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        $logged = null;

        if (isset($formData['submit'])) {
            $logged = $this->app->getAuth()->login($formData['login'], $formData['password']);
            if ($logged) {
                return $this->redirect('?c=window');
            }
        }

        $data = ($logged === false ? ['message' => 'Zlý login alebo heslo!'] : []);
        return $this->html($data);
    }

    /**
     * Logout a user
     * @return \App\Core\Responses\ViewResponse
     */
    public function logout(): Response
    {
        $this->app->getAuth()->logout();
        return $this->html();
    }

    public function registracia(): Response
    {
        return $this->html([
            'user' => new User()
        ],
            'registracia'
        );
    }
    public function ulozUsera()
    {
        $id = $this->request()->getValue('id');
        $user = ($id ? User::getOne($id) : new User());
        $user->setLogin($this->request()->getValue("login"));
        $loginVTabulke = User::getAll("login = ?", [$user->getLogin()]);
        if (count($loginVTabulke) == 0) {
            $passwd = $this->request()->getValue("password");
            $user->setPassword(password_hash( $passwd, PASSWORD_DEFAULT));
            $user->save();
            return $this->redirect("?c=window");
        } else {
            return $this->html([
                'user' => new User(),
                'message' => 'Tento login sa už nachádza v databáze použi iný!'
            ],
                'registracia'
            );
        }
    }
}