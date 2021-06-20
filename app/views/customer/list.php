<?php

$customers =  $this->get('customers');

foreach ($customers  as $customer) :
?>

    <div class="customer">
        <h4 class="name">            
            <?php echo $customer['first_name'] . "  " . $customer['last_name'] ?>
        </h4>
        <p> Телефон: <?php echo $customer['telephone'] ?></p>
        <p> Пошта: <?php echo $customer['email'] ?></p>
        <p> Місто: <?php echo $customer['city'] ?></p>
    </div>
<?php endforeach; ?>