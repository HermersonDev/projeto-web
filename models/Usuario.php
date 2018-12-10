<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Usuario".
 *
 * @property int $nivel
 * @property int $faltas
 * @property int $horario_treino
 * @property string $usuario_matricula
 *
 * @property Aluno $aluno
 * @property Desempenho[] $desempenhos
 * @property Horario[] $horarios
 * @property InstrutorUsuario[] $instrutorUsuarios
 * @property Pessoa[] $matInstrutors
 * @property Servidor $servidor
 * @property Pessoa $usuarioMatricula
 * @property UsuarioExercicioAvaliacao[] $usuarioExercicioAvaliacaos
 * @property Exercicio[] $exercicios
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['faltas'], 'integer'],
            [['nivel','horario_treino'],'string'],
            [['nivel','horario_treino'],'required'],
            [['nivel'],'in','range' => ['iniciante','intermediario','avancado']],
            [['horario_treino'],'in','range' => ['7hrs-8hrs', '8hrs-9hrs', '9hrs-10hrs', '10hrs-11hrs', '13hrs-14hrs', '14hrs-15hrs', '15hrs-16hrs', '16hrs-17hrs', '17hrs-18hrs', '18hrs-19hrs']],
            [['usuario_matricula'], 'required'],
            [['usuario_matricula'], 'string', 'max' => 45],
            [['usuario_matricula'], 'unique'],
            [['usuario_matricula'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::className(), 'targetAttribute' => ['usuario_matricula' => 'matricula']],
        ];
    }


    public static function getNiveis(){

        return[
            'iniciante' => Yii::t('app','Inciante'),
            'intermediario' => Yii::t('app','Intermediário'),
            'avancado' => Yii::t('app','Avançado'), 
        ];
    }

    public static function getHorariosTreino(){
        return [
            '7hrs-8hrs'=> Yii::t('app','7hrs ás 8hrs'),
            '8hrs-9hrs'=> Yii::t('app','8hrs ás 9hrs'), 
            '9hrs-10hrs'=> Yii::t('app','9hrs ás 10hrs'), 
            '10hrs-11hrs'=> Yii::t('app','10hrs ás 11hrs'), 
            '13hrs-14hrs'=> Yii::t('app','13hrs ás 14hrs'), 
            '14hrs-15hrs'=> Yii::t('app','14hrs ás 15hrs'), 
            '15hrs-16hrs'=> Yii::t('app','15hrs ás 16hrs'), 
            '16hrs-17hrs'=> Yii::t('app','16hrs ás 17hrs'), 
            '17hrs-18hrs'=> Yii::t('app','17hrs ás 18hrs'), 
            '18hrs-19hrs'=> Yii::t('app','18hrs ás 19hrs'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nivel' => Yii::t('app', 'Nível'),
            'faltas' => Yii::t('app', 'Faltas'),
            'horario_treino' => Yii::t('app', 'Horário Treino'),
            'usuario_matricula' => Yii::t('app', 'Usuario Matricula'),
        ];
    }

    public function getPessoa(){
        return $this->hasOne(Pessoa::className(),['matricula' => 'usuario_matricula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(Aluno::className(), ['mat_aluno' => 'usuario_matricula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesempenhos()
    {
        return $this->hasMany(Desempenho::className(), ['mat_usuario' => 'usuario_matricula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorarios()
    {
        return $this->hasMany(Horario::className(), ['mat_usuario' => 'usuario_matricula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstrutorUsuarios()
    {
        return $this->hasMany(InstrutorUsuario::className(), ['mat_usuario' => 'usuario_matricula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatInstrutors()
    {
        return $this->hasMany(Pessoa::className(), ['matricula' => 'mat_instrutor'])->viaTable('InstrutorUsuario', ['mat_usuario' => 'usuario_matricula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServidor()
    {
        return $this->hasOne(Servidor::className(), ['mat_servidor' => 'usuario_matricula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioMatricula()
    {
        return $this->hasOne(Pessoa::className(), ['matricula' => 'usuario_matricula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioExercicioAvaliacaos()
    {
        return $this->hasMany(UsuarioExercicioAvaliacao::className(), ['mat_usuario' => 'usuario_matricula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExercicios()
    {
        return $this->hasMany(Exercicio::className(), ['id' => 'idExercicio'])->viaTable('UsuarioExercicioAvaliacao', ['mat_usuario' => 'usuario_matricula']);
    }
}
