<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Aluno".
 *
 * @property string $curso
 * @property int $periodo
 * @property string $mat_aluno
 *
 * @property Usuario $matAluno
 */
class Aluno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Aluno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['curso', 'periodo', 'mat_aluno'], 'required'],
            [['periodo'], 'string'],
            [['periodo'],'in','range'=>['1-periodo', '2-periodo', '3-periodo', '4-periodo', '5-periodo', '6-periodo', '7-periodo']],
            [['curso'], 'string', 'max' => 50],
            [['mat_aluno'], 'string', 'max' => 45],
            [['mat_aluno'], 'unique'],
            [['mat_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['mat_aluno' => 'usuario_matricula']],
        ];
    }


    public static function getPeriodos(){
        return[
            '1-periodo' => Yii::t('app', '1º Período'), 
            '2-periodo' => Yii::t('app', '2º Período'), 
            '3-periodo' => Yii::t('app', '3º Período'), 
            '4-periodo' => Yii::t('app', '4º Período'), 
            '5-periodo' => Yii::t('app', '5º Período'), 
            '6-periodo' => Yii::t('app', '6º Período'), 
            '7-periodo' => Yii::t('app', '7º Período')
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'curso' => Yii::t('app', 'Curso'),
            'periodo' => Yii::t('app', 'Período'),
            'mat_aluno' => Yii::t('app', 'Mat Aluno'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatAluno()
    {
        return $this->hasOne(Usuario::className(), ['usuario_matricula' => 'mat_aluno']);
    }
}
