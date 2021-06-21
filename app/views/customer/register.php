<?php 
    $validation_errors = $this->get("validation_errors");
?>

<?php if (count($validation_errors)>0): ?>
    <?php foreach($validation_errors as $error) :?>
        <p class="error"> <?php echo $error ?> </p>
    <?php endforeach ?>
<?php endif ?>

<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
    <label>
        Пошта
        <input name="email" required>
    </label>
    </br>
    <label>
        Пароль
        <input name="password" required>
    </label>
    </br>
    <label>
        Підтвердити пароль
        <input name="password2" required>
    </label>
    </br>
    <label>
        Прізвище
        <input name="second_name" required>
    </label>
    </br>
    <label>
        Імя
        <input name="first_name" required>
    </label>
    </br>
    <label>
        Телефон
        <input name="telephone" required>
    </label>
    </br>
    <label>
        Місто
        <input name="city" required>
    </label>
    </br>
    <input type="submit" value="Зареєструватися">
</form>