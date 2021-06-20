<?php

use Core\Helper;

$customer = Helper::getCustomer();
?>

<?php if ($customer):?>
<h3>Hello, <?php echo $customer['first_name']?></h3>
<?php else: ?> 
<h3>Hello, unauthorized user!</h3>
<?php endif ?>
<?php echo "hello"; ?>


