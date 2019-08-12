<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $order app\models\SubmitOrderForm */
$deliversList = app\models\SubmitOrderForm::getDelivers();
?>
<div class="">
    <p>Привіт!</p>

    <p>Нове замовлення на сайті <?= Html::a(Yii::$app->name, Url::base(TRUE)) ?></p>

    <label>Email</label>&nldr;<span><?= $order->email ?></span><hr>
    <label>ПІБ</label>&nldr;<span><?= $order->name ?></span><hr>
    <label>Телефон</label>&nldr;<span><?= $order->phone ?></span><hr>
    <label>Тип доставки</label>&nldr;<?= $deliversList[$order->delivery] ?><hr>
    <label>Загальна вартість</label>&nldr;<?= $order->order->totalPrice ?><hr>
    <label>Коментар</label>&nldr;<p><?= $order->comment ?></p><hr>
    
    <table class="table">
        <?php foreach ($order->order->cartItems as $item) { ?>
            <tr>
                <td>
                    <img src="<?= Url::base(TRUE) . $item->item->getImageUrl(true) ?>">
                </td>
                <td>
                    <label><?= Html::a(Html::encode($item->item->title), ['/site/view', 'id' => $item->item->id]) ?></label>
                </td>
                <td>
                    <label><?= $item->price->volume ?></label>
                </td>
                <td>
                    <label><?= $item->price->price ?>&nbsp; &#x20b4</label>
                </td>
                <td>
                    <label><?= $item->count ?></label>
                </td>
            </tr>
        <?php } ?>
    </table>
    <span><?= Yii::$app->formatter->asDatetime(time()) ?>&nbsp; &#x20b4</span>
</div>