<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "Pessoa".
 *
 * @property string $matricula
 * @property string $nome
 * @property string $senha
 * @property int $idade
 * @property string $email
 * @property string $telefone
 * @property string $auth_key
 * @property string $access_token
 * @property string $type
 * @property string $foto
 *
 * @property InstrutorUsuario[] $instrutorUsuarios
 * @property Usuario[] $matUsuarios
 * @property Usuario $usuario
 */
class Pessoa extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    public $confirmar_senha;
    public $tipo_usuario = false;
    public $imageFile;

    const SCENARIO_CADASTRO = 'cadastro';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Pessoa';
    }


    public function beforeSave($insert){
        
        //Verifica se a senha da pessoa foi inserida ou alterada, depois encriptografa a senha e substitui por um hash.
       if(array_key_exists('senha', $this->dirtyAttributes)){
            $this->senha = Yii::$app->getSecurity()->generatePasswordHash($this->senha);
       }

       return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matricula', 'nome', 'senha', 'idade'], 'required'],
            [['confirmar_senha'],'required', 'on'=> [self::SCENARIO_CADASTRO]],
            [['tipo_usuario'],'required', 'on' => [self::SCENARIO_CADASTRO]],
            [['idade'], 'integer'],
            [['type', 'foto'], 'string'],
            [['matricula', 'nome', 'email'], 'string', 'max' => 45],
            [['senha', 'auth_key', 'access_token'], 'string', 'max' => 100],
            [['telefone'], 'string', 'max' => 20],
            [['matricula'], 'unique'],
            [['confirmar_senha'], 'compare', 'compareAttribute' => 'senha'],
            ['tipo_usuario','boolean'],
            [['foto'],'string'],
            ['imageFile', 'file','extensions' => 'png, jpg'],

        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/usuarios/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->foto = 'uploads/usuarios/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            return true;
        } else {
            return false;
        }
    }
    

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'matricula' => Yii::t('app', 'Matricula'),
            'nome' => Yii::t('app', 'Nome'),
            'senha' => Yii::t('app', 'Senha'),
            'idade' => Yii::t('app', 'Idade'),
            'email' => Yii::t('app', 'Email'),
            'telefone' => Yii::t('app', 'Telefone'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'access_token' => Yii::t('app', 'Access Token'),
            'type' => Yii::t('app', 'Type'),
            'foto' => Yii::t('app', 'Foto'),
            'confirmar_senha' => Yii::t('app','Confimar Senha'),
            'tipo_usuario' => Yii::t('app', 'Tipo do Usuário'),
            'imageFile' => Yii::t('app','Foto'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstrutorUsuarios()
    {
        return $this->hasMany(InstrutorUsuario::className(), ['mat_instrutor' => 'matricula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['usuario_matricula' => 'mat_usuario'])->viaTable('InstrutorUsuario', ['mat_instrutor' => 'matricula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['usuario_matricula' => 'matricula']);
    }


    // ------------------METODOS DE IDENTIFICAÇÃO-------------------------------------

    public static function findIdentity($id)
    {
        return static::findOne(['matricula' => $id]);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }


    public function getId()
    {
        return $this->matricula;
    }


    public function getAuthKey()
    {
        return $this->auth_key;
    }

   
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password){
        return Yii::$app->getSecurity()->validatePassword($password, $this->senha);
    }
}
