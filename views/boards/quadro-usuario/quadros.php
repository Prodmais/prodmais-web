<!-- Listando todos os quadros e suas atividades -->
<div class="quadro-usuario-index testimonial-group">
   <div class="row" >

      <?php foreach ($dataQuadro as $key => $value): ?>

         <div class="my-custom-col" >
            <div class="box box-default" style="position: relative; left: 0px; top: 0px;">
               <div class="box-header ui-sortable-handle overflow-spaces" >
                  <h3 class="box-title"><?php echo ucfirst($value['name']) ?></h3>
                  <div class="box-tools pull-right">

                     <?php if (!$value->isMobile): ?>
                        <div class="tools" style="cursor: pointer;">
                           <i onclick="atualizarAjax('<?= $value['id'] ?>')" style="color: #00AFB7" class="fa fa-edit"></i>
                           <i onclick="excluirQuadro('<?= $value->id ?>')" style="color: #dd4b39" class="fa fa-trash-o"></i>
                        </div>
                     <?php endif ?>

                  </div>
               </div>
               <div class="box-body">
                  <?php require(__DIR__ . '/tarefas.php'); ?>
               </div>
            </div>
         </div>

      <?php endforeach ?>

   </div>
</div>

<?php
  // Ajax get size
  $this->registerJs("
      if ($(window).width() >= 820) {
         $('.my-custom-col').addClass('col-xs-2'); 
      } else {
         $('.my-custom-col').addClass('col-xs-12');       
      }
  ", \yii\web\View::POS_LOAD, Yii::$app->getSecurity()->generateRandomString());
?>
