<?php

namespace App\Models;

use App\Core\Model;

class Drop extends Model
{
    protected int $id = 0;
    protected string $nazov = "";
    protected ?string $image = "";
    protected int $mob = 0;

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
    public function getMob(): int
    {
        return $this->mob;
    }

    /**
     * @param int $mob
     */
    public function setMob(int $mob): void
    {
        $this->mob = $mob;
    }

}