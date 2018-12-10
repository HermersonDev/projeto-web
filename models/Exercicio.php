<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Exercicio".
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property string $img
 * @property int $nivel
 * @property int $idEquipamento
 *
 * @property Equipamento $equipamento
 * @property UsuarioExercicioAvaliacao[] $usuarioExercicioAvaliacaos
 * @property Usuario[] $matUsuarios
 */
class Exercicio extends \yii\db\ActiveRecord
{   
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Exercicio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'idEquipamento'], 'required'],
            [['img'], 'string'],
            [['nivel'],'in','range' => ['iniciante','intermediario','avancado']],
            [['idEquipamento'], 'integer'],
            [['nome'], 'string', 'max' => 45],
            [['descricao'], 'string', 'max' => 100],
            [['idEquipamento'], 'exist', 'skipOnError' => true, 'targetClass' => Equipamento::className(), 'targetAttribute' => ['idEquipamento' => 'id']],
        ];
    }

    public static function getNiveis(){

        return[
            'iniciante' => Yii::t('app','Inciante'),
            'intermediario' => Yii::t('app','Intermediário'),
            'avancado' => Yii::t('app','Avançado'), 
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Nome'),
            'descricao' => Yii::t('app', 'Descrição'),
            'img' => Yii::t('app', 'Img'),
            'nivel' => Yii::t('app', 'Nível'),
            'idEquipamento' => Yii::t('app', 'Id Equipamento'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipamento()
    {
        return $this->hasOne(Equipamento::className(), ['id' => 'idEquipamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioExercicioAvaliacaos()
    {
        return $this->hasMany(UsuarioExercicioAvaliacao::className(), ['idExercicio' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['usuario_matricula' => 'mat_usuario'])->viaTable('UsuarioExercicioAvaliacao', ['idExercicio' => 'id']);
    }
}
