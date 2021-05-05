<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "jurnal_mengajar_jam_ke".
 *
 * @property int $id_jurnal_mengajar_jam_ke
 * @property int $id_jurnal_mengajar
 * @property int $id_jam_pelajaran
 */
class JurnalMengajarJamKe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jurnal_mengajar_jam_ke';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_jurnal_mengajar', 'id_jam_pelajaran'], 'required'],
            [['id_jurnal_mengajar', 'id_jam_pelajaran'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_jurnal_mengajar_jam_ke' => 'Id Jurnal Mengajar Jam Ke',
            'id_jurnal_mengajar' => 'Id Jurnal Mengajar',
            'id_jam_pelajaran' => 'Id Jam Pelajaran',
        ];
    }
}
