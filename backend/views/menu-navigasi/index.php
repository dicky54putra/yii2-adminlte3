<?php

use backend\models\Userrole;
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Utils;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MenuNavigasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu Navigasi';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-navigasi-index">

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

            'nama_menu',
            'url',

            'no_urut',
            'icon',
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'status',
                'vAlign' => 'middle'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => "{view} {update} {delete}",
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Utils::Button('view', ['id' => $model->id_menu, 'text' => 'Detail']);
                    },

                    'update' => function ($url, $model) {
                        return Utils::Button('update', ['id' => $model->id_menu, 'text' => 'Ubah']);
                    },
                    'delete' => function ($url, $model) {
                        if (Utils::userRole('DEVELOPER')) {
                            return Utils::Button('delete', ['id' => $model->id_menu, 'text' => 'Hapus']);
                        } else {
                            return '';
                        }
                    },
                ],
            ],
            [
                'class' => 'kartik\grid\CheckboxColumn',
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
            'after' =>  Utils::optionAfter(),
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

<script>
    function getRows() {
        let saa = document.querySelectorAll('input[name="selection[]"]:checked');
        let option = document.querySelector('select[name="option"]');

        let id = [];
        for (let x = 0; x < saa.length; x++) {
            id += saa[x].value + ',';
        }
        const length = id.length - 1
        let id_ = id.substr(0, length)
        console.log(id_);

        const url = `<?= Yii::$app->request->baseUrl ?>/menu-navigasi/in?ids=${id_}&type=${option.value}`

        fetch(url)
            .then(response => response.json())
            .then(data => console.log(data));
        setTimeout(() => location.reload(), 10)
    }
</script>