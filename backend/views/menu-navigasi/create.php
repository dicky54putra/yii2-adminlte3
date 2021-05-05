<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MenuNavigasi */

$this->title = 'Tambah Menu Navigasi';
// $this->params['breadcrumbs'][] = ['label' => 'Menu Navigasi', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-navigasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'menuParent' => $menuParent,
    ]) ?>

</div>