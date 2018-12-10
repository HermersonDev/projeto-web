<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;

/**
 * UsuarioSearch represents the model behind the search form of `app\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nivel', 'faltas', 'horario_treino'], 'integer'],
            [['usuario_matricula'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Usuario::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'nivel' => $this->nivel,
            'faltas' => $this->faltas,
            'horario_treino' => $this->horario_treino,
        ]);

        $query->andFilterWhere(['like', 'usuario_matricula', $this->usuario_matricula]);

        return $dataProvider;
    }

    public function searchUsuarios($matricula){

        if(!is_null($matricula)){

            $usuarios = Usuario::find();

            $instrutor = new Pessoa(['matricula' => $matricula]);
            $usuariosInstruidos = $instrutor->instrutorUsuarios;

            $matriculas = array();
            foreach($usuariosInstruidos as $usuarioInstruido){
                $matriculas[] = $usuarioInstruido->mat_usuario; 
            }

            $usuarios->where(['usuario_matricula'=>$matriculas]);

            return $usuarios;
        }

        return null;
    }
}
