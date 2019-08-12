<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $item app\models\Items */
?>
<!-- Вибір тари -->

<select class="form-control volume-select vol-sel">
    <?php foreach ($item->prices as $price) { ?>
        <option value="<?= $price->id ?>"><?= $price->volume . ' мл' . ' - ' . $price->price . ' &#x20b4;' ?></option>
    <?php } ?>
</select>

<!-- Додавання в кошик -->
<input 
    type="number" 
    class="add-oil-to-cart-number oil-number" 
    min="1" 
    max="<?= \Yii::$app->params['max_card_click'] ?>" 
    value="1">
<button 
    class="add-oil-to-cart-button oil-btn btn btn-sm btn-primary" 
    data-item-id="<?= $item->id ?>"
    data-url="<?= Url::to(['/site/add-to-cart']) ?>"
    data-success-message="<?= Yii::t('app', 'Товар додано до кошика') ?>"
    data-error-message="<?= Yii::t('app', 'Помилка додавання товару') ?>">
        <?= Yii::t('app', ' Додати в кошик ') ?>
</button>
