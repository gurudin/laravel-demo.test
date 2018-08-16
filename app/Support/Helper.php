<?php

namespace App\Support;

use App\Models\Categories;

class Helper
{
    /**
     * Get category
     *
     * @param App\Models\Categories $category
     *
     * @return Array
     */
    public static function getCategory()
    {
        $items = (new Categories)->all();

        return $items;
    }
}
