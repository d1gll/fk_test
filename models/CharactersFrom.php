<?php

namespace app\models;

use app\models\Characters;
use yii\base\Model;

//Модель для работы с введеными характеристиками
class CharactersFrom extends Model
{

    public $character;

    //Правила валидации данных
    public function rules()
    {
        return [
            ['character', 'required', 'message' => 'Введите новую характеристику'],
            ['character', 'match', 'pattern'=>'/^[а-яА-ЯёЁa-zA-Z-]+$/u', 'message' => 'Только буквы'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'character' => '',
        ];
    }

    //Добавляем новую характеристику в таблицу
    public function addCharacters(){
        $character = new Characters();
        $character->character = $this->character;
        $character->save();
        return $this->character;
    }

    //Поиск характеристики
    public function searchCharacters(){
        return Characters::find()->all();
    }

    //Поиск ид характеристики по названию
    public function searchCharacterName($character){
        return Characters::find()
            ->select('id_char')
            ->where(['character' => $character])
            ->one();
    }

    //Удаление характеристики по ид
    public function deleteChar($id){
        Statistic::deleteAll(['id_char' => $id]);
        Characters::deleteAll(['id_char' => $id]);
        return true;
    }



}