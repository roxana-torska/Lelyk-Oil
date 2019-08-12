<?php

namespace app\assets;

use yii\web\AssetBundle;

class TemplateAsset extends AssetBundle
{
    public $basePath = '@webroot/template';
    public $baseUrl = '@web/template';
    public $css = [
        'css/agency.min.css',        
        
    ];
    public $js = [
        'js/agency.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'kartik\growl\GrowlAsset',
    ];
}
