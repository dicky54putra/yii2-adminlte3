<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

if (Yii::$app->user->isGuest) {

    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    }

    \hail812\adminlte3\assets\FontAwesomeAsset::register($this);
    \hail812\adminlte3\assets\AdminLteAsset::register($this);
    $this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');

    $assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <!-- <link rel="stylesheet" href="https://adminlte.io/themes/dev/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
        <?php $this->head() ?>
    </head>

    <body class="sidebar-mini layout-fixed layout-navbar-fixed bootstrap-dark">
        <script src="<?= Yii::$app->request->baseUrl ?>/web/js/theme.js"></script>
        <?php $this->beginBody() ?>

        <div class="wrapper">
            <!-- Navbar -->
            <?= $this->render('navbar', ['assetDir' => $assetDir]) ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>

            <!-- Content Wrapper. Contains page content -->
            <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <?= $this->render('control-sidebar') ?>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <?= $this->render('footer') ?>
        </div>

        <?php $this->endBody() ?>
        <!-- <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
    </body>

    </html>
    <?php $this->endPage() ?>
<?php } ?>