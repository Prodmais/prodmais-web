<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use kartik\date\DatePicker;
?>

<div class="tasks-form">

    <?php
      $form = ActiveForm::begin([
      'id' => 'default-form',
      'options' => ['enctype'=>'multipart/form-data']
      ]);
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php
        // update
        if (!$model->isNewRecord) {
            $model->endDate =
            date("d/m/Y", strtotime($model->endDate));
        } else { //create
            $model->endDate = date('d/m/Y');
        }

        echo $form->field($model, 'endDate')->widget(DatePicker::classname(), [
        // 'value' => date('d/m/Y'),
        'removeButton' => false,
        'language' => 'pt',
        'options' => [
            // 'orientation' => 'bottom',
            // 'id' => 'xyz',
            'class' => 'form-control',
            'autocomplete' => 'off',
            'placeholder' => 'dd/mm/yyyy'
        ],
        'pluginOptions' => [
            'orientation' => 'bottom',
            'autoclose' => true,
            'format' => 'dd/mm/yyyy',
            'todayHighlight' => true,
            // 'startDate' => date("d/m/Y")
        ],
        'pluginEvents' => [
            'changeDate' => "function(e){
        }"]
        ])->label('Data de finalização');
    ?>

    <div class="form-group">

      <!-- SubmitButton Widget -->
      <div id="submit-real"><?php echo \app\widgets\submitButton\SubmitButtonWidget::widget([]) ?></div>
      <div hidden id="submit-fake">
        <button type="button" id="" class="btn-lg btn-block btn btn-success">
            <i class="fa fa-spinner fa-spin"></i>
        </button><br>
      </div>

      <?php if(!$model->isNewRecord): ?>
        <button onclick="excluirTarefaAjax('<?= $model->id ?>')" type="button" id="" class="btn btn-block btn btn-danger">
          <i class="fa fa-trash-o"></i> EXCLUIR
        </button>
      <?php endif ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
  // Validando o formulario via Ajax e evitando redirect
  $this->registerJs("
  $(document).ready(function(){

    $('#default-form').on('beforeSubmit', function(e) {

      $('#submit-real').toggle();
      $('#submit-fake').toggle();

      var form = $(this);
      var formData = form.serialize();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data) {

          if(data != 1) {

            swal(\"Ops!\", \"1 ou mais campos estão inválidos!\", \"error\");
            $('#submit-fake').toggle();
            $('#submit-real').toggle();

          } else {

            swal({

              title: 'Sucesso!',
              text: 'Tarefa salva com sucesso!',
              type: 'success',
              confirmButtonText: 'Ok!',
              closeOnConfirm: true,
              closeOnCancel: false

            },
            function(isConfirm){
              if (isConfirm) {
                $('.modal-backdrop').hide();
                $('.modal').modal('hide');
                $('body').removeClass('modal-open');
                carregaQuadrosUsuario();
              }
            });

          }

        },
        error: function () {
          $('#submit-fake').toggle();
          $('#submit-real').toggle();
        }
      });
    }).on('submit', function(e){
        e.preventDefault();
    });
  });", \yii\web\View::POS_READY, Yii::$app->getSecurity()->generateRandomString());
?>

<?php
  // @DESC excluir tarefa
  $this->registerJs("
  function excluirTarefaAjax(id) {

    swal({
      title: 'Excluir task!?',
      text: 'Deseja remover o item selecionado?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Sim, remover!',
      cancelButtonText: 'Não, cancelar!',
      closeOnConfirm: true,
      closeOnCancel: true
    },
    function(isConfirm){

      if (isConfirm) {

        $.ajax({
          beforeSend: function () { $('.div-loader').show(); },
          complete:   function () { $('.div-loader').hide(); },
          url: '". Yii::$app->urlManager->createUrl(['tasks/remover-ajax']) ."',
          data:{
            id: id
          },
          type: 'POST',
          cache: false,
          success: function(data)
          {
            $('.modal-backdrop').hide();
            $('.modal').modal('hide');
            carregaQuadrosUsuario();
          },
          error: function(data) {
          },

        });

      }

    });

  };", \yii\web\View::POS_HEAD, Yii::$app->getSecurity()->generateRandomString());
?>
