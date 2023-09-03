<?php

namespace app\models;

use yii\base\Model;
use app\models\Statistic;

//Модель для работы с объединением футболистов, характеристики и его баллов.
class StatisticFrom extends Model
{
    public $player;
    public $character;
    public $point;

    //Правила валидации данных
    public function rules()
    {
        return [
            [['point','character'], 'string'],
            [['player', ],  'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'player' => 'Игрок',
            'character' => 'Характеристика',
            'point' => 'Оценка',
        ];
    }

    //Проверка на добавление одной характеристики для футболитов или более.
    public function checkStatistics(){
        //Если больше одной, то добавляем каждую по очереди
        if (strripos($this->character,"&") &&
            strripos($this->point,"&")){
            $id_char = explode("&", $this->character);
            $point = explode("&", $this->point);
            for($i=0;$i<count($id_char);$i++)
            {
                $this->addStatistics($id_char[$i], $this->player, $point[$i]);
            }
        }
        //Если одна
        else{
            $this->addStatistics($this->character, $this->player, $this->point);
        }
    }

    //Добавление статистики по футболисту
    public function addStatistics($id_char,$id_player,$point){

        $statistic = Statistic::find()
            ->select('id')
            ->where(['id_name' => $id_player, 'id_char'=>$id_char])
            ->one();
        //Если в таблице уже есть, значит обновляем
        if ($statistic != null) {
            $statistic = Statistic::findOne($statistic);
            $statistic->point = $point;
            $statistic->update();
        }
        //Если нет - добавляем новую
        else{
            $statistic = new Statistic();
            $statistic->id_name = $id_player;
            $statistic->id_char = $id_char;
            $statistic->point = $point;
            $statistic->save();
        }
        return true;
    }

    //Вводим данные из статистики, заменяя ид - именами, для понимания. Сортируем по имени по убыванию и внутри
    //по характеристики по возростанию
    public function searchStatistics(){

        $statistic = (new \yii\db\Query())
            ->select(['players.name', 'characters.character', 'point'])
            ->from('statistic')
            ->join('INNER JOIN', 'players','players.id_name = statistic.id_name')
            ->join('INNER JOIN', 'characters','characters.id_char = statistic.id_char')->orderBy([
                'players.name' => SORT_DESC,
                'characters.character' => SORT_ASC,
            ])->all();
        return $statistic;
    }

}