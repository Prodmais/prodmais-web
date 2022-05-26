<?php
  use yii\helpers\Html;
  use yii\bootstrap\ActiveForm;
  $this->title = 'Acessar - Prodmais';
?>

  <!-- /.login-logo -->
<div class="login-box-body">

    <h4 style="text-align: center;">Preencha os campos abaixo para acessar sua conta</h4>
    <hr>


  <?php
    $form = ActiveForm::begin([
      'id' => 'default-form',
      'options' => [
        'enctype'=>'multipart/form-data',
        'autocomplete' => 'new-password'
      ]
    ]);
  ?>

    <?= $form->field($model, 'name')->textInput(['autocomplete' => 'on', 'placeholder'=>'email', 'autofocus' => true])->label('Email:') ?>

    <?= $form->field($model, 'password')->passwordInput(['autocomplete' => 'new-password', 'placeholder'=>'******'])->label('Password:') ?>

    <div style="margin-top: 3em;" class="form-group">

      <div class="form-group">
        <!--" SubmitButton Widget -->
        <?php echo \app\widgets\submitButton\SubmitButtonWidget::widget([
          'text' => 'ENTRAR',
          'classButton' => 'btn-block btn btn-default'
        ]) ?>
      </div>

      <div style="margin-top: 15px" >
        <?= Html::a('CADASTRAR', ['/users/cadastrar'], ['class'=>'btn btn-block btn-primary']); ?>
      </div>

    </div>

  <?php ActiveForm::end(); ?>

</div>
