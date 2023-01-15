<?php

namespace App\Models;

use App\Core\Model;

class Letter extends Model
{
    protected int $id = 0;
    protected string $pismeno = "";

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

    /**
     * @return string
     */
    public function getPismeno(): string
    {
        return $this->pismeno;
    }

    /**
     * @param string $pismeno
     */
    public function setPismeno(string $pismeno): void
    {
        $this->pismeno = $pismeno;
    }


    public function delete()
    {
        Model::getConnection()->beginTransaction();
        parent::delete();
        Model::getConnection()->commit();
    }
}