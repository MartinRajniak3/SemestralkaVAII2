<?php

namespace App\Auth;

use App\Core\IAuthenticator;
use App\Models\User;

/**
 * Class DummyAuthenticator
 * Basic implementation of user authentication
 * @package App\Auth
 */
class DummyAuthenticator implements IAuthenticator
{
    /**
     * DummyAuthenticator constructor
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * Verify, if the user is in DB and has his password is correct
     * @param $login
     * @param $password
     * @return bool
     * @throws \Exception
     */
    function login($login, $password) : bool
    {
        $foundUser = User::getAll("login = ?", [$login]);

        if (count($foundUser) == 1) {
            $foundUser = $foundUser[0];
            if (password_verify($password, $foundUser->getPassword())) {
                $_SESSION['user'] = $foundUser;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Logout the user
     */
    function logout() : void
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            session_destroy();
        }
    }

    /**
     * Return if the user is authenticated or not
     * @return bool
     */
    function isLogged() : bool
    {
        return isset($_SESSION['user']) && $_SESSION['user'] != null;
    }

    function getLoggedUserName(): string
    {
        return $_SESSION['user']->getLogin() ?? throw new \Exception("User not logged in");
    }

    function getLoggedUserId(): mixed
    {
        return $_SESSION['user']->getId() ?? throw new \Exception("User not logged in");
    }

    function getLoggedUserContext(): mixed
    {
        return $_SESSION['user'] ?? throw new \Exception("User not logged in");
    }
}