<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;
use backend\models\DataKecamatan;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "login".
 *
 * @property integer $id_login
 * @property string $username
 * @property string $password
 * @property string $nama
 */
class Login extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'login';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username',  'nama'], 'required'],
            [['username'], 'string', 'max' => 200],
            [['username', 'email'], 'unique'],
            [['password'], 'string', 'max' => 200],
            [['created_at', 'updated_at'], 'safe'],
            [['nama'], 'string', 'max' => 200],
            [['id_tabel', 'nama_tabel'], 'safe'],
            [['foto'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_login' => 'Id Login',
            'username' => 'Username',
            'password' => 'Password',
            'nama' => 'Nama',
            'foto' => 'Foto',
            'created_at' => 'created',
            'updated_at' => 'updated',
        ];
    }

    public static function findByUsername($username)
    {
        $if = strpos($username, "@") !== false;
        if ($if == false) {
            return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
        } else {
            return static::findOne(['email' => $username, 'status' => self::STATUS_ACTIVE]);
        }
    }

    public function validatePassword($password)
    {
        // return $this->password === md5($password);
        return password_verify($password, $this->password);
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id_login' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // throw new NotSupportedException();
        //I don't implement this method because I don't have any access token column in my database
    }

    public function getId()
    {
        return $this->id_login;
    }

    public function getAuthKey()
    {
    }

    public function validateAuthKey($authKey)
    {
        throw new NotSupportedException();
        //return $this->authKey === $authKey;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->foto) {
                $filename = time() . "_" . str_replace(" ", "_", $this->foto->baseName) . '.' . $this->foto->extension;
                $this->foto->saveAs('upload/' . $filename);
                $this->foto = $filename;
            } else {
                if (Yii::$app->request->get('id')) {
                    $foto = Login::findOne(Yii::$app->request->get('id'));
                    $this->foto = $foto->foto;
                } else {
                    $this->foto = "avatar5.png";
                }
            }
            return true;
        }
    }
}
