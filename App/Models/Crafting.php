<?php

namespace App\Models;

use App\Core\Model;

class Crafting extends Model
{

    protected int $id = 0;
    protected string $nazov = "";
    protected int $pismeno = 0;
    protected ?string $image = null;

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
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

    /**
     * @return string
     */
    public function getNazov(): string
    {
        return $this->nazov;
    }

    /**
     * @param string $nazov
     */
    public function setNazov(string $nazov): void
    {
        $this->nazov = $nazov;
    }

    /**
     * @return int
     */
    public function getPismeno(): int
    {
        return $this->pismeno;
    }

    /**
     * @param int $pismeno
     */
    public function setPismeno(int $pismeno): void
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