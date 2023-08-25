<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'

    ])
    ?>


    <?= $form->field($model, 'imageFile', [
        'template' => '
            
             <div class="input-group mb-3">
                 <div class="custom-file">
                 {input}
                    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        {label}   
                    {error}
                 </div>
            </div>
                    ',
        'labelOptions'=>['class'=>'custom-file-label'],
        'inputOptions'=>['class'=>'custom-file-input']
    ])->textInput(['type'=>'file']) ?>

    <?= $form->field($model, 'price')->textInput([
        'maxlength' => true,
        'type' => 'number'
    ]) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
