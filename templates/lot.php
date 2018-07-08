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
<section class="lot-item container">
    <?php if(isset($ad)): ?>
    <h2><?=esc($ad['name']);?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src="<?=$ad['image'];?>" width="730" height="548" alt="Сноуборд">
            </div>
            <p class="lot-item__category">Категория: <span><?=$ad['category_id'];?></span></p>
            <p class="lot-item__description"><?=esc($ad['description']);?></p>
        </div>
        <div class="lot-item__right">
            <?php if(isset($_SESSION['user'])): ?>
            <div class="lot-item__state">
                <div class="lot-item__timer timer">
                    <?=format_data($ad['lot-date']);?>
                </div>
                <div class="lot-item__cost-state">
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost"><?=format_price($ad['price']);?></span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?=$ad['step']?> р</span>
                    </div>
                </div>
                <form class="lot-item__form" action="lot.php?id=<?=$_GET['id'];?>" method="post">
                    <p class="lot-item__form-item">
                        <label for="cost">Ваша ставка</label>
                        <input id="cost" type="number" name="cost" placeholder="<?=$ad['lot-step']?>">
                    </p>
                    <button type="submit" class="button">Сделать ставку</button>
                </form>
            </div>
            <?php endif;?>
            <div class="history">
                <h3>История ставок (<span>10</span>)</h3>
                <table class="history__list">
                    <?php foreach($bets as $bet): ?>
                    <tr class="history__item">
                        <td class="history__name"><?=$bet['name'];?></td>
                        <td class="history__price"><?=$bet['value'];?> р</td>
                        <td class="history__time"><?=date('i',$bet['create_date']);?> минут назад</td>
                    </tr>
                    <? endforeach;?>
                </table>
            </div>
        </div>
    </div>
    <?php else: ?>
    <h2>Лот не найден</h2>
    <?php endif; ?>
</section>