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
            "price" => [ 
                "filter" => FILTER_SANITIZE_NUMBER_FLOAT,
                "options" =>  FILTER_FLAG_ALLOW_FRACTION 
            ],
            "qty" => [ 
                "filter" => FILTER_SANITIZE_NUMBER_FLOAT,
                "options" =>  FILTER_FLAG_ALLOW_FRACTION 
            ],
            "description" => FILTER_SANITIZE_FULL_SPECIAL_CHARS
        ];
    }
}
