<?php

/** @var \yii\web\View $this */

/** @var string $content */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
$cartItemCount=$this->params['cartItemCount'];



AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-expand-lg navbar-dark bg-dark fixed-top',
            ],
        ]);
        $menuItems = [
                       [ 'label' =>'Cart <span id="cart-quantity" class="badge badge-danger">'.$cartItemCount.'</span>',
                        'url' => ['/cart/index'],
                        'encode'=>false
        ],
        ];



        if (Yii::$app->user->isGuest) {
//            $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
//            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            $menuItems[] = ['label' => Yii::t('app','Signup'), 'url' => ['/site/signup']];
            $menuItems[] = ['label' => Yii::t('app','Login'), 'url' => ['/site/login']];
        } else {
            $menuItems[] = [
                'label' => Yii::t('app','Welcome {0}', [ Yii::$app->user->identity->getDisplayName()]),
//                'label' => Yii::$app->user->identity->getDisplayName(),
//            'dropDownOptions' => [
//                'class' => 'dropdown-menu-right'
//            ],
                'items' => [
                    [
                        'label' => 'Profile',
                        'url' => ['/site/profile'],
                    ],
                    [
                        'label' => 'Logout',
                        'url' => ['/site/logout'],
                        'linkOptions' => [
                            'data-method' => 'post'
                        ],
                    ]
                ]
            ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ml-auto'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>


        <main role="main" class="flex-shrink-0">
            <div class="container">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>
    </div>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
                </div>

                <div class="col text-right">
                    <p class="pull-right">Created by <a href="https://github.com" target="_blank">Vieru
                            Daniel</a></p>
                </div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage(); ?>