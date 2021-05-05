<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use PhpMyAdmin\ShapeFile\Util;
use yii\helpers\Utils;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SystemroleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if (Yii::$app->user->isGuest) {
    header("Location: index.php");
    exit;
}
$this->title = 'Data Hak Akses';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="systemrole-index">

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

            'nama_role',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Aksi',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => "{view} {update} {delete}",
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Utils::Button('view', ['id' => $model->id_system_role, 'text' => 'Detail']);
                    },
                    'update' => function ($url, $model) {
                        return Utils::Button('update', ['id' => $model->id_system_role, 'text' => 'Ubah']);
                    },
                    'delete' => function ($url, $model) {
                        if (Utils::userRole('DEVELOPER')) {
                            return Utils::Button('delete', ['id' => $model->id_system_role, 'text' => 'Hapus']);
                        } else {
                            return '';
                        }
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