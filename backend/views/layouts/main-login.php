<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use common\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

\hail812\adminlte3\assets\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl ?>/css/custom.css">
    <style type="text/css">
        html,
        body {
            margin: 0;
            height: 100%;
            overflow: hidden
        }

        .swal2-popup {
            font-size: 1.5rem !important;
        }
    </style>
</head>

<?php $this->beginBody() ?>

<?= $content ?>

<?php $this->endBody() ?>
<script src="<?= Yii::$app->request->baseUrl ?>/web/js/for_login.js"></script>

</html>
<?php $this->endPage() ?>