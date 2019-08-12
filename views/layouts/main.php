<?php


use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
    <?php $this->beginPage() ?>


    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?= Html::csrfMetaTags() ?>

            <?php 
        $controller = Yii::$app->controller;
        $isHome = (($controller->id === 'site') && ($controller->action->id === 'index')) ? true : false;
    ?>
            <title>
                <?= ($isHome ? "" : (Html::encode($this->title) . " - ")) . Yii::$app->name ?>
            </title>

            <?php $this->head() ?>

            <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
            <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
            <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
            <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>


    </head>

    <body id="page-top" class="index">
        <div class="page-wrapper">
            <?php $this->beginBody() ?>



            <?= $this->render('@app/views/layouts/_header'); ?>

                <div class="main">
                    <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                        <?= $content ?>
                </div>
                <div class="page-buffer"></div>
        </div>
        <div class="page-footer">
            <?= $this->render('@app/views/layouts/_footer'); ?>
        </div>

        <?php $this->endBody() ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

    </body>

    </html>
    <?php $this->endPage() ?>
