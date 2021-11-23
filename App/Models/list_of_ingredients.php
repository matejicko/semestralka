<?php

namespace App\Models;

use App\Core\Model;

class list_of_ingredients extends Model
{
    public function __construct(
        public int $recipeId = 0,
        public int $ingredientId = 0,
        public int $unitId = 0,
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
        return $this->recipeId;
    }

    /**
     * @param int $recipeId
     */
    public function setRecipeId(int $recipeId): void
    {
        $this->recipeId = $recipeId;
    }

    /**
     * @return int
     */
    public function getIngredientId(): int
    {
        return $this->ingredientId;
    }

    /**
     * @param int $ingredientId
     */
    public function setIngredientId(int $ingredientId): void
    {
        $this->ingredientId = $ingredientId;
    }

    /**
     * @return int
     */
    public function getUnitId(): int
    {
        return $this->unitId;
    }

    /**
     * @param int $unitId
     */
    public function setUnitId(int $unitId): void
    {
        $this->unitId = $unitId;
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