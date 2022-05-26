<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
?>

<div class="boards-form">

    <?php
        $form = ActiveForm::begin([
        'id' => 'default-form',
        'options' => ['enctype'=>'multipart/form-data']
        ]);
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description', [])
    ->textArea([
        'autofocus' => false,
        'placeholder'=>'Description.',
        'rows' => 6,
        'style' => 'resize:none'
    ])?>

    <div class="form-group">
        <!-- SubmitButton Widget -->
        <div id="submit-real"><?php echo \app\widgets\submitButton\SubmitButtonWidget::widget([]) ?></div>
        <div hidden id="submit-fake">
            <button type="button" id="" class="btn-lg btn-block btn btn-success">
                <i class="fa fa-spinner fa-spin"></i>
            </button>
        </div>
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
            beforeSend: function () { $('.div-loader').show(); },
            complete:   function () { $('.div-loader').hide(); },
            url: form.attr('action'),
            type: form.attr('method'),
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {

                if(data != 1) {

                    swal(\"OPS!\", \"1 ou mais campos estão inválidos!\", \"error\");
                    $('#submit-fake').toggle();
                    $('#submit-real').toggle();

                } else {

                  swal({

                    title: 'SUCESSO!',
                    text: 'Board salvo sucesso!',
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
                        // carregaQuadrosUsuario();
                        window.location.replace('".Yii::$app->urlManager->createUrl('/boards')."');
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
