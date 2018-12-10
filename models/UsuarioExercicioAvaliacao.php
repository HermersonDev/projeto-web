<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "UsuarioExercicioAvaliacao".
 *
 * @property string $mat_usuario
 * @property int $idAvaliacao
 * @property int $idExercicio
 * @property string $series
 *
 * @property Usuario $matUsuario
 * @property Exercicio $exercicio
 * @property Avaliacao $avaliacao
 */
class UsuarioExercicioAvaliacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'UsuarioExercicioAvaliacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mat_usuario', 'idAvaliacao', 'idExercicio', 'series'], 'required'],
            [['idAvaliacao', 'idExercicio'], 'integer'],
            [['mat_usuario', 'series'], 'string', 'max' => 45],
            [['mat_usuario', 'idExercicio'], 'unique', 'targetAttribute' => ['mat_usuario', 'idExercicio']],
            [['mat_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['mat_usuario' => 'usuario_matricula']],
            [['idExercicio'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicio::className(), 'targetAttribute' => ['idExercicio' => 'id']],
            [['idAvaliacao'], 'exist', 'skipOnError' => true, 'targetClass' => Avaliacao::className(), 'targetAttribute' => ['idAvaliacao' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mat_usuario' => Yii::t('app', 'Mat Usuario'),
            'idAvaliacao' => Yii::t('app', 'Id Avaliacao'),
            'idExercicio' => Yii::t('app', 'Id Exercicio'),
            'series' => Yii::t('app', 'Series'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatUsuario()
    {
        return $this->hasOne(Usuario::className(), ['usuario_matricula' => 'mat_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio()
    {
        return $this->hasOne(Exercicio::className(), ['id' => 'idExercicio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacao()
    {
        return $this->hasOne(Avaliacao::className(), ['id' => 'idAvaliacao']);
    }
}
