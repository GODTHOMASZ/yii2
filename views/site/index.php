<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var yii\bootstrap4\Modal */
/** @var app\models\MainForm $model */
/** @var app\models\MainForm */

$this->title = 'Test task app';
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Button;
use yii\bootstrap4\Modal;
use yii\helpers\ArrayHelper;

?>
<div class="site-index">
    <div class="body-content">
        <?php $form = ActiveForm::begin([
            'id' => 'main-form',
            'layout' => 'inline',
            'fieldConfig' => [
                'template' => "{input}\n{error}",
                'inputOptions' => ['class' => 'col-lg-3 form-control'],
                'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
            ],
        ]);
        ?>
        <div class="">
            <div class="col-lg-4">
                <h2>Заказы</h2>
            </div>
            <div class="col-lg-12 border border-dark">
                <h6>Фильтр</h6>
                <?=$form->field($model, 'date')->textInput() ?>
                <?=$form->field($model, 'cost')->textInput() ?>
                <p></p>
                <?php echo Button::widget([
                'label' => 'Применить',
                'options' => ['class' => 'btn btn-primary'],
                ]);

                ?>
                <?= Html::submitButton('Сбросить', ['class' => 'btn btn-primary', 'name' => 'reset-button']) ?>
                <p></p>
            </div>
            <p></p>

            <p><?= Html::submitButton('Добавить заказ', ['class' => 'btn btn-primary', 'name' => 'reset-button']) ?></p>
            <div class="col-lg-4">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ФИО</th>
                        <th scope="col">Работы</th>
                        <th scope="col">Дата начала</th>
                        <th scope="col">Дата окончания</th>
                        <th scope="col">Стоимость</th>
                        <th scope="col">Исполнитель</th>
                        <th scope="col">Исполнитель</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($orders as $order): ?>
                        <?php foreach ($executors as $executor): ?>
                            <?php if($order->id==$executor->ordernum || strtotime($today)<=strtotime($order->startdate))
                            {
                                echo '<tr class="bg-white text-dark">';
                                break;
                            }
                            else
                            {
                                echo '<tr class="text-dark bg-danger">';
                            }
                            ?>
                        <?php endforeach; ?>
                            <td>
                                <?php foreach ($users as $userr): ?>
                                    <?php if($userr->id==$order->user){
                                        echo Html::encode($userr->fio);
                                    }?>
                                <?php endforeach; ?>
                            </td>
                            <td><?= Html::encode($order->works) ?></td>
                            <td><?= Html::encode($order->startdate) ?></td>
                            <td><?= Html::encode($order->enddate) ?></td>
                            <td><?= Html::encode($order->cost) ?></td>
                            <td>
                                <?php foreach ($executors as $executor): ?>
                                    <?php if($order->id==$executor->ordernum){
                                        foreach($users as $userrr){
                                            if($userrr->id==$executor->userexecutor){
                                                echo Html::encode($userrr->fio);
                                            }
                                        }
                                    }?>
                                <?php endforeach; ?>
                            </td>
                            <td>
                                <?php Modal::begin([
                                    'title' => 'Назначить исполнителя',
                                    'toggleButton' => ['label' => 'Назначить исполнителя'],
                                ]);
                                $items = ArrayHelper::map($users,'id','fio', 'role');
                                $params = [
                                    'prompt' => 'Список исполнителей'
                                ];
                                echo $form->field($model, 'cost')->dropDownList($items[2],$params);
                                echo $form->field($model, 'cost')->textarea(['rows' => 6, 'cols' => 5])->label('Многострочное текстовое поле');
                                echo Html::submitButton('Назначить', ['class' => 'btn btn-primary', 'name' => 'apply-button']);
                                echo Html::submitButton('Отменить', ['class' => 'btn btn-primary', 'name' => 'apply-button']);

                                Modal::end();
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php ActiveForm::end(); ?>

        </div>

    </div>
</div>
