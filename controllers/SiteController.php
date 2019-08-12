<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Items;
use app\models\Prices;
use app\models\SubmitOrderForm;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add-to-cart' => ['post'],
                    'cart-set-item-count' => ['post'],
                    'cart-delete-item' => ['post'],
                ],
            ],
        ];
    }


    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        $items = Items::find()->with('prices')->all();
        return $this->render('index', ['items' => $items]);
    }


    public function actionView(int $id) {
        $item = Items::find()->where(['id' => $id])->with('prices')->one();
        return $this->render('view', ['item' => $item]);
    }


    public function actionContact() {
        return $this->render('contact');
    }


    public function actionAbout() {
        return $this->render('about');
    }

    public function actionCart() {

        $order = Yii::$app->cart->order;
        $model = new SubmitOrderForm($order);
        return $this->render('cart', ['model' => $model]);
    }

    public function actionSubmitOrder() {
        $order = Yii::$app->cart->getOrder(false);
        if (!$order) {
            throw new \yii\web\NotFoundHttpException('No order found!');
        }

        
        $model = new SubmitOrderForm($order);
        $items = $model->order->cartItems;
        if (count($items) <= 0) {
            throw new \yii\web\NotFoundHttpException('No items in order!');
        }

        $model->load(\Yii::$app->request->post());
        if ($model->submit()) {
            Yii::$app->getSession()->setFlash('success', [
                'type' => 'success',
                'icon' => 'fa fa-check-circle',
                'message' => Yii::t('app', 'Замовлення відправлено успішно!'),
            ]);
            $this->goHome();
        } else {
            Yii::$app->getSession()->setFlash('error', [
                'type' => 'danger',
                'icon' => 'fa fa-times',
                'message' => Yii::t('app', 'Помилка при відправленні замовлення'),
            ]);
            $this->redirect(['/site/cart']);
        }
    }


    public function actionAddToCart() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $itemId = \Yii::$app->request->post('itemId'); 
        $priceId = \Yii::$app->request->post('priceId'); 
        $count = \Yii::$app->request->post('count'); 
        $price = Prices::find()->where(['id' => $priceId, 'item_id' => $itemId]);

        if (!$price || $count > \Yii::$app->params['max_card_click']) {
            $result = false;
        } else {
            $result = Yii::$app->cart->add($itemId, $priceId, $count);
        }
        return ['success' => $result, 'newCount' => Yii::$app->cart->itemsCount];
    }
    
   
    public function actionCartSetItemCount()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;        
        $itemId = \Yii::$app->request->post('itemId');
        $priceId = \Yii::$app->request->post('priceId');
        $count = \Yii::$app->request->post('count');
        
       
        if ($count > \Yii::$app->params['max_card_items']) {
            $result = false;
        } else {
            $result = Yii::$app->cart->setCount($itemId, $priceId, $count);
        }
        return ['success' => $result];
    }
    
   
    public function actionCartDeleteItem()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $itemId = \Yii::$app->request->post('itemId'); 
        $priceId = \Yii::$app->request->post('priceId');
        $result = Yii::$app->cart->delete($itemId, $priceId);
        return ['success' => $result];
    }

}
