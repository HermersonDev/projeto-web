<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pessoa;

/**
 * PessoaSearch represents the model behind the search form of `app\models\Pessoa`.
 */
class PessoaSearch extends Pessoa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matricula', 'nome', 'senha', 'email', 'telefone', 'auth_key', 'access_token', 'type', 'foto'], 'safe'],
            [['idade'], 'integer'],
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
        $query = Pessoa::find();

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
            'idade' => $this->idade,
        ]);

        $query->andFilterWhere(['like', 'matricula', $this->matricula])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'senha', $this->senha])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telefone', $this->telefone])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'access_token', $this->access_token])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'foto', $this->foto]);

        return $dataProvider;
    }

    public function searchUsuarios($matricula){

        if(!is_null($matricula)){

            $usuarios = Pessoa::find();

            $instrutor = new Pessoa(['matricula' => $matricula]);
            $usuariosInstruidos = $instrutor->instrutorUsuarios;

            $matriculas = array();
            foreach($usuariosInstruidos as $usuarioInstruido){
                $matriculas[] = $usuarioInstruido->mat_usuario; 
            }

            $usuarios->where(['matricula'=>$matriculas]);

            return $usuarios;
        }

        return null;
    }
}
