<!-- @DESC assim que entrar na pagina carrega os itens via ajax -->
<?php
  // carregando os itens
  $this->registerJs("
  $(document).ready(function(){

    carregaQuadrosUsuario();

  });", \yii\web\View::POS_READY, Yii::$app->getSecurity()->generateRandomString());
?>

<?php
  // @DESC recebe todas as quadros do usuario
  $this->registerJs("
  function carregaQuadrosUsuario() {
    $.ajax({
      beforeSend: function () { $('.div-loader').show(); },
      complete:   function () { $('.div-loader').hide(); },
      url: '". Yii::$app->urlManager->createUrl(['boards/all-quadros']) ."',
      type: 'GET',
      cache: false,
      success: function(data) {
        $('#contentQuadroUsuario').html(data);
      },
      error: function(data) {
        alert('Oops algo não foi bem!')
      },
    });
  };", \yii\web\View::POS_HEAD, Yii::$app->getSecurity()->generateRandomString());
?>

<?php
  // Ajax create
  $this->registerJs("
  function cadastrarAjax() {

    $('#modal_custom').modal();
    $('#label_modal').html('Novo board');

    $.ajax({
      beforeSend: function () { $('.div-loader').show(); },
      complete:   function () { $('.div-loader').hide(); },
      url: '". Yii::$app->urlManager->createUrl([ 'boards/create-ajax' ]) ."',
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
  function atualizarAjax(id) {

    $('#modal_custom').modal();
    $('#label_modal').html('Atualizar board');

    $.ajax({
      beforeSend: function () { $('.div-loader').show(); },
      complete:   function () { $('.div-loader').hide(); },
      url: '". Yii::$app->urlManager->createUrl([ 'boards/update-ajax' ]) ."',
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
  function excluirQuadro(id) {

    swal({
      title: 'Excluir board!?',
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
          url: '". Yii::$app->urlManager->createUrl(['boards/remover-ajax']) ."',
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

      } else {
      }

    });

  };", \yii\web\View::POS_HEAD, Yii::$app->getSecurity()->generateRandomString());
?>
