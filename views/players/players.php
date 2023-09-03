<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
?>

<h1>Футболисты</h1>
    <div class="container" >
<!--Выводим всех футболистов-->
        <div class="row" id="player-container">
            <?php foreach ($players as $player): ?>
            <div class="col-3">
                <?= Html::encode("{$player->name}") ?>
            </div>
<!--Удаляем по id-->
            <div class="col-7">
                <?= Html::a('Удалить', ['/players/delplayer'],
                    ['data' => [
                            'method' => 'post',
                            'params' => ['id_name' => $player->id_name],
                        ],
                    'class'=>'btn btn-outline-danger btn-sm'
                    ]);?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

<!--Форма для добавления новых футболитов-->
<!--Добавляем с помощью ajax в js/players.js-->
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation'   => false,
        'action' => Url::to(['players/players']),
        'method' => 'post',
        'options' => ['id' => 'form-play']
    ]) ?>
        <div id="name_ipnut">
            <?= $form->field($model, 'name')->textInput(); ?>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-outline-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end() ?>
