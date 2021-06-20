<?php

namespace Core;

class Helper
{

    // ...

    public static function getCustomer()
    {
        if (!empty($_SESSION['id'])) {
            return self::getModel('customer')->initCollection()
                ->filter(array('customer_id' => $_SESSION['id']))
                ->getCollection()
                ->selectFirst();
        } else {
            return null;
        }
    }
    /**
     * @param $name
     * @return mixed
     */
    public static function getModel($name)
    {
        $name = '\\Models\\' . ucfirst($name);
        $model = new $name();
        return $model;
    }
}
