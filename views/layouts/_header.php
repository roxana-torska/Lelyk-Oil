<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>



    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container"> 
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Навігація</span> Меню 
                </button>
                <span class="company-name"><?= Html::a(Yii::t('app', 'Всім оліям Олія'), Url::home(true), ['class' => 'navbar-brand page-scroll']) ?></span>
            </div>
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                       <?= Html::a(Yii::t('app', 'Головна'), Url::home(true), ['class' => 'page-scroll'])?>
                    </li>
                    <li class="cart-position">
                        <a class="page-scroll" href=""><?= Html::a(Yii::t('app', 'Кошик'), ['/site/cart']) ?>
                        <?= Html::tag('span', Yii::$app->cart->itemsCount, ['class' => 'badge', 'id' => 'card-count-badge']) ?>
                        
                        
                        <?= $this->render('_flashMessages') ?></a>
                    </li>
                </ul>
            </div>
            
        </div>
        
    </nav>

