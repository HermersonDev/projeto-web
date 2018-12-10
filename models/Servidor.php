<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Servidor".
 *
 * @property string $tipo
 * @property string $mat_servidor
 *
 * @property Usuario $matServidor
 */
class Servidor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Servidor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo', 'mat_servidor'], 'required'],
            [['tipo', 'mat_servidor'], 'string', 'max' => 45],
            [['mat_servidor'], 'unique'],
            [['mat_servidor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['mat_servidor' => 'usuario_matricula']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tipo' => Yii::t('app', 'Função'),
            'mat_servidor' => Yii::t('app', 'Mat Servidor'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatServidor()
    {
        return $this->hasOne(Usuario::className(), ['usuario_matricula' => 'mat_servidor']);
    }
}
