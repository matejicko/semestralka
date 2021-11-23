<?php

namespace App\Models;

class unit extends \App\Core\Model
{
    public function __construct(
        public int $id = 0,
        public ?string $shortcut = null
    )
    {

    }

    static public function setDbColumns()
    {
        return ['id', 'shortcut'];
    }

    static public function setTableName()
    {
        return 'unit';
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
    public function getShortcut(): ?string
    {
        return $this->shortcut;
    }

    /**
     * @param string|null $shortcut
     */
    public function setShortcut(?string $shortcut): void
    {
        $this->shortcut = $shortcut;
    }
}