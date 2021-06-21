<?php

namespace Controllers;

use Core\Controller;
use Core\Helper;
use Core\View;

/**
 * Class ProductController
 */
class ProductController extends Controller
{
    public function indexAction()
    {
        $this->forward('product/list');
    }

    /**
     *
     */
    public function listAction()
    {
        $this->set('title', "Товари");

        $products = $this->getModel('Product')
            ->initCollection()
            ->sort($this->getSortParams())
            ->getCollection()
            ->select();
        $this->set('products', $products);

        $this->renderLayout();
    }

    /**
     *
     */
    public function viewAction()
    {
        $this->set('title', "Картка товару");

        $product = $this->getModel('Product')
            ->initCollection()
            ->filter(['id' => $this->getId()])
            ->getCollection()
            ->selectFirst();
        $this->set('product', $product);

        $this->renderLayout();
    }

    /**
     *
     */
    public function editAction()
    {
        $model = $this->getModel('Product');
        $this->set('saved', 0);
        $this->set("title", "Редагування товару");
        $id = filter_input(INPUT_POST, 'id');
        if ($id) {
            $values = $model->getFiltredValues();
            $this->set('saved', 1);
            $model->saveItem($id, $values);
        }
        $this->set('product', $model->getItem($this->getId()));

        $this->renderLayout();
    }

    /**
     *
     */
    public function addAction()
    {
        $model = $this->getModel('Product');
        $this->set("title", "Додавання товару");
        $values = $model->getFiltredValues();
        if ($values) {
            $newProduct = $model->addItem($values);
            if ($newProduct) {
                $this->redirect(sprintf("/product/edit?id=%d", $newProduct["id"]));
            }
        }
        $this->renderLayout();
    }

    /**
     *
     */
    public function deleteAction()
    {
        $model = $this->getModel('Product');
        $this->set("title", "Вилучення товару");
        $id = filter_input(INPUT_POST, 'id');
        if ($id) {
            $model->deleteItem($id);
            $this->redirect('/product/list');
            return;
        }
        $this->set('product', $model->getItem($this->getId()));

        $this->renderLayout();
    }

    /**
     * @return array
     */
    public function getSortParams()
    {
        $params = [];

        $sortfirst = Helper::getFilterOrCookie(INPUT_POST, 'sortfirst');

        if ($sortfirst) {
            if ($sortfirst === "price_DESC") {
                $params['price'] = 'DESC';
            } else {
                $params['price'] = 'ASC';
            }
            setcookie("sortfirst", $sortfirst, time() + 600);
        }
        $sortsecond = Helper::getFilterOrCookie(INPUT_POST, 'sortsecond');

        if ($sortsecond) {
            if ($sortsecond === "qty_DESC") {
                $params['qty'] = 'DESC';
            } else {
                $params['qty'] = 'ASC';
            }
            setcookie("sortsecond", $sortsecond, time() + 600);
        }


        return $params;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return filter_input(INPUT_GET, 'id');
    }


    // ...
    public function unloadAction()
    {

        $products = $this->getModel('Product')
            ->initCollection()
            ->getCollection()->select();

        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><products/>');

        foreach ($products as $product) {
            $xmlProduct = $xml->addChild('product');
            $xmlProduct->addChild('id', $product['id']);
            $xmlProduct->addChild('sku', $product['sku']);
            $xmlProduct->addChild('name', $product['name']);
            $xmlProduct->addChild('price', $product['price']);
            $xmlProduct->addChild('qty', $product['qty']);
            $xmlProduct->addChild('description', $product['description']);
        }
        //$xml->asXML('public/products.xml');

        $dom = new \DOMDocument("1.0");
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        //$dom->saveXML();

        $file = fopen('public/products.xml', 'w');
        fwrite($file, $dom->saveXML());
        fclose($file);


        $this->renderLayout();
    }
}
