<?php

namespace App\Models;

use App\Core\Model;

class Like extends Model
{
    protected ?int $id;
    protected ?int $window_id;
    protected ?string $who;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getWindowId(): ?int
    {
        return $this->window_id;
    }

    /**
     * @param int|null $window_id
     */
    public function setWindowId(?int $window_id): void
    {
        $this->window_id = $window_id;
    }

    /**
     * @return string|null
     */
    public function getWho(): ?string
    {
        return $this->who;
    }

    /**
     * @param string|null $who
     */
    public function setWho(?string $who): void
    {
        $this->who = $who;
    }

    /**
     * @param $windowId
     * @return void
     * @throws \Exception
     */
    public static function deleteLikes($windowId)
    {
        $likes = self::getAll("window_id = ?", [$windowId]);
        foreach ($likes as $like) {
            $like->delete();
        }
    }
}