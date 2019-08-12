<?php
/* @var $this yii\web\View */
/* @var $items app\models\Items[] */
?>
<div class="site-index" id="main">
   
    <div class="banner">
       <div class="header-img">
            <div class="container header">
                <div class="intro-text">
                    <div class="intro-lead-in">Якийсь текст</div>
                    <div class="intro-heading">Головний слоган</div>
                </div>
            </div>
        </div>
    </div>
   
    <!-- Zajebis Section -->
    <section id="services" class="back-color">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Заєбісь</h2>
                    <h3 class="section-subheading text-muted">Чому у нас заєбісь</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <img id="" class="img img-responsive oil-flover grow" src="/img/oil.jpg"/>
                    <h4 class="service-heading">Заєбісь 1</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                    <img id="" class="img img-responsive oil-flover grow" src="/img/oil.jpg"/>
                    <h4 class="service-heading">Заєбісь 2</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                   <img id="" class="img img-responsive oil-flover grow" src="/img/oil.jpg"/>
                    <h4 class="service-heading">Заєбісь 3</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
            </div>
        </div>
    </section>
       

   
       <div class="">
            <ul class="list-unstyled">
            <?php foreach ($items as $item) { ?>
                <li class="">
                <?= $this->render('_item', ['item' => $item]) ?>
                </li>    
            <?php } ?>
            </ul>
        </div>
    

    
    <!-- AboutUs Section -->
    <section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row int-char">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Про нас</h2>
                </div>
            </div>
            <div class="row int-char">
                <div class="col-md-6 text-just">
                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum explicabo amet aliquam veritatis dolores. Consequatur eaque dolores, laboriosam libero repellat quos consectetur sunt mollitia alias voluptatibus recusandae modi natus quod, dolorem earum eveniet perspiciatis ducimus aspernatur at. Aliquid impedit, facilis, atque adipisci consequatur debitis pariatur, sequi minima voluptas cupiditate, fuga sit tenetur consectetur distinctio harum perferendis itaque numquam aut hic!</p>
                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum aperiam quisquam in vel ullam inventore nostrum libero error. Asperiores placeat iure distinctio totam modi soluta doloribus dicta vel temporibus cupiditate. Eligendi hic maiores eos, quae eius ad sit numquam nihil tenetur illo, eum illum assumenda animi, soluta natus maxime ab earum vitae porro laudantium minima? Facilis beatae officiis aspernatur dolores?</p>
                </div>
                <div class="col-md-6">
                    
                        <img src="/img/oil-12.jpg" class="img-responsive cen" alt="">
                        
                    
                </div>
                
            </div>
        </div>
    </section> 
</div>