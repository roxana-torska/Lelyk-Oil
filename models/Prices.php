<?php

namespace app\models;

use Yii;


class Prices extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%price}}';
    }


    public function rules()
    {
        return [
            [['item_id', 'volume', 'price'], 'required'],
            [['item_id', 'volume'], 'integer'],
            [['price'], 'number'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'volume' => Yii::t('app', 'Об\'єм'),
            'price' => Yii::t('app', 'Ціна'),
        ];
    }

    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }
}
