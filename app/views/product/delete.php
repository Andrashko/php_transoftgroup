<div class="product">
    <p>
        <?= \Core\Url::getLink('/product/list', 'Повернутись до списку товарів'); ?>
    </p>
</div>

<h3> Вилучення товару </h3>


<?php
$product =  $this->get('product');
?>

<?php if ($product) : ?>
    <div class="product">
        <p> Ви справді бажаєте вилучити <?php echo $product['name'] ?>?</p>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <input name="id" type="hidden" value="<?php echo $product['id']?>">
            <input type="submit" value="Вилучити">
        </form>
    </div>
<?php else : ?>
    <p>
        Товару з id в базі даних відсутній
    </p>
<?php endif; ?>