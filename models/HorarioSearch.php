<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Horario;

/**
 * HorarioSearch represents the model behind the search form of `app\models\Horario`.
 */
class HorarioSearch extends Horario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['data', 'hora_inicio', 'hora_final', 'mat_usuario'], 'safe'],
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
        $query = Horario::find();

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
            'id' => $this->id,
            'data' => $this->data,
            'hora_inicio' => $this->hora_inicio,
            'hora_final' => $this->hora_final,
        ]);

        $query->andFilterWhere(['like', 'mat_usuario', $this->mat_usuario]);

        return $dataProvider;
    }

    public function searchUsuariosAtivos(){

        $query = Horario::find();
        
        $data = Yii::$app->formatter->asDate('now');
        
        $query->where(['data' => $data,'hora_final' => null]);

        return $query;
    }

    public function searchTreinoConcluido(){

        $query = Horario::find();

        $data = Yii::$app->formatter->asDate('now');

        $query->where(['data' => $data]);
        $query->andWhere(['<>','hora_final','00:00:00']);

        return $query;
    }
}
