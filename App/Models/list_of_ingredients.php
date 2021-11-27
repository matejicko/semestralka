<?php

namespace App\Models;

use App\Core\Model;

class list_of_ingredients extends Model
{
    public function __construct(
        public int $recipe_id = 0,
        public int $ingredient_id = 0,
        public int $unit_id = 0,
        public int $quantity = 0
    )
    {

    }


    static public function setDbColumns()
    {
        return ['recipe_id', 'ingredient_id', 'unit_id', 'quantity'];
    }

    static public function setTableName()
    {
        return 'list_of_ingredients';
    }

    /**
     * @return int
     */
    public function getRecipeId(): int
    {
        return $this->recipe_id;
    }

    /**
     * @param int $recipe_id
     */
    public function setRecipeId(int $recipe_id): void
    {
        $this->recipe_id = $recipe_id;
    }

    /**
     * @return int
     */
    public function getIngredientId(): int
    {
        return $this->ingredient_id;
    }

    /**
     * @param int $ingredient_id
     */
    public function setIngredientId(int $ingredient_id): void
    {
        $this->ingredient_id = $ingredient_id;
    }

    /**
     * @return int
     */
    public function getUnitId(): int
    {
        return $this->unit_id;
    }

    /**
     * @param int $unit_id
     */
    public function setUnitId(int $unit_id): void
    {
        $this->unit_id = $unit_id;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

}