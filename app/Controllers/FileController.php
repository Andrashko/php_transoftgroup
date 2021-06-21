<?php

namespace Controllers;

use Core\Controller;
use Core\View;
use Core\File;

/**
 * Class Task7Controller
 */
class FileController extends Controller
{
    public function indexAction()
    {
        $this->forward('file/view');
    }

    public function viewAction()
    {
        $this->set('title', "Завдання 7");
        $file = new File("filename", "upload");
        if ($file->isSelected()) {
            $file->uploadFiles();
        }
        $this->set("images", $file->showImages());
        $file->backup();
        $file->remove(fn ($filename) => $file->containsText($filename, "тест"));
        $this->renderLayout();
    }
}
