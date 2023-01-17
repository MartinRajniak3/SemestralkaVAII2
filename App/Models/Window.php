<?php

namespace App\Models;
use App\Core\Model;
use App\Models\Like;
class Window extends Model
{
    protected int $id = 0;
    protected string $title = "";
    protected string $text = "";
    protected int $tvorca = 0;
    protected int $stav = 0;
    protected int $likes = 0;

    public function __construct(string $title = "", string $text = "", int $tvorca = 0)
    {
        $this->title = $title;
        $this->text = $text;
        $this->tvorca = $tvorca;
    }
    /**
     * @return int
     */
    public function getStav(): int
    {
        return $this->stav;
    }

    /**
     * @param int $stav
     */
    public function setStav(int $stav): void
    {
        $this->stav = $stav;
    }

    /**
     * @return int
     */
    public function getTvorca(): int
    {
        return $this->tvorca;
    }

    /**
     * @param int $tvorca
     */
    public function setTvorca(int $tvorca): void
    {
        $this->tvorca = $tvorca;
    }

    public function delete()
    {
        Model::getConnection()->beginTransaction();
        Like::deleteLikes($this->id);
        parent::delete();
        Model::getConnection()->commit();
    }

    public function getLikes()
    {
        if (!$this->getId()) {
            return [];
        }
        $this->likes = count(Like::getAll("window_id = ? ", [$this->getId()]));
        return Like::getAll("window_id = ? ", [$this->getId()]);
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }



}