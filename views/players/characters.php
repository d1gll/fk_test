<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
?>

<h1>Характеристика</h1>
    <div class="container">
        <div class="row" id="character-container">
<!--Выводим все характиритики-->
            <?php foreach ($characters as $character): ?>
                <div class="col-3">
                    <?= Html::encode("{$character->character}") ?>
                </div>
                <div class="col-7">
<!--Удаляем по id-->
                    <?= Html::a('Удалить', ['/players/delchar'],
                        ['data' => [
                            'method' => 'post',
                            'params' => ['id_char' => $character->id_char],
                        ],
                            'class'=>'btn btn-outline-danger btn-sm'
                        ]);?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<!--Форма для добавления новой характритики-->
<!--Добавляем с помощью ajax в js/characters.js-->
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation'   => false,
        'action' => Url::to(['players/characters']),
        'method' => 'post',
        'options' => ['id' => 'form-char'],
    ]) ?>
        <?= $form->field($model, 'character')->textInput(); ?>
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-outline-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end() ?>

