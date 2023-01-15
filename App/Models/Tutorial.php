<?php

namespace App\Models;

use App\Core\Model;

class Tutorial extends Model
{
    protected int $id = 0;
    protected string $nadpis = "";
    protected string $popis = "";
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
    protected int $kategoriaMC = 0;

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
    public function getNadpis(): string
    {
        return $this->nadpis;
    }

    /**
     * @param string $nadpis
     */
    public function setNadpis(string $nadpis): void
    {
        $this->nadpis = $nadpis;
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
    public function getKategoriaMC(): int
    {
        return $this->kategoriaMC;
    }

    /**
     * @param int $kategoriaMC
     */
    public function setKategoriaMC(int $kategoriaMC): void
    {
        $this->kategoriaMC = $kategoriaMC;
    }

    public function delete()
    {
        Model::getConnection()->beginTransaction();
        parent::delete();
        Model::getConnection()->commit();
    }
}
