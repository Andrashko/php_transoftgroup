<?php

namespace Models;

use Core\Model;

/**
 * Class Product
 */
class Product extends Model
{

    /**
     * Product constructor.
     */
    function __construct()
    {
        $this->table_name = "products";
        $this->id_column = "id";
        $this->filters = [
            "id" => FILTER_SANITIZE_NUMBER_INT,
            "sku" => FILTER_SANITIZE_STRING,
            "name" => FILTER_SANITIZE_STRING,
            "price" => FILTER_SANITIZE_NUMBER_FLOAT,
            "qty" => FILTER_SANITIZE_NUMBER_FLOAT,
            "description" => FILTER_SANITIZE_FULL_SPECIAL_CHARS
        ];
    }
}
