<?php

namespace App\Models;
use App\Core\Model;

class country extends \App\Core\Model
{

    public function __construct(
        public int $id = 0,
        public ?string $name = null,
        public ?string $flag = null
    )
    {

    }

    static public function setDbColumns()
    {
        return ['id', 'name', 'flag'];
    }

    static public function setTableName()
    {
        return "country";
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getFlag(): ?string
    {
        return $this->flag;
    }

    /**
     * @param string|null $flag
     */
    public function setFlag(?string $flag): void
    {
        $this->flag = $flag;
    }
}