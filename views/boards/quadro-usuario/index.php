<?php
  // pop out
  use yii\bootstrap\Modal;
  Modal::begin([
      'header' => '
          <p class="h3" id="label_modal"> </p>
      ',
      'id' => 'modal_custom',
      'class' => 'modal modal-large-custom',
      'size' => 'modal-lg',
      ]);
  echo "<div id='modalContentItem'> </div>";
  Modal::end();
?>

<style>
/* Estilizando horizontal com scroll */
.testimonial-group > .row {
   overflow-x: auto;
   white-space: nowrap;
   }
.testimonial-group > .row > .col-xs-3 {
   display: inline-block;
   float: none;
}
</style>

<!-- Botão para cadastrar novo quadro -->
<div class="row" style="text-align: center;">
   <div class="col-lg-4 col-lg-offset-4">
      <button onclick="cadastrarAjax()" type="button" class="btn btn-success">
         <i class="fa fa-plus"></i> QUADRO
      </button>
   </div>
</div>

<br>

<!-- div onde será exibido os quadros -->
<div id="contentQuadroUsuario"></div>

<!-- funcoes JS -->
<?php require(__DIR__ . '/js-quadro.php'); ?>
<?php require(__DIR__ . '/js-tarefa.php'); ?>