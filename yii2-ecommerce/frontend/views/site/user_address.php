<?php

/** @var  \yii\web\View $this */
/** @var \common\models\UserAddress $userAddress */
?>



<?php use yii\helpers\Html;
use yii\widgets\ActiveForm;

\yii\widgets\Pjax::begin() ?>
<?php if (isset($success) && $success): ?>

    <div class="alert alert-succes">
        Your address was successfully updated

    </div>
<?php endif?>
<?php $addressForm = ActiveForm::begin([
    'action' => ['/site/update-address'],
    'options' => [
        'data-pjax' => 1

    ]
]); ?>
<?= $addressForm->field($userAddress, 'address') ?>
<?= $addressForm->field($userAddress, 'city') ?>
<?= $addressForm->field($userAddress, 'state') ?>
<?= $addressForm->field($userAddress, 'country') ?>
<?= $addressForm->field($userAddress, 'zipcode') ?>
<?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>

<?php ActiveForm::end() ?>
<?php \yii\widgets\Pjax::end() ?>
