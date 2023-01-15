<?php

namespace App\Models;

use App\Core\Model;

class Steptutorial extends Model
{
    protected int $id = 0;
    protected string $popis = "";
    protected ?string $image = "";

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
    protected int $tutorial = 0;

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
    public function getTutorial(): int
    {
        return $this->tutorial;
    }

    /**
     * @param int $tutorial
     */
    public function setTutorial(int $tutorial): void
    {
        $this->tutorial = $tutorial;
    }

    public function delete()
    {
        Model::getConnection()->beginTransaction();
        parent::delete();
        Model::getConnection()->commit();
    }
}