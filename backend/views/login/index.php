<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Utils;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LoginSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// ACCESS CONTROL
if (Yii::$app->user->isGuest) {
    header("Location: index.php");
    exit;
}

$this->title = 'Data Login';
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= Yii::$app->request->baseUrl ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $this->title ?></li>
        </ol>
    </nav>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'nama',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => "{view} {update} {delete}",
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Utils::Button('view', ['id' => $model->id_login, 'text' => 'Detail']);
                    },

                    'update' => function ($url, $model) {
                        return Utils::Button('update', ['id' => $model->id_login, 'text' => 'Ubah']);
                    },
                    'delete' => function ($url, $model) {
                        return Utils::Button('delete', ['id' => $model->id_login, 'text' => 'Hapus']);
                    },

                ],
            ],
        ],
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'pjax' => true,
        'toolbar' =>  [
            [
                'content' =>
                Utils::Button('add', ['size' => 'md']) . ' ' .
                    Html::a('<i class="fas fa-redo"></i>', [''], [
                        'class' => 'btn btn-outline-secondary',
                        'data-pjax' => 0,
                    ]),
                'options' => ['class' => 'btn-group mr-2']
            ],
            '{export}',
            '{toggleData}',
        ],
        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
        'export' => [
            'fontAwesome' => true
        ],
        'responsiveWrap' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => $this->title,
            'footer' => false
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 100],
        'exportConfig' => [
            GridView::EXCEL =>  [
                'filename' => $this->title,
                'showPageSummary' => true,
            ]

        ],
    ]); ?>
</div>