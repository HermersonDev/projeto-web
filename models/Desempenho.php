<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Desempenho".
 *
 * @property int $id
 * @property double $imc
 * @property double $pg
 * @property double $tmb
 * @property double $rcq
 * @property string $data
 * @property string $mat_usuario
 *
 * @property Usuario $matUsuario
 */
class Desempenho extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Desempenho';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imc', 'pg', 'tmb', 'rcq'], 'number'],
            [['data'], 'safe'],
            [['mat_usuario'], 'required'],
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
            'imc' => Yii::t('app', 'Imc'),
            'pg' => Yii::t('app', 'Pg'),
            'tmb' => Yii::t('app', 'Tmb'),
            'rcq' => Yii::t('app', 'Rcq'),
            'data' => Yii::t('app', 'Data'),
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
