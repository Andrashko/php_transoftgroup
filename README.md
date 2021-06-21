# php_transoftgroup
Transoftgroup  PHP courses tasks solutions
Розвязок завдань:


Розділ 7 Об'єктно орієнтоване програмування

Виконати задачі попереднього розділу 6 використавши ООП. Створіть свій клас і відповідні методи та реалізуйте виконання задач через створення об'єкту та виклик методів.

Розділ 6 Робота з файлами

1. Скопіюйте у директорію upload проекту більше файлів так щоб були файли за різні дати. Модифікуйте скрипт так, щоб він перевіряв чи існує, і якщо ні, то створював каталог backup. Допишіть код, який буде усі файли, створені раніше ніж 3 дні назад переміщвати у папку backup.
2. Напишіть блок коду, який видалить у папці upload всі файли з розширенням ".txt", які містять в середині слово "тест".
3. Напишіть скрипт, який зчитає текстовий файл source.txt та створить і запише файл dest.txt У новому файлі усі слова (розділені пробілами та переносами рядків) повинні бути записані із заду на перед.


Розділ 9 Робота з базами даних
1. Завантажити проект MVC
public/phpmvc.zip
2. Додати таблицю menu в свою базу даних:
3. Реалізувати сортування товарів.
4. Створити контролер, модель та представлення для відображення клієнтів.
Для моделі клієнтів створити таблицю та вручну ввести декілька записів.
5. Реалізувати методи додавання нового товара, редагування та видалення товара. Створити відповідні представлення.

Розділ 10 Особливості web-програмування в PHP
Задачі
1. Для добавлення та редагування товара:
фільтрувати небажаний HTML для текстових полів, щоб ціна та кількість були типу float.
2. Додати поле в таблицю products:
Включити це поле в методи редагування, додавання товара та перегляду товара по ID так, щоб при збереженні в базу записувався текст закодований htmlspecialchars, а при відображенні розкодовувався.
3. На сторінці списку товарів, додати фільтр за ціною та реалізувати фільтрацію. По замовчуванню, значення "ціна до" повинно дорівнювати максимальній ціні товара:
1. Змініть таблицю customer в БД test_shop, щоб вона мала таку структуру наведену нижче. Поки не реалізована реєстрація, заведіть вручну користувача. Пароль слід завести за допомогою функції md5('password');
2. Реалізувати наступні методи в проекті PhpMVC.
3. Змініть представлення для меню, щоб воно виглядало, як на наступних зоображеннях відповідно при неавторизованому користувачу та при авторизованому
1. Змінити метод ProductController::getSortParams() так, щоб він посилав/зчитував куку та при наступному заходженні у список товарів використовував збережений у куці спосіб сортування.
2. Реалізувати реєстрацію нового користувача. Для валідації даних на початковому етапі такі умови: всі поля непорожні, правильний емейл, співпадіння пароля та підтвердження.
3. Для реєстрації користувача здійснити фільтрацію, що очищає введення небажаного HTML коду, перевіряє валідність емейла(хто ще не зробив), та перевіряє, щоб пароль мав не менше 8 символів та обов'язково мав і букви і цифри, і лише цифри та англійські букви.

Розділ 11 Безпека
1. Додати поле в таблицю customer:Написати метод Helper::isAdmin(), який буде перевіряти чи поточний користувач має права адміністратора ( admin_role=1). Редагування, додавання та видалення товару зробити доступним лише для адміністратора.
2. У всіх медодах, які викликають$db->query(), передавати псевдопараметри та масив параметрів для використання PDO Prepared Statement(addItem(),saveItem(),deteteItem() та ін.)

Розділ 12 Робота з XML

Додати меню "Експорт в Xml" та реалізувати метод експорту товарів в xml файл. Метод зробити доступним для адміністратора.
