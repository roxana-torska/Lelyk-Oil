<?php

namespace app\models;

use yii\base\Model;
use Yii;

class SubmitOrderForm extends Model {

    const DELIV_NP = 'np';
    const DELIV_UKRPOST = 'ukrpost';
    const DELIV_SAM = 'sam';


    private $_order;
    public $email;
    public $name;
    public $phone;
    public $delivery;
    public $comment;
    public $captcha;

    public function __construct(\app\models\Cart $order, $config = []) {
        if (empty($order)) {
            throw new InvalidParamException('Order not found');
        }
        $this->_order = $order;
        parent::__construct($config);
    }


    public function rules() {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required'],
            ['phone', 'filter', 'filter' => 'trim'],
            ['phone', 'required'],
            ['comment', 'filter', 'filter' => 'trim'],
            [['comment'], 'string', 'max' => 1000],
            ['delivery', 'required'],
            ['delivery', 'in', 'range' => [self::DELIV_NP, self::DELIV_SAM, self::DELIV_UKRPOST]],
            ['captcha', 'required'],
            ['captcha', 'captcha'],
        ];
    }


    public function attributeLabels() {
        return [
            'email' => Yii::t('app', 'Email'),
            'name' => Yii::t('app', 'Ім\'я'),
            'phone' => Yii::t('app', 'Телефон'),
            'comment' => Yii::t('app', 'Коментар'),
            'delivery' => Yii::t('app', 'Доставка'),
            'captcha' => Yii::t('app', 'Капча'),
        ];
    }


    public function getOrder() {
        return $this->_order;
    }


    public static function getDelivers() {
        return [
            self::DELIV_NP => Yii::t('app', 'Нова Пошта'),
            self::DELIV_SAM => Yii::t('app', 'Самовивіз'),
            self::DELIV_UKRPOST => Yii::t('app', 'Укрпошта')
        ];
    }


    public function submit() {
        if ($this->validate()) {
            

            $usermailresult = Yii::$app->mailer->compose([
                        'html' => 'html/orderSighnup-html',
                        'text' => 'text/orderSighnup-text'
                            ], ['order' => $this])
                    ->setFrom([Yii::$app->params['robotEmail'] => Yii::$app->name])
                    ->setTo($this->email)
                    ->setSubject(Yii::t('app', 'Ваше замовлення з сайту') . " " . Yii::$app->name)
                    ->send();

            $adminmailResult = Yii::$app->mailer->compose([
                        'html' => 'html/orderSighnupAdmin-html',
                        'text' => 'text/orderSighnupAdmin-text'
                            ], ['order' => $this])
                    ->setFrom([Yii::$app->params['robotEmail'] => Yii::$app->name])
                    ->setTo(Yii::$app->params['ordersEmail'])
                    ->setSubject(Yii::t('app', 'Нове замовлення на сайті') . " " . Yii::$app->name)
                    ->send();

            $this->order->delete();

            return $usermailresult && $adminmailResult;
        }
        return false;
    }

}
