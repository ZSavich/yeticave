<nav class="nav">
    <ul class="nav__list container">
        <li class="nav__item">
            <a href="all-lots.html">Доски и лыжи</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Крепления</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Ботинки</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Одежда</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Инструменты</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Разное</a>
        </li>
    </ul>
</nav>
<?php if(count($errors)): ?>
    <form class="form form--add-lot container form--invalid" action="add.php" method="post" enctype="multipart/form-data">
<?php else: ?>
    <form class="form form--add-lot container" action="add.php" method="post" enctype="multipart/form-data">
<?php endif; ?>
        <h2>Добавление лота</h2>
        <div class="form__container-two">
            <?php if(!isset($errors['lot-name'])): ?>
                <div class="form__item"> <!-- form__item--invalid -->
            <?php else: ?>
                <div class="form__item form__item--invalid"> <!-- form__item--invalid -->
            <?php endif; ?>
                    <label for="lot-name">Наименование</label>
                    <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=$_POST['lot-name']?>">
                    <span class="form__error">Введите наименование лота</span>
                </div>
                <?php if(!isset($errors['category'])): ?>
                    <div class="form__item">
                <?php else: ?>
                    <div class="form__item form__item--invalid">
                <?php endif; ?>
                        <label for="category">Категория</label>
                        <select id="category" name="category" >
                            <option>Выберите категорию</option>
                            <option>Доски и лыжи</option>
                            <option>Крепления</option>
                            <option>Ботинки</option>
                            <option>Одежда</option>
                            <option>Инструменты</option>
                            <option>Разное</option>
                        </select>
                        <span class="form__error">Выберите категорию</span>
                    </div>
                </div>
                <?php if(!isset($errors['message'])): ?>
                    <div class="form__item form__item--wide">
                <?php else: ?>
                        <div class="form__item form__item--wide form__item--invalid">
                <?php endif; ?>
                        <label for="message">Описание</label>
                        <textarea id="message" name="message" placeholder="Напишите описание лота"><?=$_POST['message'];?></textarea>
                        <span class="form__error">Напишите описание лота</span>
                    </div>
                    <div class="form__item form__item--file"> <!-- form__item--uploaded -->
                        <label>Изображение</label>
                        <div class="preview">
                            <button class="preview__remove" type="button">x</button>
                            <div class="preview__img">
                                <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
                            </div>
                        </div>
                        <div class="form__input-file">
                            <input class="visually-hidden" type="file" name="lot-photo" id="photo2" value="">
                            <label for="photo2">
                                <span>+ Добавить</span>
                            </label>
                        </div>
                    </div>
                    <div class="form__container-three">
                        <?php if(!isset($errors['lot-rate'])): ?>
                            <div class="form__item form__item--small">
                        <?php else: ?>
                            <div class="form__item form__item--small form__item--invalid">
                        <?php endif; ?>
                                <label for="lot-rate">Начальная цена</label>
                                <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?=$_POST['lot-rate'];?>">
                                <span class="form__error">Введите начальную цену</span>
                            </div>
                        <?php if(!isset($errors['lot-step'])): ?>
                            <div class="form__item form__item--small">
                        <?php else: ?>
                            <div class="form__item form__item--small form__item--invalid">
                        <?php endif; ?>

                                <label for="lot-step">Шаг ставки</label>
                                <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?=$_POST['lot-step'];?>">
                                <span class="form__error">Введите шаг ставки</span>
                             </div>
                        <?php if(!isset($errors['lot-date'])): ?>
                            <div class="form__item">
                        <?php else: ?>
                            <div class="form__item form__item--invalid">
                        <?php endif; ?>

                                <label for="lot-date">Дата окончания торгов</label>
                                <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?=$_POST['lot-date'];?>">
                                <span class="form__error">Введите дату завершения торгов</span>
                            </div>
                    </div>
            <?php if(count($errors)) {
                foreach($errors as $key => $value) {
                    $message = $message . "<br><b>" . $dis[$key] . "</b> - " . $value;
                }
            } ?>
            <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме: <?=$message;?></span>
            <button type="submit" class="button">Добавить лот</button>
        </form>