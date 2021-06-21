<?php

namespace Models;

use Core\Model;

/**
 * Class Customer
 */
class Customer extends Model
{

    /**
     * Customer constructor.
     */
    function __construct()
    {
        $this->table_name = "customer";
        $this->id_column = "customer_id";
        $this->filters = [
            "email" => FILTER_VALIDATE_EMAIL,
            "password" => FILTER_DEFAULT,
            // "password" => [
            //     "filter" => FILTER_VALIDATE_REGEXP,
            //     "options" => [
            //         "regexp" => "/^[A-z\d]{8,}$/",
            //         "default" => "PASSWORD_ERROR"
            //     ]
            // ],
            "first_name" => FILTER_SANITIZE_STRING,
            "last_name" => FILTER_SANITIZE_STRING,
            "telephone" => FILTER_VALIDATE_INT,
            "city" => FILTER_SANITIZE_STRING,
            "customer_id" => FILTER_VALIDATE_INT,
            "admin_role" => FILTER_VALIDATE_INT,
        ];
    }
}
