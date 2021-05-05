<?php

use backend\models\MdPegawai;
use backend\models\MdPrestasi;
use backend\models\MdStatusPegawai;
use yii\helpers\Html;
use dosamigos\chartjs\ChartJs;
use backend\models\Userrole;

$id_login = Yii::$app->user->identity->id_login;

if (Yii::$app->user->isGuest) {
	header("Location: index.php");
	exit;
}
$this->title = 'Dashboard';
?>
<div class="site-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<ul class="breadcrumb">
		<li><a href="/"><?= $this->title ?></a></li>
	</ul>
</div>


<script type="text/javascript" src="web/js/Chart.js"></script>