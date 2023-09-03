<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Url;
?>

<h1>Статистика</h1>
<!--Форма с выбором игрока и характеристики из списка-->
<!--Добавляем с помощью ajax в js/statistics.js-->
    <?php $form = ActiveForm::begin([
        'action' => Url::to(['players/index']),
        'method' => 'post',
        'options' => ['id' => 'myForm']
    ]) ?>
        <div class="container border border-5">
            <div id="main_block">
                <div class="row">
                    <div class="col  col-lg-auto">
                        <?php echo  $form->field($model, 'player')->textInput()->dropDownList(
                            ArrayHelper::map($players, 'id_name', 'name'), ['id' => 'name_list']);?>
                    </div>
                </div>
                <div class="block" id="block">
                    <div id="clone_1" class="row">
                        <div class="col col-lg-auto">
                            <?php echo  $form->field($model, 'character')->dropDownList(
                                ArrayHelper::map($characters, 'id_char', 'character'), ['id' => 'char_list']);?>
                        </div>
                        <div class="col col-lg-auto">
                            <?php $points = [
                                '1'=>1,
                                '2'=>2,
                                '3'=>3,
                                '4'=>4,
                                '5'=>5,
                            ];
                            echo  $form->field($model, 'point')->dropDownList($points, ['id' => 'point_list']);?>
                        </div>
                    </div>
                </div>
<!--Добавляем блок с характеристикой-->
                <?= Html::button('', ['class' => 'image-button', 'id'=>'btn_plus']) ?>
            </div>
<!--Невидимые поля ввода. Сюда с помощью js заполняется набор характеритик-->
            <?= $form->field($model, 'character',)->hiddenInput(['id' => 'char_input'])->label(false); ?>
            <?= $form->field($model, 'point')->hiddenInput(['id' => 'point_input'])->label(false); ?>
            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <div class="col-lg-offset-1 col-lg-11">
                        <?= Html::button('Добавить', ['class' => 'btn btn-primary', 'id'=>'btn_main']) ?>
                    </div>
                </div>
            </div>
        </div>
<!--Табличный вывод статистики из БД-->
        <table class="table" id="table">
            <thead>
                <tr>
                    <th scope="col">Футболист</th>
                    <th scope="col">Характеристика</th>
                    <th scope="col">Оценка</th>
                </tr>
            </thead>
            <tbody id="statistic-container">
                <?php foreach ($statistics as $statistic): ?>
                    <tr>
                        <td>
                            <?= Html::encode("{$statistic['name']}") ?>
                        </<td>
                        <td>
                            <?= Html::encode("{$statistic['character']}") ?>
                        </<td>
                        <td>
                            <?= Html::encode("{$statistic['point']}") ?>
                        </<td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php ActiveForm::end();?>

