<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $items \app\models\CartItems[] */
?>

    <div class="order-items-container">
        <!-- Готові товари -->
        <div id="order-items oil-decoration">
                <?php foreach ($items as $item) { ?>
                

                
                
                <div class="row">
                        
                        

                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 col-char">
                            <img class="img-responsive" src="<?= $item->item->getImageUrl(true) ?>">
                        </div>
                        
                        <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-char">
                          
                          <p class="oil-name oil-decoration"><label><?= Html::a($item->item->title, ['/site/view', 'id' => $item->item->id]) ?></label></p>
                           
                           
                            <table>
                              <tr>
                                <th><label>Об'єм</label></th>
                                <th><label><?= $item->price->volume ?> мл</label></th>
                              </tr>
                              <tr>
                                <th><label>Ціна</label></th>
                                <th><label><?= $item->price->price ?>&nbsp; &#x20b4</label></th>
                              </tr>
                              <tr>
                                <th><label>Кількість</label></th>
                                <th><label><?= $item->count ?> шт</label></th>
                              </tr>
                              <tr>
                                <th><input class="qa"
                                type="number" 
                                min="1" 
                                max="<?= \Yii::$app->params['max_card_items'] ?>" 
                                value="<?= $item->count ?>"></th>
                                <th><button 
                                class="card-change-item-count-button btn one-more-btn btn-sm btn-success" 
                                data-item-id="<?= $item->item->id ?>"
                                data-price-id="<?= $item->price->id ?>"
                                data-url="<?= Url::to(['/site/cart-set-item-count']) ?>"
                                data-error-message="<?= Yii::t('app', 'Помилка додавання товару') ?>">
                                    <?= Yii::t('app', 'Змінити кількість') ?>
                            </button></th>
                              </tr>
                              <tr>
                                <th><label>Вартість</label></th>
                                <th><label><?= $item->totalPrice ?>&nbsp; &#x20b4</label></th>
                              </tr>
                              <tr>
                               <th></th>
                                <th ><button 
                                class="card-delete-item-button btn btn-sm btn-danger" 
                                data-item-id="<?= $item->item->id ?>"
                                data-price-id="<?= $item->price->id ?>"
                                data-url="<?= Url::to(['/site/cart-delete-item']) ?>"
                                data-error-message="<?= Yii::t('app', 'Помилка видалення') ?>">
                                    <?= Yii::t('app', 'Видалити') ?>
                            </button></th>
                                
                              </tr>
                            </table> 
                 </div>            
                 </div>            
                 </div>            
                        
                <?php } ?>
            
       
    </div>
    </div>


