<?php

namespace app\controllers;

use app\models\CharactersFrom;
use app\models\PlayersForm;
use app\models\StatisticFrom;
use yii\web\Controller;
use Yii;
use yii\web\Response;

//Главный контроллер
class PlayersController extends Controller
{
    //Действие для обработки и отправки данных на view - index (статистика)
    public function actionIndex()
    {
        $staticFrom= new StatisticFrom();
        $playFrom = new PlayersForm();
        $charFrom = new CharactersFrom();

        //Если запрос аякс
        if(Yii::$app->request->isAjax) {
            //Переводим в формат json
            Yii::$app->response->format = Response::FORMAT_JSON;
            //Если были отправлены данные с index в post запросе и пройдена валидация
            if ($staticFrom->load(Yii::$app->request->post()) && $staticFrom->validate()) {
                $staticFrom->checkStatistics();
                return $staticFrom->searchStatistics();
            }
        }
        //Ищем и выводим все данные из таблиц
        $statistics = $staticFrom->searchStatistics();
        $players = $playFrom->searchPlayers();
        $characters =$charFrom->searchCharacters();

        return $this->render('index', [
            'model' => $staticFrom,
            'players' => $players,
            'characters' => $characters,
            'statistics'=> $statistics,
        ]);
    }

    //Действие для обработки и отправки данных на view - characters(Характеристика)
    public function actionCharacters()
    {
        $charFrom = new CharactersFrom();
         if(Yii::$app->request->isAjax){
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    if($charFrom->load(Yii::$app->request->post()) && $charFrom->validate()){
                        if ($charFrom->addCharacters()) {
                            return $charFrom->searchCharacters();
                        }
                    }
                }
        $characters = $charFrom->searchCharacters();
        return $this->render('characters', [
            'characters' => $characters,
            'model' => $charFrom,
        ]);
    }

    //Удаление характеристики по id
    public function actionDelchar()
    {
        $playFrom = new CharactersFrom();
        $request = Yii::$app->request;
        $playFrom->deleteChar($request->post('id_char'));
        //Запускаем actionCharacters
        return Yii::$app->runAction('players/characters');
    }

    //Действие для обработки и отправки данных на view - players(Футболисты)
    public function actionPlayers()
    {
        $playFrom = new PlayersForm();

        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($playFrom->load(Yii::$app->request->post()) && $playFrom->validate()){
                if ($playFrom->addPlayers()) {
                    return $playFrom->searchPlayers();
                }
            }
        }

        $players = $playFrom->searchPlayers();
        return $this->render('players', [
            'players' => $players,
            'model' => $playFrom,
        ]);

    }

    //Удаление футболиста по id
    public function actionDelplayer()
    {
        $playFrom = new PlayersForm();
        $request = Yii::$app->request;
        $playFrom->deletePlayers($request->post('id_name'));
        //Запускаем actionPlayers
        return Yii::$app->runAction('players/players');
    }

}