<?php

use Core\Helper;

if (Helper::isAdmin()) : ?>
    Збережено до файлу "public/products.xml"

    <?php
    $file = 'public/products.xml';

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
    }
    ?>
<?php else : ?>
    <h4> Тільки з правами адміністратора </h4>
<?php endif ?>