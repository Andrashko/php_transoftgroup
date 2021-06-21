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


    public static function isAdmin()
    {
        $customer = self::getCustomer();
        if ($customer) {
            return $customer["admin_role"] == 1;
        }
        return false;
    }

    public static function getFilterOrCookie ($type, $value){
        $result = filter_input($type, $value);
        if ($result){
            return $result;
        }
        if (isset($_COOKIE[$value])){
            return $_COOKIE[$value];
        }
        return NULL;
    }
}
