<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="login-box-body">

    <h4 style="text-align: center;">Preencha o fomulário abaixo para completar seu cadastro</h4>
    <hr>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email']) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_confirm')->passwordInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'pess_telefone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <!-- SubmitButton Widget -->
        <?php echo Html::submitButton(Html::encode('CADASTRAR'), [
            'id' => '',
            'class' => Html::encode('btn-block btn btn-success')
          ])
        ?>
    </div>

      <div style="margin-top: 15px" >
         <?= Html::a('ENTRAR', ['/site/login'], ['class'=>'btn btn-block btn-primary']); ?>
      </div>

    <?php ActiveForm::end(); ?>

</div>
