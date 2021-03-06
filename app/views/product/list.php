<?php 
    use Core\Helper;

    $sortfirst = Helper::getFilterOrCookie(INPUT_POST, 'sortfirst');
    $sortsecond = Helper::getFilterOrCookie(INPUT_POST, 'sortsecond');
?>

<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
    <select name='sortfirst'>
        <option <?php echo $sortfirst === 'price_ASC' ? 'selected' : ''; ?> value="price_ASC">від дешевших до дорожчих</option>
        <option <?php echo $sortfirst === 'price_DESC' ? 'selected' : ''; ?> value="price_DESC">від дорожчих до дешевших</option>
    </select>
    <select name='sortsecond'>
        <option <?php echo $sortsecond  === 'qty_ASC' ? 'selected' : ''; ?> value="qty_ASC">по зростанню кількості</option>
        <option <?php echo $sortsecond  === 'qty_DESC' ? 'selected' : ''; ?> value="qty_DESC">по спаданню кількості</option>
    </select>
    <br>
    Ціна від: <input type="number" value="<?php echo $this->get('minprice') ?>" min="0" step="0.01" name="minprice"> 
    Ціна до: <input type="number" value="<?php echo $this->get('maxprice') ?>" min="0" step="0.01" name="maxprice"> 
    <br>
    <input type="submit" value="submit">
</form>

<div class="product">
    <p>
        <?= \Core\Url::getLink('/product/add', 'Додати товар'); ?>
    </p>
</div>

<?php


$products =  $this->get('products');

foreach ($products as $product) :
?>

    <div class="product">
        <p class="sku">Код: <?php echo $product['sku'] ?></p>
        <h4><?php echo $product['name'] ?></h4>
        <p> Ціна: <span class="price"><?php echo $product['price'] ?></span> грн</p>
        <p> <?php
            if ($product['qty'] > 0) {
                echo 'Кількість: ' . $product['qty'];
            } else {
                echo 'Нема в наявності';
            }
            ?></p>
        <?php if (Helper::isAdmin()) : ?>
            <?= \Core\Url::getLink('/product/edit', 'Редагувати', array('id' => $product['id'])); ?>
            </p>
            <p>
                <?= \Core\Url::getLink('/product/delete', 'Вилучити', array('id' => $product['id'])); ?>
            </p>
        <?php endif ?>
        <p>
            <?= \Core\Url::getLink('/product/view', 'Деталі', array('id' => $product['id'])); ?>
        </p>
    </div>
<?php endforeach; ?>