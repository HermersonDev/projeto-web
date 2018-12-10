<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Horario".
 *
 * @property int $id
 * @property string $data
 * @property string $hora_inicio
 * @property string $hora_final
 * @property string $mat_usuario
 *
 * @property Usuario $matUsuario
 */
class Horario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Horario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data', 'hora_inicio', 'mat_usuario'], 'required'],
            [['data', 'hora_inicio', 'hora_final'], 'safe'],
            [['mat_usuario'], 'string', 'max' => 45],
            [['mat_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['mat_usuario' => 'usuario_matricula']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'data' => Yii::t('app', 'Data'),
            'hora_inicio' => Yii::t('app', 'Hora Inicio'),
            'hora_final' => Yii::t('app', 'Hora Final'),
            'mat_usuario' => Yii::t('app', 'Mat Usuario'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatUsuario()
    {
        return $this->hasOne(Usuario::className(), ['usuario_matricula' => 'mat_usuario']);
    }
}
