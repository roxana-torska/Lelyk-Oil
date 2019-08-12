<?php

namespace app\models;

use Yii;

class Items extends \yii\db\ActiveRecord
{
 
    public static function tableName()
    {
        return '{{%items}}';
    }


    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['title', 'image'], 'string', 'max' => 255],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Назва'),
            'image' => Yii::t('app', 'Зображення'),
            'description' => Yii::t('app', 'Опис'),
        ];
    }

    public function getCardItems()
    {
        return $this->hasMany(CardItems::className(), ['item_id' => 'id']);
    }


    public function getPrices()
    {
        return $this->hasMany(Prices::className(), ['item_id' => 'id'])->orderBy(['volume' => SORT_ASC]);
    }

    public function getImageUrl(bool $thumb = false) {
        $cat = Yii::$app->params[$thumb ? 'images_thumbs_cat' : 'images_cat'];
        return $cat . $this->image;
    }
}
