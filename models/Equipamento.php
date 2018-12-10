<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "Equipamento".
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property string $img
 *
 * @property Exercicio[] $exercicios
 */
class Equipamento extends \yii\db\ActiveRecord
{

    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Equipamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['img'], 'string'],
            [['nome'], 'string', 'max' => 45],
            [['descricao'], 'string', 'max' => 100],
            ['imageFile', 'file','extensions' => 'png, jpg'],
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
            'imageFile' => Yii::t('app', 'Imagem do Equipamento'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExercicios()
    {
        return $this->hasMany(Exercicio::className(), ['idEquipamento' => 'id']);
    }

    public function upload(){

        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/equipamentos/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->img = 'uploads/equipamentos/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;

            return true;
        } else {
            return false;
        }
    }
}
