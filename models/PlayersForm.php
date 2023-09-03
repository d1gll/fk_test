<?php

namespace app\models;

use app\models\Players;
use yii\base\Model;

//Модель для работы с введеными данными по футболитам
class PlayersForm extends Model
{
    public $name;

    //Правила валидации данных
    public function rules()
    {
        return [
            ['name', 'required', 'message' => 'Введите нового футболиста'],
            ['name', 'match', 'pattern'=>'/^[а-яА-ЯёЁa-zA-Z-]+$/u', 'message' => 'Только буквы'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '',
        ];
    }

//Добавляем футболиста
    public function addPlayers(){
        $players = new Players();
        $players->name = $this->name;
        $players->save();
        return $this->name;
    }

//Возвращает всех футболистов
    public function searchPlayers(){
        return Players::find()->all();
    }

//Поиск ид футболиста по имени
    public function searchPlayerName($name){
        return Players::find()
            ->select('id_name')
            ->where(['name' => $name])
            ->one();
    }

//Удаление футболиста по ид
    public function deletePlayers($id){
        Statistic::deleteAll(['id_name' => $id]);
        Players::deleteAll(['id_name' => $id]);
        return true;
    }
}