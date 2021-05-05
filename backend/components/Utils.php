<?php

namespace yii\helpers;

use backend\models\AktJurnalUmumDetail;
use backend\models\MenuNavigasi;
use backend\models\MenuNavigasiRole;
use Yii;

class Utils
{
    public static function getDsnAttribute($name, $dsn)
    {
        if (preg_match('/' . $name . '=([^;]*)/', $dsn, $match)) {
            return $match[1];
        } else {
            return null;
        }
    }

    public static function RoleAccess()
    {
        // bahan
        $role = Yii::$app->db->createCommand("SELECT system_role.id_system_role FROM user_role INNER JOIN system_role ON system_role.id_system_role = user_role.id_system_role WHERE user_role.id_login = " . Yii::$app->user->id)->query();

        $id_role = '';
        foreach ($role as $role) {
            $id_role .= $role['id_system_role'] . ',';
        }
        $in_id_role = substr($id_role, 0, -1);
        $in = !empty($in_id_role) ? $in_id_role : 0;
        $menu = Yii::$app->controller->id;

        $menu_navigasi = MenuNavigasi::find()->where(["url" => $menu])->one();

        $userAccess = MenuNavigasiRole::find()->where("id_system_role IN (" . $in . ")")->andWhere(['id_menu' => $menu_navigasi->id_menu])->count();

        if ($userAccess < 1) {
            return Yii::$app->response->redirect(Url::to(['site/blocked']));
        }
    }

    public static function Button($tipe, $option = [])
    {
        $btnSize = $option['size'] ?? 'sm';
        if ($tipe == 'view') {
            $text =  $option['text'] ?? 'Detail';
            if (isset($option['modal'])) {
                return Html::button(
                    '<span class="fa fa-eye"></span >' . $text,
                    [
                        'value' => Url::to([$option['link'] ?? 'view', 'id' => $option['id']]),
                        'title' => 'View Data', 'class' => 'showModalButton  btn btn-sm btn-primary'
                    ]
                );
            } else {
                return Html::a('<button class = "btn btn-' . $btnSize . ' btn-primary"><span class="fa fa-eye"></span> ' .  $text . '</button>', [$option['link'] ?? 'view', 'id' => $option['id']], [
                    'title' => Yii::t('app', 'Lihat Detail'),
                ]);
            }
        } elseif ($tipe == 'update') {
            $text =  $option['text'] ?? 'Ubah';
            if (isset($option['modal'])) {
                return Html::button(
                    '<span class="fa fa-edit"></span> ' .  $text,
                    [
                        'value' => Url::to([$option['link'] ?? 'update', 'id' => $option['id']]),
                        'title' => 'Ubah Data', 'class' => 'showModalButton  btn btn' . $btnSize . ' btn-success'
                    ]
                );
            } else {
                return Html::a('<button class = "btn btn-' . $btnSize . ' btn-success"><span class="fa fa-edit"></span> ' .  $text . '</button>', [$option['link'] ?? 'update', 'id' => $option['id']], [
                    'title' => Yii::t('app', 'Update data'),
                ]);
            }
        } elseif ($tipe == 'delete') {
            $text =  $option['text'] ?? 'Delete';
            return Html::a('<button class = "btn btn-' . $btnSize . ' btn-danger"><span class="fa fa-trash"></span> ' .  $text . '</button>', [$option['link'] ?? 'delete', 'id' => $option['id']], [
                'title' => Yii::t('app', 'Hapus data'),
                'data' => [
                    'method' => 'post',
                ],
                'class' => 'tombol-hapus'
            ]);
        } elseif ($tipe == 'back') {
            $text = $option['text'] ?? 'Kembali';
            return Html::a('<span class="fa fa-arrow-left"></span> ' .  $text, [$option['link'] ?? 'index'], ['class' => 'btn btn-warning btn-' . $btnSize]);
        } elseif ($tipe == 'add') {
            $text =  $option['text'] ?? 'Tambah';
            if (isset($option['modal'])) {
                return Html::button(
                    '<span class="fa fa-plus"></span> ' .  $text,
                    [
                        'value' => Url::to([$option['link'] ?? 'create']),
                        'title' => 'Ubah Data', 'class' => 'showModalButton  btn btn' . $btnSize . ' btn-success'
                    ]
                );
            } else {
                return Html::a('<span class="fa fa-plus"></span> ' . $text, [$option['link'] ?? 'create'], [
                    'title' => Yii::t('app', 'Create data'),
                    'class' => 'btn btn-' . $btnSize . ' btn-success'
                ]);
            }
        }
    }

    public static function userRole($role)
    {
        return in_array($role, Yii::$app->session->get('user_role'));
    }

    public static function optionAfter($delete = null)
    {
        if (empty($delete)) {
            $btn = '<div class="input-group col-4 float-right">
                <select name="option" class="form-control" id="option">
                    <option value="delete">Hapus</option>
                    <option value="active">Aktifkan</option>
                    <option value="inactive">Non Aktifkan</option>
                </select>
                <span class="input-group-append">
                    <button type="button" onclick="getRows()" class="btn btn-primary"><i class="fa fa-check"></i> Konfirmasi</button>
                </span>
            </div>';
        } elseif (!empty($delete)) {
            $btn = '<button type="button" onclick="getRows()" class="btn btn-danger float-right"><i class="fa fa-trash"></i> Hapus</button>';
        }
        return $btn;
    }
}
