<?php

namespace app\components;

use app\models\Items;
use app\models\Cart;
use app\models\CartItems;
use Yii;


class CartComponent extends \yii\base\Component {

    const COOCKIE_NAME = 'cart_identity'; 

    private $_order; 



    public function createOrder() {
        $order = new Cart();


        $coockieValue = md5(uniqid(rand(), true));

        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => self::COOCKIE_NAME,
            'value' => $coockieValue,
            'expire' => strtotime("+1 year")
        ]));

        $order->coockie = $coockieValue;


        if ($order->save()) {
            $this->_order = $order;
            return true;
        }
        return false;
    }


    public function getOrder(bool $create = true) {
   
        if ($this->_order != null) {
            return $this->_order;
        }

    
        $coockieHash = Yii::$app->request->cookies->get(self::COOCKIE_NAME);
        if ($coockieHash) {
            $order = Cart::find()->where(['coockie' => $coockieHash])->one();
        }


        if (isset($order)) {
            $this->_order = $order;
            return $this->_order;
        }


        if ($create) {
            $this->createOrder();
        }
        return $this->_order;
    }


    public function add(int $itemId, int $priceId, int $count) {
        if ($count <= 0) {
            throw new \yii\web\ServerErrorHttpException('Item count must be 1 or more');
        }

        $link = CartItems::findOne([
                    'item_id' => $itemId,
                    'price_id' => $priceId,
                    'cart_id' => $this->order->id
        ]);


        if (!$link) {
            $link = new CartItems();
        }

        $item = Items::findOne($itemId);
        if (!$item) {
            throw new \yii\web\NotFoundHttpException('Item not found');
        }

        $link->item_id = $itemId;
        $link->cart_id = $this->order->id;
        $link->price_id = $priceId;

        $link->count += $count;

        if ($link->count > \Yii::$app->params['max_card_items'] || $link->count < 0) {
            throw new \yii\web\ForbiddenHttpException('Items count too large');
        }

        $result = $link->save();
        return $result;
    }

    public function delete(int $itemId, int $priceId) {
        $link = CartItems::findOne([
                    'item_id' => $itemId,
                    'cart_id' => $this->order->id,
                    'price_id' => $priceId
        ]);
        if (!$link) {
            return false;
        }
        return $link->delete();
    }


    public function setCount(int $itemId, int $priceId, int $count) {
        if ($count <= 0) {
            throw new \yii\web\ServerErrorHttpException('Items count must be 1 or more');
        }

        if ($count > \Yii::$app->params['max_card_items']) {
            throw new \yii\web\ForbiddenHttpException('Items count too large');
        }

        $link = CartItems::findOne([
                    'item_id' => $itemId,
                    'price_id' => $priceId,
                    'cart_id' => $this->order->id
        ]);
        if (!$link) {
            return false;
        }
        
        $item = Items::findOne($itemId);
        if (!$item) {
            throw new \yii\web\NotFoundHttpException('Item not found');
        }
        $link->count = $count;

        return $link->save();
    }


    public function getItemsCount() {
        $order = $this->getOrder(false);

        if (!$order) {
            return 0;
        }

        $sum = $order->getCartItems()->sum('count');
        return $sum ?? 0;
    }

}
