<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Avaliacao".
 *
 * @property int $id
 * @property int $opiniao
 * @property int $dificuldade
 * @property int $eficiencia
 *
 * @property UsuarioExercicioAvaliacao[] $usuarioExercicioAvaliacaos
 */
class Avaliacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Avaliacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['opiniao', 'dificuldade', 'eficiencia'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'opiniao' => Yii::t('app', 'Opiniao'),
            'dificuldade' => Yii::t('app', 'Dificuldade'),
            'eficiencia' => Yii::t('app', 'Eficiencia'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioExercicioAvaliacaos()
    {
        return $this->hasMany(UsuarioExercicioAvaliacao::className(), ['idAvaliacao' => 'id']);
    }
}
