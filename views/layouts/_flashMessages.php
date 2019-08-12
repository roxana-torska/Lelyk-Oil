<div id="flashMessagesContainer">

<?php 

use yii\helpers\Html;
use kartik\growl\Growl;

foreach (Yii::$app->session->getAllFlashes() as $message) {
    echo Growl::widget([
    'type' => (!empty($message['type'])) ? $message['type'] : Growl::TYPE_GROWL,
    'title' => (!empty($message['title'])) ? Html::encode($message['title']) : " ",
    'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
    'body' => (!empty($message['message'])) ? Html::encode($message['message']) : Yii::t('app', 'No message'),
    'showSeparator' => true,
    'options' => [
        'class' => 'super-top'
    ],
    'delay' => Yii::$app->request->isAjax ? 1 : 300, 
    'pluginOptions' => [
        'delay' => (!empty($message['duration'])) ? $message['duration'] : 25000, 
        'placement' => [
            'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
            'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
        ]
    ],
]);
} ?>
</div>