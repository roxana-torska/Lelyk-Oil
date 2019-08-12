<?php

namespace app\models;

use Yii;


class Cart extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%cart}}';
    }

    public function rules()
    {
        return [
            [['coockie'], 'required'],
            [['coockie'], 'string', 'max' => 255],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'coockie' => Yii::t('app', 'Coockie'),
        ];
    }


    public function getCartItems()
    {
        return $this->hasMany(CartItems::className(), ['cart_id' => 'id']);
    }
    
    public function getTotalPrice() {
        $price = 0;
        foreach ($this->cartItems as $item) {
            $price += $item->totalPrice;
        }
        return number_format($price, 2, '.', '');
    }
}
