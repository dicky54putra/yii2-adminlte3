<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use backend\models\MenuNavigasiRole;
use backend\models\Userrole;
use yii\helpers\Utils;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuNavigasi */

$this->title = "Detail Menu Navigasi: " . $model->nama_menu;
?>
<div class="menu-navigasi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= Yii::$app->request->baseUrl ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><?= Html::a('Daftar Menu Navigasi', ['index']) ?></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $this->title ?></li>
        </ol>
    </nav>

    <p>
        <?= Utils::Button('back', ['id' => $model->id_menu, 'size' => 'md']) ?>
        <?php
        if (Utils::userRole('DEVELOPER')) {
            echo Utils::Button('update', ['id' => $model->id_menu, 'size' => 'md', 'text' => 'Ubah']);
            echo '  ';
            echo Utils::Button('delete', ['id' => $model->id_menu, 'size' => 'md', 'text' => 'Hapus']);
        } else {
            $hidden = '';
        }
        ?>
    </p>

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
            <div class="card card-primary">
                <div class="card-header ">
                    <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="card-body pl-0 pr-0">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'nama_menu',
                            'url:url',
                            'id_parent',
                            'no_urut',
                            'icon',
                            [
                                'attribute' => 'status',
                                'format'    => 'raw',
                                'filter'    => array(0 => "Aktif", 1 => "Tidak Aktif"),
                                'value'     => function ($model) {
                                    return $model->status == 0 ? '<span class="fas fa-times text-danger"></span>' : '<span class="fas fa-check text-success"></span>';
                                }
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
            <div class="card card-primary">
                <div class="card-header ">
                    <h3 class="card-title">HAK AKSES</h3>
                </div>
                <div class="card-body">
                    <?= Html::beginForm(['menu-navigasi/view', 'id' => $model->id_menu], 'post') ?>
                    <?= Html::hiddenInput("id", $model->id_menu) ?>

                    <?php
                    foreach ($hakakses as $data) {
                        $cek = MenuNavigasiRole::find()->where(["id_system_role" => $data->id_system_role, "id_menu" => $model->id_menu])->count();
                        $value = "0";
                        if ($cek > 0) $value = "1";


                        echo Html::checkbox('data[' . $data->id_system_role . ']', $value, ['label' => $data->nama_role]);
                        echo "<br>";
                    }

                    ?>
                    <?= Html::submitButton('Simpan Hak Akses', ['class' => 'btn btn-primary']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
    </div>

    <?php if ($jumlahSubmenu > 0) { ?>

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
                'heading' => 'Submenu: ' . $model->nama_menu,
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

    <?php } ?>
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