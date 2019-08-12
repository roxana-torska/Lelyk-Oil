<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\SubmitOrderForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\SubmitOrderForm */

$form = ActiveForm::begin([
            'action' => ['/site/submit-order'],
        ]);
?>
<?= $form->field($model, 'email')->input('email') ?>
<?= $form->field($model, 'name')->textInput() ?>
<?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '(999)-999-99-99',
    'clientOptions' => [
        'clearIncomplete'=>true
    ]
]) ?>
<?= $form->field($model, 'delivery')->dropDownList(SubmitOrderForm::getDelivers(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Виберіть...')]) ?>
<?= $form->field($model, 'comment')->textarea(['maxlength' => true, 'rows' => 8]) ?>

<!-- Капча -->
<?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname()); ?>
<hr>
<?= Html::submitButton(Yii::t('app', 'Оформити замовлення'), ['class' => 'btn btn-primary btn-lg center-block']) ?>
<?php ActiveForm::end(); ?>