<?php

namespace App\Models;

use App\Core\Model;

class Link extends Model
{
    protected int $id = 0;
    protected string $popis = "";
    protected string $odkaz = "";

    public function delete()
    {
        Model::getConnection()->beginTransaction();
        parent::delete();
        Model::getConnection()->commit();
    }

    /**
     * @return string
     */
    public function getOdkaz(): string
    {
        return $this->odkaz;
    }

    /**
     * @param string $odkaz
     */
    public function setOdkaz(string $odkaz): void
    {
        $this->odkaz = $odkaz;
    }

    /**
     * @return string
     */
    public function getPopis(): string
    {
        return $this->popis;
    }

    /**
     * @param string $popis
     */
    public function setPopis(string $popis): void
    {
        $this->popis = $popis;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


}