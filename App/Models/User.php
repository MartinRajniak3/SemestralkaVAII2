<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected int $id = 0;
    protected string $login = "";
    protected string $password = "";

    /**
     * @param mixed|string $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed|string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed|string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param mixed|string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

}