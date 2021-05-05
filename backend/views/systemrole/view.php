<?php

use yii\helpers\Html;
use yii\helpers\Utils;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Systemrole */

if (Yii::$app->user->isGuest) {
	header("Location: index.php");
	exit;
}
$this->title = "Detail Hak Akses: " . $model->nama_role;
// $this->params['breadcrumbs'][] = ['label' => 'Data Hak Akses', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="systemrole-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li><a href="/">Dashboard</a></li>
			<li><?= Html::a('Daftar User Role', ['index']) ?></li>
			<li class="active"><?= $this->title ?></li>
		</ol>
	</nav>

	<p>
		<?= Utils::Button('back', ['id' => $model->id_system_role, 'size' => 'md']) ?>
		<?php
		if (Utils::userRole('DEVELOPER')) {
			echo Utils::Button('update', ['id' => $model->id_system_role, 'size' => 'md', 'text' => 'Ubah']);
			echo '  ';
			echo Utils::Button('delete', ['id' => $model->id_system_role, 'size' => 'md', 'text' => 'Hapus']);
		} else {
			$hidden = '';
		}
		?>
	</p>
	<div class="box">
		<div class="box-header">
			<div class="col-md-12" style="padding: 0;">
				<div class="box-body">
					<?= DetailView::widget([
						'model' => $model,
						'attributes' => [
							// 'id_system_role',
							'nama_role',
						],
					]) ?>

					<br>
					<label>Daftar User:</label><br>
					<table class="table">
						<tr>
							<th>No.
							<th>
							<th>Nama
							<th>
						</tr>
						<?php
						$i = 0;
						foreach ($userrole as $data) {
							$i++;
							$nama = Yii::$app->db->createCommand("SELECT nama FROM login WHERE id_login = '$data[id_login]'")->queryScalar();
						?>
							<tr>
								<td align='center'><?= $i ?>.
								<td>
								<td><?= $nama ?>
								<td>
							</tr>

						<?php
						}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>