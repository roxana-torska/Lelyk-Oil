<?php

/* @var $this yii\web\View */
/* @var $model \app\models\SubmitOrderForm */

$this->title = Yii::t('app', 'Оформлення замовлення');
$this->params['breadcrumbs'][] = $this->title;

$items = $model->order->cartItems;

?>
<div class="container cart-container">
    <div class="row mist">
        <?php if (count($items) > 0) { ?>
            <?= $this->render('_allItems', ['items' => $items]) ?>

            <hr>
        <span class="together">
           <label><?= Yii::t('app', 'Разом:') ?></label>
        </span>
            <span class="together"><?= $model->order->totalPrice ?>&nbsp; &#x20b4</span>
            <hr>
            
 
            <?= $this->render('_submitOrderForm', ['model' => $model]) ?>
        <?php } else { ?>
            <h1><?= Yii::t('app', 'Кошик порожній') ?></h1>
        <?php } ?>
    </div>
</div>
