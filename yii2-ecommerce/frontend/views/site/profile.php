<?php


/** @var \common\models\User $user */

/** @var \common\models\UserAddress $userAdress */

/** @var  \yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Address information
            </div>
            <div class="card-body">
                <?php echo $this->render('user_address',[
                        'userAddress'=>$userAdress
])?>

            </div>
        </div>
    </div>


    <div class="col">
        <div class="card">
            <div class="card-header">
                Account information
            </div>

            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>
                <div class="titlt"></div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($user, 'firstname')->textInput(['autofocus' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($user, 'lastname')->textInput(['autofocus' => true]) ?>
                    </div>
                </div>
                <?= $form->field($user, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($user, 'email') ?>

                <?= $form->field($user, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
