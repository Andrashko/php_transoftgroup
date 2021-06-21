<?php

namespace Core;

/**
 * Class DB
 */
class File
{
    protected $upload_dir = "upload";

    protected $source;

    protected $backup_dir = "backup";

    protected $expairs = SECONDS_IN_DAY *3;

    public function __construct($source, $upload_dir)
    {
        $this->source = $source;
        $this->upload_dir = $upload_dir;
    }

    public function uploadFiles()
    {
        $filename = $_FILES[$this->source]['name'];
        $tmp_filename = $_FILES[$this->source]['tmp_name'];
        move_uploaded_file($tmp_filename, "$this->upload_dir/$filename");
    }

    public function showImages()
    {
        $upload_files = scandir($this->upload_dir);
        $result = "";
        foreach ($upload_files as $filename) {
            if ($filename !== "." && $filename !== ".." && getimagesize("$this->upload_dir/$filename") > 0) {
                $result .= '<img src="' . "$this->upload_dir/$filename" . '">';
            }
        }
        return $result;
    }

    public function isSelected()
    {
        return !empty($_FILES);
    }

    public function backup()
    {
        if (!file_exists($this->backup_dir)) {
            mkdir($this->backup_dir);
        }
        $upload_files = scandir($this->upload_dir);
        foreach ($upload_files as $filename) {
            if ($filename !== "." && $filename !== "..") {

                $age = time() - filectime("$this->upload_dir/$filename");
                if ($age > $this->expairs) {
                    rename("$this->upload_dir/$filename", "$this->backup_dir/$filename");
                }
            }
        }
    }
}