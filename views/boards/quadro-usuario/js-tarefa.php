<?php
  // Ajax create
  $this->registerJs("
  function cadastrarTarefaAjax(id) {

    $('#modal_custom').modal();
    $('#label_modal').html('NOVA TASK');

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
    $('#label_modal').html('ATUALIZAR TASK');

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
