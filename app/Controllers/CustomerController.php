<?php

namespace Controllers;

use Core\Controller;
use Core\View;

/**
 * Class CustomerController
 */
class CustomerController extends Controller
{
    public function indexAction()
    {
        $this->forward('customer/list');
    }

    /**
     *
     */
    public function listAction()
    {
        $this->set('title', "Клієнти");

        $customers = $this->getModel('Customer')
            ->initCollection()
            ->getCollection()
            ->select();
        $this->set('customers', $customers);

        $this->renderLayout();
    }



    public function LoginAction()
    {
        $this->set('title', "Вхід");
        $this->set ("invalid_password",  0);

        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
            $email = filter_input(INPUT_POST, 'email');
            $password = md5(filter_input(INPUT_POST, 'password'));
            $params = array(
                'email' => "$email",
                'password' => "$password"
            );
            $customer = $this->getModel('customer')->initCollection()
                ->filter($params)
                ->getCollection()
                ->selectFirst();
            if (!empty($customer)) {
                $_SESSION['id'] = $customer['customer_id'];
                
                $this->redirect('/index/index');
            } else {
                $this->set ("invalid_password",  1);
            }
        }
        $this->renderLayout();
    }

    public function LogoutAction()
    {

        $_SESSION = [];

        // expire cookie

        if (!empty($_COOKIE[session_name()])) {
            setcookie(session_name(), "", time() - 3600, "/");
        }

        session_destroy();
        $this->redirect('/index/index');
    }

    public function RegisterAction()
    {
        $model = $this->getModel('Customer');
        $this->set("title", "Реєстрація");
        $values = $model->getPostValues();
        if ($values) {
            $values["password"] = md5($values["password"]);
            $newCustomer = $model->addItem($values);
            $this->redirect('/index/index');
        }
        $this->renderLayout();
    }
}
