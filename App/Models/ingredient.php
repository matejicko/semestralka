<?php

namespace App\Models;

class ingredient extends \App\Core\Model
{
    public function __construct(
        public int $id = 0,
        public ?string $name = null
    )
    {

    }

    static public function setDbColumns()
    {
        return ['id', 'name'];
    }

    static public function setTableName()
    {
        return 'ingredient';
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
}