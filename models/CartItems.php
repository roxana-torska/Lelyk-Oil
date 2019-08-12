<?php

namespace app\models;

use Yii;


class CartItems extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%cart_items}}';
    }


    public function rules()
    {
        return [
            [['cart_id', 'item_id'], 'required'],
            [['cart_id', 'item_id', 'count'], 'integer'],
            [['cart_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cart::className(), 'targetAttribute' => ['cart_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['price_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prices::className(), 'targetAttribute' => ['price_id' => 'id']],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cart_id' => Yii::t('app', 'Cart ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'price_id' => Yii::t('app', 'Price ID'),
            'count' => Yii::t('app', 'Count'),
        ];
    }


    public function getCart()
    {
        return $this->hasOne(Cart::className(), ['id' => 'cart_id']);
    }


    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }

    public function getPrice()
    {
        return $this->hasOne(Prices::className(), ['id' => 'price_id']);
    }

    public function getTotalPrice() {
        $total = $this->price->price * $this->count;
        return number_format($total, 2, '.', '');
    }
}
