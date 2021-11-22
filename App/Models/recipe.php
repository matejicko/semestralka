<?php

namespace App\Models;
use App\Core\Model;

class recipe extends \App\Core\Model
{
    public function __construct(
        public int $id = 0,
        public ?string $title = null,
        public int $countryId = 0,
        public ?string $duration = null,
        public int $portions = 0,
        public ?string $process = null,
        public ?string $about = null,
        public int $userId = 0,
        public ?string $image = null
    )
    {

    }

    static public function setDbColumns()
    {
        return ['id', 'title', 'country_id', 'duration', 'portions', 'process', 'about', 'user_id', 'image'];
    }

    static public function setTableName()
    {
        return 'recipe';
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
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getCountryId(): int
    {
        return $this->countryId;
    }

    /**
     * @param int $countryId
     */
    public function setCountryId(int $countryId): void
    {
        $this->countryId = $countryId;
    }

    /**
     * @return string|null
     */
    public function getDuration(): ?string
    {
        return $this->duration;
    }

    /**
     * @param string|null $duration
     */
    public function setDuration(?string $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return int
     */
    public function getPortions(): int
    {
        return $this->portions;
    }

    /**
     * @param int $portions
     */
    public function setPortions(int $portions): void
    {
        $this->portions = $portions;
    }

    /**
     * @return string|null
     */
    public function getProcess(): ?string
    {
        return $this->process;
    }

    /**
     * @param string|null $process
     */
    public function setProcess(?string $process): void
    {
        $this->process = $process;
    }

    /**
     * @return string|null
     */
    public function getAbout(): ?string
    {
        return $this->about;
    }

    /**
     * @param string|null $about
     */
    public function setAbout(?string $about): void
    {
        $this->about = $about;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
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
}