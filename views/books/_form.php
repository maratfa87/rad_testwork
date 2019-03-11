<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Author;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="book-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'publishing_year')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ISBN')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'pages_count')->textInput() ?>
    <?= $form->field($model, 'authors')
        ->dropDownList(Author::getAllAuthorsArray(), ['multiple'=>'multiple'])
        ->label('Authors')
    ?>
    <?= Html::fileInput('imageFile') ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
