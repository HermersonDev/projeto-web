<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "InstrutorUsuario".
 *
 * @property string $mat_instrutor
 * @property string $mat_usuario
 *
 * @property Pessoa $matInstrutor
 * @property Usuario $matUsuario
 */
class InstrutorUsuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'InstrutorUsuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mat_instrutor', 'mat_usuario'], 'required'],
            [['mat_instrutor', 'mat_usuario'], 'string', 'max' => 45],
            [['mat_instrutor', 'mat_usuario'], 'unique', 'targetAttribute' => ['mat_instrutor', 'mat_usuario']],
            [['mat_instrutor'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::className(), 'targetAttribute' => ['mat_instrutor' => 'matricula']],
            [['mat_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['mat_usuario' => 'usuario_matricula']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mat_instrutor' => Yii::t('app', 'Mat Instrutor'),
            'mat_usuario' => Yii::t('app', 'Mat Usuario'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatInstrutor()
    {
        return $this->hasOne(Pessoa::className(), ['matricula' => 'mat_instrutor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatUsuario()
    {
        return $this->hasOne(Usuario::className(), ['usuario_matricula' => 'mat_usuario']);
    }
}
