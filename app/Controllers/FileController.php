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

        $file->copy("source.txt", "dest.txt", fn ($text) => $this->reverseWords($text));
        $this->renderLayout();
    }

    public function reverseWords(string $text): string
    {
        $words = mb_split('\s', $text);
        foreach ($words as $word){
            $text = str_replace ($word, strrev($word), $text);
        }
        return $text;
    }
}
