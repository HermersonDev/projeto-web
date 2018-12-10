<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "CadastroToken".
 *
 * @property string $token_acesso
 * @property string $matricula-instrutor
 */
class CadastroToken extends \yii\db\ActiveRecord
{
    public $email;
    public $matricula_usuario;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CadastroToken';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['token_acesso', 'matricula_instrutor','email', 'matricula_usuario'], 'required'],
            [['token_acesso'], 'string', 'max' => 100],
            [['matricula_instrutor','matricula_usuario'], 'string', 'max' => 45],
            [['token_acesso'], 'unique'],
            ['email', 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'token_acesso' => Yii::t('app', 'Token Acesso'),
            'matricula_instrutor' => Yii::t('app', 'Matricula Instrutor'),
            'email' => Yii::t('app','Email'),
            'matricula_usuario' => Yii::t('app', 'Matrícula do Usuário'),
        ];
    }
}
