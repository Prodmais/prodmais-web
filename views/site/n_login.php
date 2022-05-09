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

    <?= $form->field($model, 'name')->textInput(['autocomplete' => 'on', 'placeholder'=>'informe seu username', 'autofocus' => true])->label('Username:') ?>

    <?= $form->field($model, 'password')->passwordInput(['autocomplete' => 'new-password', 'placeholder'=>'******'])->label('Password:') ?>

    <div style="margin-top: 3em;" class="form-group">

      <div id="div-loader-ajax" style="display: none;">

        <?php echo Html::button('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>',[
            'class' => Html::encode('btn-block btn btn-success')
          ])
        ?>

      </div>

      <div id="div-button-submit">
        <?php echo Html::submitButton(Html::encode('ENTRAR'), [
            'id' => '',
            'class' => Html::encode('btn-block btn btn-success')
          ])
        ?>
      </div>

      <div style="margin-top: 15px" >
        <?= Html::a('CADASTRAR', ['/users/cadastrar'], ['class'=>'btn btn-block btn-primary']); ?>
      </div>

    </div>

    <?php
      $this->registerJsFile(
        'web/custom/js/auto-button-ajax-form.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
      );
    ?>

  <?php ActiveForm::end(); ?>

</div>
