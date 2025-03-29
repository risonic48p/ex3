<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\ShortLinks $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Сервис коротких ссылок';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'short-links-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-11 col-form-label mr-lg-11'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <div class="form-group">
            <?= $form->field($model, 'url')->textInput(['autofocus' => true])->label('Укажите вашу ссылку') ?>
            </div>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('ОК', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>


            <?php if (Yii::$app->session->hasFlash('shortLinkHasCreated')): ?>

                <div class="alert alert-success">
                    Благодарим за использование нашего сервиса. Получить Вашу коротку ссылку можно ниже.
                </div>

            <div class="form-group">
                <code>
                    <a href="<?=$model->getShortLink(); ?>" target="_blank" class="btn btn-primary"><?=$model->getShortLink(); ?></a>
                </code>
            </div>

            <div class="form-group">
                <img class="d-auto" src="<?=$model->getQrCode()->writeDataUri();?>">
            </div>
            <p>Наведите камеру телефона, что-бы отсканировать QR код.
                С его помощью Вы тоже можете перейти по вашей короткой ссылке.</p>
            <?php endif; ?>

        </div>
    </div>
</div>
