<form enctype="multipart/form-data" action="/file" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
    Завантажити файл: <br><br>
    <input name="filename" type="file"><br><br>
    <input type="submit" value="Завантажити"><br><br>
</form>

<?php 
    echo $this->get("images");
?>