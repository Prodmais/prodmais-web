<?php
  // Ajax create
  $this->registerJs("
  function cadastrarTarefaAjax(id) {

    $('#modal_custom').modal();
    $('#label_modal').html('Nova task');

    $.ajax({
      beforeSend: function () { $('.div-loader').show(); },
      complete:   function () { $('.div-loader').hide(); },
      url: '". Yii::$app->urlManager->createUrl([ '/tasks/create-ajax' ]) ."',
      data: {
        id: id
      },
      type: 'GET',
      cache: false,
      success: function(data)
      {
        $('#modalContentItem').html(data);
      },
      error: function(data) {
      },

    });

  };", \yii\web\View::POS_HEAD, Yii::$app->getSecurity()->generateRandomString());
?>

<?php
  // Ajax update
  $this->registerJs("
  function atualizarTarefaAjax(id) {

    $('#modal_custom').modal();
    $('#label_modal').html('Atualizar task');

    $.ajax({
      beforeSend: function () { $('.div-loader').show(); },
      complete:   function () { $('.div-loader').hide(); },
      url: '". Yii::$app->urlManager->createUrl([ 'tasks/update-ajax' ]) ."',
      data:{
        id: id
      },
      type: 'GET',
      cache: false,
      success: function(data)
      {
        $('#modalContentItem').html(data);
      },
      error: function(data) {
      },

    });

  };", \yii\web\View::POS_HEAD, Yii::$app->getSecurity()->generateRandomString());
?>

<?php
  // @DESC excluir quadro
  $this->registerJs("
  function alterarStatus(id) {

    swal({
      title: 'Alterar Status!?',
      text: 'Deseja alterar o item selecionado?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Sim, alterar!',
      cancelButtonText: 'Não, cancelar!',
      closeOnConfirm: true,
      closeOnCancel: true
    },
    function(isConfirm){

      if (isConfirm) {

        $.ajax({
          beforeSend: function () { $('.div-loader').show(); },
          complete:   function () { $('.div-loader').hide(); },
          url: '". Yii::$app->urlManager->createUrl(['tasks/alterar-status']) ."',
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
