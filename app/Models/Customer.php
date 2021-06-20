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
    }
   
}