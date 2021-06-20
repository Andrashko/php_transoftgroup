<div class="product">
    <p>
        <?= \Core\Url::getLink('/product/list', 'Повернутись до списку товарів'); ?>
    </p>
</div>

<h3> Картка товару </h3>

<?php
$product =  $this->get('product');
?>

<?php if ($product) : ?>
    <div class="product">
        <p class="sku">Код: <?php echo $product['sku'] ?></p>
        <h4><?php echo $product['name'] ?></h4>
        <p> Ціна: <span class="price"><?php echo $product['price'] ?></span> грн</p>
        <p> <?php 
            if (!$product['qty'] > 0){
                echo 'Кількість: '.$product['qty']; 
            } else {
                echo 'Нема в наявності';
            }
        ?></p>
        <p> <?php
            echo $product["description"];
            ?></p>
        <?= \Core\Url::getLink('/product/edit', 'Редагувати', array('id' => $product['id'])); ?>
        </p>
        <p>
            <?= \Core\Url::getLink('/product/delete', 'Вилучити', array('id' => $product['id'])); ?>
        </p>
    </div>
<?php else : ?>
    <p>
        Товару з id в базі даних відсутній
    </p>
<?php endif; ?>