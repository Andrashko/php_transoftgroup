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
    <?php if ($this->get("invalid_password")) : ?>
        <p> Логін або пароль невірні </p>
    <?php endif ?>
    </br>
    <input type="submit" value="Увійти">
</form>